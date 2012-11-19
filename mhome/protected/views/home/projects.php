<?php $this->pageTitle=$datas['project']['name'].'---足不出户，畅游中国';?>
<div data-role="page">

	<div data-role="header">
		<!-- <a href="/" data-role="button" data-icon="home" data-mini="true">首页</a> -->
		<h1>全景视界(yiluhao.com)</h1>
		<!-- <a href="#" data-role="button" data-mini="true">返回</a> -->
	</div><!-- /header -->

	<div data-role="content">	
		<ul data-role="listview" class="projects" >
			<?php if($datas['projects']){ foreach($datas['projects'] as $k=>$v){?>
	        <li>
	        	<a href="<?=$this->createUrl('/home/panos/list/', array('id'=>$v['project']['id']));?>" class="ui-link-inherit">
		            <img src="<?=Yii::app()->params['img_domain']?>/panos/thumb/pic/id/<?=$v['scene']['id']?>/size/200x100.jpg"/>
		            <h3><?=$v['project']['name']?>(含<?=$v['total_num']?>个场景)</h3>
		            <p><?=$v['project']['desc']?></p>
	            </a>
	        </li>
	        <?php }}?>
	    </ul>
	    <div class="next_page">
	    <a href="index.html" data-role="button" >下一页</a>
	    </div>
	</div><!-- /content -->

</div>