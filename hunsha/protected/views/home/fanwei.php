<?php $this->pageTitle=$datas['page']['title'];?>
<div data-role="page">
	<div data-role="content">
		<div class="view_title">
			<a href="<?=$this->createUrl('/home/mobile/a', array('id'=>$datas['id']))?>">
				<img src="/style/sheying/back_img.png">
			</a>
			<span><?=$datas['basic']['tab4']?></span>
		</div>
		<div class="clear"></div>
		<div class="view_content">
			<?=$datas['info']['info']?>
		</div>
		
	</div><!-- /content -->
</div>