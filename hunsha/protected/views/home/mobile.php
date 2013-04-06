<?php 
$this->pageTitle=$datas['page']['title'];
$this->resize = true;
$num = 0;
$last_tap = '';
?>
<div data-role="page" id="page1">
	<div data-role="content">
		<div class="main_title">
			<span><?=$datas['basic']['name']?></span>
		</div>
		<div class="clear"></div>
		<div class="main_content">
				<?php 
				if($datas['basic']['tab1']){
				$num++;
				$last_tap = 'tab1';
				?>
				<a href="<?=$this->createUrl('/home/huanjin/a', array('id'=>$datas['id']))?>">
				<div id="tab1" class="radius item1 <?=$num%2==0?'fright':'fleft'?>">
					<span><?=$datas['basic']['tab1']?></span>
				</div>
				</a>
				<?php }?>
				<?php
				if($datas['basic']['tab2']){
				$num++;
				$last_tap = 'tab2';
				?>
				<a href="<?=$this->createUrl('/home/about/a', array('id'=>$datas['id']))?>">
				<div id="tab2" class="radius item2 <?=$num%2==0?'fright':'fleft'?>">
					<span><?=$datas['basic']['tab2']?></span>
				</div>
				</a>
				<?php }?>
				<?php
				if($datas['basic']['tab3']){
				$num++;
				$last_tap = 'tab3';
				?>
				<a href="<?=$this->createUrl('/home/case/a', array('id'=>$datas['id']))?>">
				<div id="tab3" class="radius item3 <?=$num%2==0?'fright':'fleft'?>">
					<span><?=$datas['basic']['tab3']?></span>
				</div>
				</a>
				<?php }?>
				<?php
				if($datas['basic']['tab4']){
				$num++;
				$last_tap = 'tab4';
				?>
				<a href="<?=$this->createUrl('/home/fanwei/a', array('id'=>$datas['id']))?>">
				<div id="tab4" class="radius item4 <?=$num%2==0?'fright':'fleft'?>">
					<div class="shupai">
						<div><?=$datas['basic']['tab4']?></div>
					</div>
				</div>
				</a>
				<?php }?>
				<?php
				if($datas['basic']['tab5']){
				$num++;
				$last_tap = 'tab5';
				?>
				<a href="<?=$this->createUrl('/home/liuyan/a', array('id'=>$datas['id']))?>">
				<div id="tab5" class="radius item5 <?=$num%2==0?'fright':'fleft'?>">
					<div class="shupai">
						<div><?=$datas['basic']['tab5']?></div>
					</div>
				</div>
				</a>
				<?php }?>
				<?php
				if($datas['basic']['tab6']){
				$num++;
				$last_tap = 'tab6';
				?>
				<a href="<?=$this->createUrl('/home/lianxi/a', array('id'=>$datas['id']))?>">
				<div id="tab6" class="radius item6 <?=$num%2==0?'fright':'fleft'?>">
					<span><?=$datas['basic']['tab6']?></span>
				</div>
				</a>
				<?php }?>
			<div class="clear"></div>
		</div>
		
	</div><!-- /content -->
</div>
<script>
var num = '<?=(ceil($num/2)-1)?>';
var last_tap = '<?=$last_tap?>';
var total = <?=$num?>;
onResize();
</script>
 
 