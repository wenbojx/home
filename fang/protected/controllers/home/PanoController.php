<?php
class PanoController extends FController{

    public $defaultAction = 'a';
    public $layout = 'player';

    public function actionA(){
    	$request = Yii::app()->request;
    	$id = $request->getParam('id');
    	$datas['id'] = $id;

    	$datas['fang'] = $this->getFangInfo($datas['id']);
    	
        $datas['page']['title'] = '全景';
        $this->render('/home/pano', array('datas'=>$datas));
    }
    private function getFangInfo($id){
    	if(!$id){
    		return false;
    	}
    	$fang_db = new Fang();
    	return $fang_db->getFangInfo($id);
    }
}