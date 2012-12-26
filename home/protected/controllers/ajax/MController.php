<?php

class MController extends Controller{

    public function actionProject(){
    	$request = Yii::app()->request;
    	$datas = array();
    	$project_id = $request->getParam('id');
    	if(!$project_id){
    		$msg['state'] = '0';
    		$msg['msg'] = '参数错误';
    		
    	}
    	$msg['project'] = $this->get_project_list($project_id);
    	
    	$this->display_msg($msg);
    }
    /**
     * 获取全景图状态
     */
    private function get_project_list($project_id){
    	
    }
    
}





