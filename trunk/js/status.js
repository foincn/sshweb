$(document).ready(function() {
	$("form[name='pay']").submit(function(){
		$('.tip').hide();
		//return false;
	if($(":radio:checked").val() == undefined){
			if(!$(".pay").next().is("span")){
				$(".pay").after("<span class='errormsg'>«Î—°‘Ò“ªœÓ</span>");
				return false;
			}
			return false;
	}
	else{
		$("form[name='pay']").submit();
	}

	});
	if($('#f').length)
	{  $('#paid').removeClass('hide');
		var offset = $('#n').offset();
		$('.tip').removeClass('hide').css({'top': offset.top - 20 + 'px', 'left': offset.left+ 345 + 'px'});
		}
	else
	{$('#notpaid').removeClass('hide');
		var offset = $('#s').offset();
		$('.tip').removeClass('hide').css({'top': offset.top - 20 + 'px', 'left': offset.left+ 160 + 'px'});
		$('.p').css('border-color','#ccc #F0E68C #ccc #ccc');
		}
});// JavaScript Document