<?php
class MsgTabController extends Controller{

    public $defaultAction = 'save';
    public $layout = 'home';

    public function actionSave(){
    	$request = Yii::app()->request;
    	$datas['project_id'] = $request->getParam('project_id');
    	$datas['tab1'] = $request->getParam('tab1');
    	$datas['tab2'] = $request->getParam('tab2');
    	$datas['tab3'] = $request->getParam('tab3');
    	$datas['info'] = $request->getParam('info');
    	
    	if(!$datas['project_id'] || !$datas['tab1'] || !$datas['tab2'] || !$datas['tab3']){
    		$msg['flag'] = '0';
    		$this->display_msg($msg);
    	}
    	
    	$this->check_project_own($datas['project_id']);
    	if($id = $this->getProjectMsgTab($datas['project_id'])){
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
    	$msgtab_db = new MsgTab();
    	return $msgtab_db->saveMsgTab($datas);
    }
    private function edit($id, $datas){
    	$msgtab_db = new MsgTab();
    	unset($datas['project_id']);
    	return $msgtab_db->editMsgTab($id, $datas);
    }
	private function getProjectMsgTab($project_id){
		$msgtab_db = new MsgTab();
		$datas = $msgtab_db->getProjectMsgTab($project_id);
		return $datas['project_id'];
	}
    
    
}






