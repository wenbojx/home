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
class Info extends Ydao
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
        return '{{info}}';
    }
	public function saveInfo($datas){
		if(!$datas['project_id'] || !$datas['tab'] ){
			return false;
		}
		//print_r($datas);
		$this->project_id = $datas['project_id'];
		$this->tab = $datas['tab'];
		$this->info = $datas['info'];

		$this->create = time();
		//print_r($datas);
		if(!$this->save()){
			return false;
		}
		return $this->attributes['id'];
	}
	public function editInfo($id, $datas){
		if(!(int)$id){
			return false;
		}
		//print_r($datas);
		
		return $this->updateByPk($id, $datas);
	}

	
	public function getProjectInfo($id){
		if(!(int)$id){
			return false;
		}
		$criteria=new CDbCriteria;

		$criteria->addCondition("project_id={$id}");
		$datas = $this->findAll($criteria);
		//print_r($criteria);
		if(!$datas){
			return false;
		}
		$info = array();
		foreach($datas as $v){
			$info[$v['tab']] = $v;
		}
		return $info;
	}
	public function getProjectInfoByTab($project_id, $tab){
		if(!(int)$project_id || !(int)$tab){
			return false;
		}
		$criteria=new CDbCriteria;
		
		$criteria->addCondition("project_id={$project_id}");
		$criteria->addCondition("tab={$tab}");
		
		return $this->find($criteria);
		
	}
}






