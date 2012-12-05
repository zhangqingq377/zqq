<?php
class LawAction extends Action
{
	public function index(){
		$username=$_SESSION[C('USER_AUTH_KEY')];
		if(!empty($username)){
			$law=M("Law");
			$law=$law->findAll();
			$this->assign("law",$law);
			$this->display();
		}else{
			redirect(__APP__);
		}
	}
}
?>