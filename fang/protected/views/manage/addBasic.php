<?php $this->pageTitle=$datas['page']['title'] ;?>
<div data-role="page">
	<div data-role="header">
		<h1><?=$datas['page']['title'] ?></h1>
		<a rel="external"
			href="/manage/list"
			data-role="button" data-icon="home" data-mini="true">返回</a>
	</div><!-- /header -->

	<div data-role="content">	
		<label for="text-basic">标题:</label>
		<input name="biaoti" id="biaoti" value="" type="text">
		<label for="text-basic">面积:</label>
		<table width="100%">
		<tr>
			<td>
				<input name="mianji" id="mianji" value="" type="text">
			</td>
			<td>
			平米
			</td>
		</tr>
		</table>
		<label for="text-basic">价格:</label>
		<table width="100%">
		<tr>
			<td>
				<input name="jiage" id="jiage" value="" type="text">
			</td>
			<td>
			万
			</td>
		</tr>
		</table>
		<label for="text-basic">类型:</label>
		<select name="shoumai" id="shoumai" data-mini="true" data-inline="true">
			    <option value="0">出售</option>
			    <option value="1">出租</option>
		</select>
		<label for="text-basic">装修情况:</label>
		<select name="zhuangxiu" id="zhuangxiu" data-mini="true" data-inline="true">
			    <option value="0">无信息</option>
			    <option value="1">毛坯</option>
			    <option value="2">简装修</option>
			    <option value="3">精装修</option>
			    <option value="3">豪华装修</option>
		</select>
			
		<label for="select-choice-mini" class="select">房型</label>
		<table width="250px">
		<tr>
			<td>
			<select name="shi" id="shi" data-mini="true" data-inline="true">
			    <option value="0">0</option>
			    <option value="1">1</option>
			    <option value="2">2</option>
			    <option value="3">3</option>
			    <option value="4">4</option>
			    <option value="5">5</option>
			    <option value="6">6</option>
			    <option value="7">7</option>
			</select>
			</td>
			<td>
			室
			</td>
			<td>
			<select name="ting" id="ting" data-mini="true" data-inline="true">
			    <option value="0">0</option>
			    <option value="1">1</option>
			    <option value="2">2</option>
			    <option value="3">3</option>
			    <option value="4">4</option>
			    <option value="5">5</option>
			</select>
			</td>
			<td>厅
			</td>
			<td>
			<select name="wei" id="wei" data-mini="true" data-inline="true">
			    <option value="0">0</option>
			    <option value="1">1</option>
			    <option value="2">2</option>
			    <option value="3">3</option>
			    <option value="4">4</option>
			    <option value="5">5</option>
			</select>
			</td>
			<td>卫
			</td>
		</tr>
		</table>
		<label for="text-basic">关键词:</label>
		<input name="guanjianci" id="guanjianci" value="" type="text">
		<label for="text-basic">描述:</label>
		<textarea name="desc" id="desc"></textarea>
		
		<input value="保存" type="button" style="width:50px;">
	</div><!-- /content -->
	<div data-role="footer" style="overflow:hidden;">
	    <div data-role="navbar">
	        <ul>
	            <li><a href="/manage/addBasic" class="ui-btn-active">基本</a></li>
	            <li><a href="/manage/addPic">图片</a></li>
	            <li><a href="/manage/addQuan">全景</a></li>
	        </ul>
	    </div><!-- /navbar -->
	</div><!-- /footer -->
</div>