<?php
class UserModel extends Model{
	//µÇÂ¼
	public function login($username,$user_password)
	{
		$User=M('User');
		$user_password=md5($user_password);
		$result=$User->where("username='$username' and user_password='$user_password'")->find();
		return $result;
	}
	public function changeMsg($username,$newmail,$newphone)
	{
		$User=M('User');
		$result=$User->where("username='$username'")->setField(array('user_email','user_phonenumber'),array($newmail,$newphone));
		return $result;
	}
	public function changePwd($username,$newpwd)
	{
		$User=M('User');
		$result=$User->where("username='$username'")->setField('user_password',$newpwd);
		return $result;
	}
	public function checkUsername($userid)
	{
		$User=M('User');
		//$result=$User->query("select * from user where username='$userid'");
		$result=$User->where("username='$userid'")->find();
		//dump($result);
		return $result;
	}
	public function deleteUser($username)
	{
		$User=M('User');
		$result=$User->where("username='$username'")->delete();
		return $result;
	}

	public function getLeader($department_id,$position_id)
	{
		$User=M('User');
		$list=$User->where("department_id='$department_id' AND position_id < '$position_id'")->select();
		//dump($list);
		return $list;
	}
}
?>