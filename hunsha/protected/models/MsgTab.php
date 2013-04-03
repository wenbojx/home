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
class MsgTab extends Ydao
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
        return '{{msg_tab}}';
    }
	public function saveMsgTab($datas){
		if(!$datas['project_id'] || !$datas['tab1'] || !$datas['tab2'] || !$datas['tab3'] ){
			return false;
		}
		//print_r($datas);
		$this->project_id = $datas['project_id'];
		$this->tab1 = $datas['tab1'];
		$this->tab2 = $datas['tab2'];
		$this->tab3 = $datas['tab3'];

		//print_r($datas);
		if(!$this->save()){
			return false;
		}
		return $this->attributes['project_id'];
	}
	public function editMsgTab($id, $datas){
		if(!(int)$id){
			return false;
		}
		return $this->updateByPk($id, $datas);
	}

	
	public function getProjectMsgTab($id){
		if(!(int)$id){
			return false;
		}
		$criteria=new CDbCriteria;

		$criteria->addCondition("project_id={$id}");
		return $this->find($criteria);
		
	}

}






