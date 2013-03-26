<?php $this->pageTitle=$datas['page']['title'] ;?>
<div data-role="page">
	<div data-role="header">
		<h1><?=$datas['page']['title'] ?></h1>
		<a rel="external"
			href="/home/list"
			data-role="button" data-icon="home" data-mini="true">返回</a>
	</div><!-- /header -->

	<div data-role="content">
		该房屋无全景图
	</div><!-- /content -->
	<div data-role="footer" style="overflow:hidden;">
	    <div data-role="navbar">
	        <ul>
	            <li><a href="/home/basic" >基本</a></li>
	            <li><a href="/home/pic" >图片</a></li>
	            <li><a href="/home/pano" class="ui-btn-active">全景</a></li>
	        </ul>
	    </div><!-- /navbar -->
	</div><!-- /footer -->
</div>