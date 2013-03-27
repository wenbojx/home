<?php $this->pageTitle=$datas['page']['title'] ;
$zhuangxiu = array('0'=>'', '1'=>'毛坯', '2'=>'简装', '3'=>'精装', '4'=>'豪装');
?>
<div data-role="page">
	<div data-role="header">
		<h1><?=$datas['page']['title'] ?></h1>
		<a rel="external"
			href="/<?=$datas['id']?>"
			data-role="button" data-icon="home" data-mini="true">返回</a>
	</div><!-- /header -->

	<div data-role="content">
		<label for="text-basic">面积: <?=$datas['info']['mianji']?> 平米</label><br>
		
		<label for="text-basic">价格: <?=$datas['info']['jiage']?> <?=$datas['info']['shoumai']=='1'?'万':'/月'?></label><br>
		
		<label for="text-basic">类型: <?=$datas['info']['shoumai']=='1'?'出售':'出租'?></label><br>

		<label for="text-basic">装修情况: <?=$zhuangxiu[$datas['info']['zhuangxiu']]?></label><br>
			
		<label for="select-choice-mini" class="select">
		房型: <?=$datas['info']['shi']?> 室 <?=$datas['info']['ting']?> 厅 <?=$datas['info']['wei']?> 卫
		</label><br>
		<label for="text-basic">描述:<br>
		<?=$datas['info']['desc']?>
		</label>
	</div><!-- /content -->
	<div data-role="footer" style="overflow:hidden;">
	    <div data-role="navbar">
	        <ul>
	            <li><a href="#" class="ui-btn-active">基本</a></li>
	            <li><a href="/home/pic/a/id/<?=$datas['id']?>">图片</a></li>
	            <li><a href="/home/pano/a/id/<?=$datas['id']?>">全景</a></li>
	        </ul>
	    </div><!-- /navbar -->
	</div><!-- /footer -->
</div>