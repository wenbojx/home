<?php
class AlbumController extends Controller{

    public $defaultAction = 'a';
    public $layout = 'home';
    private $ftype = 'jpg';
	//private $pic_width = 350;
	//private $pic_height = '350';
	//private $thumb_width = 100;
	private $id = 0;
    
    public function actionA(){
    	$request = Yii::app()->request;
        $datas['page']['title'] = '发布图片';
        $datas['id'] =  $request->getParam('id');
        $datas['msg'] = '';
        if(!$datas['id']){
        	$datas['msg'] = '参数错误';
        }
        $del = $request->getParam('del');
        if($del && $datas['id']){
        	$this->del_pic($datas['id']);
        	$datas['id']  = $this->id;
        }
        $this->check_fang_own($datas['id']);
        $fang_db = new Fang();
        $fang_datas = $fang_db->getFangInfo($datas['id']);
        if(!$fang_datas){
        	$datas['msg'] = '参数错误';
        }
        if($_FILES['file0']['name']){
        	
        	$file_path = $this->uploadPic('file0');
        	if($file_path){
        		$this->save_pic($datas['id'], $file_path, 1);
        	}
        }
        for($i=1; $i<=5; $i++){
        	if($_FILES['file'.$i]['name']){
        		
        		$file_path = $this->uploadPic('file'.$i);
        		if($file_path){
        			$this->save_pic($datas['id'], $file_path, 2);
        		}
        	}
        }
        $datas['width'] = Yii::app()->params['img_width'];
        
        $datas['list'] = $this->get_pic_list($datas['id']);
        //print_r($pic_datas);
        $this->render('/manage/addPic', array('datas'=>$datas));
    }
    public function actionUpdate(){
    	$request = Yii::app()->request;
    	$id =  $request->getParam('id');
    	$type =  $request->getParam('type');
    	$desc = $request->getParam('desc');
    	$msg['flag'] = '0';
    	$msg['id'] = '';
    	$msg['desc'] = '';
    	if(!$id){
    		$msg['msg'] = '参数错误';
    	}
    	if($type == 'desc'){
    		
    		$this->updatePicDesc($id, $desc);
    	}
    	elseif($type=='del'){
    		$this->delPic($id);
    	}
    	$msg['flag'] = '1';
    	$msg['id'] = $id;
    	$msg['desc'] = $desc;
    	$this->display_msg($msg);
    }
    public function updatePicDesc($id, $desc){
    	if(!$id){
    		return false;
    	}
    	$file_db = new File();
    	return $file_db->updateDesc($id, $desc);
    }
    public function delPic($id){
    	$file_db = new File();
    	return $file_db->delPic($id);
    }
    public function actionUpload(){
    	$request = Yii::app()->request;
    	$project_id =  $request->getParam('project_id');
    	$msg['flag'] = '0';
    	$msg['path'] = '';
		if(!$_FILES['Filedata']['name']){
    		$this->display_msg($msg);
    	}
    	$file_path = $this->uploadPic('Filedata');
    	if(!$file_path){
    		$this->display_msg($msg);
    	}
    	$id = $this->saveFile($project_id, $file_path);
    	$msg['id'] = $id;
    	$msg['flag'] = '1';
    	$msg['path'] = $file_path;
    	$msg['ftype'] = $this->ftype;
    	$this->display_msg($msg);
    }

    private function saveFile($project_id, $file_path){
    	$ftype= $this->ftype;
    	$file_db = new File();
    	return $file_db->saveFile($project_id, $file_path, $ftype);
    }
    public function uploadPic($file_name){
    	$file = CUploadedFile::getInstanceByName($file_name); //获取表单名为filename的上传信息
    	$file_md5 = md5_file($file->getTempName());

    	$file_info['name'] = $file->getName();//获取文件名
    	if(!$file_info['name']){
    		return false;
    	}
    	$file_info['type'] = strtolower($file->getExtensionName());//获取文件类型
    	$this->ftype = $file_info['type'];
    	$file_type = array('jpg','png','gif');
    	if(!in_array($file_info['type'] , $file_type)){
    		return false;
    	}
    	$year_path = 'upload/'. date('Ym', time());

    	if(!file_exists($year_path)){
    		mkdir($year_path);
    	}
    	$day_path = $year_path.'/'.date('d', time());
    	if(!file_exists($day_path)){
    		mkdir($day_path);
    	}
    	$hour_path = $day_path.'/'.date('H', time());
    	if(!file_exists($hour_path)){
    		mkdir($hour_path);
    	}
    	$md5_path = $hour_path.'/'.$file_md5;
    	if(!file_exists($md5_path)){
    		mkdir($md5_path);
    	}
    	$fileName = $md5_path.'/'.$file_md5.'.'.$file_info['type'];
    	$flag = $file->saveAs($fileName,true);//上传操作

    	$this->resize($fileName, $md5_path, $file_info['type'], false);
    	$this->resize($fileName, $md5_path, $file_info['type'], true);
    	//echo 1111;
    	//exit();
    	if(!$flag){
    		return false;
    	}
    	
    	return $md5_path;
    }
    private function resize($path, $folder, $type, $thumb){
    	if(!file_exists($path)){
    		return false;
    	}
    	
    	$myimage = new Imagick($path);
    	
    	$ext = strtolower( $myimage->getImageFormat() );
    	$myimage->setImageFormat($ext);
    	$img_w = $myimage->getimagewidth();
    	$img_h = $myimage->getimageheight();
    	
    	if($thumb){
    		$limit_w = Yii::app()->params['img_thumb_width'];
    	}
    	else{
    		$limit_w = Yii::app()->params['img_width'];
    	}
    	$to = $folder.'/w'.$limit_w.'.'.$type;
    	
    	if($img_w < $limit_w){
    		$width = $img_w;
    		$height = $img_h;
    	}
    	else{
    		$width = $limit_w;
    		$height = ($limit_w/$img_w)*$img_h;
    	}
    	
    	$myimage->resizeimage($width, $height, Imagick::FILTER_LANCZOS, 1, true);

    	$myimage->writeImage($to);
    	$myimage->clear();
    	$myimage->destroy();
    }
    public function actionAdd(){
    	$request = Yii::app()->request;
    	$datas['page']['title'] = '发布图片';
    	$datas['id'] =  $request->getParam('id');
    	echo 11;
    }
}