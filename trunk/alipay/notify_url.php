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

require_once("alipay_notify.php");
require_once("alipay_config.php");
$alipay = new alipay_notify($partner,$security_code,$sign_type,$_input_charset,$transport);
$verify_result = $alipay->notify_verify();
if($verify_result) {   //��֤�ϸ�
 //��ȡ֧�����ķ�������
    $dingdan  = $_POST['out_trade_no'];	//��ȡ֧�������ݹ����Ķ�����
    $total    = $_POST['price'];		//��ȡ֧�������ݹ������ܼ۸�
	
/*
	��ȡ֧��������������״̬,���ݲ�ͬ��״̬���������ݿ� 
	WAIT_BUYER_PAY(��ʾ�ȴ���Ҹ���);
	TRADE_FINISHED(��ʾ�����Ѿ��ɹ�����);
*/

//�����������֧�����Ĺ�����ܣ����ڷ��ص���Ϣ���治Ҫ�������жϣ���������У��ͨ���������ֶ����޷����¡��������Ҫ��ȡ�����ʹ�ù����Ľ��,
//���ȡ������Ϣ������ֶ�discount��ֵ��ȡ����ֵ��������Ҹ����ŻݵĽ��� ԭ�������ܽ��=��Ҹ���صĽ��total_fee +|discount|.
	if($_POST['trade_status'] == 'WAIT_BUYER_PAY') {         //����״̬���ȴ���Ҹ���
		//���뽻��״̬�Ƕ������״�����δ��������ݿ���³�����룬Ҳ�ɲ������κδ��롣
		echo "success";
		//log_result("verify_success");
	}
	else if($_POST['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {    //����״̬������Ѹ���ȴ����ҷ���
        //���붩��������ɺ�����ݿ���³�����룬����ر�֤echo��������Ϣֻ��success
		echo "success";

		log_result($_POST);
	}	
	else if($_POST['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS') {    //����״̬�������ѷ����ȴ����ȷ���ջ�
        //���붩��������ɺ�����ݿ���³�����룬����ر�֤echo��������Ϣֻ��success
		echo "success";

		//log_result("verify_success");
	}	
	else if($_POST['trade_status'] == 'TRADE_FINISHED') {    //����״̬�����׳ɹ�����
        //���붩��������ɺ�����ݿ���³�����룬����ر�֤echo��������Ϣֻ��success
		echo "success";

		//log_result("verify_success");
	}	
	else {//���ø��ཻ��״̬����http://club.alipay.com/read-htm-tid-8681385-fpage-2.html
		echo "success";
		//log_result ("verify_failed");
	}
}
else {    //��֤���ϸ�
	echo "fail";
	//log_result ("verify_failed");
}
?>