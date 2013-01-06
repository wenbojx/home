<?php 
class CubeTiltCommand extends CConsoleCommand{
	private $rootPath = '';
	
	public function actionRun(){
		$cubeTile = new CubeTilt();
		$this->rootPath = dirname(__FILE__).'/../..';
		//获取已处理的场景
		$panoQueueDB = new PanoQueue();
		$panoList = $panoQueueDB->get_deal_list();
		$flePathDB = new FilePath();
		foreach($panoList as $v){
			//获取项目原图目录
			$file_id = $this->get_pano_file_id($v['scene_id']);
			if(!$file_id){
				return false;
			}
			//获取文件地址
			$path = $this->rootPath. '/' . $flePathDB->get_file_folder ($file_id, 'cube');
			foreach ($cubeTile->face_box as $k=>$v1){
				$filePath = "{$path}/{$v1}.jpg";
				$cubeTile->DealPicPath($filePath, $v['scene_id'], $k);
			}
			
		}
	}
	/**
	 * 获取全景图文件ID
	 */
	private function get_pano_file_id($scene_id){
		if(!$scene_id){
			return false;
		}
		$sceneDB = new Scene();
		$panoDatas = $sceneDB->get_by_scene_id($scene_id);
		if(!$panoDatas){
			return false;
		}
		$fileId = $panoDatas['file_id'];
		return $fileId;
	}
}

?>