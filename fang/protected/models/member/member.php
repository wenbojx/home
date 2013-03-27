<?php

/**
 * This is the model class for table "{{member}}".
 *
 * The followings are the available columns in table '{{member}}':
 * @property integer $id
 * @property string $username
 * @property string $passwd
 * @property integer $status
 */
class Member extends Ydao
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Member the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{member}}';
    }

    public function find_by_email($email=''){
        if(!$email){
            return false;
        }
        $criteria=new CDbCriteria;
        $criteria->addCondition("username='{$email}'");
        $data = $this->find($criteria);
        if(!$data){
            return false;
        }
        return $data;
    }
    
    public function getByMemberId($id){
    	if(!$id){
    		return false;
    	}
    	$datas=  $this->findByPk($id);
    	if(!$datas){
    		return false;
    	}
    	unset($datas['passwd']);
    	return $datas;
    }
    
    public function check_login($datas){
        if(!$datas['username'] || !$datas['passwd']){
            return false;
        }
        $user_datas = $this->find_by_email($datas['username']);
        if(!$user_datas){
        	return false;
        }
        if($user_datas['passwd'] != $this->encrypt($datas['passwd'])){
        	return false;
        }
        unset($user_datas['passwd']);
        return $user_datas;
    }
    
    public function encrypt($passwd){
        $passwd .= Yii::app()->params['encrypt_prefix'];
        return md5($passwd);
    }
}