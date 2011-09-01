// JavaScript Document
$(document).ready(function() {
	$("form[name='myform'] input[name='id']").blur(function(){$(this).checkform('',true);});
	$("form[name='myform'] input[name='pw']").blur(function(){$(this).checkform('',true);});
	$("form[name='myform'] input[name='yz']").blur(function(){$(this).checkform('yz',true);});
	$("form[name='myform']").submit(function(){
	if($("form[name='myform'] input[name='id']").checkform('',true) && 
	   $("form[name='myform'] input[name='pw']").checkform('',true) /*&&	
	   $("form[name='myform'] input[name='yz']").checkform('yz',true)*/){ 
		$("form[name='myform']").submit();
	}
	else {
		return false;
	}
});
});
