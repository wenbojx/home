<?php
class ListController extends FController{

    public $defaultAction = 'a';
    public $layout = 'home';

    public function actionA(){
    	$request = Yii::app()->request;
        $datas['page']['title'] = '房源列表';
        $this->render('/home/list', array('datas'=>$datas));
    }
}