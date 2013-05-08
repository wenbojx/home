<?php
require_once('src/PelDataWindow.php');
require_once('src/PelJpeg.php');
require_once('src/PelTiff.php');

class tools{
	public $searchedFile = array();
	public $searchedPath = '';
	private $backUpFolder = 'Yhandle';
	//搜索文件
	public function searchFile($folder, $searchFile){
		if(!is_dir($folder))  return;
		foreach(scandir($folder) as $file){
			if($file!='.'  && $file!='..')
			{
				if ($file == $this->backUpFolder){
					continue;
				}
				$path2= $folder.'/'.$file;
				//echo $path2."\r\n";
				if(is_dir($path2))
				{
					$this->searchFile($path2, $searchFile);
				}else{
					$this->searchedFile[] = $path2;
				}
			}
		}
	}
	//统计文件
	public function countFile($files){
		if(!$files){
			return false;
		}
		$fileList = array();
		$count = 0;
		foreach($files as $v){
			if (!$v){
				continue;
			}
			$explode = explode('.', $v);
			if(!$explode[1]){
				continue;
			}
			$num = count($explode);
			$key = strtolower($explode[$num-1]);
			//echo $key."\r\n";
			$fileList[$key][] = $v;
			$count++;
		}
		//$fileList['count'] = $count;
		return $fileList;
	}
	//解析gps信息
	public function pareGpsFile($content){
		if(!$content){
			return false;
		}
		$explode_1 = explode(';', $content);
		if(!$explode_1){
			return false;
		}
		$geoDatas = array();
		//$i = 0;
		foreach($explode_1 as $v){
			$explode = explode("|", $v);
			if (!$explode){
				continue;
			}
			$i = $explode['4'];
			if(!$i || (!$explode['0'] && !$explode['1']) ) {
				continue;
			}
			$i = strtotime($i);
			$geoDatas[$i]['lat'] = $explode['0'];
			$geoDatas[$i]['lng'] = $explode['1'];
			$geoDatas[$i]['altitude'] = $explode['2'];
			$geoDatas[$i]['direction'] = $explode['3'];
			//$i++;
		}
		return $geoDatas;
	}
	//解析图片时间
	public function parePhotoFile($list){
		if(!$list){
			return false;
		}
		$photoFiles = array();
		foreach ($list as $v){
			if(!file_exists($v)){
				continue;
			}
			
			$jpeg = new PelJpeg($v);
			$exif = $jpeg->getExif();
	  		if ($exif == null) {
	  			continue;
	  		}
	  		
			$tiff = $exif->getTiff();
			$ifd0 = $tiff->getIfd();
			if ($ifd0 == null) {
			  	continue;
			}
			$entry = $ifd0->getEntry(PelTag::DATE_TIME);
			if(!$entry){
				continue;
			}
			$time = $entry->getValue();
			$photoFiles[$time] = $v;
		}
		return $photoFiles;
	}
	//匹配gps及图片数据
	public function suitDatas($geoDatas, $photoDatas){
		if(!$geoDatas || !$photoDatas){
			return false;
		}
		//print_r($photoDatas);
		$suitDatas = array();
		foreach($photoDatas as $k=>$v){
			if (isset($geoDatas[$k])){
				$suitDatas[$k]['geo'] = $geoDatas[$k];
				$suitDatas[$k]['photo'] = $v;
			}
			else if (isset($geoDatas[$k-1])){
				$suitDatas[$k]['geo'] = $geoDatas[$k-1];
				$suitDatas[$k]['photo'] = $v;
			}
			elseif (isset($geoDatas[$k+1])){
				$suitDatas[$k]['geo'] = $geoDatas[$k+1];
				$suitDatas[$k]['photo'] = $v;
			}

		}
		return $suitDatas;
	}
	//写入GPS信息
	public function saveGpsDatas($photoInfo){
		if(!$photoInfo){
			return false;
		}
		$i = 1;
		foreach($photoInfo as $v){
			$filePath = $v['photo'];
			if(!file_exists($filePath)){
				continue;
			}
			$newPath = $this->searchedPath.'/'.$this->backUpFolder;
			$newFile = str_replace($this->searchedPath, $newPath, $filePath);
			
			$this->mkDir($newFile);
			if(!is_dir($newPath)){
				continue;
			}
			echo "正在处理第 {$i} 个文件\r\n";
			copy($filePath, $newFile);
			$this->writeGpsInfo($v['geo'], $newFile);
			$i++;
		}
	}
	//写入gps信息
	public function writeGpsInfo($geo, $path){
		if(!file_exists($path)){
			return false;
		}
		$lat = $geo['lat'];
		$lng = $geo['lng'];
		$alt = $geo['altitude'];
		$direction = $geo['direction'];
		if(!$lat && !$lng){
			return false;
		}
		$jpeg = $file = new PelJpeg($path);
		$exif = $jpeg->getExif();
		if ($exif == null) {
			$exif = new PelExif();
			$jpeg->setExif($exif);
			$tiff = new PelTiff();
			$exif->setTiff($tiff);
		} else {
			$tiff = $exif->getTiff();
		}
		
		$ifd0 = $tiff->getIfd();
		if ($ifd0 == null) {
			$ifd0 = new PelIfd(PelIfd::IFD0);
			$tiff->setIfd($ifd0);
		}
		
		$gps_ifd = new PelIfd(PelIfd::GPS);
		$ifd0->addSubIfd($gps_ifd);
		
		$latE = $ifd0->getEntry(PelTag::GPS_LATITUDE);
		if ($latE == null){
			//echo "latE\r\n";
			list($hours, $minutes, $seconds) = $this->convertDecimalToDMS($lat);
			/* We interpret a negative latitude as being south. */
			$latitude_ref = ($lat < 0) ? 'S' : 'N';
			
			$gps_ifd->addEntry(new PelEntryAscii(PelTag::GPS_LATITUDE_REF,
			                                       $latitude_ref));
			$gps_ifd->addEntry(new PelEntryRational(PelTag::GPS_LATITUDE,
			                                          $hours, $minutes, $seconds));
		}
		
		$lngE = $ifd0->getEntry(PelTag::GPS_LONGITUDE);
		if ($lngE == null){
			//echo "lngE\r\n";
			/* The longitude works like the latitude. */
			list($hours, $minutes, $seconds) = $this->convertDecimalToDMS($lng);
			$longitude_ref = ($lng < 0) ? 'W' : 'E';
			
			$gps_ifd->addEntry(new PelEntryAscii(PelTag::GPS_LONGITUDE_REF,
			                                       $longitude_ref));
			$gps_ifd->addEntry(new PelEntryRational(PelTag::GPS_LONGITUDE,
			                                          $hours, $minutes, $seconds));
		}
		
		$altE = $ifd0->getEntry(PelTag::GPS_ALTITUDE);
		if ($altE == null){
			//echo "alte={$alt}\r\n";
			$gps_ifd->addEntry(new PelEntryRational(PelTag::GPS_ALTITUDE,
			                                          array((int)abs($alt), 1)));
			/* The reference is set to 1 (true) if the altitude is below sea
			   * level, or 0 (false) otherwise. */
			$gps_ifd->addEntry(new PelEntryByte(PelTag::GPS_ALTITUDE_REF,
			                                      (int)($alt < 0)));
		}
		
		$directionE = $ifd0->getEntry(PelTag::GPS_IMG_DIRECTION);
		if ($directionE == null){
			//echo "direction\r\n";
			$gps_ifd->addEntry(new PelEntryRational(PelTag::GPS_IMG_DIRECTION,
			  		array(abs($direction), 1)));
			$gps_ifd->addEntry(new PelEntryAscii(PelTag::GPS_IMG_DIRECTION_REF,
			  		(int)($direction < 0)));
		}
		$file->saveFile($path);
	}
	//转换GPS格式
	function convertDecimalToDMS($degree) {
		if ($degree > 180 || $degree < -180)
			return null;
	
		$degree = abs($degree);            // make sure number is positive
		// (no distinction here for N/S
		// or W/E).
	
		$seconds = $degree * 3600;         // Total number of seconds.
	
		$degrees = floor($degree);         // Number of whole degrees.
		$seconds -= $degrees * 3600;       // Subtract the number of seconds
		// taken by the degrees.
	
		$minutes = floor($seconds / 60);   // Number of whole minutes.
		$seconds -= $minutes * 60;         // Subtract the number of seconds
		// taken by the minutes.
	
		$seconds = round($seconds*100, 0); // Round seconds with a 1/100th
		// second precision.
	
		return array(array($degrees, 1), array($minutes, 1), array($seconds, 100));
	}
	//创建备份文件夹
	private function mkDir($path){
		if(!$path){
			return false;
		}
		$path_explode = explode ('/', $path);
		if(!is_array($path_explode)){
			return false;
		}
		$path = $path_explode[0];
		for ($i=1; $i<(count($path_explode)-1); $i++){
			$path .= '/' . $path_explode[$i];
			//echo $path."\r\n";
			$path = str_replace('/', '\\', $path);
			if(!is_dir($path)){
				//echo $path."\r\n";
				mkdir($path);
			}
		}
		return true;
	}
}











