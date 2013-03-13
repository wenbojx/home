<?php
class InfoController extends FController{
    public $defaultAction = 'a';
    public $layout = 'home';

    public function actionA(){
        $request = Yii::app()->request;
        $project_id = $request->getParam('id');
    	$datas = array();
    	$datas['project'] = $this->get_project_info($project_id);
    	
        $this->render('/home/info', array('datas'=>$datas));
    }

    /**
     * 获取项目简介
     */
    private function get_project_info($project_id){
    	if(!$project_id){
    		return false;
    	}
    	$project_db = new Project();
    	$project_data = $project_db->find_by_project_id($project_id);
    	return $project_data;
    }
}