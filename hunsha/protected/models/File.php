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
class File extends Ydao
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
        return '{{file}}';
    }
	public function saveFile($project_id, $file_path, $ftype){
		if(!$file_path || !$ftype || !$project_id){
			return false;
		}
		$this->project_id = $project_id;
		$this->url = $file_path;
		$this->ftype = $ftype;
		$this->create = time();

		if(!$this->save()){
			return false;
		}
		return $this->attributes['id'];
	}
	public function getById($id){
		return $this->findByPk($id);
	}
	public function getByProjectId($id){
		if(!$id){
			return false;
		}
		$criteria=new CDbCriteria;
		$criteria->order = 'id DESC';

		$criteria->addCondition('is_del=0');
		$criteria->addCondition('project_id='.$id);
		$pic_datas = $this->findAll($criteria);
		return $pic_datas;
	}
	public function updateDesc($id, $desc){
		return $this->updateByPk($id, array('desc'=>$desc));
	}
	public function delPic($id){
		$datas = array('is_del'=>1);
		return $this->updateByPk($id, $datas);
	}
}