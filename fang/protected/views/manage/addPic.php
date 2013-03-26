<?php $this->pageTitle=$datas['page']['title'] ;?>
<div data-role="page">
	<div data-role="header">
		<h1><?=$datas['page']['title'] ?></h1>
		<a rel="external"
			href="/manage/list"
			data-role="button" data-icon="home" data-mini="true">返回</a>
	</div><!-- /header -->

	<div data-role="content">	
		<label for="file">上传新图片:</label>
		<input name="file" id="file" value="" type="file">
		<input value="上传" type="button" style="width:50px;">
	</div><!-- /content -->
	<div data-role="footer" style="overflow:hidden;">
	    <div data-role="navbar">
	        <ul>
	            <li><a href="/manage/addBasic">基本</a></li>
	            <li><a href="/manage/addPic" class="ui-btn-active">图片</a></li>
	            <li><a href="/manage/addQuan">全景</a></li>
	        </ul>
	    </div><!-- /navbar -->
	</div><!-- /footer -->
</div>