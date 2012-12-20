<?php
ini_set('memory_limit', '100M');
class PanoPicController extends FController{
    public $defaultAction = 'index';
    private $url = '';
    private $size = array('200x100');
    private $request = null;
    public $img_size = 1024;
    public $tile_size = 512;
    private $face_box = array ('s_f'=>'front', 's_r'=>'right', 's_l'=>'left', 's_b'=>'back', 's_u'=>'top', 's_d'=>'bottom'); 

    /**
     * 获取全景图缩略图
     */
    public function actionIndex(){
        $this->request = Yii::app()->request;
        $this->url = $this->request->requestUri;
        if(strstr($this->url, '/thumb/')){
        	$this->get_pano_thumb();
        }
        else if(strstr($this->url, '.xml')){
        	$this->put_out_xmlb();
        }
    	else if(strstr($this->url, '.jpg')){
        	$this->put_out_pano_face();
        }
    }
    /**
     * 输出默认图片
     */
    private function show_default($type){
    	$panoPicTools = new PanoPicTools();
    	return $panoPicTools->show_default_pic($type);
    }
    /**
     * 输出配置文件信息
     */
    private function put_out_pano_face(){
    	$explode_url = explode ('/', $this->url);
    	$count = count($explode_url);
    	$scene_id = (int) $explode_url[$count-4];
    	$face = $explode_url[$count-3];
    	$suffix = $explode_url[$count-2];
    	$fileName = $explode_url[$count-1];
    	$faceKeys = array_keys($this->face_box);
    	if(!$scene_id || !in_array($face, $faceKeys)){
    		$this->show_default(2);
    	}
    	$path = $this->get_pano_file_path($scene_id, $face);
    	echo $path;
    	if(!file_exists($path)){
    		$this->show_default(2);
    	}
    	$water = 0;
    	$sharpen = 0;
    	$quality = 90;
    	$size = $this->img_size;
    	$toPath = PicTools::get_pano_static_path($scene_id) . '/'. $face. '/' . $suffix;
    	if(!$this->make_unexit_dir($toPath)){
    		$this->show_default(2);
    	}
    	
    	echo $path;
    	if($suffix == '9'){
    		$size = '256x256';
    		$quality = 60;
    	}
    	elseif($suffix == '10'){
    		//原图分解成4份
    		$panoPicTools = new PanoPicTools();
    		$panoPicTools->split_img_ten($path, $fileName);
    		$path = substr($path, 0, strlen($path)-4) . '/' . $fileName;
    		$quality = 100;
    		if(strstr($face, 's_b') || strstr($face, 's_u') || strstr($face, 's_d')){
    			if(strstr($fileName, '1_1')){
    				$water =1;
    			}
    		}
    	}
    	$toPath .= "/{$fileName}";
    	//echo $path."<br>";
    	//echo $toPath."<br>";
    	$panoPicTools = new PanoPicTools();
    	$panoPicTools->turnToStatic($path, $toPath, $size, $quality, $water, $sharpen);
    }
    private function put_out_xmlb(){
    	$explode_url = explode ('/', $this->url);
    	$count = count($explode_url);
    	$id = (int) $explode_url[$count-2];
    	if(!$id){
    		return false;
    	}
    	$datas['scene_id'] = $id;
    	$datas['imgSize'] = $this->img_size;
    	$datas['tileSize'] = $this->tile_size;
    	$this->render('/salado/xmlb', array('datas'=>$datas));
    }
    /**
     * 获取xml的参数
     */
    private function get_xmla_params(){
    	$nobtb =  $this->request->getParam('nobtb'); //是否含button_bar
    	$auto =  $this->request->getParam('auto'); //是否自动转
    	$single =  $this->request->getParam('single'); //是否自动转
    	$player_width =  $this->request->getParam('w'); //是否自动转
    	$player_height =  $this->request->getParam('h'); //是否自动转
    	$config['btb'] = $nobtb ? false :true;
    	$config['auto'] = $auto ? true :false;
    	$config['single'] = $single ? true :false;
    	$config['player_width'] = $player_width ? $player_width : 1000;
    	$config['player_height'] = $player_height ? $player_height : 500;
    	return $config;
    }
    /**
     * 创建不存在的目录
     */
    private function  make_unexit_dir ($path){
    	if(!$path){
    		return false;
    	}
    	$path_explode = explode ('/', $path);
    	if(!is_array($path_explode)){
    		return false;
    	}
    	if(count($path_explode)>7){
    		return false;
    	}
    	$path = Yii::app()->params['pano_static_path'];
    	for ($i=1; $i<count($path_explode); $i++){
    		$path .= '/' . $path_explode[$i];
    		//echo $path.'<br>';
    		if(!is_dir($path)){
    			mkdir($path);
    		}
    	}
    	return true;
    }
    /**
     * 获取全景图缩略图
     */
    private function get_pano_thumb(){
    	$explode_url = explode ('/', $this->url);
    	$count = count($explode_url);
    	$scene_id = (int) $explode_url[$count-3];
    	if(!$scene_id){
    		$this->show_default(1);
    	}
    	$file_name = $explode_url[$count-1];
    	$size = substr($file_name, 0, strlen($file_name)-4);
    	if(!in_array($size, $this->size)){
    		$this->show_default(1);
    	}
    	if(!$scene_id){
    		$this->show_default(1);
    	}
    	$path = $this->get_pano_thumb_path($scene_id);
    	$toPath = PicTools::get_pano_static_path($scene_id) . '/thumb';
    	//echo $toPath;
    	if(!$this->make_unexit_dir($toPath)){
    		$this->show_default(1);
    	}
    	$toPath .= '/' . $size . '.jpg';
    	$panoPicTools = new PanoPicTools();
    	$panoPicTools->turnToStatic($path, $toPath, $size, '90', 0, 0.5);
    }
    
    /**
     * 获取全景图缩略图文件地址
     */
    private function get_pano_thumb_path($scene_id){
    	if(!$scene_id){
    		$this->show_default(1);
    	}
    	$sceneThumbDB = new ScenesThumb();
    	$thumbDatas = $sceneThumbDB->find_by_scene_id($scene_id);
    	if(!$thumbDatas){
    		$this->show_default(1);
    	}
    	$fileId = $thumbDatas['file_id'];
    	//获取文件地址
    	$path = $this->get_file_path($fileId);
    	if(!file_exists($path)){
    		$this->show_default(1);
    	}
    	return $path;
    }
    /**
     * 根据file_id获取图片路径
     */
    private function get_file_path ($file_id){
    	$filePathDB = new FilePath();
    	return $filePathDB->get_file_path($file_id);
    }
    /**
     * 根据file_id获取图片目录
     */
    private function get_file_floder ($file_id, $add_prx='cube'){
    	$filePathDB = new FilePath();
    	return $filePathDB->get_file_folder($file_id, $add_prx);
    }
    /**
     * 获取全景图对应文件信息
     */
    private function get_pano_file_path($scene_id, $face){
    	if(!$scene_id){
    		$this->show_default(2);
    	}
    	
    	$sceneDB = new Scene();
    	$panoDatas = $sceneDB->get_by_scene_id($scene_id);
    	if(!$panoDatas){
    		$this->show_default(2);
    	}
    	$fileId = $panoDatas['file_id'];
    	//获取文件地址
    	$path = $this->get_file_floder ($fileId);
    	if(!is_dir($path)){
    		$this->show_default(2);
    	}
    	return $path . '/'. $this->face_box[$face] . '.jpg';
    }

}