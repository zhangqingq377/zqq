<?php
class UserAction extends Action
{
	function index(){
		//$Dep=D("Department");
		//$result=$Dep->showAll();
		//$this->assign('list',$result);
		$username=$_SESSION[C('USER_AUTH_KEY')];
		if(!empty($username)){
			$User=D("User");
			$User=$User->checkUsername($username);
			//dump($User[position_id]);
			//dump($User[department_id]);
			$Dep=D("Department");
			$Pos=D("Position");
			$Depname=$Dep->findName($User[department_id]);
			$Posname=$Pos->findName($User[position_id]);
			//dump($Posname);
			$this->assign('posname',$Posname);
			$this->assign('depname',$Depname);
			$this->assign('user',$User);
			$this->display();
		}else{
			redirect(__APP__);
		}
		
	}
	public function checkLogin(){
		$username=$_SESSION[C('USER_AUTH_KEY')];
		$user_password=$_POST['password'];
		$User=D("User");
		$result=$User->login($username,$user_password);
		//dump($result);
		$this->ajaxReturn($result);
	}
	public function changeMsg(){
		$username=$_SESSION[C('USER_AUTH_KEY')];
		$newmail=$_POST['email'];
		$newphone=$_POST['phone'];
		$User=D("User");
		$result=$User->changeMsg($username,$newmail,$newphone);
		$this->ajaxReturn($result);
	}
	public function changePwd(){
		$username=$_SESSION[C('USER_AUTH_KEY')];
		$newpwd=md5($_POST['password']);
		$User=D("User");
		$result=$User->changePwd($username,$newpwd);
		if($result==false){
			$this->error('密码修改失败！');
		}
		else{
			if(isset($_SESSION[C('USER_AUTH_KEY')])){
				unset($_SESSION[C('USER_AUTH_KEY')]);
				unset($_SESSION);
				session_destroy();
			 }
		}
	}
	public function deleteUser(){
		$userid=$_POST['username'];
		$User=D('User');
		if($User->checkUsername($userid)==1){
			$result=$User->deleteUser($userid);
			if($result==1){
				$this->ajaxReturn('1');
			}else{
				$this->ajaxReturn('2');
			}
		}else if($User->checkUsername($userid)==0){
			$this->ajaxReturn('3');
		}
	}
	public function mailList(){
		$username=$_SESSION[C('USER_AUTH_KEY')];
		if(!empty($username)){
			$mail=M("Maillist");
			//$mail=$mail->findAll();
			//dump($mail);
			if($mail){
				import("@.ORG.Page");
				$count=$mail->where("username='$username'")->count();
				$p=new Page($count,5);
				//分页查询数据
                $voList = $mail->where("username='$username'")->limit($p->firstRow.','.$p->listRows)->select();
				 //分页显示
                $page = $p->show();
                //模板赋值显示
				//dump($voList);
                $this->assign('list', $voList);
                $this->assign("count", $count);
                $this->assign("page", $page);
			}else{
				$this->redirect('index');
			}
		}else{
			redirect(__APP__);
		}
		$this->display();
	}
	public function addMail(){
		$mail=M("Maillist");
		$data['username']=$_SESSION[C('USER_AUTH_KEY')];
		$data['mail_username']=$_POST['mail_name'];
		$data['mail_userphone']=$_POST['mail_phone'];
		$data['mail_email']=$_POST['mail_email'];
		$result=$mail->add($data);
		//dump($result);返回是添加之后的主键值！
		$this->ajaxReturn($result);
	}
	public function delMail(){
		$mail=M("Maillist");
		$username=$_SESSION[C('USER_AUTH_KEY')];
		$mail_id=$_POST['mail_id'];
		//dump($mail_id);
		$mail->where("mail_id='$mail_id'")->delete();
	}
	public function scheduleList(){
		$username=$_SESSION[C('USER_AUTH_KEY')];
		if(!empty($username)){
			$Schedule=M("Schedule");
			$voList = $Schedule->where("username='$username'")->select();
			//dump($voList);
			$this->assign('list', $voList);
			$this->display();
		}else{
			redirect(__APP__);
		}
	}
	public function getDetailSchedule(){
		$schedule=M("Schedule");
		$username=$_SESSION[C('USER_AUTH_KEY')];
		$schedule_id=$_POST['schedule_id'];
		$result=$schedule->where("schedule_id='$schedule_id'")->select();
		//dump($result);
		$this->ajaxReturn($result);
	}
	public function delSchedule(){
		$schedule=M("Schedule");
		$username=$_SESSION[C('USER_AUTH_KEY')];
		$schedule_id=$_POST['schedule_id'];
		//dump($schedule_id);
		$result=$schedule->where("schedule_id='$schedule_id'")->delete();
		$this->ajaxReturn($result);
	}
	public function newSchedule(){
		$schedule=M("Schedule");
		$data = array();
		$data['username']=$_SESSION[C('USER_AUTH_KEY')];
		$data['schedule_theme']=$_POST['schedule_theme'];
		$data['schedule_dateFrom']=$_POST['datefrom'];
		$data['schedule_message']=$_POST['message'];
		$data['schedule_dateTo']=$_POST['dateto'];
		$data['last_edit_time']=time();
		$data['schedule_type']='0';
		$result=$schedule->add($data);
		//dump($result);
		$this->ajaxReturn($result);
	}

	public function saveSchedule(){
		$schedule=M("Schedule");
		$schedule_id=$_POST['schedule_id'];
		$schedule_theme=$_POST['schedule_theme'];
		$schedule_dateFrom=$_POST['datefrom'];
		$schedule_message=$_POST['message'];
		$schedule_dateTo=$_POST['dateto'];
		$time	=date("Y-m-d H:i:s",time());
		//dump($i);
		$last_edit_time=$time;
		$result=$schedule->where("schedule_id='$schedule_id'")->setField(array('last_edit_time','schedule_theme','schedule_dateFrom','schedule_message','schedule_dateTo'),array($time,$schedule_theme,$schedule_dateFrom,$schedule_message,$schedule_dateTo));
		//dump($result);
		$this->ajaxReturn($result);

	}

	public function perSummary(){
		$username=$_SESSION[C('USER_AUTO_KEY')];
		if(!empty($username)){
			$Summary=M("Summary");
			$User=D("User");
			$department_id=$User->where("username='$username'")->getField("department_id");
			$position_id=$User->where("username='$username'")->getField("position_id");
			//dump($department_id);
			//dump($position_id);
			$sendList=$User->getLeader($department_id,$position_id);
			//dump($sendList);
			//dump($voMailList);
			$voList=$Summary->where("username='$username'")->select();
			//dump($voList);
			for($i=0;$voList[$i]!=null;$i++){
				if($voList[$i]['summary_editdate']==""){
				}else{
				$voList[$i]['summary_editdate']=date('Y-m-d H:i:s',$voList[$i]['summary_editdate']);
				}
				if($voList[$i]['summary_senddate']==""){
				}else{
				$voList[$i]['summary_senddate']=date('Y-m-d H:i:s',$voList[$i]['summary_senddate']);
				}
				if($voList[$i]['summary_backdate']==""){
				}else{
				$voList[$i]['summary_backdate']=date('Y-m-d H:i:s',$voList[$i]['summary_backdate']);
				}
			}
			$this->assign('list',$voList);
			$this->assign('sendList',$sendList);
			$this->display();
		}else{
			redirect(__APP__);
		}
	}

	public function newSummary(){
		$Summary=M("Summary");
		$data = array();
		$data['username']=$_SESSION[C('USER_AUTO_KEY')];
		$data['summary_theme']=$_POST['theme'];
		$data['summary_content']=$_POST['content'];
		$data['summary_editdate']=time();
		$result=$Summary->add($data);
		$this->ajaxReturn($result);
	}
	
	public function saveSummary(){
		$Summary=M("Summary");
		$summary_id=$_POST['id'];
		$summary_theme=$_POST['theme'];
		$summary_content=$_POST['content'];
		$summary_editdate=time();
		$result=$Summary->where("summary_id='$summary_id'")->setField(array('summary_theme','summary_content','summary_editdate'),array($summary_theme,$summary_content,$summary_editdate));
		$this->ajaxReturn($result);
	}

	public function getDetailSummary(){
		$summary=M("Summary");
		$summary_id=$_POST['summary_id'];
		$result=$summary->where("summary_id='$summary_id'")->select();
		//dump($result);
		$this->ajaxReturn($result);
	}
	public function delSummary(){
		$summary=M("Summary");
		$summary_id=$_POST['summary_id'];
		$result=$summary->where("summary_id='$summary_id'")->delete();
		$this->ajaxReturn($result);
	}
	public function sendSummary(){
		$to_summary=$_POST['tousername'];
		$summary_id=$_POST['summary_id'];
		$sendtime=time();
		$summary=M("Summary");
		$summary->where("summary_id='$summary_id'")->setField(array('summary_to','summary_senddate'),array($to_summary,$sendtime));
	}
}
?>