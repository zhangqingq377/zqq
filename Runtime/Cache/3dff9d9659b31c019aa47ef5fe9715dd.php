<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" src="__TMPL__Public/js/jquery.js"></script><script type="text/javascript" src="__TMPL__Public/js/index.js"></script><script type="text/javascript" src="__TMPL__Public/js/daily.js"></script><link rel="stylesheet" type="text/css" href="__TMPL__Public/css/public.css" /><link rel="stylesheet" type="text/css" href="__TMPL__Public/css/daily.css" /><script language="javascript">	function tick() {
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
</script><!-- 头部区域 --><div id="header" class="header"><div class="headTitle"><p style="color:white;margin:0;padding-top:40px;">街道政务管理系统</p><span><a style="float:right;font-size:13px;color:wheat;margin-top:60px;"  href="__APP__/Admin">进入管理员界面</a></span></div><!-- 功能导航区 --><div class="topMenu"><ul><li class="subMenu"><a href="__APP__/">首页</a></li><li class="subMenu"><a href="__APP__/User/">个人中心</a><ul><li><a href="__APP__/User/">个人信息</a></li><li><a href="__APP__/User/maillist">通讯录</a></li><li><a href="__APP__/User/scheduleList">日程管理</a></li><li><a href="__APP__/User/perSummary">个人总结</a></li></ul></li><li class="subMenu"><a href="__APP__/DailyOffice/">日常办公</a><ul><li><a href="__APP__/DailyOffice/meetManagement">会议管理</a></li><li><a href="__APP__/DailyOffice/fileManagement">文件管理</a></li><li><a href="__APP__/DailyOffice/taskManagement">任务管理</a></li><li><a href="__APP__/DailyOffice/bulletin">公告栏</a></li></ul></li><li class="subMenu"><a href="__APP__/DepSource/">部门管理</a><ul><li><a href="__APP__/DepSource/">物资管理</a></li><li><a href="__APP__/DepSource/">书刊管理</a></li><li><a href="__APP__/DepSource/car">车辆管理</a></li><li><a href="__APP__/DepSource/duty">值班管理</a></li><li><a href="__APP__/DepSource/">网上审批</a></li></ul></li><li class="subMenu"><a href="__APP__/Law/">政策法规</a><ul><li><a>规章制度</a></li><li><a href="__APP__/Law/">行业法规</a></li></ul></li><li class="subMenu"><a href="#">领导办公</a><ul><li><a>日常安排</a></li><li><a>讲话管理</a></li><li><a>批示管理</a></li></ul></li></ul></div><div class="userTitle"><span id="Clock"></span>&nbsp;,&nbsp;<a style="text-decoration:underline;" href="__APP__/User/index" ><?php echo ($_SESSION['loginUserName']); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="__APP__/Public/loginOut">退 出</a></div></div><div class="main_daily"><!--左边导航--><div class="main_dailyMenu"><h2 class="main_dailyMenu_title">日常办公</h2><ul><li><a href="__APP__/DailyOffice/meetManagement">会议管理</a></li><li><a href="__APP__/DailyOffice/fileManagement">文件管理</a></li><li><a href="__APP__/DailyOffice/taskManagement">任务管理</a></li><li><a href="__APP__/DailyOffice/bulletin">公告栏</a></li></ul></div><!--右边详细信息--><div class="main-management"><p>在部门中用于办公的各种信息的共享等管理操作的实现。</p></div></div><!--结束部分--><div class="footer"><a href="#">联系我们</a>|<a href="#">站点地图</a>|<a href="#">设为首页</a></div>