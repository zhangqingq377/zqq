function checkUser(){
	var username= $("#username").attr("value");
	var password=$("#password").attr("value");
	if(username==null){
		alert("用户名不能为空!请输入用户名");
	}else if(password==null){
		alert("密码不能为空，请输入密码！");
	}else{
		$.ajax({
			type:"post",
			url:"checkLogin",
			dataType:"json",
			data:"username=" + username + "&" + "password=" + password,
			complete:function(){
			},success:function(data){ 
				var result = eval(data);
				if(result['data']=='1'){
					alert("登录成功");
					window.location.href="";
				}else if(result['data']=='2'){
					alert("用户名或密码错误");
					window.location.href="";
				}
			}
		});
	}
}