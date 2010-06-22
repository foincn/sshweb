$(document).ready(function() {
	$("form[name='pay']").submit(function(){
		//return false;
	if($(":radio:checked").val() == undefined){
			if(!$(".pay").next().is("span")){
				$(".pay").after("<span class='errormsg'>ÇëÑ¡ÔñÒ»Ïî</span>");
				return false;
			}
	}
	else{
		$("form[name='pay']").submit();
	}
		
	});
});// JavaScript Document