<?php
class ConfigController extends FController{
    public $defaultAction = 'a';
    public $layout = 'xml';
    public $player = true;
    private $scene_db = null;

    public function actionA(){
    	$request = Yii::app()->request;
        
        $this->render('/home/config', array('datas'=>$datas));
    }
   
}