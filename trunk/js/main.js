// JavaScript Document
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

});