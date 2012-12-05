<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" src="__TMPL__Public/js/jquery.js"></script><script type="text/javascript" src="__TMPL__Public/js/ui.core.js"></script><script type="text/javascript" src="__TMPL__Public/js/ui.dialog.js"></script><script type="text/javascript" src="__TMPL__Public/js/ui.datepicker.js"></script><script type="text/javascript" src="__TMPL__Public/js/index.js"></script><script type="text/javascript" src="__TMPL__Public/js/user.js"></script><script type="text/javascript">$(function() {
	$('.datepicker').datepicker({
		dateFormat: "yy-mm-dd",
		showButtonPanel: true
	});
	$('#dateShow').datepicker();
	$("#dialog-delSchedule").dialog({
		bgiframe: true,
		autoOpen: false,
		height: 100,
		modal: true,
	});
});
</script><link rel="stylesheet" type="text/css" href="__TMPL__Public/css/public.css" /><link rel="stylesheet" type="text/css" href="__TMPL__Public/css/user.css" /><link rel="stylesheet" type="text/css" href="__TMPL__Public/css/ui.all.css" /><script language="javascript">	function tick() {
		var today=new Date();
		var month=today.getMonth()+1;//--getMonth显示当前月份-1，所以要+1才能显示当前月份-->		var year, date, hours, minutes, seconds;
		var intHours, intMinutes, intSeconds;
		var week=new Array(); //--显示几天为星期几-->		week[0]="星期天 ";
		week[1]="星期一 ";
		week[2]="星期二 ";
		week[3]="星期三 ";
		week[4]="星期四 ";
		week[5]="星期五 ";
		week[6]="星期六 "; 
		intHours = today.getHours();
		intMinutes = today.getMinutes();
		intSeconds = today.getSeconds();
		year=today.getFullYear();
		date=today.getDate();
		
		if (intHours == 0) {
		 hours = "00:";
		} else if (intHours < 10) { 
		 hours = "0" + intHours+":";
		} else {
		 hours = intHours + ":";
		}
		if (intMinutes < 10) {
		 minutes = "0"+intMinutes+":";
		} else {
		 minutes = intMinutes+":";
		}
		if (intSeconds < 10) {
		seconds = "0"+intSeconds+" ";
		} else {
		seconds = intSeconds+" ";
		} 
		var time="午夜好";
		if(today.getHours()<=22)  time="晚上好";
		if(today.getHours()<=19)  time="傍晚好";
		if(today.getHours()<=17)  time="下午好";
		if(today.getHours()<=14)  time="中午好";
		if(today.getHours()<=12)  time="上午好";
		if(today.getHours()<=8)   time="早上好";
		if(today.getHours()<=5)   time="凌晨好";

		timeString="今天是："+year+"年"+month+"月"+date+"日  "+hours+minutes+seconds+week[today.getDay()]+time;
		document.getElementById("Clock").innerHTML = timeString;
		window.setTimeout("tick();", 1000);
	}
	window.onload = tick;
</script><!-- 头部区域 --><div id="header" class="header"><div class="headTitle"><p style="color:white;margin:0;padding-top:40px;">街道政务管理系统</p><span><a style="float:right;font-size:13px;color:wheat;margin-top:60px;"  href="__APP__/Admin">进入管理员界面</a></span></div><!-- 功能导航区 --><div class="topMenu"><ul><li class="subMenu"><a href="__APP__/">首页</a></li><li class="subMenu"><a href="__APP__/User/">个人中心</a><ul><li><a href="__APP__/User/">个人信息</a></li><li><a href="__APP__/User/maillist">通讯录</a></li><li><a href="__APP__/User/scheduleList">日程管理</a></li><li><a href="__APP__/User/perSummary">个人总结</a></li></ul></li><li class="subMenu"><a href="__APP__/DailyOffice/">日常办公</a><ul><li><a href="__APP__/DailyOffice/meetManagement">会议管理</a></li><li><a href="__APP__/DailyOffice/fileManagement">文件管理</a></li><li><a href="__APP__/DailyOffice/taskManagement">任务管理</a></li><li><a href="__APP__/DailyOffice/bulletin">公告栏</a></li></ul></li><li class="subMenu"><a href="__APP__/DepSource/">部门管理</a><ul><li><a href="__APP__/DepSource/">物资管理</a></li><li><a href="__APP__/DepSource/">书刊管理</a></li><li><a href="__APP__/DepSource/car">车辆管理</a></li><li><a href="__APP__/DepSource/duty">值班管理</a></li><li><a href="__APP__/DepSource/">网上审批</a></li></ul></li><li class="subMenu"><a href="__APP__/Law/">政策法规</a><ul><li><a>规章制度</a></li><li><a href="__APP__/Law/">行业法规</a></li></ul></li><li class="subMenu"><a href="#">领导办公</a><ul><li><a>日常安排</a></li><li><a>讲话管理</a></li><li><a>批示管理</a></li></ul></li></ul></div><div class="userTitle"><span id="Clock"></span>&nbsp;,&nbsp;<a style="text-decoration:underline;" href="__APP__/User/index" ><?php echo ($_SESSION['loginUserName']); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="__APP__/Public/loginOut">退 出</a></div></div><div class="main_user"><!--左边导航--><div class="main_userMenu"><h2 class="main_userMenu_title">个人中心</h2><ul><li><a href="__APP__/User/">个人信息</a></li><li><a href="__APP__/User/maillist">通讯录</a></li><li><a href="__APP__/User/scheduleList">日程管理</a></li><li><a href="__APP__/User/perSummary">个人总结</a></li></ul></div><div id="dialog-delSchedule" class="dialog" title="删除日程"><p>确定删除该日程？</p><div class="datalist"></div><button onclick="cancel()">取消</button><button onclick="deleteSchedule()">确定</button></div><!--右边详细信息--><div class="main_schedule"><h2 class="subNav">日程管理</h2><div class="showmsgpart"><!--显示日程表信息--><div class="sub_schedulelist"><div class="listlan"><div class="sc-menu"><a onclick="newScheduleshow()">新建</a><a class="delete-schedule">删除</a></div></div><table><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr><td width="7%" style="padding-left:8px;"><input type="checkbox" name="<?php echo ($vo["schedule_id"]); ?>"/></td><td width="43%"><?php echo ($vo["schedule_theme"]); ?></td><td width="42%"><?php echo ($vo["schedule_dateFrom"]); ?>  TO  <?php echo ($vo["schedule_dateTo"]); ?></td><td width="8%" style="padding-left:12px;"><div class="edit-ico"></div></td></tr><?php endforeach; endif; else: echo "" ;endif; ?></table><div class="listlan"><div class="sc-menu"><a onclick="newScheduleshow()">新建</a><a class="delete-schedule">删除</a></div></div></div><!--新建日程表/修改--><div class="sub_newschedule"><div class="listlan"><div class="sc-menu"><a onclick="returnback()">返回</a><a onclick="saveSchedule()">保存</a></div></div><table class="new_schedule"><tr><td class="schedule_title">主题:</td><td><input type="text" style="width:100%" id="theme"/></td></tr><tr><td class="schedule_title">时间:</td><td><input type="text" class="datepicker" readonly="true" id="starttime"><span style="float:left;font-size:13px;margin:3px 7px 0 7px;">至</span><input type="text" class="datepicker" readonly="true" id="stoptime"></td></tr><tr><td class="schedule_title">归类:</td><td><select><option>默认</option></select></td></tr><tr><td class="schedule_title">内容:</td><td><textarea style="width:100%;height:50px;font-size:13px;"/></textarea></td></tr><tr><td colspan="2"><div class="buttons"><a onclick="saveSchedule()">保存</a><a style="margin-left:5px;">取消</a></td></tr></table><div class="listlan"><div class="sc-menu"><a onclick="returnback()">返回</a><a onclick="saveSchedule()">保存</a></div></div></div></div></div><div id="dateShow"></div></div><!--结束部分--><div class="footer"><a href="#">联系我们</a>|<a href="#">站点地图</a>|<a href="#">设为首页</a></div>