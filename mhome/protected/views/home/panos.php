<?php $this->pageTitle=$datas['project']['name'].'---足不出户，畅游中国';?>
<div data-role="page">

	<div data-role="header">
		<a href="/" data-role="button" data-icon="home" data-mini="true">首页</a>
		<h1>全景视界</h1>
		<a data-rel="back" href="#" data-role="button" data-mini="true">返回</a>
	</div><!-- /header -->

	<div data-role="content">	
		<ul data-role="listview" class="panos" >
	        <li>
	        	<a href="<?=$this->createUrl('/home/view/a/');?>" class="ui-link-inherit">
		            <img src="/style/img/1.jpg" />
		            <h3>Item A</h3>
	            </a>
	        </li>
	        <li>
	        	<a href="index.html" class="ui-link-inherit">
		            <img src="/style/img/1.jpg" />
		            <h3>Item A</h3>
	            </a>
	        </li>
	        <li>
	        	<a href="index.html" class="ui-link-inherit">
		            <img src="/style/img/1.jpg" />
		            <h3>Item A</h3>
	            </a>
	        </li>  
	        <li>
	        	<a href="index.html" class="ui-link-inherit">
		            <img src="/style/img/1.jpg" />
		            <h3>Item A</h3>
	            </a>
	        </li>
	        <li>
	        	<a href="index.html" class="ui-link-inherit">
		            <img src="/style/img/1.jpg" />
		            <h3>Item A</h3>
	            </a>
	        </li>
	    </ul>
	    <div class="clear"></div>
	    <div class="next_page">
	    <a href="index.html" data-role="button" >下一页</a>
	    </div>
	</div><!-- /content -->

</div>