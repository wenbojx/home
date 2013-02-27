<?php $this->pageTitle='足不出户，畅游中国';?>

	<div class="hero-unit padding5" id="static_banner">
		<div class="banner_box">
			<div class="index_banner" style="background:url(<?=Yii::app()->baseUrl . '/style/banner/'.$datas['baner_scene_id'].'.jpg'?>)">
				<div class="click" onclick="show_banner_pano()">点击，开始奇妙之旅！</div>
				<div class="tips">拖动鼠标，享受不一样的视觉体验！</div>
			</div>
			
		</div>
	</div>
	<div class="hero-unit banner_box padding5 display_none" id="pano_banner">
		<div class="banner_box">
			<div>
				<iframe src="<?=$this->createUrl('/web/single/a/', array('id'=>$datas['baner_scene_id'],'w'=>'932','h'=>'400','auto'=>'1'));?>" frameborder=0 width="930" height="400" scrolling="no">
				</iframe>
			</div>
			<p class="r_top">
				<a href="javascript::" onclick="show_banner_pic()">收起</a>
			</p>
		</div>
	</div>
	
	<div class="mini-layout">
        <div class="row-fluid">
        <div class="span12">
        	<div class="span10">
        	<br>
        	<h3>项目简介</h3>
        	<span>
        	"装修助手"是继"全景西湖"后，全景视界开发的一个家居类的手机app项目。本项目旨在为用户和设计师提供一个室内设计参考平台。<br>
        	所有内容都以全景方式制作，解决以往只能展示室内局部图片的弊端.<br>
        	360度展示室内全景，颠覆传统视觉体验。为设计师提供一个全新的作品展示平台。
        	</span>
        	
                <br><br>
	              		<h3><span style="color: red">限时特惠</span></h3>
	              		<br>
	                	<strong>凡在3.1日至3.31日预约家居类室内全景摄影的客户(限上海地区)，
	                	即可享受<span style="color: red">超级特惠</span>服务</strong>
	                	<br><br>
	                	<h3>特惠内容</h3>
	              		<br>
	                	<span>1、价格，800元拍摄3个场景(原价2400元)，超出部分400元/场景</span><br><br>
	                	<span>2、拍摄的项目优先展示在网站"家居频道"</span><br><br>
	                	<span>3、拍摄的项目优先入选  "装修助手"</span><br><br>
	                	<span>4、客户设计师优先入选  "装修助手"的"设计师"频道</span><br><br>
	                	<span>5、设计师在频道排名中的位置按报名先后顺序排列(为期一个月)</span>
	                	<br><br>
	                	<h3>报名方式</h3>
	              		<br>
	                	<span>如果您有意愿参加我们此次活动，请发送邮件至yiluhao@gmail.com</span>
	                	<br><br>
	                	邮件标题: 参加家居类全景摄影<br>
	                	邮件内容: 您的姓名， 联系电话， 联系地址<br>
	                	附件：含需要拍摄全景的室内设计项目的图片一张或多张(用于审核)
	                	<br><br>
	                	<h3>注意事项</h3>
	              		<br>
	                	<span>1、我们会对所有报名设计师的作品进行审核，审核通过的作品才能享受优惠。</span><br><br>
	                	<span>2、审核通过的客户，我们会电话确认拍摄时间和地点，并安排专职摄影师实地拍摄。</span><br><br>
	                	<span>3、每位客户只能有一个项目参加优惠，如客户作品优秀，此条件可适当放宽</span><br><br>
	                	<span>4、我们以您发送邮件的日期为准，超过截止日期的不享受此优惠活动</span><br><br>
	                	
	                	<br><br>
	                	<br><br>
        	</div>
        	
        </div>
        </div>
    </div>
