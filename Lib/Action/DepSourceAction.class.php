<?php
class DepSourceAction extends Action
{
	public function index(){
		$username=$_SESSION[C('USER_AUTH_KEY')];
		if(!empty($username)){
			$this->display();
		}else{
			redirect(__APP__);
		}
	}
	public function duty(){
		$duty=M("Duty");
		$username=$_SESSION[C('USER_AUTH_KEY')];
		$volist=$duty->join("user on user.username=duty.username")->order("duty_date asc")->select();
		for($i=0;$volist[$i]!=null;$i++){
			if($volist[$i]['duty_date']==''){
			}else{
				$volist[$i]['duty_date']=date('Y-m-d',$volist[$i]['duty_date']);
			}
		}
		//dump($volist);
		$this->assign("list",$volist);
		$this->display();
	}
	public function car(){
		$car=M("Car");
		$volist=$car->findAll();
		for($i=0;$volist[$i]!=null;$i++){
			$volist[$i]['car_purchasedate']=date('Y-m-d',$volist[$i]['car_purchasedate']);
			if($volist[$i]['car_type']==0){
				$volist[$i]['car_type']="空闲";
			}else if($volist[$i]['car_type']==1){
				$volist[$i]['car_type']='使用中';
			}else if($volist[$i]['car_type']==2){
				$volist[$i]['car_type']='已被申请';
			}
		}
		$this->assign("list",$volist);
		$this->display();
	}
	public function useCar(){
		$car=M("Car");
		$list=M("Usecarlist");
		$number=$_POST['number'];
		$data['username']=$_SESSION[C('USER_AUTH_KEY')];
		$data['car_license_number']=$number;
		$data['usecar_starttime']=time();
		$data['usecar_comment']="预订";
		$use_id=$list->add($data);
		dump($use_id);
		$car->where("car_license_number='$number'")->setField(array("car_type","link_use"),array("2",$use_id));
	}
}
?>