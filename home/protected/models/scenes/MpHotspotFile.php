<?php
class MpHotspotFile extends Ydao
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
        return '{{mp_hotspot_file}}';
    }
    public function add_imghotsopt($datas){
        $this->hotspot_id = $datas['hotspot_id'] ? $datas['hotspot_id'] : 0;
        $this->file_id = $datas['file_id'] ? $datas['file_id'] : 0;
        $this->is_del = 0;
        
        unset($datas);
        if (!$this->save()){
        	return false;
        }
        return $this->attributes['hotspot_id'];
    }
 
    public function edit_imghotspot($id, $datas){
        if(!$id){
            return false;
        }
        return $this->updateByPk($id, $datas);
    }
    public function get_file_id($hotspot_id){
    	if(!$hotspot_id){
    		return false;
    	}
    	return $this->findByPk($hotspot_id);
    }
}




