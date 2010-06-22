jQuery.fn.checkform = function (input_type, required){
	var id = /^\w+[\d\w_]{3,20}/;
	var pw = /.{6,14}/;
	var yz = /^\d{4}$/;
	var email = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
	var taobao = /.{5,20}/;
	var qq = /^\d+/;
	//var req = /.+/;//����
	var testvalue = $(this).val();
	if(required === true){
		if(testvalue !== ''){
			$(this).next().remove();
			if(input_type === 'id'){
				var r = id.test(testvalue);
				if(r !== true){
					if(!$(this).next().is("span")){
						$(this).after("<span class='errormsg'>�û�����ʽ����ȷ</span>");
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
						$(this).after("<span class='errormsg'>����Ϊ6-14λ</span>");
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
						$(this).after("<span class='errormsg'>������֤��</span>");
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
				$(this).after("<span class='errormsg'>�ֶβ���Ϊ��</span>");
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
						$(this).after("<span class='warningmsg'>�����˺Ÿ�ʽ����ȷ</span>");
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
						$(this).after("<span class='warningmsg'>�ʼ���ַ��ʽ����ȷ</span>");
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
						$(this).after("<span class='warningmsg'>qq�Ÿ�ʽ����ȷ</span>");
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
		$(this).after("<span class='errormsg'>ȷ�����������벻һ��</span>");
		return false;
	}
}