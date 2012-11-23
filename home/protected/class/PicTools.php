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
}