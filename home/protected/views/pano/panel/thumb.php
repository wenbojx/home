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
            <span>缩略图</span>
            <div class="title_tip">
                <span class="label label-warning" id="thumb_box_upload"></span>
                200x100
            </div>
        </div>
        <div class="panel_close" onclick="hide_edit_panel()">X</div>
    </div>
    <div class="panle_content" style="height:100px;width:200px;">
        <div id="thumb_img">
            <?php if (isset($datas['thumb'])){?>
                <img alt="" src="<?=$datas['thumb']?>">
            <?php }?>
        </div>
    </div>
</div>

<script type="text/javascript">
var thumb_upload_url='<?=$this->createUrl('/pano/upload/')?>';
var scene_id = '<?=$datas['scene_id']?>';
var thumb_button_img = "<?=Yii::app()->baseUrl?>/style/img/upload_thumb.gif";
thumb_box_upload();
</script>