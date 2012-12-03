<?php
class ScenesMap extends Ydao
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Fields the static model class
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
        return '{{scene_map}}';
    }
    public function save_scene_map($scene_id, $file_id){
        if(!$scene_id || !$file_id){
            return false;
        }
        $map_datas = $this->find_by_scene_id($scene_id);
        if($map_datas){
        	$id = $map_datas['id'];
        	$attributes = array('status'=>2);
        	$this->updateByPk($id, $attributes);
        }
        $this->scene_id = $scene_id;
        $this->file_id = $file_id;
        if(!$this->save()){
        	return false;
        }
        $id = $this->attributes['id'];
        return $id;
    }
    public function find_by_scene_id($scene_id, $status=1){
        $criteria=new CDbCriteria;
    	if(!$scene_id){
    		return false;
    	}
    	if($status!==0){
    		$criteria->addCondition("status={$status}");
    	}
    	$criteria->addCondition("scene_id={$scene_id}");
    	$map_datas = $this->find($criteria);
    	return $map_datas;
    }
    public function get_map_info($scene_id){
    	$map_datas = array();
    	if(!$scene_id){
    		return false;
    	}
    	//获取地图信息
    	$map_datas['map'] = $this->find_by_scene_id($scene_id);
    	if(!$map_datas['map'] || !$map_datas['map'] ['id']){
    		return false;
    	}
    	//获取地图锚点信息
    	$map_datas['position'] = $this->get_map_position($map_datas['map']['id']);
    	return $map_datas;
    }
    private function get_map_position($map_id){
    	$map_positon_db = new ScenesMapPosition();
    	return $map_positon_db->find_by_map_id($map_id);
    }
}