<?php $this->pageTitle=$datas['page']['title'];?>
<style>
body{
	background: none repeat scroll 0 0 #555555;
}
</style>
<div data-role="page" id="MainContent">
	<div data-role="content">
		<div class="view_title">
			<a href="<?=$this->createUrl('/home/mobile/a', array('id'=>$datas['id']))?>">
				<img src="/style/sheying/back_img.png">
			</a>
			<span><?=$datas['basic']['tab3']?></span>
		</div>
		<div class="clear"></div>
		<div class="view_content">
				<div id="Gallery">
					
					<div class="gallery-row">
					<?php 
						$num = 1;
						foreach($datas['pics'] as $v){
						
					?>
						<div class="gallery-item">
							<a href="/<?=$v['url'].'/w'.Yii::app()->params['img_width'].'.'.$v['ftype']?>">
								<img src="/<?=$v['url'].'/w'.Yii::app()->params['img_thumb_width'].'.'.$v['ftype']?>" alt="<?=$v['desc']?>" />
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