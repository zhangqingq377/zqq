
//已修改
function changeMSG(){
	var newphone=$('#userphone').attr('value');
	var newmail=$('#usermail').attr('value');
	var emailreg=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	var phonereg=/^0{0,1}(13[0-9]|15[0-9]|15[0-2]|18[7-9])[0-9]{8}$/;
	if (! phonereg.test(newphone)){
		alert("联系号码格式不正确");
	}
	else if (! emailreg.test(newmail)){
		alert("电子邮件格式不正确");
	}else{
		$.ajax({
			type:"post",
			url:"changeMsg",
			dataType:"json",
			data:"email="+newmail+"&"+"phone="+newphone,
			complete:function(){
			},success:function(data){ 
				var result = eval(data);
				if(result['data']==false){
					alert("信息修改失败");
					window.location.href="";
				}else{
					alert("信息修改成功");
					window.location.href="";
				}
			}
		});
	}
}
//已修改
function changePWD(){
	//var username=$('#username1').attr('value');
	var oldpwd=$('#oldpwd').attr('value');
	var newpwd=$('#newpwd').attr('value');
	var repwd=$('#repwd').attr('value');
	if(oldpwd==""){
		alert("请输入原密码！");
	}else if(newpwd==""){
		alert("密码不能为空，请输入新密码！");
	}else if(repwd!=newpwd){
		alert("两次输入密码不一致，请重新输入！");
	}else{
		$.ajax({
			type:"post",
			url:"checkLogin",
			dataType:"json",
			data:"password=" + oldpwd,
			complete:function(){
			},success:function(data){ 
				var result = eval(data);
				if(result['data']==null){
					alert("输入的原密码错误！");
					window.location.href="";
				}else{
					$.ajax({
						type:"post",
						url:"changePwd",
						dataType:"json",
						data:"password="+newpwd,
						complete:function(){
							alert("修改成功！");
							window.location.href="../Public/login";
						},success:function(data){
						}
					});
				}
			}
		});
	}
}

function deleteUser(){
	var username=$("#username2").attr("value");
	if(username==null){
		alert("删除用户必须输入用户名！");
	}
	$.ajax({
			type:"post",
			url:"user/deleteUser",
			dataType:"json",
			data:"username=" + username,
			complete:function(){
			},success:function(data){ 
				var result = eval(data);
				//alert(result['data']);
				if(result['data']=='1'){
					alert("delete success!");
				}else if(result['data']=='2'){
					alert("detele failed!");
				}else if(result['data']=='3'){
					alert("该用户不存在！");
				}
			}
		});
}
//新添加
function showMsg(){
	$(".main_userMsg").css("display","block");
	$(".main_userMsg_update").css("display","none");
	$(".main_userMsg_changePwd").css("display","none");
}
function showupdate(){
	$(".main_userMsg").css("display","none");
	$(".main_userMsg_update").css("display","block");
	$(".main_userMsg_changePwd").css("display","none");
}
function showchange(){
	$(".main_userMsg").css("display","none");
	$(".main_userMsg_update").css("display","none");
	$(".main_userMsg_changePwd").css("display","block");
}
//弹出框效果
$(function() {
	$('#create-mail').click(function() {
		$('#dialog-addMail').dialog('open');
	});
	$('#delete-mail').click(function() {
		var str=$("input:checked");
		if(str.length==0){
			alert("请选择要删除的联系人！");
		}
		else{
		for(i=0;str[i]!=null;i++){
			$(".datalist").append("<div class='data'><b>"+str[i].name+"</b></div>");
		}
		$('#dialog-delMail').dialog('open');
		}
	});
	
	$('.delete-schedule').click(function() {
		var str=$("input:checked");
		if(str.length==0){
			alert("请选择要删除的日程！");
		}
		else{
			for(i=0;str[i]!=null;i++){
				$(".datalist").append("<div class='data'><b>"+str[i].name+"</b></div>");
			}
			$('#dialog-delSchedule').dialog('open');
		}
	});

	$(".edit-ico").click(function(){
		//alert($(this).parent().prev().prev().prev().children().attr("name"));
		var schedule_id=$(this).parent().prev().prev().prev().children().attr("name");
		//alert(schedule_id);
		
		$.ajax({
			type:"post",
			url:"getDetailSchedule",
			dataType:"json",
			data:"schedule_id="+schedule_id,
			complete:function(){
			},success:function(data){
				var result=eval(data);
				//alert(result['info']);
				var detail=result['data'][0];
				//alert(detail);
				if(detail==null){
					alert("数据加载失败！");
				}else{
					$("#theme").attr("name",detail['schedule_id']);
					$("#theme").attr("value",detail['schedule_theme']);
					$("#starttime").attr("value",detail['schedule_dateFrom']);
					$("#stoptime").attr("value",detail['schedule_dateTo']);
					$("textarea").attr("value",detail['schedule_message']);
					$(".sub_schedulelist").css("display","none");
					$(".sub_newschedule").css("display","block");	
				}
			}
		});
	});
	
	$('.delete-summary').click(function() {
		var str=$("input:checked");
		if(str.length==0){
			alert("请选择要删除的个人总结！");
		}
		else{
			for(i=0;str[i]!=null;i++){
				$(".datalist").append("<div class='data'><b>"+str[i].name+"</b></div>");
			}
			$('#dialog-delSummary').dialog('open');
		}
	});

	$(".summary_theme").click(function(){
		var summary_id=$(this).parent().prev().children('input').attr("name");
		$.ajax({
			type:"post",
			url:"getDetailSummary",
			dataType:"json",
			data:"summary_id="+summary_id,
			complete:function(){
			},success:function(data){
				var result=eval(data);
				//alert(result['info']);
				var detail=result['data'][0];
				//alert(detail);
				if(detail==null){
					alert("数据加载失败！");
				}else{
					$("#theme").attr("name",detail['summary_id']);
					$("#theme").attr("value",detail['summary_theme']);
					$("#content").attr("value",detail['summary_content']);
					$(".sub_summarylist").css("display","none");
					$(".edit_summary").css("display","block");	
				}
			}
		});
	});

	$(".summaryedit-ico").click(function(){
		//alert($(this).parent().prev().prev().prev().children().attr("name"));
		var summary_id=$(this).parent().prev().prev().prev().prev().children('input').attr("name");
		//alert(summary_id);
		$.ajax({
			type:"post",
			url:"getDetailSummary",
			dataType:"json",
			data:"summary_id="+summary_id,
			complete:function(){
			},success:function(data){
				var result=eval(data);
				//alert(result['info']);
				var detail=result['data'][0];
				//alert(detail);
				if(detail==null){
					alert("数据加载失败！");
				}else{
					$("#theme").attr("name",detail['summary_id']);
					$("#theme").attr("value",detail['summary_theme']);
					$("#content").attr("value",detail['summary_content']);
					$(".sub_summarylist").css("display","none");
					$(".edit_summary").css("display","block");	
				}
			}
		});
	});
	$(".sendsummary").click(function(){
		var theme=$("#theme").attr("value");
		var summary_id=$("#theme").attr("name");
		var content=$("#content").attr("value");
		if(theme==''||content==''){
			alert("信息输入不全，请确认！");
		}else{ 
			if(summary_id==""){
				$.ajax({
					type:"post",
					url:"newSummary",
					dataType:"json",
					data:"theme="+theme+'&'+"content="+content,
					complete:function(){
					},success:function(data){
						var result=eval(data);
						$("#dialog-mailList").attr("name",result['data']);
					}
				});
			}else{
				$.ajax({
					type:"post",
					url:"saveSummary",
					dataType:"json",
					data:"theme="+theme+'&'+"content="+content+'&'+"id="+summary_id,
					complete:function(){
					},success:function(data){
						$("#dialog-mailList").attr("name",summary_id);
					}
				});
			}
			$('#dialog-mailList').dialog('open');
		}
	});
});

function cancel(){
	$('.dialog').dialog('close');

}
function addNewMail(){
	var mail_name = $('#name').attr("value");
	//alert(mail_name);
	var mail_phone = $('#phone').attr("value");
	//alert(mail_phone);
	var mail_email = $('#email').attr('value');
	//alert(mail_email);
	var emailreg=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	var phonereg=/^0{0,1}(13[0-9]|15[0-9]|15[0-2]|18[7-9])[0-9]{8}$/;
	if(mail_name==''){
		alert("联系人姓名不能为空！");
	}else if(mail_phone=='' & mail_email==''){
		alert("至少需要输入联系人电话或者电子邮件！");
	}else if(! emailreg.test(mail_email)){
		alert("电子邮件格式不正确");
	}else if (! phonereg.test(mail_phone)){
		alert("联系号码格式不正确");
	}else{
		$.ajax({
			type:"post",
			url:"addMail",
			dataType:"json",
			data:"mail_name="+mail_name+'&'+"mail_phone="+mail_phone+'&'+"mail_email="+mail_email,
			complete:function(){
			},success:function(data){
				var result=eval(data);
				//alert(result['data']);确定是主键值
				if(result['data']==null){
					alert("联系人添加失败，请稍后再试！");
					window.location.href="";
				}else{
					alert("联系人添加成功！");
					window.location.href="";
				}
			}
		});
	}
}
function deleteMail(){
	var str=$(".data b");
	//alert(str[0]);
	for(i=0;str[i]!=null;i++){
		var mail_id=str[i].innerHTML.split('<b>');
		//alert(mail_id);
		$.ajax({
			type:"post",
			url:"delMail",
			dataType:"json",
			data:"mail_id="+mail_id,
			complete:function(){
			},success:function(data){
			}
		});
	}
	window.location.href="";
}
function deleteSchedule(){
	var str=$(".data b");
	var flag;
	//alert(str[0].innerHTML.split('<b>'));
	for(i=0;str[i]!=null;i++){
		var schedule_id=str[i].innerHTML.split('<b>');
		//alert(schedule_id);
		$.ajax({
			type:"post",
			url:"delSchedule",
			dataType:"json",
			data:"schedule_id="+schedule_id,
			complete:function(){
			},success:function(data){
				var result=eval(data);
				flag=result['data'];
			}
		});
	}
	//alert(flag);
	window.location.href="";
}

function newScheduleshow(){
	$("#theme").attr("value","");
	$("#starttime").attr("value","");
	$("#stoptime").attr("value","");
	$("textarea").attr("value","");
	$(".sub_schedulelist").css("display","none");
	$(".sub_newschedule").css("display","block");
}
function returnback(){
	$(".sub_schedulelist").css("display","block");
	$(".sub_newschedule").css("display","none");
}
function saveSchedule(){
	var theme=$("#theme").attr("value");
	var starttime=$("#starttime").attr("value");
	var stoptime=$("#stoptime").attr("value");
	var msg=$("textarea").attr("value");
	if(theme==""||starttime==""||stoptime==""||msg==""){
		alert("信息输入不全！你确认！");
	}else{
		var schedule_id=$("#theme").attr("name");
		if(schedule_id==""){
			//alert("新建");
			$.ajax({
				type:"post",
				url:"newSchedule",
				dataType:"json",
				data:"schedule_theme="+theme+'&'+"datefrom="+starttime+'&'+"message="+msg+'&'+"dateto="+stoptime,
				complete:function(){
				},success:function(data){
					var result=eval(data);
					if(result['data']==null){
						alert("系统发生错误！");
					}else{
						window.location.href="";
					}
				}
			});
		}else{
			//alert("编辑保存");
			$.ajax({
				type:"post",
				url:"saveSchedule",
				dataType:"json",
				data:"schedule_id="+schedule_id+'&'+"schedule_theme="+theme+'&'+"datefrom="+starttime+'&'+"message="+msg+'&'+"dateto="+stoptime,
				complete:function(){
				},success:function(data){
					var result=eval(data);
					if(result['data']=='0'){
						alert("日程表并没有改变！");
						window.location.href="";
					}else if(result['data']=='1'){
						alert("修改成功");
						window.location.href="";
					}
				}
			});
		}
	}
}
//个人总结
function backback(){
	$(".sub_summarylist").css("display","block");
	$(".edit_summary").css("display","none");
}
function NewSummaryShow(){
	$("#theme").attr("value","");
	$("#theme").attr("name","");
	$("#content").attr("value","");
	$(".edit_summary").css("display","block");
	$(".sub_summarylist").css("display","none");

}
function deleteSummary(){
	var str=$(".data b");
	//alert(str[0]);
	for(i=0;str[i]!=null;i++){
		var summary_id=str[i].innerHTML.split('<b>');
		//alert(mail_id);
		$.ajax({
			type:"post",
			url:"delSummary",
			dataType:"json",
			data:"summary_id="+summary_id,
			complete:function(){
			},success:function(data){
			}
		});
	}
	window.location.href="";
}
function saveSummary(){
	var theme=$("#theme").attr("value");
	var summary_id=$("#theme").attr("name");
	var content=$("#content").attr("value");
	if(theme==''||content==''){
		alert("信息输入不全，请确认！");
	}else if(summary_id==""){
		$.ajax({
			type:"post",
			url:"newSummary",
			dataType:"json",
			data:"theme="+theme+'&'+"content="+content,
			complete:function(){
			},success:function(data){
				var result=eval(data);
				if(result['data']==null){
					alert("系统发生错误！");
				}else{
					window.location.href="";
				}
			}
		});
	}else{
		$.ajax({
			type:"post",
			url:"saveSummary",
			dataType:"json",
			data:"theme="+theme+'&'+"content="+content+'&'+"id="+summary_id,
			complete:function(){
			},success:function(data){
				var result=eval(data);
				if(result['data']=='0'){
					alert("个人总结并没有改变！");
					window.location.href="";
				}else if(result['data']=='1'){
					alert("修改成功");
					window.location.href="";
				}

			}
		});
	}
}
function suresend(){
	var summary_id=$('#dialog-mailList').attr("name");
	//alert(summary_id);
	var str=$("input:checked");
	if(str.length==0){
		alert("请选择要发送的对象！");
	}
	else{
		for(i=0;str[i]!=null;i++){
			var username=str[i].name;
			//alert(username);
			$.ajax({
				type:"post",
				url:"sendSummary",
				dataType:"json",
				data:"tousername="+username+"&"+"summary_id="+summary_id,
				complete:function(){
				},success:function(data){
				}
			});
		}
		window.location.href="";
	}
}