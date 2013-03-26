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
class Fang extends Ydao
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
        return '{{fang}}';
    }
	public function addFang($datas){
		if($datas['biaoti']=='' || $datas['mianji']=='' || $datas['jiage']==''){
			return false;
		}
		//print_r($datas);
		$this->mid = $datas['mid'];
		$this->biaoti = $datas['biaoti'];
		$this->mianji = $datas['mianji'];
		$this->jiage = $datas['jiage'];
		$this->shi = $datas['shi'];
		$this->ting = $datas['ting'];
		$this->wei = $datas['wei'];
		$this->zhuangxiu = $datas['zhuangxiu'];
		$this->guanjianci = $datas['guanjianci'];
		$this->desc = $datas['desc'];
		$this->shoumai = $datas['shoumai'];
		$this->created = time();
		//print_r($datas);
		if(!$this->save()){
			return false;
		}
		return $this->attributes['id'];
	}
	public function editFang($id, $datas){
		//print_r($datas);
		return $this->updateByPk($id, $datas);
	}
	public function getFangList($m_id, $limit, $offset, $order=''){
		if(!$m_id){
			return false;
		}
		$criteria=new CDbCriteria;
		$criteria->order = 'is_del ASC, id DESC';
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
	public function getFangnum($m_id){
		if(!$m_id){
			return false;
		}
		$criteria=new CDbCriteria;
		//$criteria->order = 'is_del ASC';
		//$criteria->addCondition('is_del=1');
		$criteria->addCondition('mid='.$m_id);
		return $this->count($criteria);
	}
	
	public function getFangInfo($id){
		if(!(int)$id){
			return false;
		}
		return $this->findByPk($id);
	}
}