<?php
class BasicController extends FController{

    public $defaultAction = 'a';
    public $layout = 'home';

    public function actionA(){
    	$request = Yii::app()->request;
        $datas['page']['title'] = '基本';
        $this->render('/home/basic', array('datas'=>$datas));
    }
}