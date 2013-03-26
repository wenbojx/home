<?php
class DemoController extends FController{

    public $defaultAction = 'a';
    public $layout = 'player';

    public function actionA(){
    	$request = Yii::app()->request;
        $datas['page']['title'] = '全景案例';
        $datas['id'] =  $request->getParam('id');
        if($request->getParam('manage')){
        	$datas['fromManage'] = 1;
        }
        
        $this->render('/home/demo', array('datas'=>$datas));
    }
}