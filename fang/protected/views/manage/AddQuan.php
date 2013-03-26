<?php $this->pageTitle=$datas['page']['title'] ;?>
<div data-role="page">
	<div data-role="header">
		<h1><?=$datas['page']['title'] ?></h1>
		<a rel="external"
			href="/manage/list"
			data-role="button" data-icon="home" data-mini="true">返回</a>
	</div><!-- /header -->

	<div data-role="content">	
		<?php if(!$datas['fang']['pano_id']){?>
			您还没有设置房源全景<br>
			房源全景可以720度观看房屋全貌<br>
			并可在房屋各个房间漫游观看，犹如身临其境<br>
			<a href="/home/demo/a/id/<?=$datas['id']?>/manage/1">点击查看案例</a><br>
			希望把您的房源做的更加精彩吗？<br>
			电话联系：13651672931
		<?php }?>
		<br><br>
		<form method="post" class="form-horizontal" id="manage_addQuan" action="/manage/addQuan/a/id/<?=$datas['id']?>">
		<label for="text-basic">设置全景项目ID：</label>
		<input name="id" type="hidden" value="<?=$datas['id']?>" id="id">
		<input name="pano_id" id="pano_id" value="<?=$datas['fang']['pano_id']?$datas['fang']['pano_id']:''?>" type="text">
		<input value="保存" type="submit">
		</form>
	</div><!-- /content -->
	<div data-role="footer" style="overflow:hidden;">
	    <div data-role="navbar">
	        <ul>
	            <?php if($datas['id']){?>
	        	<li><a href="/manage/addBasic/edit/id/<?=$datas['id']?>" >基本</a></li>
	        	<?php }else{?>
	            <li><a href="/manage/addBasic">基本</a></li>
	            <?php }?>
	            <?php if($datas['id']){?>
	            <li><a href="/manage/addPic/a/id/<?=$datas['id']?>">图片</a></li>
	            <?php }else{?>
	            <li><a onclick="show_msg()">图片</a></li>
	            <?php }?>
	            <?php if($datas['id']){?>
	            <li><a href="/manage/addQuan/a/id/<?=$datas['id']?>" class="ui-btn-active">全景</a></li>
	            <?php }else{?>
	            <li><a onclick="show_msg()" class="ui-btn-active">全景</a></li>
	            <?php }?>
	        </ul>
	    </div><!-- /navbar -->
	</div><!-- /footer -->
</div>
<script>
function show_msg(){
	alert("请先添加房源");
}
</script>




