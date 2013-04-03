<?php
class InfoController extends Controller{

    public $defaultAction = 'save';
    public $layout = 'home';

    public function actionSave(){
    	$request = Yii::app()->request;
    	$datas['id'] = $request->getParam('id');
    	$datas['project_id'] = $request->getParam('project_id');
    	$datas['tab'] = $request->getParam('tab');
    	$datas['info'] = $request->getParam('info');
    	
    	if(!$datas['project_id'] || !$datas['tab']){
    		$msg['flag'] = '0';
    		$this->display_msg($msg);
    	}
    	
    	$this->check_project_own($datas['project_id']);
    	
    	if($id = $this->getProjectInfoByTab($datas['project_id'], $datas['tab'])){
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
    	$datas['member_id'] = $this->member_id;
    	$info_db = new Info();
    	return $info_db->saveInfo($datas);
    }
    private function edit($id, $datas){
    	$info_db = new Info();
    	unset($datas['id']);
    	unset($datas['project_id']);
    	unset($datas['tab']);
    	return $info_db->editInfo($id, $datas);
    }
	private function getProjectInfoByTab($project_id, $tab){
		$info_db = new Info();
		$datas = $info_db->getProjectInfoByTab($project_id, $tab);
		return $datas['id'];
	}
    
    
}






