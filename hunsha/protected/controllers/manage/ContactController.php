<?php
class ContactController extends Controller{

    public $defaultAction = 'save';
    public $layout = 'home';

    public function actionSave(){
    	$request = Yii::app()->request;
    	$datas['project_id'] = $request->getParam('project_id');
    	$datas['lat'] = $request->getParam('lat');
    	$datas['lng'] = $request->getParam('lng');
    	$datas['zoom'] = $request->getParam('zoom');
    	$datas['info'] = $request->getParam('info');
    	
    	if(!$datas['project_id'] ){
    		$msg['flag'] = '0';
    		$this->display_msg($msg);
    	}
    	
    	$this->check_project_own($datas['project_id']);
    	
    	
    	if($id = $this->getProjectContact($datas['project_id'])){
    		if(!$this->edit($datas['project_id'], $datas)){
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
    	$contact_db = new Contact();
    	return $contact_db->saveContact($datas);
    }
    private function edit($id, $datas){
    	$contact_db = new Contact();
    	unset($datas['project_id']);
    	return $contact_db->editContact($id, $datas);
    }
	private function getProjectContact($project_id){
		$contact_db = new Contact();
		$datas = $contact_db->getProjectContact($project_id);
		return $datas;
	}
    
    
}






