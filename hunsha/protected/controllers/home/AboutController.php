<?php
class AboutController extends FController{

    public $defaultAction = 'a';
    public $layout = 'mobile';

    public function actionA(){
    	$request = Yii::app()->request;
    	$datas['id'] = $request->getParam('id');
    	$datas['info'] = $this->getProjectInfo($datas['id']);
        $datas['basic'] = $this->getProjectBasic($datas['id']);
        $datas['page']['title'] = $datas['basic']['tab2'];
        $this->render('/home/about', array('datas'=>$datas));
    }
    public function getProjectInfo($project_id){
    	$info_db = new Info();
    	return $info_db->getProjectInfoByTab($project_id, 2);
    }
    public function getProjectBasic($id){
    	if(!$id){
    		return false;
    	}
    	$basic_db = new Basic();
    	return $basic_db->getBasicInfo($id);
    }
}