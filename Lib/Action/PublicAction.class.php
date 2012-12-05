<?php
class PublicAction extends Action{
	// 顶部页面
	public function top() {
		$this->display();
	}
	public function login() {
		if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
			$this->display();
		}else{
			$this->redirect('');
		}
	}
	public function index()
	{
		//如果通过认证跳转到首页
		redirect(__APP__);
	}
	//登出
	public function loginOut(){
		if(isset($_SESSION[C('USER_AUTH_KEY')])){
			unset($_SESSION[C('USER_AUTH_KEY')]);
			unset($_SESSION);
			session_destroy();
			$this->assign("jumpUrl",__URL__.'/login');
            $this->success('登出成功！');
		}else{
			$this->error('已经退出');
		}
	}
	//登入检测
	public function checkLogin(){
		$username=$_POST['username'];
		$user_password=$_POST['password'];
		$User=D("User");
		$result=$User->login($username,$user_password);
		//dump($result);
		if($result!=null){
			$_SESSION[C('USER_AUTH_KEY')]=$result[username];
			$_SESSION['loginUserName']=$result[user_name];
			$_SESSION['role']=$result[role_id];
			$this->AjaxReturn('1');
		}else{
			$this->AjaxReturn('2');
		}
	}
	
}
?>