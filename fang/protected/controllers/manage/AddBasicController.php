<?php
class AddBasicController extends FController{

    public $defaultAction = 'a';
    public $layout = 'home';

    public function actionA(){
    	$request = Yii::app()->request;
        $datas['page']['title'] = '发布房源';
        $this->render('/manage/addBasic', array('datas'=>$datas));
    }
}