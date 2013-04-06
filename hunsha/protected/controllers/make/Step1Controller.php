<?php
class Step1Controller extends Controller{

    public $defaultAction = 'a';
    public $layout = 'make';

    public function actionA(){
    	$request = Yii::app()->request;
    	$datas['username'] = '';
    	$datas['member_id'] = '';
    	if($this->member_id){
    		$datas['username'] = $this->user_name;
    		$datas['member_id'] = $this->member_id;
    	}
    	$datas['id'] = '';
    	//根据会员ID获取项目信息
    	if($basic = $this->getBasicMember($datas['member_id'])){
    		$datas['basic'] = $basic;
    		$datas['id'] = $basic['id'];
    		$datas['info'] = $this->getProjectInfo($datas['id']);
    		$datas['msgTab'] = $this->getMsgTab($datas['id']);
    		$datas['contact'] = $this->getContact($datas['id']);
    		$datas['pics'] = $this->getPics($datas['id']);
    		$datas['pano'] = $this->getPano($datas['id']);
    		
    		//print_r($datas['info']);
    		$datas['page']['title'] = '编辑项目';
    	}
    	else{
    		$datas['page']['title'] = '新建项目';
    	}
        
        $this->render('/make/step1', array('datas'=>$datas));
    }
    public function getBasicMember($member_id){
    	if(!$member_id){
    		return false;
    	}
    	$basic_db = new Basic();
    	return $basic_db->getBasicByMember($member_id);
    }
    public function actionEdit(){
    	$request = Yii::app()->request;
    	$datas['username'] = '';
    	$datas['member_id'] = '';
    	if($this->member_id){
    		$datas['username'] = $this->user_name;
    		$datas['member_id'] = $this->member_id;
    	}
    	
    	$datas['id'] = $request->getParam('id');
    	if(!$datas['id']){
    		echo '参数错误';
    		exit();
    	}
    	$datas['basic'] = $this->getProjectBasic($datas['id']);
    	$datas['info'] = $this->getProjectInfo($datas['id']);
    	$datas['msgTab'] = $this->getMsgTab($datas['id']);
    	$datas['contact'] = $this->getContact($datas['id']);
    	$datas['pics'] = $this->getPics($datas['id']);
    	$datas['pano'] = $this->getPano($datas['id']);
    	//print_r($datas['info']);
    	$datas['page']['title'] = '编辑项目';
    	$this->render('/make/step1', array('datas'=>$datas));
    }
    public function getPano($project_id){
    	$pro_pano_db = new ProjectPano();
    	return $pro_pano_db->getProjectPano($project_id);
    }
    /**
     * 获取图片
     */
    public function getPics($project_id){
    	$file_db = new File();
    	return $file_db->getByProjectId($project_id);
    }
    public function getContact($project_id){
    	$contact_db = new Contact();
    	return $contact_db->getProjectContact($project_id);
    }
    public function getMsgTab($project_id){
    	$msgtab = new MsgTab();
    	return $msgtab->getProjectMsgTab($project_id);
    }
    public function getProjectInfo($id){
    	$info_db = new Info();
    	return $info_db->getProjectInfo($id);
    }
    public function getProjectBasic($id){
    	if(!$id){
    		return false;
    	}
    	$basic_db = new Basic();
    	return $basic_db->getBasicInfo($id);
    }
}