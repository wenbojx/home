<?php
class LianxiController extends FController{

    public $defaultAction = 'a';
    public $layout = 'mobile';

	public function actionA(){
    	$request = Yii::app()->request;
    	$datas['id'] = $request->getParam('id');
    	$datas['contact'] = $this->getContact($datas['id']);
    	//print_r($datas['contact']);
        $datas['basic'] = $this->getProjectBasic($datas['id']);
        $datas['page']['title'] = $datas['basic']['tab6'];
        $this->render('/home/lianxi', array('datas'=>$datas));
    }
	public function getContact($project_id){
    	$contact_db = new Contact();
    	return $contact_db->getProjectContact($project_id);
    }
    public function getProjectBasic($id){
    	if(!$id){
    		return false;
    	}
    	$basic_db = new Basic();
    	return $basic_db->getBasicInfo($id);
    }

}