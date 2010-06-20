// JavaScript Document
jQuery.fn.checkform = function (input_type, required){
	var id = /^\w+[\d\w_]{4,20}/;
	var pw = /.{6,14}/;
	var yz = /^\d{4}$/;
	var email = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
	var taobao = /.{5,20}/;
	var qq = /^\d+/;
	//var req = /.+/;//必填
	var testvalue = $(this).val();
	if(required === true){
		if(testvalue !== ''){
			$(this).next().remove();
			if(input_type === 'id'){
				var r = id.test(testvalue);
				if(r !== true){
					if(!$(this).next().is("span")){
						$(this).after("<span class='errormsg'>用户名格式不正确</span>");
						return false;
					}
				}
				else{
					$(this).next().remove();
					return true;
				}
			}
			if(input_type === 'pw'){
				var r = pw.test(testvalue);
				if(r !== true){
					if(!$(this).next().is("span")){
						$(this).after("<span class='errormsg'>密码为6-14位</span>");
						return false;
					}
				}
				else{
					$(this).next().remove();
					return true;
				}
			}
			if(input_type === 'yz'){
				var r = yz.test(testvalue);
				if(r !== true){
					if(!$(this).next().is("span")){
						$(this).after("<span class='errormsg'>输入验证码</span>");
						return false;
					}
				}
				else{
					$(this).next().remove();
					return true;
				}
			}
			else{
				return true;
			}
		}
		else{
			if(!$(this).next().is("span")){
				$(this).after("<span class='errormsg'>字段不能为空</span>");
				return false;
			}
		}
	}
	else{
		if(testvalue !== ''){
			$(this).next().remove();
			if(input_type === 'taobao'){
				var r = taobao.test(testvalue);
				if(r !== true){
					if(!$(this).next().is("span")){
						$(this).after("<span class='warningmsg'>旺旺账号格式不正确</span>");
						return false;
					}
				}
				else{
					$(this).next().remove();
					return true;
				}
			}
			if(input_type === 'email'){
				var r = email.test(testvalue);
				if(r !== true){
					if(!$(this).next().is("span")){
						$(this).after("<span class='warningmsg'>邮件地址格式不正确</span>");
						return false;
					}
				}
				else{
					$(this).next().remove();
					return true;
				}
			}
			if(input_type === 'qq'){
				var r = qq.test(testvalue);
				if(r !== true){
					if(!$(this).next().is("span")){
						$(this).after("<span class='warningmsg'>qq号格式不正确</span>");
						return false;
					}
				}
				else{
					$(this).next().remove();
					return true;
				}
			}
			else{
				return true;
			}
		}
		else{
			return true;
		}
		
	}
}
jQuery.fn.checkeq = function (pw1,pw2){
	//alert(pw1);alert(pw2);
	if(pw1 === pw2){
		$(this).next().remove();
		return true;
	}
	else{
		$(this).next().remove();
		$(this).after("<span class='errormsg'>确认密码与密码不一致</span>");
		return false;
	}
}
//验证密码是否相等
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
	$("#htmlform1 input[name='id']").blur(function(){$(this).checkform('id',true);});
	$("#htmlform1 input[name='pw']").blur(function(){$(this).checkform('pw',true);});
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
	if($("#htmlform1 input[name='id']").checkform('id',true) && 
	   $("#htmlform1 input[name='pw']").checkform('pw',true) &&	
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

