<?php $this->pageTitle=$datas['page']['title'];?>
<div data-role="page">
	<div data-role="content">
		<div class="view_title">
			<a href="<?=$this->createUrl('/home/mobile/a', array('id'=>$datas['id']))?>">
				<img src="/style/sheying/back_img.png">
			</a>
			<span><?=$datas['basic']['tab3']?></span>
		</div>
		<div class="clear"></div>
		<div class="view_content">
			<div class="album_box">
				<?php foreach($datas['pics'] as $v){?>
				<div class="pic">
					<div>
						<img src="/<?=$v['url'].'/w'.Yii::app()->params['img_thumb_width'].'.'.$v['ftype']?>">
					</div>
					<div><?=$v['desc']?></div>
				</div>
				<?php }?>
			</div>
		</div>
		
	</div><!-- /content -->
</div>