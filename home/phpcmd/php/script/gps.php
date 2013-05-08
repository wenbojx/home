<?php
ini_set('memory_limit','-1');
set_time_limit(0);
include 'tools.php';
start();


function start(){
	
	
	fwrite(STDOUT, "�����账���Ŀ¼��:");
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
	echo "��������gps�ļ�...\r\n";
	sleep(1);
	$searchFile = '.geo';
	//$folder = $folder;
	$tools = new tools();
	$tools->searchedPath = $folder;
	$tools->searchFile($folder, $searchFile);
	$files = $tools->searchedFile;
	//�ļ���Ϣ
	$fileInfo = $tools->countFile($files);

	echo "��������GPS�ļ� ".count($fileInfo['geo'])." ���� ͼƬ�ļ� ".count($fileInfo['jpg'])." ��\r\n";
	echo "����ƥ��GPS��Ϣ\r\n";
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
	echo "��ƥ�䵽".count($suitDatas)."��ͼƬ�ļ�\r\n";
	
	
	fwrite(STDOUT, "���س���������������exit�˳�:");
	$cmd = trim(fgets(STDIN));
	if($cmd == 'exit'){
		return false;
	}
	
	
	$tools->saveGpsDatas($suitDatas);
	//print_r($suitDatas);
	//echo date("Y/m/d H:i:s",1368005849);
}


fwrite(STDOUT, "���س����˳�:");
$folder = trim(fgets(STDIN));

?>