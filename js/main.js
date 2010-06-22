$(document).ready(function() {
$('#preFeature2').siteFeature2({
	pauseBtnLocation: 'right',
	pauseOnHover: false,
	menuLocation: 'right',
	menuDirection: 'horizontal',
	menuStatus: 'open',
	showHideMenu: 'hide',
	imgAnimationDirection: 'fade',
	autoPlayInterval: 4000
});

$('#menu > ul > li > a').bind('click',function(){
	$('#menu > ul > li > a').removeClass('active');										   
	$(this).addClass('active');
	if(this.id == "loginbutton"){
		$('#htmlform2').hide();
		$('#qanda').hide();
		$('#price').hide();
		$('#arrow4').hide();
		$('#arrow3').hide();
		$('#arrow2').hide();
		$('#arrow1').slideToggle();
		//$('#arrorw1').css({'top':'0px','left':'70px','background-color':'black'});
		$('#htmlform1').animate({opacity:'toggle',height:'toggle'},'fast');
		//$("#htmlform1 input[name='id']").focus();

		//$(this).removeClass('active');
	}
	if(this.id == "regbutton"){
		$('#htmlform1').hide();
		$('#qanda').hide();
		$('#price').hide();
		$('#arrow4').hide();
		$('#arrow3').hide();
		$('#arrow1').hide();
		$('#arrow2').slideToggle('fast');
		//$('#htmlform1').slideToggle('slow');
		$('#htmlform2').animate({opacity:'toggle',height:'toggle'},'fast');
		//$("#htmlform2 input[name='id']").focus();
		
		//$(this).removeClass('active');
	}
	if(this.id == "helpbutton"){
		$('#htmlform2').hide();
		$('#htmlform1').hide();
		$('#price').hide();
		$('#arrow4').hide();
		$('#arrow1').hide();
		$('#arrow2').hide();
		$('#arrow3').slideToggle('fast');
		//$('#htmlform1').slideToggle('slow');
		$('#qanda').animate({opacity:'toggle',height:'toggle'},'fast');
		//$(this).removeClass('active');
	}
	if(this.id == "pricebutton"){
		$('#htmlform2').hide();
		$('#htmlform1').hide();
		$('#qanda').hide();
		$('#arrow1').hide();
		$('#arrow2').hide();
		$('#arrow3').hide();
		$('#arrow4').slideToggle('fast');
		//$('#htmlform1').slideToggle('slow');
		$('#price').animate({opacity:'toggle',height:'toggle'},'fast');
		//$(this).removeClass('active');
	}
});

$('.close').bind('click',function(){
		$(this).parent().hide();
		$('#arrow1').hide();
		$('#arrow2').hide();
		$('#arrow3').hide();
		$('#arrow4').hide();
		$('#menu > ul > li > a').removeClass('active');	
});
//输入框聚焦
var s = $('#inputurl').val();
$('#inputurl').click(function(){
		if($(this).val() === s){
			$(this).val('');
		}
		$(this).css({color:"#000"});
});
$('#inputurl').blur(function(){
		if($(this).val() === ''){
			$(this).val(s);
		}
		$(this).css({color:"#999"});
 });
/*验证*/
	$("#htmlform1 input[name='id']").blur(function(){$(this).checkform('',true);});
	$("#htmlform1 input[name='pw']").blur(function(){$(this).checkform('',true);});
	$("#htmlform1 input[name='yz']").blur(function(){$(this).checkform('yz',true);});

	$("#htmlform2 input[name='id']").blur(function(){$(this).checkform('id',true);});
	$("#htmlform2 input[name='pw']").blur(function(){$(this).checkform('pw',true);});
	$("#htmlform2 input[name='pw2']").blur(function(){
		$(this).checkform('pw',true);
		var pw1 = $("#htmlform2 input[name='pw']").val();
		var pw2 = $(this).val();
		$(this).checkeq(pw1,pw2);
	});	
	$("#htmlform2 input[name='taobao_name']").blur(function(){$(this).checkform('taobao',false);});
	$("#htmlform2 input[name='qq']").blur(function(){$(this).checkform('qq',false);});
	$("#htmlform2 input[name='email']").blur(function(){$(this).checkform('email',false);});
	$("#htmlform2 input[name='yz']").blur(function(){$(this).checkform('yz',true);});
	

$("#htmlform1 form").submit(function(){
	if($("#htmlform1 input[name='id']").checkform('',true) && 
	   $("#htmlform1 input[name='pw']").checkform('',true) &&	
	   $("#htmlform1 input[name='yz']").checkform('yz',true)){ 
		$("#htmlform1 form").submit();
	}
	else {
		return false;
	}
});
$("#htmlform2 form").submit(function(){
	if($("#htmlform2 input[name='id']").checkform('id',true) && 
	   $("#htmlform2 input[name='pw']").checkform('pw',true) &&	
	   //$("#htmlform2 input[name='pw2']").checkform('pw',true) &&
	   $("#htmlform2 input[name='pw2']").checkeq( ($("#htmlform2 input[name='pw']").val()),( $("#htmlform2 input[name='pw2']").val()) ) &&
	   $("#htmlform2 input[name='yz']").checkform('yz',true)){ 
		//必填项目填对之后，如果选填项目不对则清空后提交
		if(!$("#htmlform2 input[name='taobao_name']").checkform('taobao',false)){$("#htmlform2 input[name='taobao_name']").val('');}
		if(!$("#htmlform2 input[name='qq']").checkform('qq',false)){$("#htmlform2 input[name='qq']").val('');}
		if(!$("#htmlform2 input[name='email']").checkform('email',false)){$("#htmlform2 input[name='email']").val('');}
		$("#htmlform2 form").submit();
	}
	else {
		$("#htmlform2 input[name='taobao_name']").checkform('taobao',false);
		$("#htmlform2 input[name='qq']").checkform('qq',false);
		$("#htmlform2 input[name='email']").checkform('email',false);
		return false;
	}
});
});

