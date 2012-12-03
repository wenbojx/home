<?php $flag = $datas['map']['map']? true:false;?>
<style>
.uploadify-queue{
    float:left;
}
.uploadify{
    float:left;
}
</style>
<div class="panel_box_content" >
	<div class="panel_title">
		<div class="title-bar">
			<span>地图</span>
			<div class="title_tip">
        	
        	</div>
		</div>
		<div class="panel_close" onclick="hide_edit_panel()">X</div>
	</div>
	<div class="panle_content" style="height:290px;width:490px">
        <div>
        	<span class="label label-warning" id="map_box_upload"></span>
        	<span id="add_marker" style="display:<?=$flag?'':'none'?>">
        	<button onclick="show_marker_comfirm()" class="btn btn-primary">添加锚点</button>
        	</span>
        	&nbsp;&nbsp;
        	<span id="pano_marker" style="display:none">
        	<select id="scenes_list" style="width:80px;">
        		<?php if($datas['scene_list']){ foreach($datas['scene_list'] as $v){?>
        		<option value="<?=$v['id']?>"><?=$v['name']?></option>
        		<?php }}?>
        	</select>
        	</span>
        	<span id="marker_confirm" style="display:none">
        	&nbsp;&nbsp;
        	<button onclick="add_marker()" class="btn btn-warning">确定</button>
        	</span>
        	<span id="marker_delete" style="display:none">
        	&nbsp;&nbsp;
        	<button onclick="del_marker()" class="btn btn-warning">删除</button>
        	</span>
        	<span id="marker_save" style="display:none">
        	&nbsp;&nbsp;
        	<button onclick="save_marker()" class="btn btn-warning">保存</button>
        	</span>
        </div>
        <div class="tips">
        	<div id="map_tips" style="display:<?=$flag?'none':''?>">请上传地图</div>
        	<div id="map_container" class='scene_map' style="display:<?=$flag?'':'none'?>">
        		<?php if($flag){?>
        		<img src="<?=$this->createUrl('/panos/imgOut/index/', array('id'=>$datas['map']['img']['md5'], 'size'=>$datas['map']['img']['width'].'x'.$datas['map']['img']['height'].'.jpg'))?>" class="imgMap"/>
        		<?php }?>
        		<?php if($datas['map']['position']){foreach($datas['map']['position'] as $v){?>
        		<div class="marker" id="markers_<?=$v['id']?>" data-coords="<?=$v['left']?>, <?=$v['top']?>">
					<h3>France</h3>
				</div>
        		<?php }}?>
        	</div>
        </div>
	</div>
</div>

<script type="text/javascript">
var map_upload_url='<?=$this->createUrl('/pano/upload/')?>';
var scene_id = '<?=$datas['scene_id']?>';
var map_button_img = "<?=Yii::app()->baseUrl?>/style/img/upload_map.gif";
var save_map_marker_url = '<?=$this->createUrl('/salado/modules/map/')?>';
map_box_upload();
var map_id = '<?=$flag?$datas['map']['map']['id']:''?>';
<?php if($flag){?>
bind_map('scene_map');
<?php }?>
</script>