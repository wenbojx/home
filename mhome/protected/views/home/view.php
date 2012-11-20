<?php $this->pageTitle=$datas['scene']['name'].'---足不出户，畅游中国';?>
<div data-role="page">
	<div data-role="header" id="header">
		<a rel="external" href="<?=$this->createUrl('/home/panos/list/', array('id'=>$datas['scene']['project_id']));?>" data-role="button" data-icon="home" data-mini="true">返回</a>
		<h1><?=$datas['scene']['name']?></h1>
		<?php if($datas['next_id']){?>
		<a href="<?=$this->createUrl('/home/view/a/', array('id'=>$datas['next_id']));?>" rel="external" data-role="button" data-mini="true">下一个</a>
		<?php }?>
	</div><!-- /header -->

	<div data-role="content" id="pano_container">
		<div id="loading" class="loading">
			<img src="/style/img/loading_4.gif"/>
		</div>
	</div>

</div>
<script>
var url = '<?=Yii::app()->params['img_domain']?>home/pictrue/index/';
var pano_right = url+'id/<?=$datas['pics']['right']?>/size/800x800.jpg';
var pano_left = url+'id/<?=$datas['pics']['left']?>/size/800x800.jpg';
var pano_top = url+'id/<?=$datas['pics']['up']?>/size/800x800.jpg';
var pano_bottom = url+'id/<?=$datas['pics']['down']?>/size/800x800.jpg';
var pano_front = url+'id/<?=$datas['pics']['front']?>/size/800x800.jpg';
var pano_back = url+'id/<?=$datas['pics']['back']?>/size/800x800.jpg';

var camera, scene, renderer;
var geometry, material, mesh;
var target = new THREE.Vector3();

var lon = 90, lat = 0;
var phi = 0, theta = 0;

var touchX, touchY;
var pic_width = 400;

init('pano_container');
//setTimeout("animate()", 5000);
//show();
animate()
</script>