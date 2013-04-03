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
class Contact extends Ydao
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
        return '{{contact}}';
    }
	public function saveContact($datas){
		if(!$datas['project_id'] ){
			return false;
		}
		//print_r($datas);
		$this->project_id = $datas['project_id'];
		$this->lng = $datas['lng'];
		$this->lat = $datas['lat'];
		$this->zoom = $datas['zoom'];
		$this->info = $datas['info'];

		//print_r($datas);
		if(!$this->save()){
			return false;
		}
		return $this->attributes['project_id'];
	}
	public function editContact($id, $datas){
		if(!(int)$id){
			return false;
		}
		return $this->updateByPk($id, $datas);
	}

	
	public function getProjectContact($id){
		if(!(int)$id){
			return false;
		}
		return $this->findByPk($id);
		/*
		$criteria=new CDbCriteria;

		$criteria->addCondition("project_id={$id}");
		return $this->find($criteria);
		*/
	}

}






