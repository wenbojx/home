<?php
class BasicController extends FController{

    public $defaultAction = 'a';
    public $layout = 'home';

    public function actionA(){
    	$request = Yii::app()->request;
    	$id = $request->getParam('id');
    	$datas['id'] = $id;
    	$datas['info'] = $this->getFangInfo($id);
    	

        $datas['page']['title'] = '基本';
        $this->render('/home/basic', array('datas'=>$datas));
    }
    private function getFangInfo($id){
    	if(!$id){
    		return false;
    	}
    	$fang_db = new Fang();
    	return $fang_db->getFangInfo($id);
    }
}