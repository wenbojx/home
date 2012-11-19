<?php
class ProjectsController extends FController{
    public $defaultAction = 'list';
    public $layout = 'home';
    public $project_db = null;
    private $page_size = 10;
    public $page_obj = null;

    public function actionList(){
    	$request = Yii::app()->request;
    	$page = $request->getParam('page')?$request->getParam('page'):1;
        $datas['projects'] = $this->get_project_list();
        $datas['pages'] = $this->page_obj;
        print_r($datas);
        $this->render('/home/projects', array('datas'=>$datas));
    }
    
	private function get_project_list(){
    	$datas = array();
    	$this->project_db = new Project();
    	
    	$total = $this->project_db->get_project_num();
    	if($total>0){
    		$route = '/home/project/list';
    		$this->page_obj = $this->page($page, $this->page_size, $total, $route);
    		$offset = ($page-1)*$this->page_size;
    		$order = 'id DESC';
    		//获取场景信息
    		$project_datas = $this->project_db->get_project_list($this->page_size, $order, $offset);
    	}
    	
    	if(!$project_datas){
    		return $datas;
    	}
    	$project_ids = array();
    	foreach($project_datas as $k=>$v){
    		$datas[$v['id']]['project'] = $v;
    		$datas[$v['id']]['total_num'] = $this->get_scene_num($v['id']);
    	}
    	return $datas;
    }
    private function get_scene_num($project_id){
    	if(!$project_id){
    		return 0;
    	}
    	$scene_db = new Scene();
    	return $scene_db->get_scene_num($project_id);
    }
}