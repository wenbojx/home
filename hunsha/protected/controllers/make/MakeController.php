<?php
class MakeController extends FController{

    public $defaultAction = 'a';
    public $layout = 'make';

    public function actionA(){
    	$request = Yii::app()->request;

        $datas['page']['title'] = '创新婚贴';
        $this->render('/make/make', array('datas'=>$datas));
    }

}