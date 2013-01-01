<?php 
$project = array('project' => array(
		array(
			'id'=>'10',
			'title'=>'西湖',
			'info' =>'西湖简介',
			'count'=>'6',
			'thumb'=>'http://www.yiluhao.com/panos/thumb/pic/id/370/size/200x100.jpg',
			'state'=>'1',
		),
		array(
				'id'=>'11',
				'title'=>'胡雪岩故居',
				'info' =>'胡雪岩故居简介',
				'count'=>'8',
				'thumb'=>'http://www.yiluhao.com/panos/thumb/pic/id/312/size/200x100.jpg',
				'state'=>'1',
		),
		array(
				'id'=>'12',
				'title'=>'西溪湿地',
				'info' =>'西溪湿地简介',
				'count'=>'9',
				'thumb'=>'http://www.yiluhao.com/panos/thumb/pic/id/496/size/200x100.jpg',
				'state'=>'1',
		),
		array(
				'id'=>'15',
				'title'=>'西溪湿地',
				'info' =>'西溪湿地简介',
				'count'=>'9',
				'thumb'=>'http://www.yiluhao.com/panos/thumb/pic/id/495/size/200x100.jpg',
				'state'=>'1',
		),
		array(
				'id'=>'14',
				'title'=>'西溪湿地',
				'info' =>'西溪湿地简介',
				'count'=>'9',
				'thumb'=>'http://www.yiluhao.com/panos/thumb/pic/id/494/size/200x100.jpg',
				'state'=>'1',
		),
		array(
				'id'=>'13',
				'title'=>'西溪湿地',
				'info' =>'西溪湿地简介',
				'count'=>'9',
				'thumb'=>'http://www.yiluhao.com/panos/thumb/pic/id/493/size/200x100.jpg',
				'state'=>'1',
		),
		array(
				'id'=>'16',
				'title'=>'西溪湿地',
				'info' =>'西溪湿地简介',
				'count'=>'9',
				'thumb'=>'http://www.yiluhao.com/panos/thumb/pic/id/492/size/200x100.jpg',
				'state'=>'1',
		)
		
	));
$panos = array('map'=>'http://beta1.yiluhao.com/html/pano/front.jpg',
		'panos' => array(
		array(
				'id'=>'1',
				'title'=>'景点一',
				'info' =>'景点一简介',
				'thumb'=>'http://www.yiluhao.com/panos/thumb/pic/id/480/size/200x100.jpg',
				'state'=>'1',
		),
		array(
				'id'=>'2',
				'title'=>'景点一',
				'info' =>'景点二简介',
				'thumb'=>'http://www.yiluhao.com/panos/thumb/pic/id/481/size/200x100.jpg',
				'state'=>'1',
		),
		array(
				'id'=>'3',
				'title'=>'景点三',
				'info' =>'景点三简介',
				'thumb'=>'http://www.yiluhao.com/panos/thumb/pic/id/482/size/200x100.jpg',
				'state'=>'1',
		),
		array(
				'id'=>'4',
				'title'=>'景点一',
				'info' =>'景点二简介',
				'thumb'=>'http://www.yiluhao.com/panos/thumb/pic/id/483/size/200x100.jpg',
				'state'=>'1',
		),
		array(
				'id'=>'5',
				'title'=>'景点一',
				'info' =>'景点二简介',
				'thumb'=>'http://www.yiluhao.com/panos/thumb/pic/id/484/size/200x100.jpg',
				'state'=>'1',
		),
		array(
				'id'=>'6',
				'title'=>'景点一',
				'info' =>'景点二简介',
				'thumb'=>'http://www.yiluhao.com/panos/thumb/pic/id/485/size/200x100.jpg',
				'state'=>'1',
		),
		array(
				'id'=>'7',
				'title'=>'景点一',
				'info' =>'景点二简介',
				'thumb'=>'http://www.yiluhao.com/panos/thumb/pic/id/486/size/200x100.jpg',
				'state'=>'1',
		)
		
));
$map = '<?xml version="1.0" encoding="utf-8"?><maps><map name="map">
		<area shape="poly" coords="230,35,294,38,299,57,299,79,228,79" id="@+id/area1" name = "N. Dakota"/>
		<area shape="poly" coords="227,80,299,80,302,120,282,116,226,116" id="@+id/area2" name = "S. Dakota"/>
		<area shape="poly" coords="229,35,226,87,154,81,145,86,131,69,123,21" id="@+id/area3" name = "Montana"/>
		<area shape="poly" coords="224,89,223,143,148,136,156,83" id="@+id/area4" name = "Wyoming"/>
		<area shape="poly" coords="169,141,241,147,241,197,162,191" id="@+id/area5" name = "Colorado"/>
		<area shape="poly" coords="112,20,121,20,132,87,152,87,149,119,94,111" id="@+id/area6" name = "Idaho"/>
		<area shape="poly" coords="42,10,66,7,111,18,104,57,48,51,40,36" id="@+id/area7" name = "Washington"/>
		<area shape="poly" coords="40,42,47,54,104,60,92,111,18,94" id="@+id/area8" name = "Oregon"/>
		<area shape="poly" coords="57,106,120,118,101,206,49,147" id="@+id/area9" name = "Nevada"/>
	</map>
</maps>';

$pano = array('pano' =>
					array(
						'id'=>'1',
						'title'=>'景点一',
						'info' =>'景点一简介',
						
						's_f'=>'http://beta1.yiluhao.com/html/pano/front.jpg',
							's_r'=>'http://beta1.yiluhao.com/html/pano/right.jpg',
							's_b'=>'http://beta1.yiluhao.com/html/pano/back.jpg',
							's_l'=>'http://beta1.yiluhao.com/html/pano/left.jpg',
							's_u'=>'http://beta1.yiluhao.com/html/pano/up.jpg',
							's_d'=>'http://beta1.yiluhao.com/html/pano/down.jpg',
						'state'=>'1',
							'hotspot'=>array(
									array(
											'ht_id'=>'1',
											'link_pano_id'=>'3',
											'tilt'=>'-1',
											'pan'=>'-98',
											'fov'=>'90'
									),
									array(
											'ht_id'=>'2',
											'link_pano_id'=>'4',
											'tilt'=>'-5',
											'pan'=>'-50',
											'fov'=>'90'
									),
							)
					)
				);

if(isset($_GET['panos'])){
	$str = json_encode($panos);
}
elseif(isset($_GET['pano'])){
	$str = json_encode($pano);
}
elseif(isset($_GET['map'])){
	$str = $map;
}
else{
	$str = json_encode($project);
}
echo $str;
?>