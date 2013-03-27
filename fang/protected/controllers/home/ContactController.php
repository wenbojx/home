<?php
class ContactController extends FController{

    public $defaultAction = 'a';
    public $layout = 'home';

    public function actionA(){
    	$request = Yii::app()->request;
    	$id = $request->getParam('id');
    	$datas['id'] = $id;
    	$datas['member'] = $this->getMemberInfo($id);
        $datas['page']['title'] = '联系人';
        $this->render('/home/contact', array('datas'=>$datas));
    }
    private function getMemberInfo($id){
    	if(!$id){
    		return false;
    	}
    	$member_db = new Member();
    	return $member_db->getByMemberId($id);
    }
}