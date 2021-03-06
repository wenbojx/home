<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout='//layouts/column1';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu=array();
    public $member_id = '';
    public $user_name = '';

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs=array();
    public function __construct(){
        if(!$this->check_admin()){
            $this->redirect(array('make/make'));
        }

        $login_info = Yii::app()->session['userinfo'];
        $this->member_id = $login_info['id'];
        $this->user_name = $login_info['username'];
		//print_r($login_info);
        return true;
    }
    public function check_admin(){
        if(!Yii::app()->session['userinfo']){
            return false;
        }
        return true;
    }
    public function check_project_own($id = 0){
        $msg['flag'] = 0;
        $msg['msg'] = '无权限';
        if($id == 0){
            $this->display_msg($msg);
        }
        $basic_db = new Basic();
        $datas = $basic_db->getBasicInfo($id);
        if($datas['member_id'] != $this->member_id){
            $this->display_msg($msg);
        }
        return true;
    }
    
    public function display_msg($msg){
        $str = json_encode($msg);
        exit($str);
    }
    protected function login_state(){
        if(Yii::app()->session['userinfo']){
            $this->redirect(array('home/index'));
        }
        return false;
    }
}