<?php $this->pageTitle=$datas['page']['title'];?>
<div data-role="page">
	<div data-role="header" id="header" style="z-index: 99999">
		<?php if($datas['fromManage']){?>
		<a rel="external"
			href="/manage/addQuan/a/id/<?=$datas['id']?>"
			data-role="button" data-icon="home" data-mini="true">返回</a>
			<?php }else{?>
			
			<?php }?>
		<h1 id="titleTip">
			全景案例
		</h1>
		
	</div>
	<!-- /header -->
	<div data-role="content" style="margin: 0; padding: 0">
		<iframe id="pano_box" name="pano_box" width="100%" height="500" scrolling="no" frameborder="0"
			src="http://www.yiluhao.com/s/10238/?m=1"> </iframe>
	</div>
</div>
<script>
resize();
</script>