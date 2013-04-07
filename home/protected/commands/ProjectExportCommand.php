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
        $panoramPath = $this->projectPath;
        $this->mkdir($panoramPath.'/'.$this->panoPath);
        $playerPath = $this->exportFolder.'plugins/salado/export/*';
        $sys_cmd = "cp -rf {$playerPath} {$this->exportFolder}{$this->folder}/{$panoramPath}";
        //echo $sys_cmd."\r\n";
        system($sys_cmd);
        //获取需处理的全景
        $scene_db = new Scene();
        $sceneDatas = $scene_db->find_scene_by_project_id($projectDatas['project_id'], 1000);
        if(!$sceneDatas){
        	return false;
        }
        $i = 0;
        $configPath = $this->exportFolder.$this->folder.$this->projectPath.'/config.xml';
        foreach($sceneDatas as $v){
        	if($i>=5){
        		continue;
        	}
        	if($i==0){
        		$xml_content = '<?xml version="1.0" encoding="utf-8" ?>';
        		$xml_content = $this->configXml($v['id']);
        		$xml_content = $this->newXmlContent($xml_content);
        	}
        	$i++;
        	if($i>5)
        		continue;
        	$xml_content = $this->newXmlFile($xml_content, $v['id']);
        	
	        $scene_path = $this->exportFolder.$this->folder.$this->projectPath.'/'.$this->panoPath;
	        //$this->mkdir($scene_path);
	        $pic_path = $this->exportFolder.PicTools::get_pano_path($v['id']).'/';
	        //echo $pic_path."\r\n";
	        $sys_cmd = "cp -rf {$pic_path} {$scene_path}";
	        $text = '<Image TileSize="450" Overlap="1" Format="jpg" ServerFormat="Default" xmnls="http://schemas.microsoft.com/deepzoom/2009">
<Size Width="1800" Height="1800"></Size>
</Image>';
	        
	        //-------------------------
	        //$pic_path = str_replace('/', '\\', $pic_path);
	        //$scene_path = str_replace('/', '\\', $scene_path);
	        		
	        //$sys_cmd = "xcopy {$pic_path}*.* {$scene_path}\{$v['id']} /s";
	        
	        echo $sys_cmd."\r\n";
	        system($sys_cmd);
	        $xmlFile = $scene_path.$v['id'].'/s_f.xml';
	        file_put_contents($xmlFile, $text);
	        $i++;
	        

        }
        //echo $xml_content;
        //file_put_contents('C:/mydatas/APMServ5.2.6/www/htdocs/home/home/download/1001/config.xml', $xml_content);
        file_put_contents($configPath, $xml_content);
        //echo count($sceneDatas);
    }
    private function newXmlFile($content, $id){
    	$replace_text = PicTools::get_pano_path($id).'/';
    	//echo $replace_text."\r\n";
    	$newPath = './'.$this->panoPath.$id.'/';
    	$content = str_replace($replace_text, $newPath, $content);
    	return $content;
    }
    private function newXmlContent($content){
    	$replace_text = '/var/www/home/home/protected/plugins/salado/';
    	//$replace_text = 'c:\mydatas\APMServ5.2.6\www\htdocs\home\home\protected/plugins/salado/';
    	$content = str_replace($replace_text, './', $content);
    	
    	$replace_text = '/var/www/home/home/protected/style/img/';
    	//$replace_text = 'c:\mydatas\APMServ5.2.6\www\htdocs\home\home\protected/style/img/';
    	$content = str_replace($replace_text, './media/', $content);
    	
    	$replace_text = '/var/www/home/home/plugins/salado/media/';
    	//$replace_text = 'c:\mydatas\APMServ5.2.6\www\htdocs\home\home\protected/plugins/salado/media/';
    	$content = str_replace($replace_text, './media/', $content);
    	
    	return $content;
    }
    private function configXml($id){
    	$from = '';
    	$config['nobtb'] = $nobtb ? false :true;
    	$config['auto'] = $auto ? true :false;
    	$config['single'] = $single ? true :false;
    	$config['player_width'] = $player_width;
    	$config['player_height'] = $player_height;
    	
    	if(!$id){
    		exit('');
    	}
    	return $this->actionXmls($id, $from, $config);
    	
    }
    private function actionXmls($id, $from, $config){
    	//获取全景信息
    	$player_obj = new SaladoPlayer();
    	$datas['scene_id'] = $id;
    	$admin = false;
    	$player_obj->display_config = $config;
    	return  $player_obj->get_single_config($id);

    }
    private function mkdir($path){
    	//$path = $this->exportFolder.$path;
    	$path_array = explode('/', $path);
    	$newPath = $this->exportFolder.$this->folder;
    	//print_r($path_array);
    	foreach($path_array as $v){
    		if(!$v){
    			continue;
    		}
    		$newPath .= $v.'/'; 
    		//echo $newPath."\r\n";
    		if(file_exists($newPath)){
    			continue;
    		}
    		echo $newPath."\r\n";
    		mkdir($newPath);
    	}
    }


}