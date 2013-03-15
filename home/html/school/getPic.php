<?php
ob_end_flush();
$time = time();
$from = $_GET['f'];
$to = $_GET['t'];
//exit();
$path_prex = 'http://www.lpu.in/virtual_tour/panoramas/';
$position = array('f','r','b','l','u','d');
for($s=$from; $s<=$to; $s++){
	if(strlen($s)<3){
		$i = strlen($s)>1? ('0'.$s) : ('00'.$s);
	}
	else{
		$i = $s;
	}
	echo "dz_Panos_{$i}<br>";
	if(!file_exists("dz_Panos_{$i}")){
		mkdir("dz_Panos_{$i}");
	}
	foreach($position as $v){
		$leve8 = "dz_Panos_{$i}/Panos_{$i}_{$v}/8/";
		if(!file_exists("dz_Panos_{$i}/Panos_{$i}_{$v}/")){
			mkdir("dz_Panos_{$i}/Panos_{$i}_{$v}/");
		}
		if(!file_exists("dz_Panos_{$i}/Panos_{$i}_{$v}/8/")){
			mkdir("dz_Panos_{$i}/Panos_{$i}_{$v}/8/");
		}
		$file_name = '0_0.jpg';
		$get_url = $path_prex.$leve8.$file_name;
		
		if(!file_exists($leve8.$file_name)){
			echo $get_url.'<br>';
			$file = file_get_contents($get_url);
			file_put_contents($file_name, $file);
			copy($file_name, $leve8.$file_name);
			echo $leve8.$file_name.'<br>';
		}
	}
	flush();
	foreach($position as $v){
		$leve9 = "dz_Panos_{$i}/Panos_{$i}_{$v}/9/";
		if(!file_exists("dz_Panos_{$i}/Panos_{$i}_{$v}/9/")){
		mkdir("dz_Panos_{$i}/Panos_{$i}_{$v}/9/");
		}
		$file_name = '0_0.jpg';
		$get_url = $path_prex.$leve9.$file_name;
		
		if(!file_exists($leve9.$file_name)){
			echo $get_url.'<br>';
			$file = file_get_contents($get_url);
			file_put_contents($file_name, $file);
			copy($file_name, $leve9.$file_name);
			echo $leve9.$file_name.'<br>';
		}
	}
	flush();
	foreach ($position as $v){
		$leve10 = "dz_Panos_{$i}/Panos_{$i}_{$v}/10/";
		if(!file_exists("dz_Panos_{$i}/Panos_{$i}_{$v}/10/")){
			mkdir("dz_Panos_{$i}/Panos_{$i}_{$v}/10/");
		}
		for($k=0; $k<=1; $k++){
			for($j=0; $j<=1; $j++){
				$file_name = "{$k}_{$j}.jpg";
				$get_url = $path_prex.$leve10.$file_name;
				
				if(!file_exists($leve10.$file_name)){
					echo $get_url.'<br>';
					$file = file_get_contents($get_url);
					file_put_contents($file_name, $file);
					copy($file_name, $leve10.$file_name);
					echo $leve10.$file_name.'<br>';
				}
			}
		}
	}
	flush();
	foreach ($position as $v){
		$leve11 = "dz_Panos_{$i}/Panos_{$i}_{$v}/11/";
		if(!file_exists("dz_Panos_{$i}/Panos_{$i}_{$v}/11/")){
			mkdir("dz_Panos_{$i}/Panos_{$i}_{$v}/11/");
		}
		for($k=0; $k<=3; $k++){
			for($j=0; $j<=3; $j++){
				$file_name = "{$k}_{$j}.jpg";
				$get_url = $path_prex.$leve11.$file_name;
				
				if(!file_exists($leve11.$file_name)){
					echo $get_url.'<br>';
					$file = file_get_contents($get_url);
					file_put_contents($file_name, $file);
					copy($file_name, $leve11.$file_name);
					echo $leve11.$file_name.'<br>';
				}
			}
		}
	}
	flush();
	echo ((time()-$time)/60).'<br><br>';
}
echo $s.'<br>';
echo ((time()-$time)/60).'<br><br><br><br><br><br>';
flush();
	
	
	
	
	
	
	
	
	
	
	
	
	