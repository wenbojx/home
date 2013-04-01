<?php
class FanweiController extends FController{

    public $defaultAction = 'a';
    public $layout = 'mobile';

    public function actionA(){
    	$request = Yii::app()->request;

        $datas['page']['title'] = '服务范围';
        $this->render('/home/fanwei', array('datas'=>$datas));
    }

}