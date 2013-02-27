<?php
class ServiceController extends FController{
    public $defaultAction = 'a';
    public $layout = 'home';
    public function actionA(){
    	$datas = array();
        $this->render('/web/service', array('datas'=>$datas));
    }
}