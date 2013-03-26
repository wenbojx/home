<?php $this->pageTitle=$datas['pages']['title'] ;?>
<div data-role="page">
	<?php if(!$datas['back_hide']){?>
		<a data-rel="back"  href="#" data-role="button" data-mini="true">返回</a>
		<?php }else{?>
		<a href="<?=$this->createUrl('/home/sort/list/', array('id'=>1001));?>" data-role="button" data-icon="home" data-mini="true">首页</a>
	<?php }?>
	<div data-role="header">
		<h1><?=$datas['page']['title'] ?></h1>
	</div><!-- /header -->

	<div data-role="content">	
		<ul data-role="listview" class="projects" >
			<li>
	        	<a href="/home/basic/a/id/111" class="ui-link-inherit">
		            <img src="http://img.dev.yiluhao.com/pp/21/6f/87/10259/thumb/150x110.jpg"/>
		            <h3>南宁民族博物馆</h3>
		            <p>(含10个场景)</p>
	            </a>
	        </li>
	        
	    </ul>
	    <?php if($datas['page_next']){?>
	    <div class="next_page">
	    <a href="<?=$this->createUrl('/home/panos/list/', array('id'=>$datas['project']['id'], 'page'=>$datas['page']));?>" data-role="button" >下一页</a>
	    </div>
	    <?php }?>
	</div><!-- /content -->

</div>