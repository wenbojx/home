<?php 
$this->pageTitle=$datas['page']['title'];
?>
<div class="content">
	<div class="header">
		<div class="items fleft"></div>
		<div class="login fright">
			<a href="<?=$this->createUrl('/member/step1/a/');?>">注册</a>
			<a href="<?=$this->createUrl('/member/login/a/');?>">登陆</a>
		</div>
	</div>
	<div class="left_demo fleft">
		<div class="demo_window">
		<iframe width="327" height="486" src="/home/mobile"></iframe>
		</div>
	</div>
	<div class="right_make fleft">
		<div class="desc">
		
		</div>
		<div class="start_make">
			<a href="<?=$this->createUrl('/make/step1/a/');?>">开始制作</a>
		</div>
	</div>
</div>