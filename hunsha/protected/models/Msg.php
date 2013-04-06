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
class Msg extends Ydao
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
        return '{{msg}}';
    }
	public function saveMsg($datas){
		if(!$datas['project_id'] || !$datas['tab1'] || !$datas['tab2'] || !$datas['tab3'] ){
			return false;
		}
		//print_r($datas);
		$this->project_id = $datas['project_id'];
		$this->tab1 = $datas['tab1'];
		$this->tab2 = $datas['tab2'];
		$this->tab3 = $datas['tab3'];
		$this->create = time();
		//print_r($datas);
		if(!$this->save()){
			return false;
		}
		return $this->attributes['id'];
	}
	
	public function getProjectMsg($id, $limit=10, $last_id=0, $order='id desc'){
		if(!(int)$id){
			return false;
		}
		$criteria=new CDbCriteria;
		$criteria->order = 'id DESC';
		if($order){
			$criteria->order = $order;
		}
		if($limit){
			$criteria->limit = $limit;
		}
		$criteria->addCondition("project_id={$id}");
		if($last_id){
			$criteria->addCondition("id<{$last_id}");
		}
		$criteria->addCondition("is_del=0");
		//print_r($criteria);
		return $this->findAll($criteria);
		
	}
	public function getCount($project_id){
		if(!(int)$project_id){
			return 0;
		}
		$criteria=new CDbCriteria;
		
		$criteria->addCondition("project_id={$project_id}");
		$criteria->addCondition("is_del=0");
		return $this->count($criteria);
	}
}






