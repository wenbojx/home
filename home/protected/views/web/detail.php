<?php $this->pageTitle=$datas['project']['name'].'---足不出户，畅游中国';?>
<?php $flag = $datas['map']['map']? true:false;?>
<div class="detail">
    <div class="hero-unit margin-top55">
        <div class="banner_box">
			<h2>足不出户 畅游中国</h2>
			<div class="r_index">
			<a style="color:#0088CC;" href="/">返回首页</a>
			</div>
		</div>
    </div>
    <div class="row-fluid">
        <div class="span11">
            <div class="thumbnail">
                <div class="pano-detail" id="pano-detail">
                	<div id="scene_box"></div>
                	<div id="pano_loading" class="pano_loading">
                    	<img id="pano_loading_img" src="<?=Yii::app()->baseUrl . '/style/img/loading_4.gif'?>"/>
                    </div>
                    <div id="hotspot_loading" class="hotspot_loading">
                    	<img id="hotspot_loading_img" src="<?=Yii::app()->baseUrl . '/style/img/loading_5.gif'?>"/>
                    </div>
                	<div id="scroll_pano_opacity" class="scroll_pano_container scroll_pano_opacity"></div>
                	<div class="scroll_close" id="scroll_close">
                		<i class="icon-backward"></i>
                	</div>
                	<div class="scroll_open" id="scroll_open">
                		<i class="icon-chevron-right"></i>
                	</div>
                	<div class="marker_map_close" id="marker_map_close" style="display:<?=$datas['map_flag']?'block':'none'?>"><a onclick="bind_marker_map()" class="close">&times;</a></div>
                	<div id="scroll_map" class="scroll_map" style="display:<?=$datas['map_flag']?'block':'none'?>">
                		<div class="marker_map" id="marker_map">
                			<?php if($flag){?>
			        		<img src="<?=$this->createUrl('/panos/imgOut/index/', array('id'=>$datas['map']['img']['md5'], 'size'=>$datas['map']['img']['width'].'x'.$datas['map']['img']['height'].'.jpg'))?>" class="imgMap"/>
			        		<?php }?>
			        		<?php if($datas['map']['position']){foreach($datas['map']['position'] as $v){?>
			        		<div title="<?=$datas['map']['link_scenes'][$v['scene_id']]['name']?>" class="marker" id="markers_<?=$v['scene_id']?>_<?=$v['id']?>" data-coords="<?=$v['left']?>,<?=$v['top']?>">
								<h3><?=$datas['map']['link_scenes'][$v['scene_id']]['name']?></h3>
							</div>
			        		<?php }}?>
                		</div>
                	</div>
                	<div id="scroll_pano_detail" class="scroll_pano_detail">
	                	<div class="scroll_pano_container scroll_pano">
	                		<div class="pano_prev">
	                			<i class="icon-chevron-up vertical"></i>
	                		</div>
	                		<div class="jCarouselLite">
						        <ul>
						        <?php 
						        	if(is_array($datas['extend']['hotspot'])){
										foreach($datas['extend']['hotspot'] as $v1){
								?>
									<li>
									<a href="javascript:;" onclick="salado_handle_click('load_pano_<?=$v1['link_scene_id']?>')">
									<img src="<?=PicTools::get_pano_small($v1['id'], '200x100')?>">
									</a>
									</li>
								<?php }}
									if(is_array($datas['extend']['extend'])){
										foreach($datas['extend']['extend'] as $v2){
								?>
						            <li>
										<a href="/web/detail/a/id/<?=$v2['id']?>">
											<img src="<?=PicTools::get_pano_small($v2['id'], '200x100')?>">
										</a>
						        	</li>
						        <?php }}?>
						        </ul>
						    </div>
						    <div class="pano_next">
						    <i class="icon-chevron-down vertical"></i>
						    </div>
	                	</div>
                	</div>
                </div>
            </div>
        </div>
        <div class="span1">
            <div class="thumbnail">
                <button class="btn btn-success" onclick="jump_to('<?=$this->createUrl('/web/view/a/', array('id'=>$datas['scene']['project_id']))?>')">返回</button>
                <?php if($flag){?>
                <button class="btn" id="menu_map">地图</button>
                <?php }?>
                <button class="btn" id="menu_scroller">相关</button>
                
                <!-- <button class="btn">足迹</button>
                <button class="btn">游记</button> -->
                <!-- <button class="btn">攻略</button> -->
                <!-- <button class="btn">评论</button> -->
                
            </div>
            
        </div>
    </div>
    <div class="row-fluid margin-top10">
        <div class="span10">
        <h3><!-- 足迹： --></h3>
        <div id="editor">
        </div>
        </div>
        <div class="span2">
        </div>
    </div>
</div>
<script type="text/javascript">
var page_url = '<?=$this->createUrl('/web/detail/a/');?>'
var scene_id = '<?=$datas['scene_id']?>';
var box_marker = 'marker_map';
</script>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/style/js/common.js"?>"></script>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/plugins/salado/scene.js"?>"></script>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/plugins/craftmap/js/craftmap.js"?>"></script>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/plugins/craftmap/js/map.js"?>"></script>
<script >
var scene_box = 'scene_box';
var player_url = '<?=Yii::app()->baseUrl?>/plugins/salado/Player.swf';
var scene_xml_url = '<?=$this->createUrl('/salado/index/a/', array('id'=>$datas['scene_id']))?>';
load_scene(scene_box, scene_xml_url, player_url, 'transparent');
<?php if($flag){?>
map_width = '<?=$datas['map']['img']['width']?>';
map_height = '<?=$datas['map']['img']['height']?>';

bind_map(box_marker);
<?php }?>
</script>

