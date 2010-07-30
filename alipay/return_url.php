<?php
/*
	*功能：付完款后跳转的页面
	*版本：2.0
	*日期：2008-08-01
	*修正日期：2010-4-22
	'说明：
	'以下代码只是方便商户测试，提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
	'该代码仅供学习和研究支付宝接口使用，只是提供一个参考。
	
*/

///////////页面功能说明///////////////
//该页面可在本机电脑测试
//该页面称作“返回页”，是同步被支付宝服务器所调用，可当作是支付完成后的提示信息页，如“您的某某某订单，多少金额已支付成功”。
//可放入HTML等美化页面的代码、订单交易完成后的数据库更新程序代码
//该页面调试工具可以使用PHP拥有的断点调试工具Zend Studio，也可以使用写文本函数log_result，该函数已被默认关闭，见alipay_notify.php中的函数return_verify
/////////////////////////////

require_once("alipay_notify.php");
require_once("alipay_config.php");
$alipay = new alipay_notify($partner,$security_code,$sign_type,$_input_charset,$transport);
$verify_result = $alipay->return_verify();


//print_r($_GET);Array ( [body] => 购买后可以直接使用您的账号，具体请登陆fan-qiang.com [buyer_email] => d2@bupt.cn [buyer_id] => 2088102271385533 [discount] => 0.00 [gmt_create] => 2010-06-11 23:00:17 [gmt_logistics_modify] => 2010-06-11 23:00:17 [gmt_payment] => 2010-06-11 23:01:47 [is_success] => T [is_total_fee_adjust] => Y [logistics_fee] => 0.00 [logistics_payment] => SELLER_PAY [logistics_type] => EXPRESS [notify_id] => RqPnCoPT3K9%2Fvwbh3I%2BLU09q3DlJSkhAzP%2Frj%2FsAWNc5%2Fo4u%2FLWsC7PsXxzoXukUm8Ho [notify_time] => 2010-06-11 23:01:47 [notify_type] => trade_status_sync [out_trade_no] => 20100611100640 [payment_type] => 1 [price] => 0.01 [quantity] => 1 [receive_address] => 交费后自动开通 [receive_name] => testdb [seller_actions] => SEND_GOODS [seller_email] => kecker.d2@gmail.com [seller_id] => 2088002473321794 [subject] => SSH账号10个月 [total_fee] => 0.01 [trade_no] => 2010061182369712 [trade_status] => WAIT_SELLER_SEND_GOODS [use_coupon] => N [sign] => 251e16eb069860a39f1a2147aca82ac7 [sign_type] => MD5 )
//获取支付宝的反馈参数
   $dingdan	= $_GET['out_trade_no'];	//获取支付宝传递过来的订单号
   $total	= $_GET['price'];			//获取支付宝传递过来的总价格  

if($verify_result) {    //认证合格
	if($_GET['trade_status'] == 'WAIT_SELLER_SEND_GOODS') //交易状态：买家已付款，等待卖家发货
	{
		//log_result("verify_success"); 
		
		//如果您申请了支付宝的购物卷功能，请在返回的信息里面不要做金额的判断，否则会出现校验通不过，出现订单无法更新。如果您需要获取买家所使用购物卷的金额,
		//请获取返回信息的这个字段discount的值，取绝对值，就是买家付款优惠的金额。即 原订单的总金额=买家付款返回的金额total_fee +|discount|.

		echo "支付成功<br>订单号是：".$dingdan."<br>订单金额是：".$total;
		echo "<br><a href=\"http://72.11.150.242/sshweb/status.php\">返回fan-qiang.com</a>";
		echo "<br>您的账号已经可以使用~可以到http://72.11.150.242登陆查看到期时间，谢谢您选择fan-qiang.com~";
		echo "<br>服务器，端口都是22<br>ssh1.fan-qiang.com<br>ssh2.fan-qiang.com<br>ssh3.fan-qiang.com<br>ssh6.fan-qiang.com";
		echo "<br>选您最快的用户吧~有问题请联系站长，旺旺：kecker ,qq:58587926";
	}
	else
	{
		echo "fail";
	}
}
else {    //认证不合格
	echo "fail";
	//log_result ("verify_failed");
}
?>