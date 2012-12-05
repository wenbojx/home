<?php
class DetailController extends FController{
    public $defaultAction = 'a';
    public $layout = 'home';
    public $default_scroller_num = 6;
    public function actionA(){

        $request = Yii::app()->request;
        $datas['scene_id'] = $request->getParam('id');
        $datas['map_flag'] = $request->getParam('map')?true:false;
        if($datas['scene_id']){
            $datas['scene'] = $this->get_scene_datas($datas['scene_id']);

            if($datas['scene']){
                $datas['project'] = $this->get_project_datas($datas['scene']['project_id']);
            }

            $datas['extend'] = $this->get_extend_datas($datas['scene_id'], $datas['project']['id']);
        	//print_r($datas['extend']);
        	$datas['map'] = $this->get_map_info($datas['scene_id']);
        	//print_r($datas['map']);
        }
        $this->render('/web/detail', array('datas'=>$datas));
    }
    
    /**
     * 获取地图信息
     */
    private function get_map_info($scene_id){
    	$map_db = new ScenesMap();
    	$map_datas = $map_db->get_map_info($scene_id);
    	if(!$map_datas){
    		return false;
    	}
    	 
    	//获取图片名
    	$file_path_db = new FilePath();
    	$file_path = $file_path_db->get_file_path($map_datas['map']['file_id'], 'original');
    	if(is_file($file_path)){
    		$myimage = new Imagick($file_path);
    		$map_datas['img']['width'] = $myimage->getImageWidth();
    		$map_datas['img']['height'] = $myimage->getImageHeight();
    		$file_info = $file_path_db->get_by_file_id($map_datas['map']['file_id']);
    		$map_datas['img']['md5'] = $file_info['md5value'];
    	}
    	else{
    		$map_datas['img']['width'] = '0';
    		$map_datas['img']['height'] = '0';
    	}
    	 
    	return $map_datas;
    }
    
    /**
     * 获取热点
     */
    private function get_hotspots($scene_id){
    	if(!$scene_id){
    		return array();
    	}
    	$hotspot_db = new ScenesHotspot();
    	return $hotspot_db->find_by_scene_id($scene_id);
    }
    /**
     * 获取相关场景
    */
    private function get_extend_datas($scene_id, $project_id){
    	$extend_datas = array();
    	$extend_datas['hotspot'] = $this->get_hotspots($scene_id);
    	$num = $this->default_scroller_num - count($extend_datas['hotspot']);
        $scene_db = new Scene();
        $extend_datas['extend'] = $scene_db->find_extend_scene_project($scene_id, $num, $project_id);
        if($extend_datas['extend']){
        	$num_extend = $num-count($extend_datas['extend']);
        	if($num_extend >0){
        		$extend_1 = $scene_db->find_extend_scene_project($scene_id, $num_extend);
        		if($extend_1 & is_array($extend_1)){
        			$extend_datas['extend'] = array_merge($extend_datas['extend'], $extend_1);
        		}
        	}
        }
        return $extend_datas;
    }
    private function get_scene_datas($scene_id){
        $scene_db = new Scene();
        return $scene_db->get_by_scene_id($scene_id);
    }
    private function get_project_datas($project_id){
        $project_db = new Project();
        return $project_db->find_by_project_id($project_id);
    }
}