<?php
class AddQuanController extends FController{

    public $defaultAction = 'a';
    public $layout = 'home';

    public function actionA(){
    	$request = Yii::app()->request;
        $datas['page']['title'] = '设置全景';
        $datas['id'] =  $request->getParam('id');
        $pano_id = $request->getParam('pano_id');
        //echo $pano_id;
        if($pano_id){
        	$this->editPano($datas['id'], $pano_id);
        }
        	
        if($datas['id']){
        	$datas['fang'] = $this->getFangInfo($datas['id']);
        }
        
        $this->render('/manage/addQuan', array('datas'=>$datas));
    }
    private function getFangInfo($id){
    	$fang_db = new Fang();
    	return $fang_db->getFangInfo($id);
    }
    private function editPano($id, $pano_id){
    	if(!$id || !$pano_id){
    		return false;
    	}
    	$fang_db = new Fang();
    	$datas['pano_id'] = $pano_id;
    	return $fang_db->editFang($id, $datas);
    }
}