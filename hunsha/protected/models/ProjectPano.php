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
class ProjectPano extends Ydao
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
        return '{{pano}}';
    }
	public function savePano($datas){
		if(!$datas['project_id'] || !$datas['pano_id'] ){
			return false;
		}
		//print_r($datas);
		$this->project_id = $datas['project_id'];
		$this->pano_id = $datas['pano_id'];

		if(!$this->save()){
			return false;
		}
		return $this->attributes['project_id'];
	}
	public function editPano($id, $datas){
		if(!(int)$id){
			return false;
		}
		return $this->updateByPk($id, $datas);
	}

	
	public function getProjectPano($id){
		if(!(int)$id){
			return false;
		}
		$criteria=new CDbCriteria;

		$criteria->addCondition("project_id={$id}");
		return $this->find($criteria);
		
	}

}






