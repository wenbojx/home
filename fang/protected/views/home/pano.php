<?php $this->pageTitle=$datas['page']['title'] ;?>
<div data-role="page">
	<div data-role="header">
		<h1><?=$datas['page']['title'] ?></h1>
		<a rel="external"
			href="/home/basic/a/id/<?=$datas['id']?>"
			data-role="button" data-icon="home" data-mini="true">返回</a>
	</div><!-- /header -->

	<div data-role="content" style="margin: 0; padding: 0">
	<?php if($datas['fang']['pano_id']){?>
		<iframe id="pano_box" name="pano_box" width="100%" height="500" scrolling="no" frameborder="0"
			src="http://www.yiluhao.com/s/<?=$datas['fang']['pano_id']?>/?m=1"> </iframe>
	<?php }else{?>
	无全景图
	<?php }?>
	</div><!-- /content -->
	
</div>
<script>
resize();
</script>