<?php
class PicController extends FController{

    public $defaultAction = 'a';
    public $layout = 'home';

    public function actionA(){
    	$request = Yii::app()->request;
        $datas['page']['title'] = '图片';
        $this->render('/home/pic', array('datas'=>$datas));
    }
}