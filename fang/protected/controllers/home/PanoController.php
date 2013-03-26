<?php
class PanoController extends FController{

    public $defaultAction = 'a';
    public $layout = 'home';

    public function actionA(){
    	$request = Yii::app()->request;
        $datas['page']['title'] = '全景';
        $this->render('/home/pano', array('datas'=>$datas));
    }
}