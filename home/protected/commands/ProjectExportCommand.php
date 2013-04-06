<?php
class ProjectExportCommand extends CConsoleCommand {

	//private $exportFolder = 'C:/mydatas/APMServ5.2.6/www/htdocs/home/home/';//-----------------
	private $exportFolder = '/var/www/home/home/';
	private $projectPath = '';
	private $folder = 'download/';
	private $panoPath = 'panoramas/';
    public function actionRun(){
        //获取需处理的全景
        $project_queue_db = new ProjectQueue();
        $projectDatas = $project_queue_db->get_undeal_list();
        if(!$projectDatas){
        	return false;
        }
        $this->projectPath = $projectDatas['project_id'];
        $this->mkdir($this->projectPath);
        $panoramPath = $this->exportFolder.$this->projectPath.'/'.$this->panoPath;
        $this->mkdir($panoramPath);
        $playerPath = $this->exportFolder.'plugins/salado/export/*';
        $sys_cmd = "cp -rf {$playerPath} {$panoramPath}";
        echo $sys_cmd."\r\n";
        system($sys_cmd);
        
        //获取需处理的全景
        $scene_db = new Scene();
        $sceneDatas = $scene_db->find_scene_by_project_id($projectDatas['project_id'], 1000);
        if(!$sceneDatas){
        	return false;
        }
        foreach($sceneDatas as $v){
	        $scene_path = $this->exportFolder.$this->folder.$this->projectPath.'/';
	        //$this->mkdir($scene_path);
	        $pic_path = $this->exportFolder.PicTools::get_pano_path($v['id']).'/';
	        //echo $pic_path."\r\n";
	        $sys_cmd = "cp -rf {$pic_path} {$scene_path}";
	        //-------------------------
	        //$pic_path = str_replace('/', '\\', $pic_path);
	        //$scene_path = str_replace('/', '\\', $scene_path);
	        		
	        //$sys_cmd = "xcopy {$pic_path}*.* {$scene_path}\{$v['id']} /s";
	        
	        echo $sys_cmd."\r\n";
	        system($sys_cmd);
	        exit();
        }
        //echo count($sceneDatas);
    }

    private function mkdir($path){
    	//$path = $this->exportFolder.$path;
    	$path_array = explode('/', $path);
    	$newPath = $this->exportFolder.$this->folder;
    	foreach($path_array as $v){
    		if(!$v){
    			continue;
    		}
    		$newPath .= $v.'/'; 
    		//echo $newPath."\r\n";
    		if(file_exists($newPath)){
    			continue;
    		}
    		//echo $newPath."\r\n";
    		mkdir($newPath);
    	}
    }


}