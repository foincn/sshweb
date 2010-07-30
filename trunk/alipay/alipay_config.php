<?php
/*
	*功能：设置帐户有关信息及返回路径
	*版本：2.0
	*日期：2008-08-01
	'说明：
	'以下代码只是方便商户测试，提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
	'该代码仅供学习和研究支付宝接口使用，只是提供一个参考。
*/

//////////页面功能说明////////////
//该页面是设置不会被经常变动的信息。
//建议partner、security_code、seller_email通过网站后台的设置来动态获取。
//////////////////////////////////

$partner        = "2088002473321794";       //合作伙伴ID
$security_code  = "nwxjivs0mednwbni1g9shcdmo3m1p4kd";       //安全检验码
$seller_email   = "kecker.d2@gmail.com";       //卖家支付宝帐户
$_input_charset = "GBK";  //字符编码格式  目前支持 GBK 或 utf-8
$sign_type      = "MD5";    //加密方式  系统默认(不要修改)
$transport      = "http";  //访问模式,你可以根据自己的服务器是否支持ssl访问而选择http以及https访问模式
$notify_url     = "http://72.11.150.242/sshweb/alipay/notify_url.php"; //交易过程中服务器通知的页面 要用 http://格式的完整路径
$return_url     = "http://72.11.150.242/sshweb/alipay/return_url.php"; //付完款后跳转的页面 要用 http://格式的完整路径
$show_url       = "http://72.11.150.242"        //你网站商品的展示地址

/** 提示：如何获取安全校验码和合作ID
1.访问 www.alipay.com，然后登陆您的帐户($seller_email).
2.点商家服务.导航栏的下面可以看到
*/
?>