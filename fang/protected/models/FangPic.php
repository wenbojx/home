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
class FangPic extends Ydao
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
        return '{{fang_pic}}';
    }
	public function addPic($id, $url, $type=2, $ftype='jpg'){
		if($id=='' || $url =='' ){
			return false;
		}
		//print_r($datas);
		$this->f_id = $id;
		$this->url = $url;
		$this->type = $type;
		$this->ftype = $ftype;
		
		//print_r($datas);
		if(!$this->save()){
			return false;
		}
		return $this->attributes['id'];
	}
	public function getById($id){
		return $this->findByPk($id);
	}
	public function getByFid($id){
		if(!$id){
			return false;
		}
		$criteria=new CDbCriteria;
		$criteria->order = 'id ASC';

		$criteria->addCondition('is_del=0');
		$criteria->addCondition('f_id='.$id);
		$pic_datas = $this->findAll($criteria);
		return $pic_datas;
	}
	public function getByFids($ids){

		if(!is_array($ids) || !$ids){
			return false;
		}
		$ids_str = implode(',', $ids);
		if(!$ids_str){
			return false;
		}
		$criteria=new CDbCriteria;
		$criteria->addCondition("f_id in ({$ids_str})");
		$criteria->addCondition("type = 1");
		$criteria->addCondition("is_del = 0");
		$datas = $this->findAll($criteria);
		if(!$datas){
			return false;
		}
		$fangDatas = array();
		foreach($datas as $v){
			$fangDatas[$v['f_id']] = $v;
		}
		return $fangDatas;
	}
	public function delPic($id){
		$datas = array('is_del'=>1);
		return $this->updateByPk($id, $datas);
	}
}