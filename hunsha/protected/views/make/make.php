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
		<iframe width="327" height="486" src="/1"></iframe>
		</div>
	</div>
	<div class="right_make fleft">
		<div class="desc">
		<form method="post" class="form-horizontal" id="member_login" action="<?=$this->createUrl('/member/login/checkLogin');?>">
			<label style="display:none;" id="login_tip_flag">账号密码错误，请重新输入</label><br>
			<label for="text-basic">用户名:</label><br>
			<input name="username" id="username" value="" type="text"><br>
			<label for="password">密码:</label><br>
			<input name="passwd" id="passwd" value="" autocomplete="off" type="password"><br>
			<input value="登陆" type="button" onclick="member.login()"><br>
		</form>
		</div>
		<div class="start_make">
			<a href="<?=$this->createUrl('/make/step1/a/');?>">开始制作</a>
		</div>
	</div>
</div>
<script>
var login_jump_url =  "<?=$this->createUrl('/make/step1/a');?>";
</script>