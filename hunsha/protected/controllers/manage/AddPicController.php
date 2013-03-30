<?php
class AddPicController extends Controller{

    public $defaultAction = 'a';
    public $layout = 'home';
    private $ftype = 'jpg';
	private $pic_width = 350;
	//private $pic_height = '350';
	private $thumb_width = 100;
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
        $datas['width'] = $this->pic_width;
        $datas['list'] = $this->get_pic_list($datas['id']);
        //print_r($pic_datas);
        $this->render('/manage/addPic', array('datas'=>$datas));
    }
    private function del_pic($id){
    	//获取图片信息
    	$fangpic_db = new FangPic();
    	$datas = $fangpic_db->getById($id);
    	if(!$datas){
    		return false;
    	}
    	$this->id = $datas['f_id'];
    	$this->check_fang_own($this->id);
    	return $fangpic_db->delPic($id);
    }
    /**
     * 获取图片信息
     */
    private function get_pic_list($id){
    	$fangpic_db = new FangPic();
    	return $fangpic_db->getByFid($id);
    }
    private function save_pic($id, $url, $type=2){
    	$ftype= $this->ftype;
    	$fangpic_db = new FangPic();
    	return $fangpic_db->addPic($id, $url, $type, $ftype);
    }
    public function uploadPic($file_name){
    	
    	$file = CUploadedFile::getInstanceByName($file_name); //获取表单名为filename的上传信息
    	$file_md5 = md5_file($file->getTempName());
    	//echo $file_md5;
    	//$file_md5 = 'aaaa';
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
    	
    	
    	
    	if($file_name == 'file0'){
    		$this->resize($fileName, $md5_path, $file_info['type'], true);
    	}
    	else{
    		$this->resize($fileName, $md5_path, $file_info['type'], false);
    	}
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
    		$to = $folder.'/thumb.'.$type;
    		$limit_w = $this->thumb_width;
    	}
    	else{
    		$to = $folder.'/w'.$this->pic_width.'.'.$type;
    		$limit_w = $this->pic_width;
    	}
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