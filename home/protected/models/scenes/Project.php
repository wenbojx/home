<?php

/**
 * This is the model class for table "{{datas}}".
 *
 * The followings are the available columns in table '{{datas}}':
 */
class Project extends Ydao
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Datas the static model class
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
        return '{{project}}';
    }
    /**
     * 获取某用户所有项目
     */
    public function get_project_list_member($member_id, $page_size=2, $limit=0, $page_break=true){
        if(!$member_id){
            return false;
        }

        return $datas;
    }
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('member_id, name', 'required'),
            array('member_id, created, status', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>60),
            array('desc', 'length', 'max'=>300),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, type, year, month, content', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'member_id' => 'Member_id',
            'name' => 'Name',
            'desc' => 'Desc',
            'created' => 'Created',
            'status' => 'Status',
        );
    }
    public function add_project($datas){
    	if($datas['name']==''){
    		return false;
    	}
    	$this->name = $datas['name'];
    	$this->desc = $datas['desc'];
    	$this->member_id = $datas['member_id'];
    	$this->created = $datas['created'];
    	if(!$this->save()){
    		return false;
    	}
    	return $this->attributes['id'];
    }
    public function edit_project($datas){
    	return $this->updateByPk($datas['id'], $datas);
    }
    public function find_by_project_id($project_id){
    	return $this->findByPk($project_id);
    }
    public function update_dispaly($project_id, $display){
    	if(!$project_id){
    		return false;
    	}
    	return $this->updateByPk($project_id, array('display'=>$display));
    }
    /**
     * 获取项目列表
     */
    public function get_project_list($limit=5, $order='', $offset=0, $display=''){
    	
    	$criteria=new CDbCriteria;
    	$criteria->order = 'id ASC';
    	if($order){
    		$criteria->order = $order;
    	}
    	if($limit){
    		$criteria->limit = $limit;
    	}
    	if($offset){
    		$criteria->offset = $offset;
    	}
    	if($display){
    		$criteria->addCondition("display={$display}");
    	}
    	$criteria->addCondition('status=1');
    	$project_datas = $this->findAll($criteria);
    	return $project_datas;
    }
    /**
     * 获取某项目的后N个项目
     */
    public function get_next_by_project_id($project_id=''){
    	$criteria=new CDbCriteria;
    	$criteria->order = 'id ASC';
    	$criteria->addCondition('status=1');
    	if($project_id){
    		$criteria->addCondition("id={$display}");
    	}
    	$criteria->limit = $num;
    	return $this->findAll($criteria);
    }
    /*
     * 获取最新的3个项目
    */
    public function get_last_project($num=3, $display=''){
    	$criteria=new CDbCriteria;
    	$criteria->order = 'id DESC';
    	$criteria->addCondition('status=1');
    	if($display){
    		$criteria->addCondition("display={$display}");
    	}
    	$criteria->limit = $num;
    	return $this->findAll($criteria);
    }
    /*
     * 获取景点数
    */
    public function get_project_num($display=''){

    	$criteria=new CDbCriteria;
    	$criteria->addCondition('status=1');
    	if($display){
    		$criteria->addCondition("display={$display}");
    	}
    	return $this->count($criteria);
    }
    
}







