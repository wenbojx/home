<?php
class ViewController extends FController{
    public $defaultAction = 'a';
    public $layout = 'player';
    public $player = true;
    private $scene_db = null;

    public function actionA(){
    	$request = Yii::app()->request;
    	$scene_id = $request->getParam('id');
    	$this->scene_db = new Scene();
    	if(!$scene_id){
    		return false;
    	}
    	$datas = array();
    	$datas['scene'] = $this->get_scene_data($scene_id);
    	$datas['pics'] = $this->get_scene_pics($scene_id);
    	if($datas['scene']){
    		$datas['next_id'] = $this->get_next_scene($scene_id, $datas['scene']['project_id']);
    	}
    	//print_r($datas['next_id']);
        
        $this->render('/home/view', array('datas'=>$datas));
    }
    //获取该场景下一个场景
    private function get_next_scene($scene_id, $project_id){
    	return $this->scene_db->get_next_scene_id($scene_id, $project_id);
    }
    //获取场景信息
    private function get_scene_data($scene_id){
    	$data = array();
    	$data = $this->scene_db->get_by_scene_id($scene_id);
    	return $data;
    }
    //获取场景图片信息
    private function get_scene_pics($scene_id){
    	$data = array();
    	$mp_scene_file_db = new MpSceneFile();
    	$data = $mp_scene_file_db->get_scene_list($scene_id);
    	return $data;
    }
}