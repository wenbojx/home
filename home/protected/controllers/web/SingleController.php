<?php
class SingleController extends FController{
    public $defaultAction = 'a';
    public $layout = 'single';
    private $default_width = "900";
    private $default_height= "600";
    

	public function actionA(){
        $request = Yii::app()->request;
        $datas['scene_id'] = $request->getParam('id');
        $width = $request->getParam('w');
        $height = $request->getParam('h');
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
        
        if($datas['scene_id']){
            $datas['scene'] = $this->get_scene_datas($datas['scene_id']);
            if($datas['config']['title']){
            	$datas['project'] = $this->get_project_datas($datas['scene']['project_id']);
            }
        }
        $this->render('/web/single', array('datas'=>$datas));
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