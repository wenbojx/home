<?php $this->pageTitle=$datas['page']['title'];?>
<div data-role="page">

	<div data-role="header">
		<h1>会员登录</h1>
	</div><!-- /header -->

	<div data-role="content">
	<form method="post" class="form-horizontal" id="member_login" action="<?=$this->createUrl('/member/login/checkLogin');?>">
                 
		<label style="color: red; display:none;" id="login_tip_flag">账号密码错误，请重新输入</label><br>
		<label for="text-basic">用户名:</label>
		<input name="username" id="username" value="" type="text">
		<label for="password">密码:</label>
		<input name="passwd" id="passwd" value="" autocomplete="off" type="password">
		<input value="登陆" type="button" onclick="member.login()">
		</form>
	</div><!-- /content -->
</div>
<script>
var login_jump_url =  "<?=$this->createUrl('/manage/list');?>";
</script>