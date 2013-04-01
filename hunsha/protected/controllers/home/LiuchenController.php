<?php
class LiuchenController extends FController{

    public $defaultAction = 'a';
    public $layout = 'mobile';

    public function actionA(){
    	$request = Yii::app()->request;

        $datas['page']['title'] = '创新婚贴';
        $this->render('/home/liuchen', array('datas'=>$datas));
    }

}