<?php
class DepartmentModel extends Model{
	public function showAll(){
		$Dep=M('Department');
		$result=$Dep->findAll();
		return $result;
	}
	//���ݲ���id��ȡ���ŵ�����
	public function findName($department_id){
		//dump($department_id);
		//$department_id="1";
		$Dep=M('Department');
		$result=$Dep->where("department_id='$department_id'")->getField("department_name");
		return $result;
	}
}
?>