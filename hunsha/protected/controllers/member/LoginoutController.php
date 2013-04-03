<?php
class LoginoutController extends Controller{

    public $defaultAction = 'a';
    //public $layout = 'default';

    public function actionA(){
        unset(Yii::app()->session['userinfo']);
        $this->login_state();
    }

    public function login_state(){
    	$this->redirect(array('make/make/a'));
    	return false;
    }
}