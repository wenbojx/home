<?php
class ErweiaController extends Controller{

    public $defaultAction = 'a';
    public $layout = 'home';

    public function actionA(){
    	$request = Yii::app()->request;
        $datas['page']['title'] = '我的二维码';
        $datas['id'] = $request->getParam('id');

        $datas['url'] = 'http://fang.yiluhao.com/'.$this->member_id;
        
        if($datas['id'] ){
        	$datas['page']['title'] = '房源二维码';
        	$datas['url'] = 'http://fang.yiluhao.com/a/'.$datas['id'] ;
        }
        $this->render('/manage/erweia', array('datas'=>$datas));
    }
}