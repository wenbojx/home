<?php
class Step1Controller extends FController{

    public $defaultAction = 'a';
    public $layout = 'make';

    public function actionA(){
    	$request = Yii::app()->request;

        $datas['page']['title'] = '第一步';
        $this->render('/make/step1', array('datas'=>$datas));
    }

}