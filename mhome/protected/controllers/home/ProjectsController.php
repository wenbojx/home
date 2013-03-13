<?php
class ProjectsController extends FController{
    public $defaultAction = 'list';
    public $layout = 'home';
    private $project_db = null;
    private $page_size = 8;
    //public $page_obj = null;
    public $page_next = true; //是否有下页

    public function actionList(){
    	$request = Yii::app()->request;
    	$page = $request->getParam('page')?$request->getParam('page'):1;
        $datas['projects'] = $this->get_project_list($page);
        $datas['page_next'] = $this->page_next;
        $datas['page'] = $page+1;
        $datas['back'] = $page==1?false:true;
        //print_r($datas);
        $this->render('/home/projects', array('datas'=>$datas));
    }
    
	private function get_project_list($page){
    	$datas = array();
    	$this->project_db = new Project();
    	
    	$total = $this->project_db->get_project_num(3);
    	$page_num = ceil($total/$this->page_size);
    	//echo $page_num;
    	if($page_num<2 || $page_num == $page){
    		$this->page_next = false;
    		//echo 111;
    	}
    	if($total>0){
    		$offset = ($page-1)*$this->page_size;
    		$order = 'id DESC';
    		//获取场景信息
    		$project_datas = $this->project_db->get_project_list($this->page_size, $order, $offset,3);
    	}
    	
    	if(!$project_datas){
    		return $datas;
    	}
    	$project_ids = array();
    	foreach($project_datas as $k=>$v){
    			$datas[$v['id']]['project'] = $v;
    			$datas[$v['id']]['total_num'] = $this->get_scene_num($v['id']);
    			$datas[$v['id']]['thumb'] = $this->get_default_thumb($v['id']);
    	}
    	return $datas;
    }
    /**
     * 项目默认缩略图
     */
    private function get_default_thumb($project_id){
    	return $this->project_db->get_thumb_scene_id($project_id);
    }
    private function get_scene_num($project_id){
    	if(!$project_id){
    		return 0;
    	}
    	$scene_db = new Scene();
    	return $scene_db->get_scene_num($project_id);
    }
}