<?php
class PositionModel extends Model{
	public function findName($position_id){
		$Pos=M("Position");
		$result=$Pos->where("position_id='$position_id'")->getField("position_name");
		return $result;
	}
}
?>