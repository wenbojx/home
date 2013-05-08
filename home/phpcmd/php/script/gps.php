<?php
ini_set('memory_limit','-1');
set_time_limit(0);
include 'tools.php';
start();


function start(){
	
	
	fwrite(STDOUT, "输入需处理的目录名:");
	// get input
	$folder = trim(fgets(STDIN));
	
	
	if($folder == ''){
		$folder = 'photos';
	}
	else {
		$folder = str_replace('\\', "/", $folder);
		if (substr($folder, -1) == '\\'){
			$folder = substr($folder, 0, strlen($folder)-1);
		}
	}
	echo "正在搜索gps文件...\r\n";
	sleep(1);
	$searchFile = '.geo';
	//$folder = $folder;
	$tools = new tools();
	$tools->searchedPath = $folder;
	$tools->searchFile($folder, $searchFile);
	$files = $tools->searchedFile;
	//文件信息
	$fileInfo = $tools->countFile($files);

	echo "共搜索到GPS文件 ".count($fileInfo['geo'])." 个， 图片文件 ".count($fileInfo['jpg'])." 个\r\n";
	echo "正在匹配GPS信息\r\n";
	sleep(1);
	$geoContent = '';
	foreach ($fileInfo['geo'] as $v){
		if(file_exists($v)){
			$geoContent .= file_get_contents($v);
		}
	}
	$geoDatas = $tools->pareGpsFile($geoContent);
	//print_r($geoDatas);
	$photoDatas = $tools->parePhotoFile($fileInfo['jpg']);
	//print_r($photoDatas);
	$suitDatas = $tools->suitDatas($geoDatas, $photoDatas);
	//print_r($suitDatas);
	echo "共匹配到".count($suitDatas)."个图片文件\r\n";
	
	
	fwrite(STDOUT, "按回车键继续处理，输入exit退出:");
	$cmd = trim(fgets(STDIN));
	if($cmd == 'exit'){
		return false;
	}
	
	
	$tools->saveGpsDatas($suitDatas);
	//print_r($suitDatas);
	//echo date("Y/m/d H:i:s",1368005849);
}


fwrite(STDOUT, "按回车键退出:");
$folder = trim(fgets(STDIN));

?>