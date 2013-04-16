<?php $this->pageTitle='祝福留言';?>
<div data-role="page">
	<div data-role="content">
		<div class="main_title">
			<a href="/1"><img src="/style/hunli/bg.png"/></a>
			<span>祝福留言</span>
		</div>
		<div class="page_content">
			<div class="live_msg">
				<form method="post" class="form-horizontal" id="submit_msg" action="<?=$this->createUrl('/home/liuyan/save');?>">
					<input type="hidden" name="id" id="project_id" value="<?=$datas['id']?>">
					
					<lable>您的名字</lable><br>
					<div class="yuanjiao">
						<input class="name" type="text" name="tab1" value="" id="tab1" class="widthall"><br>
					</div>

					<lable>您的留言</lable><br>
					<div class="yuanjiao">
						<textarea name="tab3" id="tab3" class="widthall"></textarea><br>
					</div>
					<div class="submit">
						<img onclick="saveMsg()" src="/style/hunli/bt.png" />	
					</div>
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
						<?=$v['tab1']?> | <?=date('Y-m-d H:i', $v['create'])?>
					</dt>
				</dl>
				<?php }?>
			</div>
			<?php if($datas['more']){?>
			<div class="msg_more" onclick="loadMore()">
				<span id="more_bt">更多...</span>
				
			</div>
			<br>
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