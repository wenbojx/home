<?php 
$this->pageTitle=$datas['page']['title'];
$basic = $datas['basic'];
$widhtHeight = $widhtHeight = 100;
$chl = urlencode("http://a.yiluhao.com/{$datas['id']}/");
?>
<div class="content">
	<div class="header">
		<div class="items fleft"></div>
		<div class="login fright">
				<?php if($datas['username']){?>
				欢迎您:<?=$datas['username']?>
				
				<input type="hidden" name="id" id="project_id" value="<?=$datas['id']?>">
				&nbsp;&nbsp;
				<a href="/member/loginout">退出</a>
				<?php }else{?>
				<a href="<?=$this->createUrl('/member/step1/a/');?>">注册</a> <a
				href="<?=$this->createUrl('/member/login/a/');?>">登陆</a>
				<?php }?>
		</div>
	</div>
	<div class="left_demo fleft">
		<div class="demo_window">
		<iframe width="327" height="486" src="<?=$this->createUrl('/home/mobile/a/', array('id'=>$datas['id']));?>"></iframe>
		</div>
		<div class="erweima">
		<img alt="" src="http://chart.apis.google.com/chart?chs=<?=$widhtHeight?>x<?=$widhtHeight?>&cht=qr&chld=L|0&chl=<?=$chl?>" alt="QR code" widhtHeight="<?=$widhtHeight?>" widhtHeight="<?=$widhtHeight?>"/>
	
		</div>
	</div>
	<div class="right_make fleft">
		<div >
			<dl class="step" >
				<dt onclick="showStep1()"><h3>封面页</h3></dt>
				<dd id="step1">
					<form method="post" class="form-horizontal" id="manage_basic" action="<?=$this->createUrl('/manage/basic/save');?>">
					<ul class="form_box">
						<li><label>标 题：</label> <input type="text" value="<?=$basic['name']?>" name="name" style="width: 300px;"
							id="name" />
						</li>
						<li><label>栏位一：</label> 
						<input type="text" value="<?=$basic['tab1']?$basic['tab1']:'公司环境'?>" name="tab1" id="tab1" />
						</li>
						<li><label>栏位二：</label> <input type="text" value="<?=$basic['tab1']?$basic['tab2']:'关于我们'?>" name="tab2"
							id="tab2" />
						</li>
						<li><label>栏位三：</label> <input type="text" value="<?=$basic['tab1']?$basic['tab3']:'图片展示'?>" name="tab3"
							id="tab3" />
						</li>
						<li><label>栏位四：</label> <input type="text" value="<?=$basic['tab1']?$basic['tab4']:'服务内容'?>" name="tab4"
							id="tab4" />
						</li>
						<li><label>栏位五：</label> <input type="text" value="<?=$basic['tab1']?$basic['tab5']:'留言反馈'?>" name="tab5"
							id="tab5" />
						</li>
						<li><label>栏位六：</label> <input type="text" value="<?=$basic['tab1']?$basic['tab6']:'联系我们'?>" name="tab6"
							id="tab6" />
						</li>
						<li>
							<lable id="basic_tip_flag" class="hide"></lable>
							<input type="button" onclick="saveBsic()" name="save" value="保 存" class="save" style="margin:10px 0 0 70px;">
						</li>
						<br>
					</ul>
					</form>
				</dd>
			</dl>
		</div>
		<?php if($datas['id']){?>
		<div>
		<dl class="step" >
			<dt onclick="showStep2()"><h3>详细页</h3></dt>
				<dd id="step2" >
					<dl class="form_box" >
						<dt><?=$basic['tab1']?$basic['tab1']:'公司环境'?></dt>
						<dd id="item1" class="hide">
							<form method="post" class="form-horizontal" id="manage_pano" action="<?=$this->createUrl('/manage/pano/save');?>">
							<br>
							<lable>全景ID：</lable>
							<input type="text" id="tab1_input" name="tab1_input" value="<?=$datas['pano']['pano_id']?$datas['pano']['pano_id']:''?>"><br><br>
							<lable id="pano_tip_flag" class="hide"></lable>
							<input type="button" onclick="savePano()" name="save" value="保 存" class="save" style="margin:10px 0 0 70px;">

							(如需拍摄三维全景照片请联系13651672931, 李先生)
							<br>
							</form>
						</dd>
					</dl>
					<dl class="form_box">
						<form method="post" class="form-horizontal" id="manage_info_1" action="<?=$this->createUrl('/manage/info/save');?>">
						<dt><?=$basic['tab1']?$basic['tab2']:'关于我们'?></dt>
						<dd class="hide" id="item2">
							<br>
							<div class="editor">
								<script id="tab2_input" type="text/plain"><?=$datas['info'][2]['info']?></script>
							</div><br>
							<lable id="info2_tip_flag" class="hide"></lable>
							<input type="button" onclick="saveInfo(2)" name="save" value="保 存" class="save" >
							<br>
						</dd>
						</form>
					</dl>
					
					<dl class="form_box">
						<dt><?=$basic['tab1']?$basic['tab3']:'图片展示'?></dt>
						<dd  class="hide" id="item3">
							<div class="album_box" id="album_box">
								<form method="post" class="form-horizontal" id="form_album_pic" action="<?=$this->createUrl('/manage/album/update');?>">
									<?php foreach($datas['pics'] as $v){?>
										<div class="album_pic" id="album_<?=$v['id']?>">
										<div class="img_box">
										<img src="<?php echo '/'.$v['url'].'/w'.Yii::app()->params['img_thumb_width'].'.'.$v['ftype']?>"/>
										</div>
										<span id="album_pic_<?=$v['id']?>"><?=$v['desc']?$v['desc']:'图片简介'?></span>
										<span>
											<a id="pic_edit_<?=$v['id']?>" onclick="editPic(<?=$v['id']?>)">编辑</a>
											<a id="pic_save_<?=$v['id']?>" style="display:none" onclick="savePic(<?=$v['id']?>,'desc')">保存</a>
											&nbsp;&nbsp;&nbsp;&nbsp;
											<a onclick="savePic(<?=$v['id']?>,'del')">删除</a>
										</span>
										</div>
										
									<?php }?>
								</form>
							</div>
							<div class="clear"></div>
							<br>

							<div id="upload" class="upload">
								<div>
								
									<span id="album_box_upload"></span>
									说明: 按着Control或Shift键可一次选取多个文件,每次最多选十张
								</div>
							</div>
						</dd>
					</dl>
					<dl class="form_box">
						<dt><?=$basic['tab1']?$basic['tab4']:'服务内容'?></dt>
						<dd  class="hide" id="item4">
							<br>
							<div class="editor">
								<script id="tab4_input" type="text/plain"><?=$datas['info'][4]['info']?></script>
							</div>
							<br>
							<lable id="info4_tip_flag" class="hide"></lable>
							<input type="button" onclick="saveInfo(4)" name="save" value="保 存" class="save" >
							<br>
						</dd>
					</dl>
					<dl class="form_box">
						<dt><?=$basic['tab1']?$basic['tab5']:'留言反馈'?></dt>
						<dd  class="hide" id="item5">
						<form method="post" class="form-horizontal" id="manage_msg" action="<?=$this->createUrl('/manage/msgTab/save');?>">
						
							<br>
							<lable>标题栏一</lable>
							<input type="text" id="tab5_input_name" name="tab5_input_name" value="<?=$datas['msgTab']['tab1']?$datas['msgTab']['tab1']:'您的姓名'?>"><br><br>
							<lable>标题栏二</lable>
							<input type="text" id="tab5_input_phone" name="tab5_input_phone" value="<?=$datas['msgTab']['tab2']?$datas['msgTab']['tab2']:'您的电话'?>"><br><br>
							<lable>标题栏三</lable>
							<input type="text" id="tab5_input_content" name="tab5_input_content" value="<?=$datas['msgTab']['tab3']?$datas['msgTab']['tab3']:'留言内容'?>">
							<br>
							<lable id="msg_tip_flag" class="hide"></lable>
							<input type="button" onclick="saveMsgTab()" name="save" value="保 存" class="save" style="margin:10px 0 0 70px;">
							<br>
						</form>
						</dd>
					</dl>
					<dl class="form_box">
						<dt><?=$basic['tab1']?$basic['tab6']:'联系我们'?></dt>
						<dd  class="hide" id="item6">
						<form method="post" class="form-horizontal" id="manage_contact" action="<?=$this->createUrl('/manage/contact/save');?>">
							<div>
								<input type="text" id="map_search" name="map_search" onclick="searchMap()"/>
								<input type="button" name="search" value="搜索"  onclick="searchMap()">
								点击鼠标右键在地图上做出标记
							</div>
							<div class="map">
								<div id="map_canvas" class="map_canvas"></div>
							</div>
							<br>
							<lable>交通指引说明:</lable>
							<div class="editor">
								<script id="tab6_input" type="text/plain"><?php if($datas['contact']){ echo $datas['contact']['info'];}else{?>
地铁一号线，3号线4号出口<br>
地址:东方路 1880弄20号2503<br>
联系电话:186000909<br>
<?php }?>
</script>
							</div>
								<br>
								<lable id="contact_tip_flag" class="hide"></lable>
								<input type="button" onclick="saveLianxi()" name="save" value="保 存" class="save">
								<br>
						</form>
						</dd>
					</dl>
				</dd>
				</dl>

		</div>
		<?php }?>
	</div>
	<div class="clear"></div>
	
</div>
<div class="footer"></div>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/plugins/ueditor/editor_config.js"?>"></script>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/plugins/ueditor/editor_all.js"?>"></script>

<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/plugins/jscalendar-1.0/calendar.js"?>"></script>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/plugins/jscalendar-1.0/lang/cn_utf8.js"?>"></script>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/plugins/jscalendar-1.0/calendar-setup.js"?>"></script>
<script src="http://api.map.baidu.com/api?v=1.3" type="text/javascript"></script>

<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/plugins/uploadify/jquery.uploadify-3.1.js"?>"></script>


<script>
var edit_jump_url = "<?=$this->createUrl('/make/step1/edit/')?>";
var session_id = '<?=session_id()?>';
var thumb_img_width = '<?=Yii::app()->params['img_thumb_width']?>';
itemBindClick();

<?php if($datas['id']){?>
var ua = UE.getEditor('tab2_input');
ua.initialFrameWidth = 300;
ua.addListener('ready',function(){
    this.focus()
});

var ub = UE.getEditor('tab4_input');
ub.initialFrameWidth = 300;
ub.addListener('ready',function(){
    this.focus()
});

var uc = UE.getEditor('tab6_input');
uc.initialFrameWidth = 300;
uc.initialFrameHeight = 50;
uc.addListener('ready',function(){
    this.focus()
});

var flash_url = '<?=Yii::app()->baseUrl?>/plugins/uploadify/uploadify.swf';
var image_button_img = '<?=Yii::app()->baseUrl?>/style/img/pic_upload.png';
var image_upload_url='<?=$this->createUrl('/manage/album/upload/')?>';
//image_box_upload();

album_box_upload();

var map;
var point = {};
var marker;
point.lat = <?=$datas['contact']['lat'] ? $datas['contact']['lat'] : "''"?>;
point.lng = <?=$datas['contact']['lng'] ? $datas['contact']['lng'] : "''"?>;
point.zoom = <?=$datas['contact']['zoom'] ? $datas['contact']['zoom'] : "''"?>;

<?php }?>


</script>







