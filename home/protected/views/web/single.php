<?php $this->pageTitle=$datas['scene']['name'].'，全景，三维，上海';?>
<div>
	<div style="position:relative;width:<?=$datas['style']['width']?>px; height:<?=$datas['style']['height']?>px;<?=$datas['config']['center'] ? ' margin:0 auto' :''?>">
	<?php if($datas['config']['title'] && $datas['project']){?>
	<div style="background-color:#EEEEEE;margin:3px 0"><h3>&nbsp;<?=$datas['project']['name']?>&nbsp;&nbsp;<?=$datas['scene']['name']?></h3></div>
	<?php }?>
		<div id="pano-detail" style="width:<?=$datas['style']['width']?>px; height:<?=$datas['style']['height']?>px;<?=$datas['config']['center'] ? ' margin:0 auto' :''?>">
		<div id="scene_box"></div>
		<div id="pano_loading" class="pano_loading">
			<img id="pano_loading_img" src="<?=Yii::app()->baseUrl . '/style/img/loading_4.gif'?>"/>
		</div>
		<div id="hotspot_loading" class="hotspot_loading">
			<img id="hotspot_loading_img" src="<?=Yii::app()->baseUrl . '/style/img/loading_5.gif'?>"/>
		</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/style/js/common.js"?>"></script>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/plugins/salado/scene.js"?>"></script>
<script>
var scene_box = 'scene_box';
var player_url = '<?=Yii::app()->baseUrl?>/plugins/salado/Player.swf';
var scene_xml_url = '<?=$this->createUrl('/salado/index/s/', array('id'=>$datas['scene_id'],'w'=>$datas['style']['width'],'h'=>$datas['style']['height'],'auto'=>$datas['config']['auto'],'single'=>$datas['config']['single'], 'nobtb'=>$datas['config']['nobtb']))?>';
load_scene(scene_box, scene_xml_url, player_url, 'transparent');
</script>