<?php
class PanosController extends FController{
    public $defaultAction = 'list';
    public $layout = 'home';
    private $page_size = 8;

    public function actionList(){
        $datas = array();
        $datas['list'] = $this->get_pano_list();
        $this->render('/home/panos', array('datas'=>$datas));
    }

    private function get_pano_list(){
    	$project_db = new Project();
    	$order = 'id DESC';
    	$datas = $project_db->get_project_list($page_size, $order);
    	//print_r($datas);
    	return $datas;
    }
}