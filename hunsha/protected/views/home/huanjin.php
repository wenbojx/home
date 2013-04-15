<?php $this->pageTitle=$datas['page']['title'];?>
<div data-role="page">
	<div data-role="content">
		<div class="view_title">
			<a href="<?=$this->createUrl('/home/mobile/a', array('id'=>$datas['id']))?>">
				<img src="/style/sheying/back_img.png">
			</a>
			<span><?=$datas['basic']['tab1']?></span>
		</div>
		<div class="clear"></div>
		<div class="view_content" style="padding:0">
			<iframe id="pano_box" name="pano_box" width="100%" height="450" scrolling="no" frameborder="0"
			src="http://www.yiluhao.com/s/10339/?m=1"> </iframe>
		</div>
	</div><!-- /content -->
</div>
<script>
function resize(){
	var height = $(document.body).height();
	height = parseInt(height)-100;
	$("#pano_box").attr("height", height);
	alert(height);
}
resize();
</script>