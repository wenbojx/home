<?php

class LoginController extends FController{

    public $defaultAction = 'a';
    public $layout = 'home';

    public function actionA(){
    	$request = Yii::app()->request;
    	
    	if(Yii::app()->session['userinfo']){
    		$this->redirect(array('manage/list'));
    	}
        $datas['page']['title'] = '用户登陆';
        $this->render('/member/login', array('datas'=>$datas));
    }
    public function actionCheck(){
    	$msg['flag'] = '0';
    	if($this->member_id){
    		$msg['flag'] = '1';
    		$msg['member_id'] = $this->member_id;
    		$msg['nick_name'] = $this->nick_name;
    	}
    	$this->display_msg($msg);
    }
    public function actionCheckLogin(){
        $request = Yii::app()->request;
        $datas['username'] = $request->getParam('username');
        $datas['passwd'] = $request->getParam('passwd');

        $msg['flag'] = '1';
        if($datas['username']== '' || $datas['passwd']== ''){
            $msg['flag'] = '0';
        }
        else{
	        if($this->check_user($datas)){
	            $msg['flag'] = '1';
	            //$msg['url'] = Yii::app()->baseUrl;
	            //$msg['url'] = $this->createUrl('/pano/project');
	        }
	        else{
	        	$msg['flag'] = '0';
	        }
        }
        $this->display_msg($msg);
    }
    private function check_user($datas){
        $member_db = new Member();
        $user_datas = $member_db->check_login($datas);
        if(!$user_datas){
        	return false;
        }
        $session_datas['id'] = $user_datas['id'];
        $session_datas['username'] = $user_datas['username'];
        $session_datas['truename'] = $user_datas['truename'];
        Yii::app()->session['userinfo'] = $session_datas;
        return true;
    }
}