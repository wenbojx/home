<?php $this->pageTitle=$datas['project']['name'].'---yiluhao.com';?>
<div data-role="page">

	<div data-role="header">
		<?php if(!$datas['back_hide']){?>
		<a data-rel="back"  href="#" data-role="button" data-mini="true">返回</a>
		<?php }else{?>
		<a data-rel="back" href="#" data-role="button" data-icon="home" data-mini="true">首页</a>
		<?php }?>
		<h1><?=$datas['project']['name']?></h1>
		<a rel="external" href="<?=$this->createUrl('/home/info/a/', array('id'=>$datas['project']['id']));?>/" data-role="button" data-icon="info" data-mini="true">详细</a>
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