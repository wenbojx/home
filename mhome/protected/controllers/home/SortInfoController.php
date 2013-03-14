<?php
class SortInfoController extends FController{
    public $defaultAction = 'a';
    public $layout = 'home';

    public function actionA(){
        $request = Yii::app()->request;
        $sort_id = $request->getParam('id');
    	$datas = array();
    	$datas['sort'] = $this->get_sort_info($sort_id);
    	
        $this->render('/home/sort_info', array('datas'=>$datas));
    }

    /**
     * 获取分类信息
     */
	public function get_sort_info($sort_id){
    	if(!$sort_id){
    		return false;
    	}
    	$sort_db = new ProjectSort();
    	$sort_data = $sort_db->get_by_sort_id($sort_id);
    	return $sort_data;
    }
}