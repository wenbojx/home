<?php
class BasicController extends Controller{

    public $defaultAction = 'save';
    public $layout = 'home';

    public function actionSave(){
    	$request = Yii::app()->request;
    	$datas['id'] = $request->getParam('id');
    	$datas['name'] = $request->getParam('name');
    	$datas['tab1'] = $request->getParam('tab1');
    	$datas['tab2'] = $request->getParam('tab2');
    	$datas['tab3'] = $request->getParam('tab3');
    	$datas['tab4'] = $request->getParam('tab4');
    	$datas['tab5'] = $request->getParam('tab5');
    	$datas['tab6'] = $request->getParam('tab6');
    	
    	if($datas['name']==''){
    		$msg['flag'] = '0';
    		$this->display_msg($msg);
    	}
    	
    	if($datas['id']){
    		$this->check_project_own($datas['id']);
    		if(!$id = $this->edit($datas['id'], $datas)){
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
    	$msg['id'] = $id;
    	$this->display_msg($msg);
    }
    public function add($datas){
    	$datas['member_id'] = $this->member_id;
    	$basic_db = new Basic();
    	return $basic_db->saveBasic($datas);
    }
    private function edit($id, $datas){
    	$basic_db = new Basic();
    	return $basic_db->editBasic($id, $datas);
    }

    
    
}






