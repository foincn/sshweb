<?php
/*
	*���ܣ�������Ʒ�й���Ϣ��������Ϣ
	*�汾��2.0
	*���ڣ�2008-08-01
	*�޸����ڣ�2010-04-22
	'˵����
	'���´���ֻ�Ƿ����̻����ԣ��ṩ���������룬�̻����Ը����Լ���վ����Ҫ�����ռ����ĵ���д,����һ��Ҫʹ�øô��롣
	'�ô������ѧϰ���о�֧�����ӿ�ʹ�ã�ֻ���ṩһ���ο���
*/

require_once("alipay_service.php");
require_once("alipay_config.php");

////////////ҳ�湦��˵��///////////
//��ҳ���ǽӿ����ҳ�棬����֧��ʱ��URL
//��ҳ�����ʱ���֡����Դ�����ο���http://club.alipay.com/read-htm-tid-8681712.html
//Ҫ���ݵĲ���Ҫô������Ϊ�գ�Ҫô�Ͳ�Ҫ���������������ؿؼ���URL������
///////////////////////////////////
$yue = $_POST['paymonth'];	//��������
switch ($yue){
	case 1:
		$qian = 4.5;
		break;
	case 3:
		$qian = 13;
		break;
	case 6:
		$qian = 25;
		break;
	case 12:
		$qian = 45;
		break;
	default:
		$qian = 0.01;
}
///////���²�������Ҫͨ���µ�ʱ�Ķ������ݴ���������//////////
$out_trade_no = date('Ymdhms');
$subject = "SSH�˺�".$yue."����";
$body = "��������ֱ��ʹ��".$_POST['name']."���������½fan-qiang.com";
$price = $qian;

$receive_name = $_POST['name'];
$receive_address = "���Ѻ��Զ���ͨ";
$receive_zip = "";
$receive_phone = "";
$receive_mobile = "";

$logistics_fee_1 = "0.00";
$logistics_payment_1 = "BUYER_PAY";
$logistics_type_1 = "EMS";
	
$logistics_fee_2 = "0.00";
$logistics_payment_2 = "BUYER_PAY";
$logistics_type_2 = "POST";

$buyer_email = "";
////////////////////////////////////////////////////////////

$parameter = array(
/////////////////������ĵı������/////////////////////////////
	"service"        => "create_partner_trade_by_buyer",  //�������� ʵ���׼˫�ӿڷ������ƣ�trade_create_by_buyer �� �н鵣�����ף����������ף��������ƣ�create_partner_trade_by_buyer
	"payment_type"   => "1",                      //Ĭ��Ϊ1,����Ҫ�޸�
	"_input_charset" => $_input_charset,          //�ַ�����Ĭ��ΪGBK
	
/////////////////����Ĳ���////////////////////////////////////
	"partner"        => $partner,                 //���������ID
	"seller_email"   => $seller_email,            //�տ�֧�����˺ţ�һ����ǩԼ֧�����˺�
	"out_trade_no"   => $out_trade_no,            //�̼���վΨһ�����ţ���֤�̼���վ����ϵͳ����Ķ�����Ψһ��
	"subject"        => $subject,                 //��Ʒ���ƣ���������
	"price"          => $price,                   //��Ʒ���ۣ������ܼۣ��۸���Ϊ0��
	"quantity"       => "1",                      //��Ʒ������������Ʒ����ʱ��������
	
	"logistics_fee"      => '0.00',               //�������ͷ���
	"logistics_payment"  => 'SELLER_PAY',          //�������ø��ʽ��SELLER_PAY(����֧��)��BUYER_PAY(���֧��)��BUYER_PAY_AFTER_RECEIVE(��������)
	"logistics_type"     => 'EXPRESS',            //�������ͷ�ʽ��POST(ƽ��)��EMS(EMS)��EXPRESS(�������)
	
/////////////////������д����Ҫ�Ĳ���/////////////////////////
	"return_url"     => $return_url,              //ͬ������,����ҳ·����ַ
	"notify_url"     => $notify_url,              //�첽���أ�֪ͨҳ·����ַ
	"body"           => $body,                    //��Ʒ������������ע

	"show_url"       => $show_url,                 //��Ʒ�����վ

////////////////�������õ�ѡ�����///////////////////////////
	//�ջ�����Ϣ�������ٺ�����Щ�����е�receive_name��receive_address��receive_zipʱ������֧��������̨�Ժ�Ĳ��������л���������ջ�����Ϣ��һ��
	"receive_name"	 => $receive_name,		   //�ջ�������
	"receive_address"=> $receive_address,	   //�ջ��˵�ַ
	"receive_zip"	 => $receive_zip,		   //�ջ����ʱ�
	"receive_phone"  => $receive_phone,		   //�ջ�����ϵ�绰
	"receive_mobile" => $receive_mobile,	   //�ջ����ֻ�
	
	"buyer_email"	 => $buyer_email		   //���֧�����˺�
/*
	"logistics_fee_1"    => $logistics_fee_1,             //�������ͷ���
	"logistics_payment_1"=> $logistics_payment_1,        //�������ø��ʽ��SELLER_PAY(����֧��)��BUYER_PAY(���֧��)��BUYER_PAY_AFTER_RECEIVE(��������)
	"logistics_type_1"   => $logistics_type_1,              //�������ͷ�ʽ��POST(ƽ��)��EMS(EMS)��EXPRESS(�������)
	
	"logistics_fee_2"    => $logistics_fee_2,             //�������ͷ���
	"logistics_payment_2"=> $logistics_payment_2,        //�������ø��ʽ��SELLER_PAY(����֧��)��BUYER_PAY(���֧��)��BUYER_PAY_AFTER_RECEIVE(��������)
	"logistics_type_2"   => $logistics_type_2             //�������ͷ�ʽ��POST(ƽ��)��EMS(EMS)��EXPRESS(�������)
*/
);
$alipay = new alipay_service($parameter,$security_code,$sign_type);


//POST��ʽ���ݣ��õ����ܽ���ַ���
$sign = $alipay->Get_Sign();


//���ĳ�GET��ʽ���ݣ���ȡ�����������ע��
$link=$alipay->create_url();
echo "<script>window.location =\"$link\";</script>"; 
?>
<html>
<head>
<title>֧���������ӿ�</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312"></head>
<body>
			<form name="alipaysubmit" method="post" action="https://www.alipay.com/cooperate/gateway.do?_input_charset=<?=$_input_charset?>">
				<input type=hidden name="service" value="create_partner_trade_by_buyer">
				<input type=hidden name="partner" value="<?=$partner?>">
				<input type=hidden name="return_url" value="<?=$return_url?>"> 
				<input type=hidden name="notify_url" value="<?=$notify_url?>">  
				<input type=hidden name="subject" value="<?=$subject?>"> 
				<input type=hidden name="body" value="<?=$body?>">
				<input type=hidden name="out_trade_no" value="<?=$out_trade_no?>">
				<input type=hidden name="price" value="<?=$price?>">
				<input type=hidden name="quantity" value="1">
				<input type=hidden name="payment_type" value="1">
				<input type=hidden name="show_url" value="<?=$show_url?>">
				<input type=hidden name="seller_email" value="<?=$seller_email?>">
				<input type=hidden name="logistics_fee" value="0.00">
				<input type=hidden name="logistics_payment" value="BUYER_PAY">
				<input type=hidden name="logistics_type" value="EXPRESS">
				<input type=hidden name="sign" value="<?=$sign?>">
				<input type=hidden name="sign_type" value="MD5">
				
				<input type=hidden name="receive_name" value="<?=$receive_name?>">
				<input type=hidden name="receive_address" value="<?=$receive_address?>">
				<input type=hidden name="receive_zip" value="<?=$receive_zip?>">
				<input type=hidden name="receive_phone" value="<?=$receive_phone?>">
				<input type=hidden name="receive_mobile" value="<?=$receive_mobile?>">
				
				<input type=hidden name="buyer_email" value="<?=$buyer_email?>">
				<!--
				<input type=hidden name="logistics_fee_1" value="<?=$logistics_fee_1?>">
				<input type=hidden name="logistics_payment_1" value="<?=$logistics_payment_1?>">
				<input type=hidden name="logistics_type_1" value="<?=$logistics_type_1?>">
				<input type=hidden name="logistics_fee_2" value="<?=$logistics_fee_2?>">
				<input type=hidden name="logistics_payment_2" value="<?=$logistics_payment_2?>">
				<input type=hidden name="logistics_type_2" value="<?=$logistics_type_2?>">
				 -->
			</form>
	<table>
		<tr><td>
			<input type="button" name="v_action" value="֧�������ϰ�ȫ��ʱ֧��ƽ̨" onClick="alipaysubmit.submit()">
		</td></tr>
	</table>
</body>
</html>
