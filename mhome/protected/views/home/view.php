<?php $this->pageTitle=$datas['project']['name'].'---足不出户，畅游中国';?>
<div data-role="page">
	<div data-role="header" id="header">
		<a href="<?=$this->createUrl('/home/panos/list/', array('id'=>1));?>" data-role="button" data-icon="home" data-mini="true">返回</a>
		<h1>全景视界</h1>
		<a href="<?=$this->createUrl('/home/view/a/', array('id'=>2));?>" data-role="button" data-mini="true">下一个</a>
	</div><!-- /header -->

	<div data-role="content" id="pano_container">
		<div id="loading" class="loading">
			<img src="/style/img/loading_4.gif"/>
		</div>
	</div>

</div>
<script>
var pano_right = '/html/threepano/cube/Bridge2/posx.jpg';
var pano_left = '/html/threepano/cube/Bridge2/negx.jpg';
var pano_top = '/html/threepano/cube/Bridge2/posy.jpg';
var pano_bottom = '/html/threepano/cube/Bridge2/negy.jpg';
var pano_front = '/html/threepano/cube/Bridge2/posz.jpg';
var pano_back = '/html/threepano/cube/Bridge2/negz.jpg';

var camera, scene, renderer;
var geometry, material, mesh;
var target = new THREE.Vector3();

var lon = 90, lat = 0;
var phi = 0, theta = 0;

var touchX, touchY;

init('pano_container');
animate();
</script>