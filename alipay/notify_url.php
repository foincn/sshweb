<?php
/*
	*���ܣ���������з�����֪ͨҳ��
	*�汾��2.0
	*���ڣ�2008-08-01
	*�������ڣ�2010-4-22
	'˵����
	'���´���ֻ�Ƿ����̻����ԣ��ṩ���������룬�̻����Ը����Լ���վ����Ҫ�����ռ����ĵ���д,����һ��Ҫʹ�øô��롣
	'�ô������ѧϰ���о�֧�����ӿ�ʹ�ã�ֻ���ṩһ���ο���

*/

///////////ҳ�湦��˵��///////////////
//������ҳ���ļ�ʱ�������ĸ�ҳ���ļ������κ�HTML���뼰�ո�
//��֧�����Ķ���״̬�ı�ʱ��֧��������������Զ����ô�ҳ�棬���������������վ������Ϣ��֧�����ϵĶ�����ͬ������
//��ҳ�治���ڱ������Բ��ԣ��뵽�������������ԣ����������ܹ����ʵõ����ҳ�漴�ɡ�
//��ҳ����Թ�����ʹ��д�ı�����log_result���ú����ѱ�Ĭ�Ͽ�������alipay_notify.php�еĺ���notify_verify
/////////////////////////////


require_once ("alipay_notify.php");
require_once ("alipay_config.php");
$alipay = new alipay_notify ( $partner, $security_code, $sign_type, $_input_charset, $transport );
$verify_result = $alipay->notify_verify ();
if ($verify_result) { //��֤�ϸ�
	//��ȡ֧�����ķ�������
	$dingdan = $_POST ['out_trade_no']; //��ȡ֧�������ݹ����Ķ�����
	$total = $_POST ['price']; //��ȡ֧�������ݹ������ܼ۸�
	

	/*
	��ȡ֧��������������״̬,���ݲ�ͬ��״̬���������ݿ� 
	WAIT_BUYER_PAY(��ʾ�ȴ���Ҹ���);
	TRADE_FINISHED(��ʾ�����Ѿ��ɹ�����);
*/
	
	//�����������֧�����Ĺ�����ܣ����ڷ��ص���Ϣ���治Ҫ�������жϣ���������У��ͨ���������ֶ����޷����¡��������Ҫ��ȡ�����ʹ�ù����Ľ��,
	//���ȡ������Ϣ������ֶ�discount��ֵ��ȡ����ֵ��������Ҹ����ŻݵĽ��� ԭ�������ܽ��=��Ҹ���صĽ��total_fee +|discount|.
	if ($_POST ['trade_status'] == 'WAIT_BUYER_PAY') { //����״̬���ȴ���Ҹ���
		//���뽻��״̬�Ƕ������״�����δ��������ݿ���³�����룬Ҳ�ɲ������κδ��롣
		echo "success";
		//log_result("verify_success");
	} else if ($_POST ['trade_status'] == 'WAIT_SELLER_SEND_GOODS') { //����״̬������Ѹ���ȴ����ҷ���
		//���붩��������ɺ�����ݿ���³�����룬����ر�֤echo��������Ϣֻ��success
		echo "success";
		$pay_money = $_POST ['total_fee'];
		$receive_user = $_POST ['receive_name'];
		
		switch ($pay_money) {
			case 45 :
				$add = 12;
				break;
			case 25 :
				$add = 6;
				break;
			case 13 :
				$add = 3;
				break;
			case 4.5 :
				$add = 1;
				break;
			case 0.01 :
				$add = 2;
				break;
			default :
				$add = 0;
		}
		$server = "174.140.166.123:3306";
		$user = "ssh";
		$pass = "buptisc";
		
		@mysql_connect ( $server, $user, $pass );
		@mysql_select_db ( 'ssh' );
		$sql = "select * from user where name='$receive_user'";
		
		$result = mysql_query ( $sql );
		$in_user = mysql_fetch_array ( $result );
		$pay_date = date ( "Y-m-d" );
		
		if ($in_user ['overtime'] == '') {
			//not paid person!
			$r = substr ( $pay_date, 8, 2 ); //��
			$y = substr ( $pay_date, 5, 2 ); //��
			$n = substr ( $pay_date, 0, 4 ); //��
			$end_date = date ( "Y-m-d", mktime ( 0, 0, 0, $y + $add, $r + 1, $n ) );
		
		} else {
			if (date ( "Y-m-d", strtotime ( $in_user ['overtime'] ) ) > date ( "Y-m-d" )) {
				$r = substr ( $in_user ['overtime'], 8, 2 ); //��
				$y = substr ( $in_user ['overtime'], 5, 2 ); //��
				$n = substr ( $in_user ['overtime'], 0, 4 ); //��
				$end_date = date ( "Y-m-d", mktime ( 0, 0, 0, $y + $add, $r + 1, $n ) );
				///echo "Y";
			} else {
				$r = substr ( $pay_date, 8, 2 ); //��
				$y = substr ( $pay_date, 5, 2 ); //��
				$n = substr ( $pay_date, 0, 4 ); //��
				$end_date = date ( "Y-m-d", mktime ( 0, 0, 0, $y + $add, $r + 1, $n ) );
				//echo "N";
			}
		}
		$sql = "update user set paytime='$pay_date',overtime='$end_date',pay=pay+'$pay_money' where name = '$receive_user'";
		$result = mysql_query ( $sql );
		
		//�������ڷ������Ͻ��˺�
		$sql = "select * from user where name='$receive_user'";
		$result = mysql_query ( $sql );
		$in_user = mysql_fetch_array ( $result );
		
		require_once '../servers.php';
		foreach ( $servers as $server ) {
			$url = "http://$server:9999/cgi-bin/system_adduser.cgi?name=$receive_user&pass=".$in_user['password']."&date=$end_date";
			@file_get_contents ( $url );
		}
		//@exec("../../fetion/fx/sms alipay::::$receive_user",$ret);
		
		
		
		
	//log_result($_POST);
	} else if ($_POST ['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS') { //����״̬�������ѷ����ȴ����ȷ���ջ�
		//���붩��������ɺ�����ݿ���³�����룬����ر�֤echo��������Ϣֻ��success
		echo "success";
		
	//log_result("verify_success");
	} else if ($_POST ['trade_status'] == 'TRADE_FINISHED') { //����״̬�����׳ɹ�����
		//���붩��������ɺ�����ݿ���³�����룬����ر�֤echo��������Ϣֻ��success
		echo "success";
		
	//log_result("verify_success");
	} else { //���ø��ཻ��״̬����http://club.alipay.com/read-htm-tid-8681385-fpage-2.html
		echo "success";
		//log_result ("verify_failed");
	}
} else { //��֤���ϸ�
	echo "fail";
	//log_result ("verify_failed");
}
?>