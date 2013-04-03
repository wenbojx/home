<?php
class CaseController extends FController{

    public $defaultAction = 'a';
    public $layout = 'mobile';

	public function actionA(){
    	$request = Yii::app()->request;
    	$datas['id'] = $request->getParam('id');
    	$datas['pics'] = $this->getPics($datas['id']);
    	
        $datas['basic'] = $this->getProjectBasic($datas['id']);
        $datas['page']['title'] = $datas['basic']['tab6'];
        $this->render('/home/case', array('datas'=>$datas));
    }
	public function getPics($project_id){
    	$file_db = new File();
    	return $file_db->getByProjectId($project_id);
    }
    public function getProjectBasic($id){
    	if(!$id){
    		return false;
    	}
    	$basic_db = new Basic();
    	return $basic_db->getBasicInfo($id);
    }

}