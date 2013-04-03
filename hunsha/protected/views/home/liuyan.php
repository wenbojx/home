<?php $this->pageTitle=$datas['page']['title'];?>
<div data-role="page">
	<div data-role="content">
		<div class="view_title">
			<a href="<?=$this->createUrl('/home/mobile/a', array('id'=>$datas['id']))?>">
				<img src="/style/sheying/back_img.png">
			</a>
			<span><?=$datas['basic']['tab5']?></span>
		</div>
		<div class="clear"></div>
		<div class="view_content">
			<lable><?=$datas['msgTab']['tab1']?></lable><br>
			<input type="text" name="name" value="" id="name"><br>
			<lable><?=$datas['msgTab']['tab2']?></lable><br>
			<input type="text" name="mobile" value="" id="mobile"><br>
			<lable><?=$datas['msgTab']['tab3']?></lable><br>
			<textarea name="content" id="content"></textarea>
		</div>
	</div><!-- /content -->
</div>