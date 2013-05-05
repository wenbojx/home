<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>content</title>
</head>
<body>

<?php 
$img = '1.jpg';

//Read exif meta information
$info = exif_read_data($img, NULL, true, false);

//Read thumbnail data
$thumb = exif_thumbnail($img, $width, $height, $type);

//Get mime type: require GD2 extension
$mimeType = image_type_to_mime_type($type);
$data = base64_encode($thumb);

echo 'Thumbnail: ', $width , 'x', $height, ', Type:',
$type, ';', $mimeType , "<br />\n";
echo '<img alt="" src="data:', $type, ';base64,', $data, '" />';

foreach ($info as $key=>$sinfo) {
	echo '<h3>', $key, '</h3>';
	if (is_array($sinfo)) {
		echo '<table border="1" cellspacing="0" borderColor="#CCC">';
		foreach ($sinfo as $skey=>$svalue) {
			echo '<tr><td>', $skey, '</td><td>', $svalue, '</td></tr>';
		}
		echo '</table>';
	}
}


?>

<iframe width="930" scrolling="no" height="400" frameborder="0" src="http://www.yiluhao.com/s/10001/w/932/h/400/title/1"></iframe>

<form action="/project/uploadPano/" method="post" enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="Filedata" id="file" />
<input type="hidden" name="scene_id" value="2">
<input type="hidden" name="position" value="left">
<input type="hidden" name="from" value="box_pic">

<br />
<input type="submit" name="submit" value="Submit" />
</form>

<form action="http://www.dev.yiluhao.com/pano/upload" method="post" enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="Filedata" id="file" />
<input type="hidden" name="scene_id" value="1">
<input type="hidden" name="from" value="thumb_pic">

<br />
<input type="submit" name="submit" value="Submit" />
</form>

<form action="http://www.dev.yiluhao.com/pano/upload" method="post" enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="Filedata" id="file" />
<input type="hidden" name="project_id" value="1">
<input type="hidden" name="scene_id" value="3">
<input type="hidden" name="from" value="map_pic">

<br />
<input type="submit" name="submit" value="地图" />
</form>

<form action="http://www.dev.yiluhao.com/pano/upload" method="post" enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="Filedata" id="file" />
<input type="hidden" name="scene_id" value="575">
<input type="hidden" name="from" value="pano_pic">

<br />
<input type="submit" name="submit" value="场景图片" />
</form>

<form action="http://www.dev.yiluhao.com/pano/upload" method="post" enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="Filedata" id="file" />
<input type="hidden" name="project_id" value="1">
<input type="hidden" name="scene_id" value="3">
<input type="hidden" name="from" value="image_pic">

<br />
<input type="submit" name="submit" value="图片" />
</form>

<form action="http://www.dev.yiluhao.com/pano/upload" method="post" enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="Filedata" id="file" />
<input type="hidden" name="project_id" value="1">
<input type="hidden" name="scene_id" value="3">
<input type="hidden" name="from" value="music">

<br />
<input type="submit" name="submit" value="音乐" />
</form>

</body>
</html>