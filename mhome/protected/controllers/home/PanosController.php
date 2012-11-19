<?php
class PanosController extends FController{
    public $defaultAction = 'list';
    public $layout = 'home';
    private $scene_db = null;
    private $page_size = 8;
    public $page_next = true; //是否有下页

    public function actionList(){
        $request = Yii::app()->request;
        $project_id = $request->getParam('id');
    	$page = $request->getParam('page')?$request->getParam('page'):1;
        $datas['scenes'] = $this->get_scene_list($page, $project_id);
        //print_r($datas);
        $datas['project'] = $this->get_project_datas($project_id);
        $datas['page_next'] = $this->page_next;
        $datas['page'] = $page+1;
        $datas['back'] = $page==1?false:true;
        $this->render('/home/panos', array('datas'=>$datas));
    }

    private function get_scene_list($page, $project_id){
    	$datas = array();
    	$this->scene_db = new Scene();
    	 
    	$total = $this->scene_db->get_scene_num($project_id);
    	$page_num = ceil($total/$this->page_size);
    	if($page_num<2 || $page_num == $page){
    		$this->page_next = false;
    	}
    	if($total>0){
    		$offset = ($page-1)*$this->page_size;
    		//获取场景信息
    		$scene_datas = $this->get_scene_datas($project_id, $offset);
    	}
    	//print_r($scene_datas);
    	if($scene_datas){
    		$datas = $scene_datas;
    	}
    	return $datas;
    }
    
	private function get_project_datas($project_id){
    	$project_db = new Project();
    	return $project_db->find_by_project_id($project_id);
    }
    
    private function get_scene_datas($project_id, $offset){
    	$order = 'id ASC';
    	return $this->scene_db->find_scene_by_project_id($project_id, $this->page_size, $order, $offset);
    }
}