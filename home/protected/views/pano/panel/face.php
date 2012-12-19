
<style>
.uploadify-queue{
    position:absolute;
    top:0;
    right:0;
}
</style>
<div class="panel_box_content" id="panel_face">
<div class="panel_title">
	<div class="title-bar">上传全景图</div>
	<div class="panel_close" onclick="hide_edit_panel()">X</div>
</div>
<div class="panle_content" style="height:400px;width:485px;">
    <ul class="nav nav-tabs">
    <li class="active" id="pano_upload_tab">
    <a href="javascript:pano_upload_change(1)">上传全景图</a>
    </li>
    <li id="cube_upload_tab"><a href="javascript:pano_upload_change(2)">上传单图</a></li>
    </ul>
    <div id="pano_upload"  class="pano_upload">
    	<div class="pano_upload_box">
    	<br><br>
    		<button id="pano_upload_bt"  class="btn btn-warning">点击上传</button>
    		<br>
    		<div class="pano_show" id="pano_show">
    			
    		</div>
    	</div>
    	<div>
    		
    	</div>
    </div>
    
    <div id="cube_upload_box" class="cube_upload_box">
	    <div id="pano_state" class="pano_state"  style="display:<?=$datas['pano_state'] ? "" : "none"?>">
	    <br> <br>
	    	<h3 class="color_green">全景图转换中，请稍等...</h3>
	    	<br> <br>
	    	<img src="<?=Yii::app()->baseUrl?>/style/img/loading/loading_1.gif">
	    </div>
	    <div id="cube_upload" class="cube_upload"  style="display:<?=$datas['pano_state'] ? "none" : ""?>">
			<div class="box_open" >
			    <div class="box_side box_left" id="box_side_left"><img id="box_left" src="<?=Yii::app()->baseUrl?>/style/img/box_left.gif"/></div>
			    <div class="box_side box_right" id="box_side_right"><img id="box_right" src="<?=Yii::app()->baseUrl?>/style/img/box_right.gif"/></div>
			    <div class="box_side box_down" id="box_side_down"><img id="box_down" src="<?=Yii::app()->baseUrl?>/style/img/box_down.gif"/></div>
			    <div class="box_side box_up" id="box_side_up"><img id="box_up" src="<?=Yii::app()->baseUrl?>/style/img/box_up.gif"/></div>
			    <div class="box_side box_front" id="box_side_front"><img id="box_front" src="<?=Yii::app()->baseUrl?>/style/img/box_front.gif"/></div>
			    <div class="box_side box_back" id="box_side_back"><img id="box_back" src="<?=Yii::app()->baseUrl?>/style/img/box_back.gif"/></div>
			</div>
		</div>
	</div>
</div>
</div>

<script type="text/javascript">
var script_url='<?=$this->createUrl('/pano/upload/')?>';
var scene_id = '<?=$datas['scene_id']?>';
var width = 120;
var height = 120;
<?php if (!$datas['pano_state']){?>
var box_left = "<?=$datas['scene_files']['left']?>";
var box_right = "<?=$datas['scene_files']['right']?>";
var box_down = "<?=$datas['scene_files']['down']?>";
var box_up = "<?=$datas['scene_files']['up']?>";
var box_front = "<?=$datas['scene_files']['front']?>";
var box_back = "<?=$datas['scene_files']['back']?>";

init_box_upload('left');
init_box_upload('right');
init_box_upload('down');
init_box_upload('up');
init_box_upload('front');
init_box_upload('back');
<?php }?>
var pano_button_img = "<?=Yii::app()->baseUrl?>/style/img/pano_upload_bt.gif";
pano_box_upload();

</script>


