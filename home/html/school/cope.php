<?php
ob_end_flush();
$time = time();
$from = $_GET['f'];
$to = $_GET['t'];
////exit();
$path_prex = 'http://www.lpu.in/virtual_tour/panoramas/';
$position = array('f','r','b','l','u','d');
for($s=$from; $s<=$to; $s++){
	if(strlen($s)<3){
		$i = strlen($s)>1? ('0'.$s) : ('00'.$s);
	}
	else{
		$i = $s;
	}
	$to_file = "Panos_{$i}_f.xml";
	$path = "panoramas/dz_Panos_{$i}/";
	if(file_exists($path)){
		copy("Panos_001_f.xml", $path.$to_file);
	}
}
echo $s.'<br>';
echo ((time()-$time)/60).'<br><br><br><br><br><br>';
flush();
	
	
	
	
	
	
	
	
	
	
	
	
	