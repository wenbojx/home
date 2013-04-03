<?php $this->pageTitle=$datas['page']['title'];?>
<div data-role="page">
	<div data-role="content">
		<div class="view_title">
			<a href="<?=$this->createUrl('/home/mobile/a', array('id'=>$datas['id']))?>">
				<img src="/style/sheying/back_img.png">
			</a>
			<span><?=$datas['basic']['tab6']?></span>
		</div>
		<div class="clear"></div>
		<div class="view_content">
			<div>
			<?=$datas['contact']['info']?>
			</div>
			<div id="map" style="width:300px; height:200px;"></div>
		</div>
	</div><!-- /content -->
</div>
<script src="http://api.map.baidu.com/api?v=1.3" type="text/javascript"></script>
<script>
map_width();
<?php if($datas['contact']['lat']){?>
var map;
var point = {};
var marker;
point.lat = <?=$datas['contact']['lat'] ? $datas['contact']['lat'] : "''"?>;
point.lng = <?=$datas['contact']['lng'] ? $datas['contact']['lng'] : "''"?>;
point.zoom = <?=$datas['contact']['zoom'] ? $datas['contact']['zoom'] : "''"?>;
show_map('map');
<?php }?>
</script>