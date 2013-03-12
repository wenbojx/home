<?php $this->pageTitle=$datas['scene']['name'].'，全景，三维，上海';?>

<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/plugins/html5/player/player.js"?>"></script>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/plugins/html5/player/skin.js"?>"></script>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/plugins/html5/player/setting.js"?>"></script>
<div id="container" style="width:100%;height:100%;">
		This content requires HTML5/CSS3, WebGL, or Adobe Flash Player Version 9 or higher.
</div>
<script type="text/javascript">
	
	
			// create the panorama player with the container
			pano=new pano2vrPlayer("container");
			// add the skin object
			skin=new pano2vrSkin(pano,'/plugins/html5/');
			// load the configuration
			pano.readConfigUrl("config.xml");
			// hide the URL bar on the iPhone
			hideUrlBar();
			// add gyroscope controller
			gyro=new pano2vrGyro(pano,"container");
		</script>
		<noscript>
			<p><b>您的浏览器不支持js</b></p>
		</noscript> -->