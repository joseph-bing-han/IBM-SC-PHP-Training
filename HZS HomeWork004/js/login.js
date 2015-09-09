function check(){
	useridvalue = $("#userid").val();
	passvalue = $("#pass").val();
	if(useridvalue == ''){
		alert('请输入用户名');
		$("#userid").focus();
		return false;
	};
	if(passvalue == ''){
		alert('请输入密码');
		$("#pass").focus();
		return false;
	}

	$.ajax({
		type:"POST",
		url:"ajax.php?action=checkUser",
		data:{userid:useridvalue,pass:passvalue},
		success:function(data){
			if (data.sts == 0){
				alert(data.msg);
			}else{
				location.href='chat.php';
				comeinto(useridvalue);
			}
		},
		dataType: "json"
    });
};

function comeinto(userid){
	$.ajax({
		type:"POST",
		url:"ajax.php?action=insertActive",
		data:{userid:userid},
		success:function(data){
			alert('成功');
		},
		dataType: "json"
    });
}

function getfocus(){
	$("#userid").focus();
}

function regcheck(oInput){
	var ckuname = /^[0-9a-zA-Z_@\.-]+$/;
	if(!oInput.value){
		// window.setTimeout( function(){ oInput.focus(); }, 0);
		$("#showmsg").html("<font style=\'color:red;\'>用户名不可以为空！</font>");
		return false;
	}
	if(oInput.value.length<5 || oInput.value.length>20){
		$("#showmsg").html("<font style=\'color:red;\'>长度在5-20之间！</font>");
		return;
	}
	if(!ckuname.test(oInput.value)){
		$("#showmsg").html("<font style=\'color:red;\'>请使用[数字/字母/中划线/下划线/@.]！</font>");
		return;
	}

	userid = $("#userid").val();
	
	$.ajax({
		type:"POST",
		url:"ajax.php?action=checkExist",
		data:{userid:userid},
		success:function(data,st){
			if (data.sts != 1){
				$("#showmsg").html(data.msg);
			}else{
				$("#showmsg").html("");
			}
		},
		dataType: "json"
    });
}

function reg(){
	userid = $("#userid").val();
	pass1 = $("#pass1").val();
	pass2 = $("#pass2").val();

	if($("#showmsg").text() != ''){
		alert($("#showmsg").text());
		return false;
	}
	if(pass1 != pass2){
		$("#pass2").focus();
		$("#showmsg2").html("<font style=\'color:red;\'>两次密码不一致！</font>");
		return;
	}
	if(pass1.length <5 || pass1.length>20){
		$("#pass2").focus();
		$("#showmsg2").html("<font style=\'color:red;\'>密码位数5-20之间！</font>");
		return;
	}
	code_num = $("#checkcode").val();

	$.post("config/chk_code.php?act=num",{code:code_num},function(msg){
		if(msg!=1){
			alert("验证码错误！");
			return;
		}else{
			$.ajax({
				type:"POST",
				url:"ajax.php?action=reg",
				data:{userid:userid,pass:pass1},
				success:function(data,st){
					if (data.sts != true){
						alert('注册失败！');
					}else{
						alert('注册成功！');
						location.href='login.php';
					}
					
				},
				dataType: "json"
			});
		}
	});
	
};

