<?php $this->pageTitle=$datas['scene']['name'].'---足不出户，畅游中国';?>
<div data-role="page">
	<div data-role="header" id="header" style="z-index: 99999">
		<a rel="external"
			href="<?=$this->createUrl('/home/panos/list/', array('id'=>$datas['scene']['project_id']));?>"
			data-role="button" data-icon="home" data-mini="true">返回</a>
		<h1>
			<?=$datas['scene']['name']?>
		</h1>
		
	</div>
	<!-- /header -->
	<div data-role="content" style="margin: 0; padding: 0">
		<iframe id="pano_box" name="pano_box" width="100%" scrolling="no" frameborder="0"
			src="http://www.yiluhao.com/s/<?=$datas['scene']['id']?>/?m=1"> </iframe>
	</div>
</div>
<script>
resize();
</script>
