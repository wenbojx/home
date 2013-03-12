<?php $this->pageTitle=$datas['scene']['name'].'---足不出户，畅游中国';?>
<div data-role="page">
	<div data-role="header" id="header" style="z-index: 99999">
		<a rel="external" href="<?=$this->createUrl('/home/panos/list/', array('id'=>$datas['scene']['project_id']));?>" data-role="button" data-icon="home" data-mini="true">返回</a>
		<h1><?=$datas['scene']['name']?></h1>
		
	</div><!-- /header -->
</div>
<div id="container" style="width:100%;height:100%;">
		This content requires HTML5/CSS3, WebGL, or Adobe Flash Player Version 9 or higher.
</div>

<script type="text/javascript" src="/style/player/player.js"></script>
<script type="text/javascript" src="/style/player/skin.js"></script>
<script type="text/javascript" src="/style/player/setting.js"></script>
<script type="text/javascript">
	
	
			// create the panorama player with the container
			pano=new pano2vrPlayer("container");
			// add the skin object
			skin=new pano2vrSkin(pano,'/html/yf_files/');
			// load the configuration
			pano.readConfigUrl("/html/yf.xml");
			// hide the URL bar on the iPhone
			hideUrlBar();
			// add gyroscope controller
			gyro=new pano2vrGyro(pano,"container");
		</script>
		<noscript>
			<p><b>您的浏览器不支持js</b></p>
		</noscript>