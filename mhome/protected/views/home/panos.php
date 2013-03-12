<?php $this->pageTitle=$datas['project']['name'].'---足不出户，畅游中国';?>
<div data-role="page">

	<div data-role="header">
		
		<h1><?=$datas['project']['name']?></h1>
		<a data-rel="back" href="#" data-role="button" data-mini="true">返回</a>
	</div><!-- /header -->

	<div data-role="content">	
		<ul data-role="listview" class="panos" >
			<?php if($datas['scenes']){ foreach ($datas['scenes'] as $v){?>
	        <li>
	        	<a rel="external" href="<?=$this->createUrl('/home/view/a/', array('id'=>$v['id']));?>/" class="ui-link-inherit">
		            <img src="<?=PicTools::get_pano_thumb($v['id'], '150x110')?>" />
		            <h3><?=$v['name']?></h3>
	            </a>
	        </li>
	        <?php }}?>
	    </ul>
	    <?php if($datas['page_next']){?>
	    <div class="next_page">
	    <a href="<?=$this->createUrl('/home/panos/list/', array('id'=>$datas['project']['id'], 'page'=>$datas['page']));?>" data-role="button" >下一页</a>
	    </div>
	    <?php }?>
	</div><!-- /content -->

</div>