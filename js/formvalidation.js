jQuery.fn.checkform = function (input_type, required){
	var id = /^\w+[\d\w_]{3,20}/;
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