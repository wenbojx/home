<?php
class ConfigController extends Controller{
    public $defaultAction = 'v';
    public $defaultType = array(
            'face', 'position', 'basic', 'camera', 'view', 'hotspot','hotspotEdit',
            'button', 'map', 'navigat', 'radar',
            'html', 'rightkey', 'link', 'flare','action','thumb'
            );
    private $pano_thumb_size = '200x100';

    public function actionV(){
        $request = Yii::app()->request;
        $datas = array();
        $scene_id = $request->getParam('scene_id');
        if(!$scene_id){
            exit('参数错误');
        }
        $datas['scene_id'] = $scene_id;
        $type = $request->getParam('t');
        if ($type == 'hotspot'){
            $datas['link_scene'] = $this->get_link_scenes($scene_id);
        }
        elseif ($type == 'thumb'){
            $datas['thumb'] = $this->get_thumb($scene_id);
        }
        elseif ($type == 'face'){
            $scene_files = $this->get_scene_pic($scene_id);
            $datas['scene_files'] = $this->get_file_url($scene_files);
        }
        elseif ($type == 'camera'){
        	$datas['camera'] = $this->get_camera_info($scene_id);
        	//print_r($datas['camera']);
        }
        elseif ($type == 'map'){
        	$datas['map'] = $this->get_map_info($scene_id);
        	//print_r($datas['map']['position']);
        	$datas['scene_list'] = $this->get_link_scenes($scene_id, false);
        	//print_r($datas['scene_list']);
        }
        elseif($type == 'hotspotEdit'){
        	$datas['hotspot_id'] = $request->getParam('hotspot_id');
        	$datas['thumb'] = $this->get_thumb_by_hotspot($datas['hotspot_id']);
        }
        if(!in_array($type, $this->defaultType)){
            exit();
        }
        $this->render('/pano/panel/'.$type, array('datas'=>$datas));
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
     * 获取摄像机信息
     */
    private function get_camera_info($scene_id){
    	$panoram_db = new ScenesPanoram();
    	return $panoram_db->get_camera_info($scene_id);
    }
    /**
     * 获取图片地址
     */
    private function get_file_url($scene_files){
        $file_url = array();
        $pic_name = '120x120.jpg';
        $default_scene = array('left', 'right', 'down', 'up', 'front', 'back');
        foreach ($default_scene as $v){
            $file_url[$v] = isset($scene_files[$v]) && $scene_files[$v] ? $this->createUrl('/home/pictrue/index/', array('id'=>$scene_files[$v], 'size'=>$pic_name)) : $this->get_default_url($v);
        }
        unset($scene_files);
        return $file_url;
    }
    /*
     * 获取全景图
    */
    private function get_scene_pic($scene_id){
        $pics = array();
        if(!$scene_id){
            return $pics;
        }
        $scene_file_db = new MpSceneFile();
        return $scene_file_db->get_scene_list($scene_id);
    }
    /**
     * 获取默认图片地址
     */
    private function get_default_url($position){
        return Yii::app()->baseUrl."/pages/images/box_{$position}.gif";
    }
    /**
     * 获取热点链接的缩略图
     */
    private function get_thumb_by_hotspot($hotspot_id){
    	if(!$hotspot_id){
    		return false;
    	}
    	$hotspot_db = new ScenesHotspot();
    	$hotspot_datas = $hotspot_db->get_by_hotspot_id($hotspot_id);
    	if(!$hotspot_datas){
    		return false;
    	}
    	return $this->get_thumb($hotspot_datas['link_scene_id']);
    }
    /**
     * 获取场景缩略图
     */
    private function get_thumb($scene_id){
        //$thumb_db = new ScenesThumb();
        //if($thumb_db->find_by_scene_id($scene_id)){
        return $this->createUrl('/panos/thumb/pic/', array('id'=>$scene_id, 'size'=>$this->pano_thumb_size.'.jpg'));
        //}
        return false;
    }
    /**
     * 获取项目中的其他场景列表
     */
    private function get_link_scenes($scene_id, $self=true){
        $scene_datas = array();
        if(!$scene_id){
            return $scene_datas;
        }
        //获取project_id
        $scene_db = new Scene();
        $scene_data = $scene_db->get_by_scene_id($scene_id);
        if(!$scene_data || !$scene_data->project_id){
            return $scene_datas;
        }
        $project_id = $scene_data->project_id;
        $criteria=new CDbCriteria;
        $criteria->order = 'id ASC';
        $criteria->addCondition("project_id={$project_id}");
        if($self){
        	$criteria->addCondition("id!={$scene_id}");
        }
        $criteria->addCondition('status=1');
        $scene_datas = $scene_db->findAll($criteria);
        return $scene_datas;
    }

}