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
			<div class="live_msg">
				<form method="post" class="form-horizontal" id="submit_msg" action="<?=$this->createUrl('/home/liuyan/save');?>">
					<input type="hidden" name="id" id="project_id" value="<?=$datas['id']?>">
					<?php if($datas['msgTab']['info']){?>
					<div class="msg_info">
					<?=$datas['msgTab']['info']?>
					</div>
					<?php }?>
					<lable><?=$datas['msgTab']['tab1']?></lable><br>
					<input type="text" name="tab1" value="" id="tab1" class="widthall"><br>
					<lable><?=$datas['msgTab']['tab2']?></lable><br>
					<input type="text" name="tab2" value="" id="tab2" class="widthall"><br>
					<lable><?=$datas['msgTab']['tab3']?></lable><br>
					<textarea name="tab3" id="tab3" class="widthall"></textarea><br>
					<input type="button" onclick="saveMsg()" name="save" value="提交" class="save">
				</form>
			</div>
			<div class="msg_list" id = "msg_list">
				<?php 
				$last_id = 0;
				foreach ($datas['msgList'] as $v){
					$last_id = $v['id'];
				?>
				<dl>
					<dd>
						<?=nl2br($v['tab3'])?>
					</dd>
					<dt>
						<?=$v['tab1']?> | <?=$v['tab2']?> | <?=date('Y-m-d H:i', $v['create'])?>
					</dt>
				</dl>
				<?php }?>
			</div>
			<?php if($datas['more']){?>
			<div class="msg_more" onclick="loadMore()">
				<span id="more_bt">更多...</span>
			</div>
			<?php }?>
		</div>
	</div><!-- /content -->
</div>
<script>
var tab1 = '<?=$datas['msgTab']['tab1']?>';
var tab2 = '<?=$datas['msgTab']['tab2']?>';
var tab3 = '<?=$datas['msgTab']['tab3']?>';
var last_id = '<?=$last_id?>';
var load_more_url = '<?=$this->createUrl('/home/liuyan/loadMore');?>';
</script>