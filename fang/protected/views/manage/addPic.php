<?php $this->pageTitle=$datas['page']['title'] ;?>
<?php $num = 0;?>
<div data-role="page">
	<div data-role="header">
		<h1><?=$datas['page']['title'] ?></h1>
		<a rel="external"
			href="/manage/list"
			data-role="button" data-icon="home" data-mini="true">返回</a>
	</div><!-- /header -->

	<div data-role="content">
	<?php if($datas['list']){ foreach($datas['list'] as $v){
	if($v['type'] != '1'){
		continue;
	}
	?>	
	<div>
		<label>缩略图</label><br>
		<img src="/<?=$v['url'].'/thumb.'.$v['ftype'];?>"><br>
		<a href="/manage/addPic/a/del/1/id/<?=$v['id']?>">删除</a><br><br>
	</div>
	<?php }}?>
	
	<?php if($datas['list']){ 
		echo '<label>实景图</label><br>';
		foreach($datas['list'] as $v){
		if($v['type'] == '1'){
			continue;
		}
		$num++;
?>	
		
	<div>
		<img src="/<?=$v['url'].'/w'.$datas['width'].'.'.$v['ftype'];?>"><br>
		<a href="/manage/addPic/a/del/1/id/<?=$v['id']?>">删除</a>
	</div>
	<?php 
	}}else{
		//echo '无实景图';
	}
	?>
	<form method="post" data-ajax="false" class="form-horizontal" enctype="multipart/form-data" id="manage_addpic" action="/manage/addPic/a/id/<?=$datas['id']?>">
     	<input name="id" id="fid" value="<?=$datas['id']?>" type="hidden">
     	<?php if( $datas['msg'] ){?>
     	<label style="color:red"><?=$datas['msg']?></label><br>
     	<?php }?>
     	
     	<label for="file">上传缩略图:</label><br>
		<input name="file0" id="file0"  type="file"><br><br>
		<label for="file">上传实景图:</label><br>
		<?php for($i=1; $i<=(5-$num); $i++){?>
		<input name="file<?=$i?>" id="file<?=$i?>"  type="file"><br><br>
		<?php }?>
		
		<label style="color: red">最多上传5张图片</label><br>
		<input value="上传" type="submit">
	</form>
	</div><!-- /content -->
	<div data-role="footer" style="overflow:hidden;">
	    <div data-role="navbar">
	        <ul>
	            
	            <?php if($datas['id']){?>
	        	<li><a href="/manage/addBasic/edit/id/<?=$datas['id']?>">基本</a></li>
	        	<?php }else{?>
	            <li><a href="/manage/addBasic">基本</a></li>
	            <?php }?>
	            <?php if($datas['id']){?>
	            <li><a href="/manage/addPic/a/id/<?=$datas['id']?>" class="ui-btn-active">图片</a></li>
	            <?php }else{?>
	            <li><a onclick="show_msg()" class="ui-btn-active">图片</a></li>
	            <?php }?>
	            <?php if($datas['id']){?>
	            <li><a href="/manage/addQuan/a/id/<?=$datas['id']?>">全景</a></li>
	            <?php }else{?>
	            <li><a onclick="show_msg()">全景</a></li>
	            <?php }?>
	            <?php if($datas['id']){?>
	            <li><a href="/manage/erweia/a/id/<?=$datas['id']?>">二维码</a></li>
	            <?php }else{?>
	            <li><a onclick="show_msg()">二维码</a></li>
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