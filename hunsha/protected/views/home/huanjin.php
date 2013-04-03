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
			
		</div>
	</div><!-- /content -->
</div>