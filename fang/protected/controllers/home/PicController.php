<?php
class PicController extends FController{

    public $defaultAction = 'a';
    public $layout = 'home';
    private $pic_width = '400';
    private $pic_height = '350';

    public function actionA(){
    	$request = Yii::app()->request;
    	
    	$id = $request->getParam('id');
    	//$datas['info'] = $this->getFangInfo($id);
    	$datas['id'] = $id;
    	$datas['list'] = $this->get_pic_list($datas['id']);
        $datas['page']['title'] = '图片';
        $datas['width'] = $this->pic_width;
        $this->render('/home/pic', array('datas'=>$datas));
    }
    /**
     * 获取图片信息
     */
    private function get_pic_list($id){
    	$fangpic_db = new FangPic();
    	return $fangpic_db->getByFid($id);
    }
}