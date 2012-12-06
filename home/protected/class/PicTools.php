<?php
class PicTools{
	public static function get_img_domain($num=''){
		$domains = array(
					0=>'img_domain_1',
					1=>'img_domain_2',
				);
		$key = '';
		if($num!==''){
			$key = $domains[$num];
		}
		else{
			$prx = array_rand($domains);
			//$prx = 1;
			$key = $domains[$prx];
		}
		return Yii::app()->params[$key];
	}
	/**
	 * 获取场景对应文件信息
	 */
	public function get_scene_file_tag($scene_id){
		$mp_scene_file_db = new MpSceneFile();
		$datas = $mp_scene_file_db->get_scene_list($scene_id);
		if(!$datas){
			return '0';
		}
		$str = '';
		foreach($datas as $v){
			$str .= $v;
		}
		return $scene_id.'-'.md5($str);
	}
}