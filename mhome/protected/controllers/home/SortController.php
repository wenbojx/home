<?php
class SortController extends FController{
    public $defaultAction = 'list';
    public $layout = 'home';

    public function actionList(){
        $request = Yii::app()->request;
        $sort_id = $request->getParam('id');
    	$datas = array();
    	if($sort_id){
    		$datas['sort'] = $this->get_sort_info($sort_id);
    		if($datas['sort']){
    			$sort_id = $datas['sort']['id'];
    			$datas['projects'] = $this->get_sort_project($sort_id);
    		}
    	}
    	//print_r($datas);
        $this->render('/home/sorts', array('datas'=>$datas));
    }

    public function get_sort_info($sort_id){
    	if(!$sort_id){
    		return false;
    	}
    	$sort_db = new ProjectSort();
    	$sort_data = $sort_db->get_by_sort_id($sort_id);
    	return $sort_data;
    }
    public function get_sort_project($sort_id){
    	$project_sort_db = new MpProjectSort();
    	return $project_sort_db->get_project_list($sort_id, 'fang');
    }
}