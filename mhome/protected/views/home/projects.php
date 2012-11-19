<?php $this->pageTitle='一路好---足不出户，畅游中国';?>
<div data-role="page">

	<div data-role="header">
		<?php if($datas['back']){?>
		<a href="/" data-role="button" data-icon="home" data-mini="true">首页</a>
		<?php }?>
		<h1>全景视界</h1>
		<?php if($datas['back']){?>
		<a data-rel="back" href="#" data-role="button" data-mini="true">返回</a>
		<?php }?>
	</div><!-- /header -->

	<div data-role="content">	
		<ul data-role="listview" class="projects" >
			<?php if($datas['projects']){ foreach($datas['projects'] as $k=>$v){?>
	        <li>
	        	<a href="<?=$this->createUrl('/home/panos/list/', array('id'=>$v['project']['id']));?>" class="ui-link-inherit">
		            <img src="<?=Yii::app()->params['img_domain']?>/panos/thumb/pic/id/<?=$v['scene']['id']?>/size/200x100.jpg"/>
		            <h3><?=$v['project']['name']?></h3>
		            <p>(含<?=$v['total_num']?>个场景)</p>
	            </a>
	        </li>
	        <?php }}?>
	    </ul>
	    <?php if($datas['page_next']){?>
	    <div class="next_page">
	    <a href="<?=$this->createUrl('/home/projects/list/', array('page'=>$datas['page']));?>" data-role="button" >下一页</a>
	    </div>
	    <?php }?>
	</div><!-- /content -->

</div>