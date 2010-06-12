<?php
	/*
	*���ܣ���������з�����֪ͨ��
	*�汾��2.0
	*���ڣ�2008-08-01
	*�޸����ڣ�2010-03-11
	'˵����
	'���´���ֻ�Ƿ����̻����ԣ��ṩ���������룬�̻����Ը����Լ���վ����Ҫ�����ռ����ĵ���д,����һ��Ҫʹ�øô��롣
	'�ô������ѧϰ���о�֧�����ӿ�ʹ�ã�ֻ���ṩһ���ο���

	*/
	

// ��־��Ϣ,��֧���������Ĳ�����¼����
function  log_result($word) {
	$fp = fopen("log.txt","a");	
	flock($fp, LOCK_EX) ;
	$temp = var_export($word,true);
	fwrite($fp,"ִ�����ڣ�".strftime("%Y%m%d%H%I%S",time())."\n".$temp."\n");
	flock($fp, LOCK_UN); 
	fclose($fp);
}

class alipay_notify {
	var $gateway;           //֧���ӿ�
	var $security_code;  	//��ȫУ����
	var $partner;           //�������ID
	var $sign_type;         //���ܷ�ʽ ϵͳĬ��
	var $mysign;            //ǩ��     
	var $_input_charset;    //�ַ������ʽ
	var $transport;         //����ģʽ
	function alipay_notify($partner,$security_code,$sign_type = "MD5",$_input_charset = "GBK",$transport= "https") {
		$this->partner        = $partner;
		$this->security_code  = $security_code;
		$this->sign_type      = $sign_type;
		$this->mysign         = "";
		$this->_input_charset = $_input_charset ;
		$this->transport      = $transport;
		if($this->transport == "https") {
			$this->gateway = "https://www.alipay.com/cooperate/gateway.do?";
		}else $this->gateway = "http://notify.alipay.com/trade/notify_query.do?";
	}
/****************************************��notify_url����֤*********************************/
	function notify_verify() {   
		if($this->transport == "https") {
			$veryfy_url = $this->gateway. "service=notify_verify" ."&partner=" .$this->partner. "&notify_id=".$_POST["notify_id"];
		} else {
			$veryfy_url = $this->gateway. "partner=".$this->partner."&notify_id=".$_POST["notify_id"];
		}
		$veryfy_result = $this->get_verify($veryfy_url);
		$post          = $this->para_filter($_POST);
		$sort_post     = $this->arg_sort($post);
		while (list ($key, $val) = each ($sort_post)) {
			$arg.=$key."=".$val."&";
		}
		$prestr = substr($arg,0,count($arg)-2);  //ȥ�����һ��&��
		$this->mysign = $this->sign($prestr.$this->security_code);
		//д��־��¼
		log_result("veryfy_result=".$veryfy_result."\n notify_url_log:sign=".$_POST["sign"]."&mysign=".$this->mysign."&".$this->charset_decode(implode(",",$_POST),$this->_input_charset ));
		if (eregi("true$",$veryfy_result) && $this->mysign == $_POST["sign"])  {
			return true;
		} else return false;
	}
/*******************************************************************************************/

/**********************************��return_url����֤***************************************/	
	function return_verify() {  
		if($this->transport == "https") {
			$veryfy_url = $this->gateway. "service=notify_verify" ."&partner=" .$this->partner. "&notify_id=".$_GET["notify_id"];
		} else {
			$veryfy_url = $this->gateway. "partner=".$this->partner."&notify_id=".$_GET["notify_id"];
		}
		$veryfy_result = $this->get_verify($veryfy_url);
		$sort_get= $this->arg_sort($_GET);
		while (list ($key, $val) = each ($sort_get)) {
			if($key != "sign" && $key != "sign_type")
			$arg.=$key."=".$val."&";
		}
		$prestr = substr($arg,0,count($arg)-2);  //ȥ�����һ��&��
		$this->mysign = $this->sign($prestr.$this->security_code);
		/*//�����ã�֧��������������ʱ������·����
		while (list ($key, $val) = each ($_GET)) {
		$arg_get.=$key."=".$val."&";
		}*/
		//д��־��¼
		//log_result("veryfy_result=".$veryfy_result."\n return_url_log=".$_GET["sign"]."&".$this->mysign."&".$this->charset_decode(implode(",",$_GET),$this->_input_charset ));
		if (eregi("true$",$veryfy_result) && $this->mysign == $_GET["sign"])  return true;
		else return false;
	}
/*******************************************************************************************/

	function get_verify($url,$time_out = "60") {
		$urlarr     = parse_url($url);
		$errno      = "";
		$errstr     = "";
		$transports = "";
		if($urlarr["scheme"] == "https") {
			$transports = "ssl://";
			$urlarr["port"] = "443";
		} else {
			$transports = "tcp://";
			$urlarr["port"] = "80";
		}
		$fp=@fsockopen($transports . $urlarr['host'],$urlarr['port'],$errno,$errstr,$time_out);
		if(!$fp) {
			die("ERROR: $errno - $errstr<br />\n");
		} else {
			fputs($fp, "POST ".$urlarr["path"]." HTTP/1.1\r\n");
			fputs($fp, "Host: ".$urlarr["host"]."\r\n");
			fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
			fputs($fp, "Content-length: ".strlen($urlarr["query"])."\r\n");
			fputs($fp, "Connection: close\r\n\r\n");
			fputs($fp, $urlarr["query"] . "\r\n\r\n");
			while(!feof($fp)) {
				$info[]=@fgets($fp, 1024);
			}
			fclose($fp);
			$info = implode(",",$info);
			while (list ($key, $val) = each ($_POST)) {
				$arg.=$key."=".$val."&";
			}
			//д��־��¼
			//log_result("notify_url_log=".$url.$this->charset_decode($info,$this->_input_charset));
			//log_result("notify_url_log=".$this->charset_decode($arg,$this->_input_charset));
			return $info;
		}
	}

	function arg_sort($array) {
		ksort($array);
		reset($array);
		return $array;
	}

	function sign($prestr) {
		$sign='';
		if($this->sign_type == 'MD5') {
			$sign = md5($prestr);
		}elseif($this->sign_type =='DSA') {
			//DSA ǩ����������������
			die("DSA ǩ����������������������ʹ��MD5ǩ����ʽ");
		}else {
			die("֧�����ݲ�֧��".$this->sign_type."���͵�ǩ����ʽ");
		}
		return $sign;
	}
/***********************��ȥ�����еĿ�ֵ��ǩ��ģʽ*****************************/
	function para_filter($parameter) { 
		$para = array();
		while (list ($key, $val) = each ($parameter)) {
			if($key == "sign" || $key == "sign_type" || $val == "")continue;
			else	$para[$key] = $parameter[$key];
		}
		return $para;
	}
/********************************************************************************/

/******************************ʵ�ֶ����ַ����뷽ʽ*****************************/
	function charset_encode($input,$_output_charset ,$_input_charset ="utf-8" ) {
		$output = "";
		if(!isset($_output_charset) )$_output_charset  = $this->parameter['_input_charset'];
		if($_input_charset == $_output_charset || $input ==null ) {
			$output = $input;
		} elseif (function_exists("mb_convert_encoding")){
			$output = mb_convert_encoding($input,$_output_charset,$_input_charset);
		} elseif(function_exists("iconv")) {
			$output = iconv($_input_charset,$_output_charset,$input);
		} else die("sorry, you have no libs support for charset change.");
		return $output;
	}
/********************************************************************************/

/******************************ʵ�ֶ����ַ����뷽ʽ******************************/
	function charset_decode($input,$_input_charset ,$_output_charset="utf-8"  ) {
		$output = "";
		if(!isset($_input_charset) )$_input_charset  = $this->_input_charset ;
		if($_input_charset == $_output_charset || $input ==null ) {
			$output = $input;
		} elseif (function_exists("mb_convert_encoding")){
			$output = mb_convert_encoding($input,$_output_charset,$_input_charset);
		} elseif(function_exists("iconv")) {
			$output = iconv($_input_charset,$_output_charset,$input);
		} else die("sorry, you have no libs support for charset changes.");
		return $output;
	}
/*********************************************************************************/
}
?>
