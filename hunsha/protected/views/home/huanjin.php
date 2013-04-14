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
		<div class="view_content">
			<iframe id="pano_box" name="pano_box" width="100%" height="500" scrolling="no" frameborder="0"
			src="http://www.yiluhao.com/s/10339/?m=1"> </iframe>
		</div>
	</div><!-- /content -->
</div>
<audio src="/a.mp3"></audio>