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
class Basic extends Ydao
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
        return '{{basic}}';
    }
	public function saveBasic($datas){
		if(!$datas['name'] || !$datas['tab1'] || !$datas['tab2'] || !$datas['tab3'] || !$datas['tab4']
		|| !$datas['tab5'] || !$datas['tab6'] || !$datas['member_id']	
		){
			return false;
		}
		//print_r($datas);
		$this->member_id = $datas['member_id'];
		$this->name = $datas['name'];
		$this->tab1 = $datas['tab1'];
		$this->tab2 = $datas['tab2'];
		$this->tab3 = $datas['tab3'];
		$this->tab4 = $datas['tab4'];
		$this->tab5 = $datas['tab5'];
		$this->tab6 = $datas['tab6'];
		$this->create = time();
		//print_r($datas);
		if(!$this->save()){
			return false;
		}
		return $this->attributes['id'];
	}
	public function editBasic($id, $datas){
		//print_r($datas);
		return $this->updateByPk($id, $datas);
	}
	public function getFangList($m_id, $is_del='', $limit, $offset, $order=''){
		if(!$m_id){
			return false;
		}
		$criteria=new CDbCriteria;
		$criteria->order = 'id DESC';
		if($is_del !== ''){
			$criteria->addCondition('is_del='.$is_del);
		}
		if($order){
			$criteria->order = $order;
		}
		if($limit){
			$criteria->limit = $limit;
		}
		if($offset){
			$criteria->offset = $offset;
		}

		$criteria->addCondition("mid={$m_id}");
		$datas = $this->findAll($criteria);
		if(!$datas){
			return false;
		}
		$fangDatas = array();
		foreach($datas as $v){
			$fangDatas[$v['id']] = $v;
		}
		return $fangDatas;
	}
	/*
	 * 
	*/
	public function getFangnum($m_id, $is_del=''){
		if(!$m_id){
			return false;
		}
		$criteria=new CDbCriteria;
		//$criteria->order = 'is_del ASC';
		if($is_del!=''){
			$criteria->addCondition('is_del='.$is_del);
		}
		
		$criteria->addCondition('mid='.$m_id);
		return $this->count($criteria);
	}
	
	public function getBasicInfo($id){
		if(!(int)$id){
			return false;
		}
		return $this->findByPk($id);
	}
}