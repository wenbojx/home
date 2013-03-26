<?php $this->pageTitle=$datas['page']['title'] ;?>
<div data-role="page">
	<div data-role="header">
		<h1><?=$datas['page']['title'] ?></h1>
		<a rel="external"
			href="/home/list"
			data-role="button" data-icon="home" data-mini="true">返回</a>
	</div><!-- /header -->

	<div data-role="content">
		<img src="http://www.yiluhao.com/pp/64/64/24/10133/small/200x100.jpg"/><br>
		<img src="http://www.yiluhao.com/pp/3c/ef/d3/10005/small/200x100.jpg"/><br>
		<img src="http://www.yiluhao.com/pp/d7/5f/04/10132/small/200x100.jpg"/><br>
	</div><!-- /content -->
	<div data-role="footer" style="overflow:hidden;">
	    <div data-role="navbar">
	        <ul>
	            <li><a href="/home/basic" >基本</a></li>
	            <li><a href="/home/pic" class="ui-btn-active">图片</a></li>
	            <li><a href="/home/pano">全景</a></li>
	        </ul>
	    </div><!-- /navbar -->
	</div><!-- /footer -->
</div>