
function checkusername(){
	var name=$(".a-userid").attr("value");
	$.ajax({
		type:"post",
		url:"checkusername",
		dataType:"json",
		data:"name="+name,
		complete:function(){
		},success:function(data){
			var result = eval(data);
			if(result['data']=="0"){
				$("#notes2").css("display","none");
				$("#notes1").css("display","inline");
			}else{
				$("#notes1").css("display","none");
				$("#notes2").css("display","inline");
			}
		}
	});
}

function addUser(){
	var name=$(".a-userid").attr("value");
	var username=$(".a-name").attr("value");
	var department=$('#department').attr("value");
	//alert(department);
	var position=$("#position").attr("value");
	var pwd=$("#pwd").attr("value");
	if(name==null){
		alert("用户名不能为空");
	}else if(username==null){
		alert("姓名不能为空");
	}else if(pwd==null){
		alert("密码不能为空");
	}else{
		$.ajax({
			type:"post",
			url:"addUser",
			dataType:"json",
			data:"userid="+name+"&"+"username="+username+"&"+"department="+department+"&"+"position="+position+"&"+"pwd="+pwd,
			complete:function(){
			},success:function(data){ 
				var result = eval(data);
				if(result['data']=="1"){
					alert("添加成功");
					window.location.href="";
				}else if(result['data']=="2"){
					alert("添加失败");
					window.location.href="";
				}else if(result['data']=="3"){
					alert("用户名已存在");
					window.location.href="";
				}
			}
		});
	}	
}

function deleteuser(){
	var str=$("input:checked");
	if(str.length==0){
		alert("请选择要删除的用户！");
	}else{
		for(i=0;str[i]!=null;i++){
			$.ajax({
				type:"post",
				url:"delUser",
				dataType:"json",
				data:"name="+str[i].name,
				complete:function(){
				},success:function(data){
					var result = eval(data);
					window.location.href="";
				}
			});
		}
	}
}

function showupd(){
	var str=$("input:checked");
	if(str.length==0){
		alert("请选择要修改的用户！");
	}else{
		for(i=0;str[i]!=null;i++){
			$.ajax({
				type:"post",
				url:"getUsermsg",
				dataType:"json",
				data:"name="+str[i].name,
				complete:function(){
				},success:function(data){
					var result = eval(data);
					if(result["data"]==null){
						alert("系统出错！");
					}else{
						$(".addUser").css("display","block");
						$(".content-user").css("display","none");
						$("#addbtn").css("display","none");
						$("#updatebtn").css("display","block");
						//alert(result["data"]["username"]);
						$(".a-userid").attr("value",result["data"]["username"]);
						$(".a-userid").attr("disabled","disabled");
						$(".a-name").attr("value",result["data"]["user_name"]);
						$(".a-name").attr("disabled","disabled");
						$('#department').attr("value",result["data"]["department_id"]);
						$("#position").attr("value",result["data"]["position_id"]);
						$("#pwdpart").css("display","none");
					}
				}
			});
		}
	}
}

function updateUser(){
	var name=$(".a-userid").attr("value");
	var department=$('#department').attr("value");
	var position=$("#position").attr("value");
	$.ajax({
		type:"post",
		url:"updateUser",
		dataType:"json",
		data:"name="+name+'&'+"department="+department+'&'+"position="+position,
		complete:function(){
		},success:function(data){
			var result = eval(data);
			if(result['data']==""){
				alert(name+"信息并没有修改");
				window.location.href="";
			}else{
				alert(name+"信息修改成功");
				window.location.href="";
			}
		}
	});
}

//各种界面获取
$(function() {
	$(".backlist").click(function(){
		$(".addUser").css("display","none");
		$(".content-user").css("display","block");
	});
	$(".rolename").click(function(){
		var roleid=$(this).attr("name");
	});
});
function showadd(){
	$(".addUser").css("display","block");
	$(".content-user").css("display","none");
}
function showuserpart(){
	$(".content-user").css("display","block");
	$(".content-role").css("display","none");
}
function showrolepart(){
	$(".content-user").css("display","none");
	$(".content-role").css("display","block");
}

function backmain(){
	$(".datapart").css("display","block");
	$(".add-content").css("display","none");
	$(".update-content").css("display","none");
	$(".content-title b").css("display","block");
	$(".content-title a").css("display","none");

}
function addshow(){
	$(".update-content").css("display","none");
	$(".datapart").css("display","none");
	$(".content-title b").css("display","none");
	$(".content-title a").css("display","block");
	$(".add-content").css("display","block");
}

function updateshow(){
	$(".add-content").css("display","none");
	$(".datapart").css("display","none");
	$(".update-content").css("display","block");
}

function addnewbulletin(){
	var name=$("#bulletinname").attr("value");
	var content=$("#bulletincontent").attr("value");
	$.ajax({
		type:"post",
		url:"addBulletin",
		dataType:"json",
		data:"name="+name+'&'+"content="+content,
		complete:function(){
		},success:function(data){
			var result = eval(data);
			if(result['data']!=''){
				alert("添加成功");
				window.location.href="";
			}
		}
	});
}

function addNewMeeting(){
	var theme=$("#m-theme").attr("value");
	var content=$("#m-content").attr("value");
	var room_id=$("#m-room").attr("value");
	var time=$("#time").attr("value");
	var hour=$("#hour").attr("value");
	var minu=$('#minu').attr("value");
	time=time+'-'+hour+'-'+minu+"-00";
	var dep=$("#department").attr("value");
	var master=$("#master").attr("value");
	var comment=$("#m-comment").attr("value");
	$.ajax({
		type:"post",
		url:"addMeeting",
		dataType:"json",
		data:"theme="+theme+'&'+"content="+content+'&'+"room_id="+room_id+'&'+"time="+time+'&'+"master="+master+'&'+"comment="+comment+'&'+"dep_id="+dep,
		complete:function(){
		},success:function(data){
			var result = eval(data);
			if(result['data']!=''){
				alert("添加成功");
				window.location.href="";
			}
		}
	});
}
function addnewduty(){
	var time=$("#time").attr("value");
	var username=$("#username").attr("value");
	$.ajax({
		type:"post",
		url:"addDuty",
		dataType:"json",
		data:"time="+time+'&'+"username="+username,
		complete:function(){
		},success:function(data){
			var result = eval(data);
			if(result['data']=='0'){
				alert("日期选择错误！");
				window.location.href="";
			}else if(result['data']==null){
				alert("当天已有人值班");
				window.location.href="";
			}else{
				window.location.href="";
			}
		}
	});
}
function addNewCar(){
	var number=$("#number").attr("value");
	var color=$("#color").attr("value");
	var time=$("#time").attr("value");
	$.ajax({
		type:"post",
		url:"addcar",
		dataType:"json",
		data:"time="+time+'&'+"number="+number+'&'+"color="+color,
		complete:function(){
		},success:function(data){
			var result = eval(data);
			if(result['data']==''){
				alert("添加失败");
				window.location.href="";
			}else{
				window.location.href="";
			}
		}
	});
}