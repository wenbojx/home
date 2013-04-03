<?php
class LiuyanController extends FController{

    public $defaultAction = 'a';
    public $layout = 'mobile';

	public function actionA(){
    	$request = Yii::app()->request;
    	$datas['id'] = $request->getParam('id');
    	$datas['msgTab'] = $this->getMsgTab($datas['id']);
    	//print_r($datas['msgTab']);
        $datas['basic'] = $this->getProjectBasic($datas['id']);
        $datas['page']['title'] = $datas['basic']['tab6'];
        $this->render('/home/liuyan', array('datas'=>$datas));
    }
	public function getMsgTab($project_id){
    	$msgtab = new MsgTab();
    	return $msgtab->getProjectMsgTab($project_id);
    }
    public function getProjectBasic($id){
    	if(!$id){
    		return false;
    	}
    	$basic_db = new Basic();
    	return $basic_db->getBasicInfo($id);
    }
    

}