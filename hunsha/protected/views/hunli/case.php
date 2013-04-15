<?php $this->pageTitle='照片故事';?>
<div data-role="page" id="MainContent">
	<div data-role="content">
		<div class="main_title">
			<a href="/1"><img src="/style/hunli/bg.png"/></a>
			<span>照片故事</span>
		</div>
		<div class="page_content">
				<div id="Gallery">
					<div class="gallery-row">
					<?php 
						$num = 1;
						foreach($datas['pics'] as $v){
						
					?>
						<div class="gallery-item">
							<a style="background:url('/<?=$v['url'].'/w'.Yii::app()->params['img_thumb_width'].'.'.$v['ftype']?>') no-repeat scroll center top transparent;" href="/<?=$v['url'].'/w'.Yii::app()->params['img_width'].'.'.$v['ftype']?>">
								
							</a>
						</div>
						<?php
						/* if( ($num%4)==0){
							echo '<div class="gallery-row">';
						}
						$num++; */
						 }?>
					</div>
				</div>
		</div>
		
	</div><!-- /content -->
</div>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/plugins/photoSwipe/simple-inheritance.min.js"?>"></script>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/plugins/photoSwipe/code-photoswipe-jQuery-1.0.19.min.js"?>"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#Gallery a").photoSwipe();				
});	
</script>