<?php
class ViewController extends FController{
    public $defaultAction = 'a';
    public $layout = 'home';

    public function actionA(){
        $datas = array();
        $this->render('/home/view', array('datas'=>$datas));
    }

}