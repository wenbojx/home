<?php $this->pageTitle=$datas['page']['title'] ;?>
<div data-role="page">
	<div data-role="header">
		<h1><?=$datas['page']['title'] ?></h1>
		<a rel="external"
			href="/manage/list"
			data-role="button" data-icon="home" data-mini="true">返回</a>
	</div><!-- /header -->

	<div data-role="content">	
		
		<label for="text-basic">设置全景项目ID：</label>
		<input name="biaoti" id="biaoti" value="" type="text">
		<input value="保存" type="button" style="width:50px;">
		
	</div><!-- /content -->
	<div data-role="footer" style="overflow:hidden;">
	    <div data-role="navbar">
	        <ul>
	            <li><a href="/manage/addBasic">基本</a></li>
	            <li><a href="/manage/addPic" >图片</a></li>
	            <li><a href="/manage/addQuan" class="ui-btn-active">全景</a></li>
	        </ul>
	    </div><!-- /navbar -->
	</div><!-- /footer -->
</div>