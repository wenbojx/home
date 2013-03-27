<?php $this->pageTitle=$datas['page']['title'] ;?>
<div data-role="page">
	<div data-role="header">
		<h1><?=$datas['page']['title'] ?></h1>
		<a rel="external"
			href="/manage/list"
			data-role="button" data-icon="home" data-mini="true">返回</a>
	</div><!-- /header -->

	<div data-role="content">	
	<form method="post" class="form-horizontal" id="manage_add" action="<?=$this->createUrl('/manage/addBasic/add');?>">
     	<input name="id" id="fid" value="<?=$datas['info']['id']?>" type="hidden">
		<label for="text-basic">标题:</label>
		<input name="biaoti" id="biaoti" value="<?=$datas['info']['biaoti']?>" type="text">
		<label for="text-basic">面积: 单位平米</label>
		<input name="mianji" id="mianji" value="<?=$datas['info']['mianji']?>" type="text">
		
		<label for="text-basic">价格: 单位万或每月</label>
		<input name="jiage" id="jiage" value="<?=$datas['info']['jiage']?>" type="text">
		
		<label for="text-basic">售卖类型:</label>
		<select name="shoumai" id="shoumai" data-mini="true" data-inline="true">
			    <option value="1" <?=$datas['info']['shoumai']=='1' ? 'selected="selected"':''?>>出售</option>
			    <option value="2" <?=$datas['info']['shoumai']=='2' ? 'selected="selected"':''?>>出租</option>
		</select>
		<label for="text-basic">装修情况:</label>
		<select name="zhuangxiu" id="zhuangxiu" data-mini="true" data-inline="true">
			    <option value="0" <?=$datas['info']['zhuangxiu']=='0' ? 'selected="selected"':''?>>无信息</option>
			    <option value="1"  <?=$datas['info']['zhuangxiu']=='1' ? 'selected="selected"':''?>>毛坯</option>
			    <option value="2" <?=$datas['info']['zhuangxiu']=='2' ? 'selected="selected"':''?>>简装修</option>
			    <option value="3" <?=$datas['info']['zhuangxiu']=='3' ? 'selected="selected"':''?>>精装修</option>
			    <option value="4" <?=$datas['info']['zhuangxiu']=='4' ? 'selected="selected"':''?>>豪华装修</option>
		</select>
			
		<label for="select-choice-mini" class="select">房型</label>
		<table width="250px">
		<tr>
			<td>
			<select name="shi" id="shi" data-mini="true" data-inline="true">
			    <option value="0" <?=$datas['info']['shi']=='0' ? 'selected="selected"':''?>>0</option>
			    <option value="1" <?=$datas['info']['shi']=='1' ? 'selected="selected"':''?>>1</option>
			    <option value="2" <?=$datas['info']['shi']=='2' ? 'selected="selected"':''?>>2</option>
			    <option value="3" <?=$datas['info']['shi']=='3' ? 'selected="selected"':''?>>3</option>
			    <option value="4" <?=$datas['info']['shi']=='4' ? 'selected="selected"':''?>>4</option>
			    <option value="5" <?=$datas['info']['shi']=='5' ? 'selected="selected"':''?>>5</option>
			    <option value="6" <?=$datas['info']['shi']=='6' ? 'selected="selected"':''?>>6</option>
			    <option value="7" <?=$datas['info']['shi']=='7' ? 'selected="selected"':''?>>7</option>
			</select>
			</td>
			<td>
			室
			</td>
			<td>
			<select name="ting" id="ting" data-mini="true" data-inline="true">
			    <option value="0" <?=$datas['info']['ting']=='0' ? 'selected="selected"':''?>>0</option>
			    <option value="1" <?=$datas['info']['ting']=='1' ? 'selected="selected"':''?>>1</option>
			    <option value="2" <?=$datas['info']['ting']=='2' ? 'selected="selected"':''?>>2</option>
			    <option value="3" <?=$datas['info']['ting']=='3' ? 'selected="selected"':''?>>3</option>
			    <option value="4" <?=$datas['info']['ting']=='4' ? 'selected="selected"':''?>>4</option>
			    <option value="5" <?=$datas['info']['ting']=='5' ? 'selected="selected"':''?>>5</option>
			</select>
			</td>
			<td>厅
			</td>
			<td>
			<select name="wei" id="wei" data-mini="true" data-inline="true">
			    <option value="0" <?=$datas['info']['wei']=='0' ? 'selected="selected"':''?>>0</option>
			    <option value="1" <?=$datas['info']['wei']=='1' ? 'selected="selected"':''?>>1</option>
			    <option value="2" <?=$datas['info']['wei']=='2' ? 'selected="selected"':''?>>2</option>
			    <option value="3" <?=$datas['info']['wei']=='3' ? 'selected="selected"':''?>>3</option>
			    <option value="4" <?=$datas['info']['wei']=='4' ? 'selected="selected"':''?>>4</option>
			    <option value="5" <?=$datas['info']['wei']=='5' ? 'selected="selected"':''?>>5</option>
			</select>
			</td>
			<td>卫
			</td>
		</tr>
		</table>
		<label for="text-basic">关键词:（如：小区央座, 身份象征）</label>
		<input name="guanjianci" id="guanjianci" value="<?=$datas['info']['guanjianci']?>" type="text">
		<label for="text-basic">描述:</label>
		<textarea name="desc" id="desc"><?=$datas['info']['desc']?></textarea>
		<label style="color: red; display:none;" id="add_tip_flag"></label><br>
		<input value="保存" type="button" id="submit_button" onclick= "fang.add()">
		<?php if($datas['info']['id']){?>
			<?php if($datas['info']['is_del']=='0'){?>
			<input value="删除" type="button" id="del_button" onclick= "fang.del(1)">
			<?php }else{?>
			<input value="恢复" type="button" id="del_button" onclick= "fang.del(0)">
			<?php }?>
		<?php }?>
		</form>
	</div><!-- /content -->
	<div data-role="footer" style="overflow:hidden;">
	    <div data-role="navbar">
	        <ul>
	        	<?php if($datas['info']['id']){?>
	        	<li><a href="/manage/addBasic/edit/id/<?=$datas['info']['id']?>" class="ui-btn-active">基本</a></li>
	        	<?php }else{?>
	            <li><a href="/manage/addBasic" class="ui-btn-active">基本</a></li>
	            <?php }?>
	            <?php if($datas['info']['id']){?>
	            <li><a href="/manage/addPic/a/id/<?=$datas['info']['id']?>">图片</a></li>
	            <?php }else{?>
	            <li><a onclick="show_msg()">图片</a></li>
	            <?php }?>
	            <?php if($datas['info']['id']){?>
	            <li><a href="/manage/addQuan/a/id/<?=$datas['info']['id']?>">全景</a></li>
	            <?php }else{?>
	            <li><a onclick="show_msg()">全景</a></li>
	            <?php }?>
	            
	            <?php if($datas['info']['id']){?>
	            <li><a href="/manage/erweia/a/id/<?=$datas['info']['id']?>">二维码</a></li>
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



