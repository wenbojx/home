<?php 
$this->pageTitle=$datas['page']['title'];
?>
<div class="content">
	<div class="header">
		<div class="items fleft"></div>
		<div class="login fright">
			<a href="<?=$this->createUrl('/member/step1/a/');?>">注册</a> <a
				href="<?=$this->createUrl('/member/login/a/');?>">登陆</a>
		</div>
	</div>
	<div class="left_demo fleft">
	<div class="demo_window">
		<iframe width="327" height="486" src="/home/welcome"></iframe>
		</div>
	</div>
	<div class="right_make fleft">
		<div >
			<dl class="step" >
				<dt onclick="showStep1()"><h3>封面页</h3></dt>
				<dd id="step1">
					<ul class="form_box">
						<li><label>新郎姓名：</label> <input type="text" value="" name="xinglang"
							id="xinglang" />
						</li>
						<li><label>新娘姓名：</label> <input type="text" value=""
							name="xingniang" id="xingniang" />
						</li>
						<li><label>宴客时间：</label> <input type="text" value="" name="riqi"
							id="riqi" />
						</li>
						<li><label>关 键 词：</label> <input type="text" style="width: 200px;"
							value="" name="guanjianci" id="guanjianci" />
						</li>
						<div>
						<label>封面图片：</label> 
						
							<span id="image_box_upload"></span>
						</div>
					</ul>
				</dd>
			</dl>
		</div>
		<div>
		<dl class="step" >
			<dt onclick="showStep2()"><h3>列表页</h3></dt>
				<dd id="step2" >
					<dl class="form_box" >
						<dt>爱的邀约</dt>
						<dd id="item1" class="hide">
							<table width="100%">
								<tr>
									<td><label>标题：</label> <input type="text" value="爱的邀约"
										name="yaoyue" id="yaoyue" />
									</td>
									<td align="right"><input type="checkbox" name="yaoyue_show"
										id="yaoyue_show">隐藏</td>
								</tr>
							</table>
							<div class="editor">
								<script id="yaoyue_text" type="text/plain">	
<p style="text-align:center">
<span style="font-family:微软雅黑,宋体,microsoft jhenghei,microsoft yahei,arial">
<span style="font-size:18px">
<span style="color: rgb(51, 51, 51); font-family: 微软雅黑,Microsoft YaHei;">​那一年，我们偶然相遇</span>
</span></span><br>
</p>

<p style="text-align:center">
<span style="font-family:微软雅黑,宋体,microsoft jhenghei,microsoft yahei,arial">
<span style="font-size:18px">
<span style="color: rgb(51, 51, 51); font-family: 微软雅黑,Microsoft YaHei;">没想到世界这么大</span>
</span></span><br>
</p>

<p style="text-align:center">
<span style="font-family:微软雅黑,宋体,microsoft jhenghei,microsoft yahei,arial">
<span style="font-size:18px"><span style="color: rgb(51, 51, 51); font-family: 微软雅黑,Microsoft YaHei;">
两颗小小的心却从此被系在一起</span></span></span></p>

<p style="text-align:center"><span style="font-family:微软雅黑,宋体,microsoft jhenghei,microsoft yahei,arial">
<span style="font-size:18px"><span style="color: rgb(51, 51, 51); font-family: 微软雅黑,Microsoft YaHei;">
我们看到彼此的好</span></span></span><br></p>

<p style="text-align:center"><span style="font-family:微软雅黑,宋体,microsoft jhenghei,microsoft yahei,arial">
<span style="font-size:18px"><span style="color: rgb(51, 51, 51); font-family: 微软雅黑,Microsoft YaHei;">
也看到彼此对自己的重要</span></span></span></p>

<p style="text-align:center"><span style="font-family:微软雅黑,宋体,microsoft jhenghei,microsoft yahei,arial">
<span style="font-size:18px"><span style="color: rgb(51, 51, 51); font-family: 微软雅黑,Microsoft YaHei;">
在这个美丽的日子</span></span></span></p>

<p style="text-align:center"><span style="font-family:微软雅黑,宋体,microsoft jhenghei,microsoft yahei,arial">
<span style="font-size:18px"><span style="color: rgb(51, 51, 51); font-family: 微软雅黑,Microsoft YaHei;">
我们决定让幸福延续</span></span></span></p>

<p style="text-align:center"><span style="font-family:微软雅黑,宋体,microsoft jhenghei,microsoft yahei,arial">
<span style="font-size:18px"><span style="color: rgb(51, 51, 51); font-family: 微软雅黑,Microsoft YaHei;">
期望快乐的回忆里，有您的参与</span></span></span></p><p style="text-align:right"><br></p>

<p style="text-align:right"><span style="font-family:微软雅黑,宋体,microsoft jhenghei,microsoft yahei,arial">
<span style="font-size:18px"><span style="color: rgb(51, 51, 51); font-family: 微软雅黑,Microsoft YaHei;">
{新郎}与{新娘}敬邀</span></span></span></p><p><br></p>

<p><span style="font-family:微软雅黑,宋体,microsoft jhenghei,microsoft yahei,arial"><span style="font-size:18px">
<span style="color: rgb(255, 0, 102); font-family: 微软雅黑,Microsoft YaHei;">日期：{宴客日期}</span></span></span></p>

<p><span style="font-family:微软雅黑,宋体,microsoft jhenghei,microsoft yahei,arial"><span style="font-size:18px">
<span style="color: rgb(255, 0, 102); font-family: 微软雅黑,Microsoft YaHei;">时间：{宴客时间}</span></span></span></p>
<p><span style="font-family:微软雅黑,宋体,microsoft jhenghei,microsoft yahei,arial"><span style="font-size:18px">
<span style="color: rgb(255, 0, 102); font-family: 微软雅黑,Microsoft YaHei;">地点：{场所名称}</span></span></span></p>

<p><span style="font-family:微软雅黑,宋体,microsoft jhenghei,microsoft yahei,arial"><span style="font-size:18px">
<span style="color: rgb(255, 0, 102); font-family: 微软雅黑,Microsoft YaHei;">地址：{场所地址}</span></span></span></p>

<p><span style="font-family:微软雅黑,宋体,microsoft jhenghei,microsoft yahei,arial"><span style="font-size:18px">
<span style="color: rgb(255, 0, 102); font-family: 微软雅黑,Microsoft YaHei;">电话：{联络电话}</span></span></span></p>
						</script>
							</div>
						</dd>
					</dl>
					<dl class="form_box">
						<dt>爱的故事</dt>
						<dd class="hide" id="item2">
							<table width="100%">
								<tr>
									<td><label>标题：</label> 
									<input type="text" value="爱的故事" name="gushi" id="gushi" />
									</td>
									<td align="right"><input type="checkbox" name="gushi_show"
										id="gushi_show">隐藏</td>
								</tr>
							</table>
							<div class="editor">
								<script id="gushi_text" type="text/plain">	

						</script>
							</div>
						
						</dd>
					</dl>
					
					<dl class="form_box">
						<dt>婚纱相册</dt>
						<dd  class="hide" id="item3">
							<div class="album_box" id="album_box">
							
							</div>
							<div id="upload" class="upload">
								<div>
								<label>相册图片：(每次最多选择10张图片上传)</label>
									<span id="album_box_upload"></span>
									说明: 按着Control或Shift键可一次选取多个文件
								</div>
							</div>
						</dd>
					</dl>
					<dl class="form_box">
						<dt>婚宴回函</dt>
						<dd  class="hide" id="item4">
							<table width="100%" height:100%>
								<tr>
									<td><label>标题：</label> 
									<input type="text" value="婚宴回函" name="huihan" id="huihan" />
									</td>
									<td align="right"><input type="checkbox" name="huihan_show"
										id="huihan_show">隐藏</td>
								</tr>
							</table>
							<div>
								<lable>提示</lable>
								<textarea name="map_desc" id="map_desc">为了方便统整婚宴资料，请您花几分钟填写以下内容，并在O月O日前回覆，我们的婚宴会因您的协助更加美好。</textarea>
							</div>
							<br>
							<div id="diaocha" class="diaocha hide">
								<table width="100%">
									<tr>
										<th width="10%">选项</th>
										<th align="left">问题</th>
									</tr>
									<tr>
										<td align="center"><input type="checkbox" name="ti1" id="ti1" value='1'/></td>
										<td><input type="text" name="ti1_in" id="ti1_in" value="您的姓名"/></td>
									</tr>
									<tr>
										<td align="center"><input type="checkbox" name="ti2" id="ti2" value='1'/></td>
										<td><input type="text" name="ti2_in" id="ti2_in" value="您的手机号"/></td>
									</tr>
									<tr>
										<td align="center"><input type="checkbox" name="ti3" id="ti3" value='1'/></td>
										<td>
											<input type="text" name="ti3_in" id="ti3_in" value="您会来参与我们的婚宴吗?"/>
											<ul>
												<li>
												<input type="text" name="ti3_select_1" id="ti3_select_1" value="非常乐意，有{1-10}人参加"/><br>
												<input type="text" name="ti3_select_2" id="ti3_select_2" value="无法参加"/><br>
												</li>
											</ul>
										</td>
									</tr>
									
									
									<tr>
										<td align="center"><input type="checkbox" name="ti4" id="ti4" value='1'/></td>
										<td>
											<input type="text" name="ti4_in" id="ti4_in" value="您是新郎还是新娘的宾客？"/>
											<ul>
												<li>
												<input type="text" name="ti4_select_1" id="ti4_select_1" value="我是帅新郎的{亲戚|朋友|同学|同事}"/><br>
												<input type="text" name="ti4_select_2" id="ti4_select_2" value="我是俏新娘的{亲戚|朋友|同学|同事}"/><br>
												<input type="text" name="ti4_select_3" id="ti4_select_3" value="其他:{}"/><br>
												</li>
											</ul>
										</td>
									</tr>
									
									
								</table>
							</div>
						</dd>
					</dl>
					<dl class="form_box">
						<dt>婚宴地图</dt>
						<dd  class="hide" id="item5">
						<div>
							<div>
<lable>交通指引说明:</lable><br>
<textarea id="map_desc">{地铁一号线，3号线4号出口}
地址:{东方路 1880弄20号2503}
联系电话:186000909</textarea>
							</div>
							<div>
							<input type="text" id="map_search" name="map_search" onclick="searchMap()"/>
							<input type="button" name="search" value="搜索"  onclick="searchMap()">
							点击鼠标右键在地图上做出标记
							</div>
						</div>
						<div id="map_canvas" class="map_canvas"></div>
						</dd>
					</dl>
					<dl class="form_box">
						<dt>爱的祝福</dt>
						<dd  class="hide" id="item6">
						<table width="100%">
								<tr>
									<td><label>标题：</label> 
									<input type="text" value="爱的祝福" name="zhufu" id="zhufu" />
									</td>
									<td align="right"><input type="checkbox" name="zhufu_show"
										id="zhufu_show">隐藏</td>
								</tr>
							</table>
						<br>
						</dd>
					</dl>
					<dl class="form_box">
						<dt>婚礼直播</dt>
						<dd  class="hide" id="item7">
						<table width="100%">
								<tr>
									<td><label>标题：</label> 
									<input type="text" value="婚礼直播" name="zhufu" id="zhufu" />
									</td>
									<td align="right"><input type="checkbox" name="zhufu_show"
										id="zhufu_show">隐藏</td>
								</tr>
							</table>
							<br>
							<div>
							<lable>开始时间</lable>
							<input type="text" value="" name="kaishishijian" id="kaishishijian" />
							<lable>结束时间</lable>
							<input type="text" value="" name="jieshushijian" id="jieshushijian" />
							</div>
							<br>
						</dd>
					</dl>
				</dd>
				</dl>

		</div>
	</div>
</div>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/plugins/ueditor/editor_config.js"?>"></script>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/plugins/ueditor/editor_all.js"?>"></script>

<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/plugins/jscalendar-1.0/calendar.js"?>"></script>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/plugins/jscalendar-1.0/lang/cn_utf8.js"?>"></script>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/plugins/jscalendar-1.0/calendar-setup.js"?>"></script>
<script src="http://api.map.baidu.com/api?v=1.3" type="text/javascript"></script>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/style/js/baidu.js"?>"></script>

<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/plugins/uploadify/jquery.uploadify-3.1.js"?>"></script>


<script>
var session_id = '<?=session_id()?>';

itemBindClick();
var ua = UE.getEditor('yaoyue_text');
ua.initialFrameWidth = 300;
ua.addListener('ready',function(){
    this.focus()
});
var ub = UE.getEditor('gushi_text');
ub.initialFrameWidth = 300;
ub.addListener('ready',function(){
    this.focus()
});

Calendar.setup({
    inputField      :    "kaishishijian",   // id of the input field
    ifFormat        :    "%Y-%m-%d %H:%M",       // format of the input field
    showsTime       :    true,
    timeFormat      :    "24"
    //onUpdate        :    catcalc
});

Calendar.setup({
    inputField      :    "jieshushijian",   // id of the input field
    ifFormat        :    "%Y-%m-%d %H:%M",       // format of the input field
    showsTime       :    true,
    timeFormat      :    "24"
    //onUpdate        :    catcalc
});

Calendar.setup({
    inputField      :    "riqi",   // id of the input field
    ifFormat        :    "%Y-%m-%d %H:%M",       // format of the input field
    showsTime       :    true,
    timeFormat      :    "24"
    //onUpdate        :    catcalc
});

var flash_url = '<?=Yii::app()->baseUrl?>/plugins/uploadify/uploadify.swf';
var image_button_img = "<?=Yii::app()->baseUrl?>/style/img/pic_upload.png";
var image_upload_url='<?=$this->createUrl('/album/upload/')?>';
image_box_upload();

album_box_upload();

var map;
var point = {};
point.lat = '';
point.lng = '';
point.zoom = 12;

initMap('map_canvas');
var marker;
addContextMenu();

if(!point.lat){
	var myCity = new BMap.LocalCity();
	myCity.get(myFun);
}
if(marker){
var p = marker.getPosition();       //获取marker的位置
alert("marker的位置是" + p.lng + "," + p.lat); 
}



</script>







