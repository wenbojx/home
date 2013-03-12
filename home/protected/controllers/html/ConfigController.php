<?php
class ConfigController extends FController{
    public $defaultAction = 'a';
    public $layout = 'htmlConfig';
    public $player = true;
    private $scene_db = null;

    public function actionA(){
    	$request = Yii::app()->request;

        $this->render('/html/config', array('datas'=>$datas));
    }
   
}