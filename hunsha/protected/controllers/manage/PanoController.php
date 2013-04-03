<?php
class PanoController extends Controller{

    public $defaultAction = 'save';
    public $layout = 'home';

    public function actionSave(){
    	$request = Yii::app()->request;
    	$datas['project_id'] = $request->getParam('project_id');
    	$datas['pano_id'] = $request->getParam('pano_id');
    	
    	if(!$datas['project_id'] || !$datas['pano_id']){
    		$msg['flag'] = '0';
    		$this->display_msg($msg);
    	}
    	
    	$this->check_project_own($datas['project_id']);
    	
    	if($id = $this->getProjectPano($datas['project_id'])){
    		if(!$this->edit($id, $datas)){
    			$msg['flag'] = '0';
	    		$this->display_msg($msg);
    		}
    	}
    	else{
	    	if(!$id = $this->add($datas)){
	    		$msg['flag'] = '0';
	    		$this->display_msg($msg);
	    	}
    	}
    	$msg['flag'] = '1';
    	$msg['project_id'] = $datas['project_id'];
    	$this->display_msg($msg);
    }
    public function add($datas){
    	$project_pano_db = new ProjectPano();
    	return $project_pano_db->savePano($datas);
    }
    private function edit($id, $datas){
    	$project_pano_db = new ProjectPano();
    	unset($datas['project_id']);
    	return $project_pano_db->editPano($id, $datas);
    }
	private function getProjectPano($project_id){
		$project_pano_db = new ProjectPano();
		$datas = $project_pano_db->getProjectPano($project_id);
		return $datas['project_id'];
	}
    
    
}






