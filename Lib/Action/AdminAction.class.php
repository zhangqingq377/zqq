<?php
class AdminAction extends Action
{
	public function index(){
		$role_id=$_SESSION["role"];
		//dump($role_id);
		if(!isset($_SESSION[C('USER_AUTH_KEY')])){
			$this->assign('jumpUrl','__APP__/Public/login');
			$this->error('没有登录');
		}else if($role_id=="3"){
			$this->assign('jumpUrl','__APP__/');
			$this->error('您没有权限！');
		}else if($role_id=="1"){
			$this->redirect('Admin/sadmin','页面跳转中……');
		}else if($role_id=="2"){
			$this->redirect('Admin/madmin','页面跳转中……');
		}else{
			$this->display();
		}
	}
	public function sadmin(){
		//echo "System admin!";
		$user=D("User");
		import("@.ORG.Page");
		$count=$user->count();
		$p=new Page($count,10);
		$volist=$user->join("department on department.department_id=user.department_id")->join("position on position.position_id=user.position_id")->join("role on role.role_id=user.role_id")->limit($p->firstRow.','.$p->listRows)->select();
		$page = $p->show();

		$dep=D("Department");
		$deplist=$dep->findAll();
		
		$pos=D("Position");
		$poslist=$pos->findAll();

		$role=D("Role");
		$rolelist=$role->findAll();

		$this->assign('role',$rolelist);
		$this->assign('pos',$poslist);
		$this->assign('dep',$deplist);
		$this->assign('list',$volist);
		$this->assign("count", $count);
		$this->assign("page", $page);
		$this->display();
	}

	public function checkusername(){
		$name=$_POST['name'];
		$User=D("User");
		if($User->checkUsername($name)==null){
			$this->ajaxReturn("0");
		}else{
			$this->ajaxReturn("1");
		}
	}
	
	public function addUser(){
		$userid=$_POST['userid'];
		$User=D("User");
		if($User->checkUsername($userid)==null){
			//$U=M("User");
			$data['username']=$userid;
			$data['user_password']=md5($_POST['pwd']);
			if($_POST['department']<7){
				$data['role_id']=2;
			}else{
				$data['role_id']=3;
			}
			$data['user_name']=$_POST['username'];
			$data['department_id']=$_POST['department'];
			$data['position_id']=$_POST['position'];
			$result=$User->add($data);
			//dump($result);
			if($result){
				$this->ajaxReturn('1');
			}else{
				$this->ajaxReturn('2');
			}
			//$this->ajaxReturn($result);
			//$result=$User->addUser($userid,$username,$department,$position,$email,$phone,$password);
		}else{
			$this->ajaxReturn('3');
		}
		
	}
	
	public function getUsermsg(){
		$name=$_POST['name'];
		$user=M("User");
		$result=$user->where("username='$name'")->find();
		$this->ajaxReturn($result);
	}
	
	public function updateUser(){
		$name=$_POST['name'];
		$department_id=$_POST['department'];
		$position_id=$_POST['position'];
		if($position_id<7){
			$role_id=2;
		}else{
			$role_id=3;
		}
		$user=M("User");
		$result=$user->where("username='$name'")->setField(array('department_id','position_id','role_id'),array($department_id,$position_id,$role_id));
		//dump($result);
		$this->ajaxReturn($result);
	}

	public function delUser(){
		$name=$_POST['name'];
		$user=M("User");
		$result=$user->where("username='$name'")->delete();
		$this->ajaxReturn($result);
	}

	public function madmin(){
		//echo "message admin!";
		$user=M("User");
		$room=M("Room");
		$dep=M("Department");
		$b=M("Bulletin");
		$m=M("Meeting");
		
		$user=$user->findAll();
		$room=$room->findAll();
		$dep=$dep->findAll();

		import("@.ORG.Page");
		$bcount=$b->count();
		$mcount=$m->count();
		$bp=new Page($bcount,7);
		$mp=new Page($mcount,3);
		$blist=$b->limit($bp->firstRow.','.$bp->listRows)->select();
		$mlist=$m->where()->join("department on department.department_id=meeting.department_id")->join("room on meeting.room_id=room.room_id")->join("user on user.username=meeting.meeting_master")->limit($mp->firstRow.','.$mp->listRows)->select();
		//dump($mlist);
		for($i=0;$blist[$i]!=null;$i++){
			if($blist[$i]['creat_time']==''){
			}else{
				$blist[$i]['creat_time']=date('Y-m-d H:i:s',$blist[$i]['creat_time']);
			}
		}
		for($i=0;$mlist[$i]!=null;$i++){
			if($mlist[$i]['department_name']==''){
				$mlist[$i]['department_name']="全体部门";
			}
			if($mlist[$i]['meeting_starttime']==''){
			}else{
				$mlist[$i]['meeting_starttime']=date('Y-m-d H:i',$mlist[$i]['meeting_starttime']);
			}
			if($mlist[$i]['meeting_stoptime']==''){
			}else{
				$mlist[$i]['meeting_stoptime']=date('Y-m-d H:i',$mlist[$i]['meeting_stoptime']);
			}
			if($mlist[$i]['meeting_posttime']==''){
			}else{
				$mlist[$i]['meeting_posttime']=date('Y-m-d H:i:s',$mlist[$i]['meeting_posttime']);
			}
		}
		$bpage = $bp->show();
		$mpage = $mp->show();

		//dump($blist);
		//dump($mlist);
		$this->assign('user',$user);
		$this->assign('room',$room);
		$this->assign('dep',$dep);

		$this->assign("b",$blist);
		$this->assign("bcount", $bcount);
		$this->assign("bpage", $bpage);

		$this->assign("m",$mlist);
		$this->assign("mcount", $mcount);
		$this->assign("mpage", $mpage);


		$this->display();

	}
	public function bulletin(){
		$user=M("User");
		$room=M("Room");
		$dep=M("Department");
		$b=M("Bulletin");
		
		$user=$user->findAll();
		$room=$room->findAll();
		$dep=$dep->findAll();

		import("@.ORG.Page");
		$bcount=$b->count();
		$bp=new Page($bcount,7);
		$blist=$b->limit($bp->firstRow.','.$bp->listRows)->select();

		for($i=0;$blist[$i]!=null;$i++){
			if($blist[$i]['creat_time']==''){
			}else{
				$blist[$i]['creat_time']=date('Y-m-d H:i:s',$blist[$i]['creat_time']);
			}
		}
		$bpage = $bp->show();
		//dump($blist);
		//dump($mlist);
		$this->assign('user',$user);
		$this->assign('room',$room);
		$this->assign('dep',$dep);

		$this->assign("b",$blist);
		$this->assign("bcount", $bcount);
		$this->assign("bpage", $bpage);

		$this->display();

	}
	public function meeting(){
		$user=M("User");
		$room=M("Room");
		$dep=M("Department");
		$m=M("Meeting");
		
		$user=$user->findAll();
		$room=$room->findAll();
		$dep=$dep->findAll();

		import("@.ORG.Page");
		$mcount=$m->count();
		$mp=new Page($mcount,3);
		$mlist=$m->where()->join("department on department.department_id=meeting.department_id")->join("room on meeting.room_id=room.room_id")->join("user on user.username=meeting.meeting_master")->limit($mp->firstRow.','.$mp->listRows)->select();
		//dump($mlist);

		for($i=0;$mlist[$i]!=null;$i++){
			if($mlist[$i]['department_name']==''){
				$mlist[$i]['department_name']="全体部门";
			}
			if($mlist[$i]['meeting_starttime']==''){
			}else{
				$mlist[$i]['meeting_starttime']=date('Y-m-d H:i',$mlist[$i]['meeting_starttime']);
			}
			if($mlist[$i]['meeting_stoptime']==''){
			}else{
				$mlist[$i]['meeting_stoptime']=date('Y-m-d H:i',$mlist[$i]['meeting_stoptime']);
			}
			if($mlist[$i]['meeting_posttime']==''){
			}else{
				$mlist[$i]['meeting_posttime']=date('Y-m-d H:i:s',$mlist[$i]['meeting_posttime']);
			}
		}
		$mpage = $mp->show();

		//dump($blist);
		//dump($mlist);
		$this->assign('user',$user);
		$this->assign('room',$room);
		$this->assign('dep',$dep);

		$this->assign("m",$mlist);
		$this->assign("mcount", $mcount);
		$this->assign("mpage", $mpage);

		$this->display();
	}
	public function addBulletin(){
		$b=M("Bulletin");
		$data['bulletin_theme']=$_POST['name'];
		$data['bulletin_content']=$_POST['content'];
		$data['creat_time']=time();
		$result=$b->add($data);
		$this->ajaxReturn($result);
	}
	public function addMeeting(){
		$meet=M("Meeting");
		$data['meeting_theme']=$_POST['theme'];
		$data['room_id']=$_POST['room_id'];
		$time=$_POST['time'];
		$arr = explode('-',$time);
		// 按 "-" 分隔成数组,也可以是其它的分隔符
		$time = mktime($arr[3],$arr[4],$arr[5],$arr[1],$arr[2],$arr[0]);
		// 根据数组中的三个数据生成UNIX时间戳mktime(时,分,秒,月,日,年)
		$data['meeting_starttime']=$time;
		$data['meeting_master']=$_POST['master'];
		$data['meeting_content']=$_POST['content'];
		$data['meeting_postusername']=$_SESSION[C('USER_AUTH_KEY')];
		$data['meeting_posttime']=time();
		$data['department_id']=$_POST['dep_id'];
		$data['meeting_comment']=$_POST['comment'];
		$result=$meet->add($data);
		$this->ajaxReturn($result);
	}
	
	public function duty(){
		$user=M("User");
		$user=$user->findAll();
		$duty=M("Duty");
		import("@.ORG.Page");
		$count=$duty->count();
		$p=new Page($count,7);
		$list=$duty->where()
			->join("user on user.username=duty.username")->order("duty_date asc")->limit($p->firstRow.','.$p->listRows)->select();
		for($i=0;$list[$i]!=null;$i++){
			if($list[$i]['duty_date']<time()){
				if($list[$i]['duty_situation']==0){
				$this->setDutyType($list[$i]['duty_id']);
				$list[$i]['duty_situation']=2;
				}
			}
			if($list[$i]['duty_situation']==0){
					$list[$i]['duty_situation']="时间未到";
			}else if($list[$i]['duty_situation']==1){
				$list[$i]['duty_situation']="已值班";
			}else if($list[$i]['duty_situation']==2){
				$list[$i]['duty_situation']="未值班";
			}else{
				$list[$i]['duty_situation']="系统发生错误！请联系管理员";
			}

			if($list[$i]['duty_date']==''){
			}else{
				$list[$i]['duty_date']=date('Y-m-d',$list[$i]['duty_date']);
			}
		}
		$page = $p->show();
		//dump($page);
		$this->assign('user',$user);

		$this->assign("volist",$list);
		$this->assign("count", $count);
		$this->assign("page", $page);
		$this->display();

	}
	private function setDutyType($duty_id){
		$duty=M("Duty");
		$duty->where("duty_id='$duty_id'")->setField('duty_situation',2);
	}
	public function addDuty(){
		$duty=M("Duty");
		$today=time();
		$time=$_POST['time'];
		$arr = explode('-',$time);
		$time = mktime(0,0,0,$arr[1],$arr[2],$arr[0]);
		$flag=$duty->where("duty_date='$time'")->select();
		if($flag!=null){
			$this->ajaxReturn(null);
		}else if($time>$today){
			$data['username']=$_POST['username'];
			$data['duty_date']=$time;
			$data['duty_situation']=0;
			$result=$duty->add($data);
			$this->ajaxReturn($result);
		}else{
			$this->ajaxReturn("0");
		}
	}
	public function law(){
		$law=M("Law");
		$volist=$law->findAll();
		//dump($volist);
		$this->assign("list",$volist);
		$this->display();
		
	}
	public function things(){
		$car=M("Car");
		$clist=$car->findAll();
		for($i=0;$clist[$i]!=null;$i++){
			$clist[$i]['car_purchasedate']=date('Y-m-d',$clist[$i]['car_purchasedate']);
			if($clist[$i]['car_type']==0){
				$clist[$i]['car_type']="空闲";
			}else if($clist[$i]['car_type']==1){
				$clist[$i]['car_type']='使用中';
			}else if($clist[$i]['car_type']==2){
				$clist[$i]['car_type']='订了';
			}
		}
		$this->assign("c",$clist);
		$this->display();
	}
	public function addcar(){
		$car=M("Car");
		$time=$_POST['time'];
		$arr = explode('-',$time);
		$data['car_purchasedate'] = mktime(0,0,0,$arr[1],$arr[2],$arr[0]);
		$data['car_license_number']=$_POST['number'];
		$data['car_color']=$_POST['color'];
		$data['car_type']="0";
		$data['link_use']='0';
		$result=$car->add($data);
		$this->ajaxReturn($result);
	}
	public function usecar(){
		$number=$_GET['number'];
		$car = M("Car");
		$use = M("Usecarlist");
		if($car->where("car_license_number='$number'")->getField("car_type")==1){
		}else if($car->where("car_license_number='$number'")->getField("car_type")==0){
			$data['username']=$_SESSION[C('USER_AUTH_KEY')];
			$data['car_license_number']=$number;
			$data['usecar_starttime']=time();
			$data['usecar_comment']="使用";
			$use_id=$use->add($data);
			//$User->where('score>80')->order('score desc')->last();
			$car->where("car_license_number='$number'")->setField(array('car_type','link_use'),array('1',$use_id));
		}else if($car->where("car_license_number='$number'")->getField("car_type")==2){
			$car->where("car_license_number='$number'")->setField('car_type',1);
			$use_id=$car->where("car_license_number='$number'")->getField('link_use');
			$use->where("usecar_id='$use_id'")->setField('usecar_comment','使用');
		}
		$this->redirect('Admin/things','页面跳转中……');
	}
	public function backcar(){
		$number=$_GET['number'];
		$car = M("Car");
		$use = M("Usecarlist");
		if($car->where("car_license_number='$number'")->getField("car_type")==0){
			$car->where("car_license_number='$number'")->setField('link_use',0);
		}else{
			$use_id=$car->where("car_license_number='$number'")->getField("link_use");
			$t=time();
			$str="结束";
			$use->where("usecar_id='$use_id'")->setField(array('usecar_stoptime','usecar_comment'),array($t,$str));
			$use_id='0';
			$flag='0';
			$car->where("car_license_number='$number' ")->setField(array('car_type','link_use'),array($flag,$use_id));
		}
		$this->redirect('Admin/things','页面跳转中……');
	}

	public function usecarlist(){
		$number=$_GET['number'];
		$use = M("Usecarlist");
		$volist=$use->where("car_license_number='$number'")->join("user on user.username=usecarlist.username")->select();
		//dump($volist);
		for($i=0;$volist[$i]!=null;$i++){
			$volist[$i]['usecar_starttime']=date('Y-m-d H:m:s',$volist[$i]['usecar_starttime']);
			if($volist[$i]['usecar_stoptime']==""){
			}else{
				$volist[$i]['usecar_stoptime']=date('Y-m-d H:m:s',$volist[$i]['usecar_stoptime']);
			}
		}
		$this->assign("number",$number);
		$this->assign("list",$volist);
		$this->display();
	}
}
?>