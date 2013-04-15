<?php $this->pageTitle='照片故事';?>
<div data-role="page">
	<div data-role="content">
		<div class="main_title">
			<a href="/tab3/1"><img src="/style/hunli/bg.png"/></a>
			<span>照片故事</span>
		</div>
		<div class="view_content" style="padding:0">
			<iframe id="pano_box" name="pano_box" width="100%" height="450" scrolling="no" frameborder="0"
			src="http://www.yiluhao.com/s/10339/?m=1"> </iframe>
		</div>
	</div><!-- /content -->
</div>
<script>
function resize(){
	var height = $(document.body).height();
	height = parseInt(height)-40;

	$("#pano_box").attr("height", height);
	//
}
resize();
</script>