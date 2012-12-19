<?php
class ProjectController extends Controller{
    public $defaultAction = 'list';
    public $layout = 'home';
    private $page_size = 10;
    public $madmin = true;

    /**
     * 获取全景图缩略图
     */
    public function actionThumb(){
        $request = Yii::app()->request;
        $datas = array();
    }
    
    /**
     * 获取全景图cube face
     */
    public function actionFace(){
    	
    }

}