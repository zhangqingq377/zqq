<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" src="__TMPL__Public/js/jquery.js"></script><script type="text/javascript" src="__TMPL__Public/js/jquery-scroll.js"></script><script type="text/javascript" src="__TMPL__Public/js/user.js"></script><script type="text/javascript" src="__TMPL__Public/js/index.js"></script><script type="text/javascript" src="__TMPL__Public/js/public.js"></script><link rel="stylesheet" type="text/css" href="__TMPL__Public/css/public.css" /><script language="javascript">	function tick() {
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
</script><!-- 头部区域 --><div id="header" class="header"><div class="headTitle"><p style="color:white;margin:0;padding-top:40px;">街道政务管理系统</p><span><a style="float:right;font-size:13px;color:wheat;margin-top:60px;"  href="__APP__/Admin">进入管理员界面</a></span></div><!-- 功能导航区 --><div class="topMenu"><ul><li class="subMenu"><a href="__APP__/">首页</a></li><li class="subMenu"><a href="__APP__/User/">个人中心</a><ul><li><a href="__APP__/User/">个人信息</a></li><li><a href="__APP__/User/maillist">通讯录</a></li><li><a href="__APP__/User/scheduleList">日程管理</a></li><li><a href="__APP__/User/perSummary">个人总结</a></li></ul></li><li class="subMenu"><a href="__APP__/DailyOffice/">日常办公</a><ul><li><a href="__APP__/DailyOffice/meetManagement">会议管理</a></li><li><a href="__APP__/DailyOffice/fileManagement">文件管理</a></li><li><a href="__APP__/DailyOffice/taskManagement">任务管理</a></li><li><a href="__APP__/DailyOffice/bulletin">公告栏</a></li></ul></li><li class="subMenu"><a href="__APP__/DepSource/">部门管理</a><ul><li><a href="__APP__/DepSource/">物资管理</a></li><li><a href="__APP__/DepSource/">书刊管理</a></li><li><a href="__APP__/DepSource/car">车辆管理</a></li><li><a href="__APP__/DepSource/duty">值班管理</a></li><li><a href="__APP__/DepSource/">网上审批</a></li></ul></li><li class="subMenu"><a href="__APP__/Law/">政策法规</a><ul><li><a>规章制度</a></li><li><a href="__APP__/Law/">行业法规</a></li></ul></li><li class="subMenu"><a href="#">领导办公</a><ul><li><a>日常安排</a></li><li><a>讲话管理</a></li><li><a>批示管理</a></li></ul></li></ul></div><div class="userTitle"><span id="Clock"></span>&nbsp;,&nbsp;<a style="text-decoration:underline;" href="__APP__/User/index" ><?php echo ($_SESSION['loginUserName']); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="__APP__/Public/loginOut">退 出</a></div></div><script type="text/javascript">(function($){
$.fn.extend({
        Scroll:function(opt,callback){
                //参数初始化
                if(!opt) var opt={};
                var _btnUp = $("#"+ opt.up);//Shawphy:向上按钮
                var _btnDown = $("#"+ opt.down);//Shawphy:向下按钮
                var timerID;
                var _this=this.eq(0).find("ul:first");
                var     lineH=_this.find("li:first").height(), //获取行高
                        line=opt.line?parseInt(opt.line,10):parseInt(this.height()/lineH,10), //每次滚动的行数，默认为一屏，即父容器高度
                        speed=opt.speed?parseInt(opt.speed,10):2500; //卷动速度，数值越大，速度越慢（毫秒）
                        timer=opt.timer //?parseInt(opt.timer,10):3000; //滚动的时间间隔（毫秒）
                if(line==0) line=1;
                var upHeight=0-line*lineH;
                //滚动函数
                var scrollUp=function(){
                        _btnUp.unbind("click",scrollUp); //Shawphy:取消向上按钮的函数绑定
                        _this.animate({
                                marginTop:upHeight},speed,function(){
                                for(i=1;i<=line;i++){
                                        _this.find("li:first").appendTo(_this);
                                }
                                _this.css({marginTop:0});
                                _btnUp.bind("click",scrollUp); //Shawphy:绑定向上按钮的点击事件
                        });
                }
                //Shawphy:向下翻页函数
                var scrollDown=function(){
                        _btnDown.unbind("click",scrollDown);
                        for(i=1;i<=line;i++){
                                _this.find("li:last").show().prependTo(_this);
                        }
                        _this.css({marginTop:upHeight});
                        _this.animate({
                                marginTop:0
                        },speed,function(){
                                _btnDown.bind("click",scrollDown);
                        });
                }
               //Shawphy:自动播放
                var autoPlay = function(){
                        if(timer)timerID = window.setInterval(scrollUp,timer);
                };
                var autoStop = function(){
                        if(timer)window.clearInterval(timerID);
                };
                 //鼠标事件绑定
                _this.hover(autoStop,autoPlay).mouseout();
                _btnUp.css("cursor","pointer").click( scrollUp ).hover(autoStop,autoPlay);//Shawphy:向上向下鼠标事件绑定
                _btnDown.css("cursor","pointer").click( scrollDown ).hover(autoStop,autoPlay);
        }      
})
})(jQuery);
$(document).ready(function(){
        $(".scrollDiv").Scroll({line:1,speed:2500,timer:5000,up:"btn1",down:"btn2"});
});
</script><!--主题部分--><div class="index_main"><!--左边最近活动照片--><div class="gonggao"><h2>公告栏</h2><div class="scrollDiv"><ul><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li name="<?php echo ($vo["bulletin_id"]); ?>"><a><?php echo ($vo["bulletin_theme"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?></ul></div><span id="btn1">向前</span>&nbsp;&nbsp;<span id="btn2">向后</span></div><div class="s-user"><table id="checkList" cellpadding=0 cellspacing=0 ><tr><td height="5" colspan="5" class="topTd" ></td></tr><tr><th colspan="3">系统信息</th></tr><?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr height="23px" style="text-align:center;"><td width="45%"><?php echo ($key); ?></td><td width="55%"><?php echo ($v); ?></td></tr><?php endforeach; endif; else: echo "" ;endif; ?></table></div></div><!--结束部分--><div class="footer"><a href="#">联系我们</a>|<a href="#">站点地图</a>|<a href="#">设为首页</a></div>