<?php
ini_set('memory_limit', '100M');
class UploadController extends Controller{
    public $defaultAction = 'uploadFile';
    //public $layout = 'page';
    public $position = array('left'=>1,'right'=>2,'down'=>3,'up'=>4,'front'=>5,'back'=>6);
    private $images_info = array(
        'type'=>array('jpg','png','gif','JPG','PNG','GIF'),
        'size'=>5242880,
    );
    private $image_width = '';
    private $image_height = '';

    public function actionUploadFile(){
        $request = Yii::app()->request;
        $from_box_pic = false;
        $from_thumb_pic = false;
        $from_map_pic = false;
        $from_pano_pic = false;;

        $scene_id = $request->getParam('scene_id');
        if ($request->getParam('position')!='' && $request->getParam('from')=='box_pic' && $scene_id>0){
        	$from_box_pic = true;
        }
        elseif ($request->getParam('from')=='thumb_pic' && $scene_id>0){
        	$from_thumb_pic = true;
        }
        elseif ($request->getParam('from')=='map_pic' && $scene_id>0){
        	$from_map_pic = true;
        }
       else if ($request->getParam('from')=='pano_pic' && $scene_id>0 ){
       		$from_pano_pic = true;
       }

        $this->check_scene_own($scene_id);

        $file_info = $this->upload($from_box_pic, $from_pano_pic);
        $msg = array('flag'=>0,'msg'=>'文件上传出错');
        $flag = true;
        $flag_scene = false;
        if(!$file_info){
        	$this->display_msg($msg);
        }
        $path_id = $this->save_file_path($file_info);
        if(!$path_id){
        	$this->display_msg($msg);
        }
        $file_id = $this->save_file($this->member_id, $file_info['md5value']);
        if(!$file_id){
        	$this->display_msg($msg);
        }
        //场景图
        if($from_box_pic){
        	$flag_scene = $this->save_scene_file($file_id, $scene_id, $request->getParam('position'));
        }
        //场景缩略图
        elseif($from_thumb_pic){
        	$flag_scene =$this->save_scene_thumb($file_id,$scene_id);
        }
        //地图
        elseif($from_map_pic){
        	$flag_scene =$this->save_scene_map($file_id,$scene_id);
        }
        elseif($from_pano_pic){
        	$flag_scene =$this->save_scene_pano($file_id,$scene_id);
        }
        if(!$flag_scene){
        	$this->display_msg($msg);
        }
        $file_info['width'] = $this->image_width;
        $file_info['height'] = $this->image_height;
        $msg = array('flag'=>1,'msg'=>'', 'id'=>$flag_scene, 'type'=>$file_info['type'], 'w'=>$file_info['width'], 'h'=>$file_info['height'], 'file'=>$file_info['md5value']);
        $this->display_msg($msg);
    }
    private function save_scene_pano($file_id,$scene_id){
    	$scene = new Scene();
    	$flag = $scene->update_scene_pano ($file_id,$scene_id);
    	$panoQueue = new PanoQueue();
    	$data['scene_id'] = $scene_id;
    	$panoQueue->add_queue ($data);
    	return $flag;
    }
    private function save_scene_map($file_id,$scene_id){
    	$scene_map_db = new ScenesMap();
    	$datas = $scene_map_db->save_scene_map($scene_id, $file_id);
    	return $datas;
    }

    private function save_file_path($file_info){
        $file_path_db = new FilePath();
        return $file_path_db->save_file_path($file_info);
    }
    private function save_file($member_id, $md5file){
        if(!$member_id || !$md5file){
            return false;
        }
        $file_db = new File();
        return $file_db->save_file($member_id, $md5file);
    }
    /**
     * 保存缩略图
     */
    private function save_scene_thumb($file_id,$scene_id){
        $scene_thumb_db = new ScenesThumb();
        $datas = $scene_thumb_db->save_pano_thumb($scene_id, $file_id);
        return $datas;
    }
    /*
     * 保存场景全景图关系
     */
    private function save_scene_file($file_id, $scene_id, $position){
        if(!$file_id || !$scene_id){
            return false;
        }
        $scene_file_db = new MpSceneFile();
        return $scene_file_db->save_scene_file($file_id, $scene_id, $position);
    }

    /**
     * 上传文件
     */
    private function upload($from_box_pic = false, $from_pano_pic=false){
        if(!$_FILES['Filedata']){
            return false;
        }
        $pre = Yii::app()->params['file_pic_folder'].'/';
        $file_info['folder'] = date('Y',time()).date('m',time());
        $folder_pic = $pre.$file_info['folder'].'/';
        if(!is_dir($folder_pic)){
            mkdir($folder_pic);
        }
        $day = date('d',time());
        $folder_pic .= $day.'/';
        $file_info['folder'] .= $day;
        if(!is_dir($folder_pic)){
            mkdir($folder_pic);
        }
        $file = CUploadedFile::getInstanceByName('Filedata'); //获取表单名为filename的上传信息
        $md5file = $file->getTempName();
        $file_info['md5value'] = md5_file($md5file);
        $folder_pic .= $file_info['md5value'].'/';
        if(!is_dir($folder_pic)){
            mkdir($folder_pic);
        }
        $folder = $folder_pic.'original/';
        if(!is_dir($folder)){
            mkdir($folder);
        }
        $file_info['name'] = $file->getName();//获取文件名
        $file_info['size'] = $file->getSize();//获取文件大小
        $file_info['type'] = strtolower($file->getExtensionName());//获取文件类型
        if(!in_array($file_info['type'], $this->images_info['type'])){
        	return false;
        }
        //$file_info['name']=iconv("utf-8", "gb2312", $file_info['name']);//这里是处理中文的问题，非中文不需要
        $uploadfile = $folder.$file_info['md5value'].'.'.$file_info['type'];
        $flag = $file->saveAs($uploadfile,true);//上传操作

        $myimage = new Imagick($uploadfile);
        $this->image_width = $myimage->getImageWidth();
        $this->image_height = $myimage->getImageHeight();

        if($from_pano_pic){
        	$cube_path = $folder.'cube';
        	mkdir($cube_path);
        }
        if(!$from_box_pic){
        	return $file_info;
        }
        $pano_pic_tools = new PanoPicTools();
        //将文件处理成1000大小
        $pano_pic_tools->resize_pano($uploadfile, $folder_pic, $file_info['type']);
        if(!$flag){
            return false;
        }
        return $file_info;
    }

}





