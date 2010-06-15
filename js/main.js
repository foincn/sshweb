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
		$('#htmlform3').hide();
		$('#htmlform4').hide();
		$('#arrow4').hide();
		$('#arrow3').hide();
		$('#arrow2').hide();
		$('#arrow1').slideToggle();
		//$('#htmlform1').slideToggle('slow');
		$('#htmlform1').animate({opacity:'toggle',height:'toggle'},'slow');
		//$(this).removeClass('active');
	}
	if(this.id == "regbutton"){
		$('#htmlform1').hide();
		$('#htmlform3').hide();
		$('#htmlform4').hide();
		$('#arrow4').hide();
		$('#arrow3').hide();
		$('#arrow1').hide();
		$('#arrow2').slideToggle();
		//$('#htmlform1').slideToggle('slow');
		$('#htmlform2').animate({opacity:'toggle',height:'toggle'},'slow');
		//$(this).removeClass('active');
	}
	if(this.id == "helpbutton"){
		$('#htmlform2').hide();
		$('#htmlform1').hide();
		$('#htmlform4').hide();
		$('#arrow4').hide();
		$('#arrow1').hide();
		$('#arrow2').hide();
		$('#arrow3').slideToggle();
		//$('#htmlform1').slideToggle('slow');
		$('#htmlform3').animate({opacity:'toggle',height:'toggle'},'slow');
		//$(this).removeClass('active');
	}
	if(this.id == "pricebutton"){
		$('#htmlform2').hide();
		$('#htmlform1').hide();
		$('#htmlform3').hide();
		$('#arrow1').hide();
		$('#arrow2').hide();
		$('#arrow3').hide();
		$('#arrow4').slideToggle();
		//$('#htmlform1').slideToggle('slow');
		$('#htmlform4').animate({opacity:'toggle',height:'toggle'},'slow');
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