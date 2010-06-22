$(document).ready(function() {
	$("form[name='myform'] input[name='taobao_name']").blur(function(){$(this).checkform('taobao',false);});
	$("form[name='myform'] input[name='qq']").blur(function(){$(this).checkform('qq',false);});
	$("form[name='myform'] input[name='email']").blur(function(){$(this).checkform('email',false);});
	$("form[name='myform'] input[name='yz']").blur(function(){$(this).checkform('yz',true);});
	$("form[name='myform']").submit(function(){
	if($("form[name='myform'] input[name='id']").checkform('id',true) && 
	   $("form[name='myform'] input[name='pw']").checkform('pw',true) &&	
	   //$("form[name='myform'] input[name='pw2']").checkform('pw',true) &&
	   $("form[name='myform'] input[name='pw2']").checkeq( ($("form[name='myform'] input[name='pw']").val()),( $("form[name='myform'] input[name='pw2']").val()) ) &&
	   $("form[name='myform'] input[name='yz']").checkform('yz',true)){ 
		//必填项目填对之后，如果选填项目不对则清空后提交
		if(!$("form[name='myform'] input[name='taobao_name']").checkform('taobao',false)){$("form[name='myform'] input[name='taobao_name']").val('');}
		if(!$("form[name='myform'] input[name='qq']").checkform('qq',false)){$("form[name='myform'] input[name='qq']").val('');}
		if(!$("form[name='myform'] input[name='email']").checkform('email',false)){$("form[name='myform'] input[name='email']").val('');}
		$("form[name='myform']").submit();
	}
	else {
		$("form[name='myform'] input[name='taobao_name']").checkform('taobao',false);
		$("form[name='myform'] input[name='qq']").checkform('qq',false);
		$("form[name='myform'] input[name='email']").checkform('email',false);
		return false;
	}
});
});// JavaScript Document