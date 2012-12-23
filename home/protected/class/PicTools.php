<?php
class PicTools{
	//private $;
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
	 * 获取全景图静态地址
	 */
	public static function get_pano_static_path($scene_id){
		if(!$scene_id){
			return false;
		}
		$md5 = md5($scene_id . Yii::app()->params['pic_path_prefix']);
		$lastThreeChar = substr($md5, strlen($md5)-3, 3);
		$num = substr($scene_id, strlen($scene_id)-1, 1)%2;
		$str =  Yii::app()->params['pano_static_path'] . '/' ;
		$str .= substr($lastThreeChar, 0, 1) . '/';
		$str .= substr($lastThreeChar, 1, 1). '/';
		$str .= substr($lastThreeChar, 2, 1);
		return $str. '/' . $scene_id;
	}
	/**
	 * 获取全景图目录
	 */
	public static function get_pano_path($scene_id){
		if(!$scene_id){
			return false;
		}
		$num = substr($scene_id, -1);
		
		$path = self::get_img_domain($num%2). '/' .self::get_pano_static_path($scene_id);
		return $path;
	}
	/**
	 * 获取全景图小图地址
	 */
	public static function get_pano_small($scene_id, $size){
		if(!$scene_id){
			return false;
		}
		$num = 0;
		$path = self::get_img_domain($num). '/' .self::get_pano_static_path($scene_id) . '/small/' . $size . '.jpg';
		return $path;
	}
	/**
	 * 获取全景图面缩略图
	 */
	public static function get_face_small($scene_id, $face,  $size='120x120'){
		if(!$scene_id || !$face){
			return false;
		}
		$num = 0;
		$path = self::get_img_domain($num). '/' .self::get_pano_static_path($scene_id) . '/'.$face.'/fthumb/' . $size . '.jpg';
		return $path;
	}
	/**
	* 获取缩略图地址
	 */
	public static function get_pano_thumb($scene_id, $size){
		if(!$scene_id){
			return false;
		}
		$num = 0;
		$path = self::get_img_domain($num). '/' .self::get_pano_static_path($scene_id) . '/thumb/' . $size . '.jpg';
		return $path;
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