<?php

class MController extends FController{

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
    public function actionPL(){
    	$request = Yii::app()->request;
    	$datas = array();
    	$project_id = $request->getParam('id');
    	$msg['panos'] = array();
    	$msg['map'] = '';
    	if(!$project_id){
    		$this->display_msg($msg);
    	}
    	$msg['panos'] = $this->get_scene_datas($project_id);
    	$msg['map'] = $this->get_scene_map($project_id);
    	
    	$this->display_msg($msg);
    }
    /**
     * 获取地图
     */
    private function get_scene_map($project_id){
    	$map_db = new ProjectMap();
    	$map_datas = $map_db->get_map_info($project_id);
    	if(!$map_datas){
    		return false;
    	}
    	$map_id = $map_datas['map']['id'];
    	return PicTools::get_pano_map($project_id, $map_id);
    }
    /**
     * 获取场景信息
     */
    private function get_scene_datas($project_id){
    	$order = 'id ASC';
    	$sceneDB = new Scene();
    	$datas =  $sceneDB->find_scene_by_project_id($project_id, 10, $order, 0);
    	if(!$datas){
    		return array();
    	}
    	$sceneDatas = array();
    	$i = 0;
    	foreach($datas as $v){
    		$sceneDatas[$i]['id'] = $v['id'];
    		$sceneDatas[$i]['title'] = $v['name'];
    		$sceneDatas[$i]['info'] = $v['desc'];
    		$sceneDatas[$i]['thumb'] = PicTools::get_pano_thumb($v['id'] , '150x110');
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
    		$datas[$i]['info'] = $v['desc'];
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





