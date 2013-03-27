<?php $this->pageTitle=$datas['page']['title'] ;?>
<div data-role="page">
	<div data-role="header">
		<h1><?=$datas['page']['title'] ?></h1>
		<a rel="external"
			href="/<?=$datas['info']['mid']?>"
			data-role="button" data-icon="home" data-mini="true">返回</a>
	</div><!-- /header -->

	<div data-role="content">
		<?php if($datas['list']){ 
				
				foreach($datas['list'] as $v){
				if($v['type'] == '1'){
					continue;
				}
				$num++;
		?>	
				
			<div>
				<img src="/<?=$v['url'].'/w'.$datas['width'].'.'.$v['ftype'];?>"><br>
			</div>
			<?php 
			}}else{
				echo '无图片';
			}
			?>
	</div><!-- /content -->
	<div data-role="footer" style="overflow:hidden;">
	    <div data-role="navbar">
	        <ul>
	            <li><a href="/home/basic/a/id/<?=$datas['id']?>" >基本</a></li>
	            <li><a href="#" class="ui-btn-active">图片</a></li>
	            <li><a href="/home/pano/a/id/<?=$datas['id']?>">全景</a></li>
	        </ul>
	    </div><!-- /navbar -->
	</div><!-- /footer -->
</div>