<?php 
include 'gps.php';
include 'JPEG.php';
$fileName = '1.JPG';


$output = '1.back.JPG';
$latitude = 31.23903147959;
$longitude = 121.495828619727;
$altitude = 28;

addGpsInfo($fileName, $output, '', '', '',
$longitude, $latitude, $altitude, 181, $date_time);


exit();

$fileName = '1.back.JPG';

$jpeg_obj = new JpegMeta($fileName);
$datas = $jpeg_obj->getRawInfo();
print_r($datas);
exit();
$lat = Array(
             'val' => '31.2243531',
             'num' => '31.2243531',
             'den' => 1
        
      );
$lng = Array(
             'val' => '121.4759159',
             'num' => '121.4759159',
             'den' => 1
      );
$lat = 31.2243531;
$lng = 121.4759159;

$jpeg_obj->setExifField('GPSLatitude', $lat);
$jpeg_obj->setExifField('GPSLongitude', $lng);
$jpeg_obj->save("1.back.JPG");
//$datas = $jpeg_obj->getRawInfo();
print_r($datas);

?>