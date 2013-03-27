<?php $this->pageTitle=$datas['page']['title'] ;
?>
<div data-role="page">
	<div data-role="header">
		<h1><?=$datas['page']['title'] ?></h1>
		<a rel="external"
			href="/<?=$datas['id']?>"
			data-role="button" data-icon="home" data-mini="true">返回</a>
	</div><!-- /header -->

	<div data-role="content">
		<label for="text-basic">联系人: <?=$datas['member']['truename']?></label><br>
		
		<label for="text-basic">电话: <?=$datas['member']['phone']?></label><br>
		
		<label for="text-basic">地址: <?=$datas['member']['address']?></label><br>

		<label for="text-basic">邮箱: <?=$datas['member']['email']?></label><br>
			
		
		
		</div><!-- /content -->

</div>