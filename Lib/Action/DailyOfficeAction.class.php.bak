<?php
class DailyOfficeAction extends Action
{
	public function index(){
		$username=$_SESSION[C('USER_AUTH_KEY')];
		if(!empty($username)){
			$this->display();
		}else{
			redirect(__APP__);
		}
	}
	public function meetManagement(){
		$username=$_SESSION[C('USER_AUTH_KEY')];
		if(!empty($username)){
			$user=D('User');
			$department_id=$user->where("username='$username'")->getField("department_id");
			//dump($department_id);
			$meet=M('Meeting');
			//分页操作
			import("@.ORG.Page");
			$count=$meet->where("department_id='$department_id' OR department_id='0'")->count();
			$p=new Page($count,8);
			$volist=$meet->where("department_id='$department_id' OR department_id='0'")->join('room on room.room_id=meeting.room_id')->order('meeting_starttime asc')->limit($p->firstRow.','.$p->listRows)->select();
			//dump($volist);
			for($i=0;$volist[$i]!=null;$i++){
				if($volist[$i]['meeting_starttime']==''){
				}else{
					$volist[$i]['meeting_starttime']=date('Y-m-d H:i:s',$volist[$i]['meeting_starttime']);
				}
				if($volist[$i]['meeting_posttime']==''){
				}else{
					$volist[$i]['meeting_posttime']=date('Y-m-d H:i:s',$voLlst[$i]['meeting_posttime']);
				}
				if($volist[$i]['meeting_stoptime']==''){
				}else{
					$volist[$i]['meeting_stoptime']=date('Y-m-d H:i:s',$voLlst[$i]['meeting_stoptime']);
				}
				
			}
			$page = $p->show();
			$this->assign('list',$volist);
			$this->assign("count", $count);
			$this->assign("page", $page);
			
			$this->display();
		}else{
			redirect(__APP__);
		}
	}
	public function getDetail(){
		$meeting_id=$_POST['meeting_id'];
		$meet=M('Meeting');
		$detail=$meet->where("meeting_id='$meeting_id'")->join('room on room.room_id=meeting.room_id')->join('user on user.username=meeting.meeting_master')->find();
		if($detail['meeting_starttime']==''){
			$detail['meeting_starttime']='空';
		}else{
			$detail['meeting_starttime']=date('Y-m-d H:i:s',$detail['meeting_starttime']);
		}
		if($detail['meeting_posttime']==''){
			$detail['meeting_posttime']='空';
		}else{
			$detail['meeting_posttime']=date('Y-m-d H:i:s',$detail['meeting_posttime']);
		}
		if($detail['meeting_stoptime']==''){
			$detail['meeting_stoptime']='空';
		}else{
			$detail['meeting_stoptime']=date('Y-m-d H:i:s',$detail['meeting_stoptime']);
		}
		$this->ajaxReturn($detail);
	}
	public function fileManagement(){
		$username=$_SESSION[C('USER_AUTH_KEY')];
		if(!empty($username)){
			$file=M('file');
			$list=$file->select();
			for($i=0;$list[$i]!=null;$i++){
				$list[$i]['creat_time']=date('Y-m-d H:i:s',$list[$i]['creat_time']);
			}
			
			//dump($list);
			$this->assign('filelist',$list);
			$this->display();
		}else{
			redirect(__APP__);
		}
	}
	function upload(){
		if(empty($_FILES)){
			$this->error('必须选择上传文件');
		}else{
			$a=$this->up();
			if(isset($a)){
				//写入数据库的方法
				if($this->c($a)){
					$this->success('上传成功');
				}else{
					$this->error('写入数据库失败');
				}
			}else{
				$this->error('上传文件有异常请与系统管理员联系');
			}
		}
	}
	private function c($data){
		$file=M('file');
		//dump($data[0]);
		$data['filename']=$data[0]['savename'];
		$data['creat_time']=time();
		$data['name']=$data[0]['name'];
		$data['size']=$data[0]['size'];
		//$data['savepath']=$data[0]['savepath'];
		
		if($file->data($data)->add()){
			return true;
		}else{
			return false;
		}
	}
	private function up(){
		//echo '模拟上传';
		//基本上传功能
		//批量上传功能
		//生成图片缩略图
		//自定义参数上传
		//上传检测(大小，后缀，mime类型)
		//支持覆盖方式上传
		//上传类型，附件大小，上传路径定义
		//支持哈希或者日期子目录保存上传文件
		//上传图片的安全性检测
		//对上传文件的hash检测
		//上传文件名自定规范
		import('@.Org.UploadFile');
		$upload=new UploadFile();
		$upload->maxSize='1000000';  //是指上传文件的大小，默认为-1,不限制上传文件大小bytes
		$upload->savePath='../upload/';       //上传保存到什么地方？路径建议大家已主文件平级目录或者平级目录的子目录来保存
		$upload->saveRule=uniqid;    //上传文件的文件名保存规则  time uniqid  com_create_guid  uniqid
		//$upload->autoCheck=false   ;  //是否自动检测附件
		$upload->uploadReplace=true;     //如果存在同名文件是否进行覆盖
		$upload->allowExts=array('doc','txt','xle','ppt');     //准许上传的文件后缀
		//$upload->allowTypes=array('image/png','image/jpg','image/pjpeg','image/gif','image/jpeg');  //检测mime类型
		//$upload->thumb=true;   //是否开启图片文件缩略
		$upload->thumbMaxWidth='300,500';  //以字串格式来传，如果你希望有多个，那就在此处，用,分格，写上多个最大宽
		$upload->thumbMaxHeight='200,400';	//最大高度
		//$upload->thumbPrefix='s_,m_';//缩略图文件前缀
		//$upload->thumbSuffix='_s,_m';  //文件后缀
		//$upload->thumbPath='' ;  // 如果留空直接上传至
		//$upload->thumbFile   在数据库当中也存一个文件名即可
		//$upload->thumbRemoveOrigin=1;  //如果生成缩略图，是否删除原图
		//$upload->autoSub   是否使用子目录进行保存上传文件
		//$upload->subType='';   //子目录创创方式默认为hash 也可以设为date
		//$upload->dateFormat  子目录方式date的指定日期格式
		//$upload->hashLevle
			
		//upload()  如果上传成功，返回ture,失败返回false
			
		if($upload->upload()){
			//局部变量，你可以在此处，保存到一个超全局变量当中去进行返回
			$info=$upload->getUploadFileInfo();
			return $info;
		}else{
			//是专门来获取上传的错误信息的
			$this->error($upload->getErrorMsg());
		}
			
	}

	public function download(){
		$id=$_GET['id'];
		$uploadpath="D:/dev/Apache2.2/htdocs/upload/";
		if($id==""){
			$this->error('获取下载信息失败！');
		}
		$file=D("File");
		$result= $file->find($id);
		//dump($result);
		if($result==false){
			$this->error('数据读取失败！');
		}
		$savename=$result['filename'];//文件保存名 
		$showname=$result['name'];//文件原名
		//dump($showname);
		$filename=$uploadpath.$savename;//完整文件名（路径加名字） 
		//dump($filename);
		import('ORG.NET.Http');
		Http::download($filename,$showname);

	}
	
	public function bulletin(){
		$username=$_SESSION[C('USER_AUTH_KEY')];
		if(!empty($username)){
			$b=M("Bulletin");
			import("@.ORG.Page");
			$count=$b->count();
			//dump($count);
			$p=new Page($count,8);
			$volist=$b->limit($p->firstRow.','.$p->listRows)->select();
			for($i=0;$volist[$i]!=null;$i++){
				$volist[$i]['creat_time']=date('Y-m-d H:i:s',$volist[$i]['creat_time']);
			}
			$page = $p->show();
			$this->assign('list',$volist);
			$this->assign('count',$count);
			$this->assign('page',$page);
			$this->display();
		}else{
			redirect(__APP__);
		}
	}
}
?>