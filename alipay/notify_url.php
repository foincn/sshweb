<?php
/*
	*功能：付款过程中服务器通知页面
	*版本：2.0
	*日期：2008-08-01
	*修正日期：2010-4-22
	'说明：
	'以下代码只是方便商户测试，提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
	'该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

*/

///////////页面功能说明///////////////
//创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
//当支付宝的订单状态改变时，支付宝服务器则会自动调用此页面，因此请做好自身网站订单信息与支付宝上的订单的同步工作
//该页面不能在本机电脑测试，请到服务器上做测试，即互联网能够访问得到这个页面即可。
//该页面调试工具请使用写文本函数log_result，该函数已被默认开启，见alipay_notify.php中的函数notify_verify
/////////////////////////////


require_once ("alipay_notify.php");
require_once ("alipay_config.php");
$alipay = new alipay_notify ( $partner, $security_code, $sign_type, $_input_charset, $transport );
$verify_result = $alipay->notify_verify ();
if ($verify_result) { //认证合格
	//获取支付宝的反馈参数
	$dingdan = $_POST ['out_trade_no']; //获取支付宝传递过来的订单号
	$total = $_POST ['price']; //获取支付宝传递过来的总价格
	

	/*
	获取支付宝反馈过来的状态,根据不同的状态来更新数据库 
	WAIT_BUYER_PAY(表示等待买家付款);
	TRADE_FINISHED(表示交易已经成功结束);
*/
	
	//如果您申请了支付宝的购物卷功能，请在返回的信息里面不要做金额的判断，否则会出现校验通不过，出现订单无法更新。如果您需要获取买家所使用购物卷的金额,
	//请获取返回信息的这个字段discount的值，取绝对值，就是买家付款优惠的金额。即 原订单的总金额=买家付款返回的金额total_fee +|discount|.
	if ($_POST ['trade_status'] == 'WAIT_BUYER_PAY') { //交易状态：等待买家付款
		//放入交易状态是订单交易创建还未付款的数据库更新程序代码，也可不放入任何代码。
		echo "success";
		//log_result("verify_success");
	} else if ($_POST ['trade_status'] == 'WAIT_SELLER_SEND_GOODS') { //交易状态：买家已付款，等待卖家发货
		//放入订单交易完成后的数据库更新程序代码，请务必保证echo出来的信息只有success
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
			$r = substr ( $pay_date, 8, 2 ); //日
			$y = substr ( $pay_date, 5, 2 ); //月
			$n = substr ( $pay_date, 0, 4 ); //年
			$end_date = date ( "Y-m-d", mktime ( 0, 0, 0, $y + $add, $r + 1, $n ) );
		
		} else {
			if (date ( "Y-m-d", strtotime ( $in_user ['overtime'] ) ) > date ( "Y-m-d" )) {
				$r = substr ( $in_user ['overtime'], 8, 2 ); //日
				$y = substr ( $in_user ['overtime'], 5, 2 ); //月
				$n = substr ( $in_user ['overtime'], 0, 4 ); //年
				$end_date = date ( "Y-m-d", mktime ( 0, 0, 0, $y + $add, $r + 1, $n ) );
				///echo "Y";
			} else {
				$r = substr ( $pay_date, 8, 2 ); //日
				$y = substr ( $pay_date, 5, 2 ); //月
				$n = substr ( $pay_date, 0, 4 ); //年
				$end_date = date ( "Y-m-d", mktime ( 0, 0, 0, $y + $add, $r + 1, $n ) );
				//echo "N";
			}
		}
		$sql = "update user set paytime='$pay_date',overtime='$end_date',pay=pay+'$pay_money' where name = '$receive_user'";
		$result = mysql_query ( $sql );
		
		//下面是在服务器上建账号
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
	} else if ($_POST ['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS') { //交易状态：卖家已发货等待买家确认收货
		//放入订单交易完成后的数据库更新程序代码，请务必保证echo出来的信息只有success
		echo "success";
		
	//log_result("verify_success");
	} else if ($_POST ['trade_status'] == 'TRADE_FINISHED') { //交易状态：交易成功结束
		//放入订单交易完成后的数据库更新程序代码，请务必保证echo出来的信息只有success
		echo "success";
		
	//log_result("verify_success");
	} else { //放置更多交易状态，见http://club.alipay.com/read-htm-tid-8681385-fpage-2.html
		echo "success";
		//log_result ("verify_failed");
	}
} else { //认证不合格
	echo "fail";
	//log_result ("verify_failed");
}
?>