<?php
class SingleController extends FController{
    public $defaultAction = 'a';
    public $layout = 'single';
    private $default_width = "880";
    private $default_height= "550";
    private $map_show = false;

	public function actionA(){
        $request = Yii::app()->request;
        $datas['scene_id'] = $request->getParam('id');
        $width = $request->getParam('w');
        $height = $request->getParam('h');
        $m = $request->getParam('m');
        $datas['style']['width'] = $width ? $width : $this->default_width;
        $datas['style']['height'] = $height ? $height : $this->default_height;
        
        $nobtb = $request->getParam('nobtb'); //是否含button_bar
        $auto = $request->getParam('auto'); //是否自动转
        $center = $request->getParam('center'); //是否自动转
        $title = $request->getParam('title'); //是否自动转
        //$single = $request->getParam('single'); //是否单个
        $datas['config']['nobtb'] = $nobtb ? '1' :'0';
        $datas['config']['auto'] = $auto ? '0' :'1';
        $datas['config']['single'] = 1;
        $datas['config']['center'] = $center ? '0':'1';
        $datas['config']['title'] = $title ? '0': '1';
        $datas['config']['contact_show'] = false;
        
        if($datas['scene_id']){
            $datas['scene'] = $this->get_scene_datas($datas['scene_id']);
            if($datas['config']['title']){
            	$datas['project'] = $this->get_project_datas($datas['scene']['project_id']);
            	if($datas['project']['id'] == '1007'){
            		$datas['config']['contact_show'] = true;
            	}
            }
        }
        if(!$m){
        	$this->render('/web/single', array('datas'=>$datas));
        }
        else{
        	$datas['map_flag'] = $request->getParam('map')==''?$this->map_show:false;
        	$this->layout = 'htmlPlayer';
        	$datas['map'] = $this->get_map_info($datas['project']['id']);
        	$this->render('/web/msingle', array('datas'=>$datas));
        }
    }
    /**
     * 获取地图信息
     */
    private function get_map_info($project_id){
    	$map_db = new ProjectMap();
    	$map_datas = $map_db->get_map_info($project_id);
    	if(!$map_datas){
    		return false;
    	}
    	return $map_datas;
    }
    private function get_scene_datas($scene_id){
        $scene_db = new Scene();
        return $scene_db->get_by_scene_id($scene_id);
    }
    private function get_project_datas($project_id){
    	if(!$project_id){
    		return false;
    	}
    	$project_db = new Project();
    	$project_data = $project_db->find_by_project_id($project_id);
    	return $project_data;
    }
}