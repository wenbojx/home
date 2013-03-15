<?php

class MController extends FController{

	/**
	 * 项目列表
	 */
    public function actionPS(){
    	$request = Yii::app()->request;
    	$datas = array();
    	$project_id = $request->getParam('id');
    	if(!$project_id){
    		//$msg['state'] = '0';
    		//$msg['msg'] = '参数错误';
    	}
    	$msg['project'] = $this->get_project_list($project_id);
    	$this->display_msg($msg);
    }
    /**
     * 场景列表
     */
    public function actionPL(){
    	$request = Yii::app()->request;
    	$datas = array();
    	$project_id = $request->getParam('id');
    	$msg['panos'] = array();
    	$msg['map'] = '';
    	if(!$project_id){
    		$this->display_msg($msg);
    	}
    	$msg['panos'] = $this->get_scene_list($project_id);
    	$msg['map'] = $this->get_scene_map($project_id);
    	$msg['info'] = $this->getProjectInfo($project_id);
    	$msg['pay'] = '0';
    	//$msg['display'] = 
    	//print_r($msg);
    	$this->display_msg($msg);
    }
    /**
     * 场景详细
     */
    public function actionPV(){
    	$request = Yii::app()->request;
    	$datas = array();
    	$scene_id = $request->getParam('id');
    	$msg['pano'] = array();
    	if(!$scene_id){
    		$this->display_msg($msg);
    	}
    	$msg['pano'] = $this->get_scene_data($scene_id);
    	$msg['hotspots'] = $this->get_scene_hotspots($scene_id);
    	//print_r($msg);
    	$this->display_msg($msg);
    }
    /**
     * 地图json
     */
    public function actionPM(){
    	$request = Yii::app()->request;
    	$datas = array();
    	$project_id = $request->getParam('id');
    	if($project_id){
    		$datas['coords'] = $this->get_map_position($project_id, 'json');
    		$datas['map'] = $this->get_scene_map($project_id);
    	}
    	//print_r($datas);
    	$this->display_msg($datas);
    }
    /**
     * 地图XML
     */
    public function actionMP(){
    	$request = Yii::app()->request;
    	$datas = array();
    	$project_id = $request->getParam('id');
    	$str = '<?xml version="1.0" encoding="utf-8"?><maps><map name="map">';
    	if($project_id){
    		$str .= $this->get_map_position($project_id);
    	}
    	$str .= '</map></maps>';

    	echo $str;
    }
    /**
     * 获取项目信息
     */
    private function getProjectInfo($project_id){
    	$projectDB = new Project();
    	$projectData = $projectDB->find_by_project_id($project_id);
    	if(!$projectData){
    		return '';
    	}
    	return $projectData['desc'];
    }
    private function get_map_position($project_id, $type="xml"){
    	$str = '';
    	$map_db = new ProjectMap();
    	$map_datas = $map_db->get_map_info($project_id);
    	$map_positon = $map_datas['position'];
    	$positionData = array();
    	if(!$map_positon){
    		return $type=='xml' ? $str : $positionData;
    	}
    	$positionData = array();
    	$i = 0;
    	foreach($map_positon as $v){
    		$p11 = $v['left'] -15;
    		$p12 = $v['top'] - 20;
    		$p21 = $v['left'] +15;
    		$p22 = $v['top'] -20;
    		$p31 = $v['left'] -15;
    		$p32 = $v['top'] +20;
    		$p41 = $v['left'] +15;
    		$p42 = $v['top'] +20;
    		if ($type == 'xml'){
    			$str .= "<area shape=\"poly\" link=\"{$v['scene_id']}\" coords=\"{$p11},{$p12},{$p21},{$p22},{$p41},{$p42},{$p31},{$p32}\" id=\"@+id/area{$v['id']}\" name = \"{$map_datas['link_scenes'][$v['scene_id']]['name']}\"/>";
    		}
    		else{
    			$positionData[$i]['linkScene'] = $v['scene_id'];
    			$positionData[$i]['linkTitle'] = $map_datas['link_scenes'][$v['scene_id']]['name'];
    			$positionData[$i]['coords'] = "{$p11},{$p12},{$p21},{$p22},{$p41},{$p42},{$p31},{$p32}";
    			$i++;
    		}
    		
    	}
    	return $type=='xml' ? $str : $positionData;
    }
    /**
     * 获取场景信息
     */
    private function get_scene_data($scene_id){
    	$sceneDB = new Scene();
    	$datas = $sceneDB->get_by_scene_id($scene_id);
    	if(!$datas){
    		return false;
    	}
    	$sceneData = array();
    	$sceneData['id'] = $datas['id'];
    	$sceneData['id'] = $datas['id'];
    	$sceneData['title'] = $datas['name'];
    	$sceneData['info'] = $datas['desc'];
    	$sceneData['state'] = 1;
    	$size = '1024x1024';
    	$sceneData['s_f'] = PicTools::get_face_small($scene_id, 's_f' , $size);
    	$sceneData['s_r'] = PicTools::get_face_small($scene_id, 's_r' , $size);
    	$sceneData['s_b'] = PicTools::get_face_small($scene_id, 's_b' , $size);
    	$sceneData['s_l'] = PicTools::get_face_small($scene_id, 's_l' , $size);
    	$sceneData['s_u'] = PicTools::get_face_small($scene_id, 's_u' , $size);
    	$sceneData['s_d'] = PicTools::get_face_small($scene_id, 's_d' , $size);
    	return $sceneData;
    }
    /**
     * 获取地图
     */
    private function get_scene_map($project_id){
    	$map_db = new ProjectMap();
    	$map_datas = $map_db->get_map_info($project_id);
    	if(!$map_datas){
    		return "nomap";
    	}
    	$map_id = $map_datas['map']['id'];
    	$mapUrl = PicTools::get_pano_map($project_id, $map_id);
    	//echo $mapUrl;
    	//echo 111;
    	if($mapUrl){
    		return $mapUrl;
    	}
    	else{
    		return "nomap";
    	}
    }
    /**
     * 获取场景热点
     */
    private function get_scene_hotspots($scene_id){
    	$hotspots = array();
    	if(!$scene_id){
    		return $hotspots;
    	}
    	$hotspotsDB = new ScenesHotspot();
    	$hotspots = $hotspotsDB->get_scene_hotspots($scene_id);
    	//print_r($hotspots);
    	if(!$hotspots){
    		return array();
    	}
    	foreach($hotspots as $k=>$v){
    		if($v['type'] == 4){
    			$hotspots[$k]['file_path'] = PicTools::get_img_hotspot_path($v['scene_id'], $v['id']);
    		}
    	}
    	return $hotspots;
    }
    /**
     * 获取场景信息
     */
    private function get_scene_list($project_id){
    	$order = 'id ASC';
    	$sceneDB = new Scene();
    	$datas =  $sceneDB->find_scene_by_project_id($project_id, 0, $order, 0);
    	if(!$datas){
    		return array();
    	}
    	$sceneDatas = array();
    	$i = 0;
    	foreach($datas as $v){
    		$sceneDatas[$i]['id'] = $v['id'];
    		$sceneDatas[$i]['title'] = $v['name'];
    		$sceneDatas[$i]['info'] = $v['desc'];
    		$sceneDatas[$i]['created'] = date(' Y-m-d H : i ', $v['created']);
    		$sceneDatas[$i]['thumb'] = PicTools::get_pano_small($v['id'] , '200x100');
    		$sceneDatas[$i]['state'] = 1;
    		$i++;
    	}
    	return $sceneDatas;
    }
    /**
     * 获取全景图状态
     */
    private function get_project_list($project_id){
    	$projectDB = new Project();
    	$order = 'id desc';
    	$project_list = $projectDB->get_project_list(10, $order, 0, 3);
    	if(!$project_list){
    		return false;
    	}
    	$datas = array();
    	$i = 0;
    	foreach($project_list as $v){
    		$datas[$i]['id'] = $v['id'];
    		$datas[$i]['title'] = $v['name'];
    		//$datas[$i]['info'] = $v['desc'];
    		$datas[$i]['created'] = date(' Y 年 m 月 d 日', $v['created']);
    		$datas[$i]['state'] = 1;
    		$datas[$i]['count'] = $this->get_scene_num($v['id']);
    		$thumb_scene_id = $this->get_thumb_scene_id($v['id']);
    		$datas[$i]['thumb'] = PicTools::get_pano_thumb($thumb_scene_id , '150x110');
    		$i++;
    	}
    	return $datas;
    }
    private function get_scene_num($project_id){
    	if(!$project_id){
    		return 0;
    	}
    	$scene_db = new Scene();
    	return $scene_db->get_scene_num($project_id);
    }
    /**
     * 获取项目的默认缩略图
     */
    private function get_thumb_scene_id($project_id){
    	if(!$project_id){
    		return false;
    	}
    	$projectDB = new Project();
    	return $projectDB->get_thumb_scene_id($project_id);
    }
}





