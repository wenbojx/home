<?php
class LiuyanController extends FController{

    public $defaultAction = 'a';
    public $layout = 'hunli';
    public $limit = 10;

	public function actionA(){
    	$request = Yii::app()->request;
    	$datas['id'] = $request->getParam('id');
    	
    	$datas['msgList'] = $this->getMsg($datas['id'], $this->limit);
    	$datas['msgTab'] = $this->getMsgTab($datas['id']);
    	$datas['count'] = $this->getCount($datas['id']);
    	if($datas['count'] > $this->limit){
    		$datas['more'] = true;
    	}
    	//print_r($datas['msgTab']);
        $datas['basic'] = $this->getProjectBasic($datas['id']);
        $datas['page']['title'] = $datas['basic']['tab6'];
        $this->render('/hunli/liuyan', array('datas'=>$datas));
    }
    public function actionSave(){
    	$request = Yii::app()->request;
    	$datas['project_id'] = $request->getParam('project_id');
    	$datas['tab1'] = $request->getParam('tab1');
    	$datas['tab2'] = $request->getParam('tab2');
    	$datas['tab3'] = $request->getParam('tab3');
    	//$datas['tab3'] = nl2br($datas['tab3']);
    	$msg['flag'] = '0';
    	$msg['project_id'] = $datas['project_id'];
    	if(!$datas['project_id'] || $datas['tab1']=='' || $datas['tab2']=='' || $datas['tab3']==''){
    		$this->display_msg($msg);
    	}
    	$id = $this->saveMsg($datas);
    	$msg['flag'] = '1';
    	$msg['project_id'] = $id;
    	$this->display_msg($msg);
    }
    public function actionLoadMore(){
    	$request = Yii::app()->request;
    	$datas['project_id'] = $request->getParam('project_id');
    	$datas['last_id'] = $request->getParam('last_id');
    	$msg['flag'] = '0';
    	if(!$datas['project_id'] || !$datas['last_id']){
    		$this->display_msg($msg);
    	}
    	$order = 'id desc';
    	$datas['list'] = $this->getMsg($datas['project_id'], $this->limit, $datas['last_id'], $order);
    	if(!$datas['list']){
    		$msg['flag'] = '1';
    		$msg['none'] = '1';
    		$this->display_msg($msg);
    	}
    	$msg['list'] = array();
    	foreach($datas['list'] as $v){
    		$msg['list'][$v['id']]['tab1'] = $v['tab1'];
    		$msg['list'][$v['id']]['tab2'] = $v['tab2'];
    		$msg['list'][$v['id']]['tab3'] = $v['tab3'];
    		$msg['list'][$v['id']]['time'] = date('Y-m-d H:i',$v['create']);
    	}
    	$msg['flag'] = '1';

    	$this->display_msg($msg);
    	
    }
    public function getMsg($project_id, $limit=10, $last_id=0, $order=''){
    	$msg_db = new Msg();
    	return $msg_db->getProjectMsg($project_id, $limit, $last_id, $order);
    }
    public function getCount($project_id){
    	$msg_db = new Msg();
    	return $msg_db->getCount($project_id);
    }
	public function getMsgTab($project_id){
    	$msgtab = new MsgTab();
    	return $msgtab->getProjectMsgTab($project_id);
    }
    public function getProjectBasic($id){
    	if(!$id){
    		return false;
    	}
    	$basic_db = new Basic();
    	return $basic_db->getBasicInfo($id);
    }
    public function saveMsg($datas){
    	$msg_db = new Msg();
    	return $msg_db->saveMsg($datas);
    }

}