<?php
/*
	*���ܣ���������ת��ҳ��
	*�汾��2.0
	*���ڣ�2008-08-01
	*�������ڣ�2010-4-22
	'˵����
	'���´���ֻ�Ƿ����̻����ԣ��ṩ���������룬�̻����Ը����Լ���վ����Ҫ�����ռ����ĵ���д,����һ��Ҫʹ�øô��롣
	'�ô������ѧϰ���о�֧�����ӿ�ʹ�ã�ֻ���ṩһ���ο���
	
*/

///////////ҳ�湦��˵��///////////////
//��ҳ����ڱ������Բ���
//��ҳ�����������ҳ������ͬ����֧���������������ã��ɵ�����֧����ɺ����ʾ��Ϣҳ���硰����ĳĳĳ���������ٽ����֧���ɹ�����
//�ɷ���HTML������ҳ��Ĵ��롢����������ɺ�����ݿ���³������
//��ҳ����Թ��߿���ʹ��PHPӵ�еĶϵ���Թ���Zend Studio��Ҳ����ʹ��д�ı�����log_result���ú����ѱ�Ĭ�Ϲرգ���alipay_notify.php�еĺ���return_verify
/////////////////////////////

require_once("alipay_notify.php");
require_once("alipay_config.php");
$alipay = new alipay_notify($partner,$security_code,$sign_type,$_input_charset,$transport);
$verify_result = $alipay->return_verify();


//print_r($_GET);Array ( [body] => ��������ֱ��ʹ�������˺ţ��������½fan-qiang.com [buyer_email] => d2@bupt.cn [buyer_id] => 2088102271385533 [discount] => 0.00 [gmt_create] => 2010-06-11 23:00:17 [gmt_logistics_modify] => 2010-06-11 23:00:17 [gmt_payment] => 2010-06-11 23:01:47 [is_success] => T [is_total_fee_adjust] => Y [logistics_fee] => 0.00 [logistics_payment] => SELLER_PAY [logistics_type] => EXPRESS [notify_id] => RqPnCoPT3K9%2Fvwbh3I%2BLU09q3DlJSkhAzP%2Frj%2FsAWNc5%2Fo4u%2FLWsC7PsXxzoXukUm8Ho [notify_time] => 2010-06-11 23:01:47 [notify_type] => trade_status_sync [out_trade_no] => 20100611100640 [payment_type] => 1 [price] => 0.01 [quantity] => 1 [receive_address] => ���Ѻ��Զ���ͨ [receive_name] => testdb [seller_actions] => SEND_GOODS [seller_email] => kecker.d2@gmail.com [seller_id] => 2088002473321794 [subject] => SSH�˺�10���� [total_fee] => 0.01 [trade_no] => 2010061182369712 [trade_status] => WAIT_SELLER_SEND_GOODS [use_coupon] => N [sign] => 251e16eb069860a39f1a2147aca82ac7 [sign_type] => MD5 )
//��ȡ֧�����ķ�������
   $dingdan	= $_GET['out_trade_no'];	//��ȡ֧�������ݹ����Ķ�����
   $total	= $_GET['price'];			//��ȡ֧�������ݹ������ܼ۸�  

if($verify_result) {    //��֤�ϸ�
	if($_GET['trade_status'] == 'WAIT_SELLER_SEND_GOODS') //����״̬������Ѹ���ȴ����ҷ���
	{
		//log_result("verify_success"); 
		
		//�����������֧�����Ĺ�����ܣ����ڷ��ص���Ϣ���治Ҫ�������жϣ���������У��ͨ���������ֶ����޷����¡��������Ҫ��ȡ�����ʹ�ù����Ľ��,
		//���ȡ������Ϣ������ֶ�discount��ֵ��ȡ����ֵ��������Ҹ����ŻݵĽ��� ԭ�������ܽ��=��Ҹ���صĽ��total_fee +|discount|.

		echo "֧���ɹ�<br>�������ǣ�".$dingdan."<br>��������ǣ�".$total;
		echo "<br><a href=\"http://72.11.150.242/sshweb/status.php\">����fan-qiang.com</a>";
		echo "<br>�����˺��Ѿ�����ʹ��~���Ե�http://72.11.150.242��½�鿴����ʱ�䣬лл��ѡ��fan-qiang.com~";
		echo "<br>���������˿ڶ���22<br>ssh1.fan-qiang.com<br>ssh2.fan-qiang.com<br>ssh3.fan-qiang.com<br>ssh6.fan-qiang.com";
		echo "<br>ѡ�������û���~����������ϵվ����������kecker ,qq:58587926";
	}
	else
	{
		echo "fail";
	}
}
else {    //��֤���ϸ�
	echo "fail";
	//log_result ("verify_failed");
}
?>