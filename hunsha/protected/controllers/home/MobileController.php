<?php
class MobileController extends FController{

    public $defaultAction = 'a';
    public $layout = 'mobile';
    public $resize = true;

    public function actionA(){
    	$request = Yii::app()->request;
    	$datas['id'] = $request->getParam('id');
    	$datas['basic'] = $this->getProjectBasic($datas['id']);
        $datas['page']['title'] = $datas['basic']['name'];
        $this->render('/home/mobile', array('datas'=>$datas));
    }
	public function getProjectBasic($id){
    	if(!$id){
    		return false;
    	}
    	$basic_db = new Basic();
    	return $basic_db->getBasicInfo($id);
    }
}