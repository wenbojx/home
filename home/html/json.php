<?php 
$project = array('project' => array(
		array(
			'id'=>'10',
			'title'=>'西湖',
			'info' =>'西湖简介',
			'count'=>'6',
			'thumb'=>'http://42.121.52.5/panos/thumb/pic/id/370/size/200x100.jpg',
			'state'=>'1',
		),
		array(
				'id'=>'11',
				'title'=>'胡雪岩故居',
				'info' =>'胡雪岩故居简介',
				'count'=>'8',
				'thumb'=>'http://42.121.52.5/panos/thumb/pic/id/312/size/200x100.jpg',
				'state'=>'1',
		),
		array(
				'id'=>'12',
				'title'=>'西溪湿地',
				'info' =>'西溪湿地简介',
				'count'=>'9',
				'thumb'=>'http://42.121.52.5/panos/thumb/pic/id/496/size/200x100.jpg',
				'state'=>'1',
		),
		array(
				'id'=>'12',
				'title'=>'西溪湿地',
				'info' =>'西溪湿地简介',
				'count'=>'9',
				'thumb'=>'http://42.121.52.5/panos/thumb/pic/id/496/size/200x100.jpg',
				'state'=>'1',
		),
		array(
				'id'=>'12',
				'title'=>'西溪湿地',
				'info' =>'西溪湿地简介',
				'count'=>'9',
				'thumb'=>'http://42.121.52.5/panos/thumb/pic/id/496/size/200x100.jpg',
				'state'=>'1',
		),
		array(
				'id'=>'13',
				'title'=>'西溪湿地',
				'info' =>'西溪湿地简介',
				'count'=>'9',
				'thumb'=>'http://42.121.52.5/panos/thumb/pic/id/496/size/200x100.jpg',
				'state'=>'1',
		),
		array(
				'id'=>'14',
				'title'=>'西溪湿地',
				'info' =>'西溪湿地简介',
				'count'=>'9',
				'thumb'=>'http://42.121.52.5/panos/thumb/pic/id/496/size/200x100.jpg',
				'state'=>'1',
		)
		
	));
$panos = array('panos' => array(
		array(
				'id'=>'1',
				'title'=>'景点一',
				'info' =>'景点一简介',
				'thumb'=>'http://42.121.52.5/panos/thumb/pic/id/496/size/200x100.jpg',
				'state'=>'1',
		),
		array(
				'id'=>'2',
				'title'=>'景点一',
				'info' =>'景点二简介',
				'thumb'=>'http://42.121.52.5/panos/thumb/pic/id/497/size/200x100.jpg',
				'state'=>'1',
		),
		array(
				'id'=>'3',
				'title'=>'景点三',
				'info' =>'景点三简介',
				'thumb'=>'http://42.121.52.5/panos/thumb/pic/id/498/size/200x100.jpg',
				'state'=>'1',
		),
		array(
				'id'=>'2',
				'title'=>'景点一',
				'info' =>'景点二简介',
				'thumb'=>'http://42.121.52.5/panos/thumb/pic/id/497/size/200x100.jpg',
				'state'=>'1',
		),
		array(
				'id'=>'2',
				'title'=>'景点一',
				'info' =>'景点二简介',
				'thumb'=>'http://42.121.52.5/panos/thumb/pic/id/497/size/200x100.jpg',
				'state'=>'1',
		),
		array(
				'id'=>'2',
				'title'=>'景点一',
				'info' =>'景点二简介',
				'thumb'=>'http://42.121.52.5/panos/thumb/pic/id/497/size/200x100.jpg',
				'state'=>'1',
		),
		array(
				'id'=>'2',
				'title'=>'景点一',
				'info' =>'景点二简介',
				'thumb'=>'http://42.121.52.5/panos/thumb/pic/id/497/size/200x100.jpg',
				'state'=>'1',
		)
		
));

$pano = array('pano' =>
					array(
						'id'=>'1',
						'title'=>'景点一',
						'info' =>'景点一简介',
						's_f'=>'http://42.121.52.5/salado/index/b/id/498/s_f/10/front.jpg',
							's_r'=>'http://42.121.52.5/salado/index/b/id/498/s_r/10/right.jpg',
							's_b'=>'http://42.121.52.5/salado/index/b/id/498/s_b/10/back.jpg',
							's_l'=>'http://42.121.52.5/salado/index/b/id/498/s_l/10/left.jpg',
							's_u'=>'http://42.121.52.5/salado/index/b/id/498/s_u/10/up.jpg',
							's_d'=>'http://42.121.52.5/salado/index/b/id/498/s_d/10/down.jpg',
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
else{
	$str = json_encode($project);
}
echo $str;
?>