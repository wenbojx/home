<!DOCTYPE html>
<html>
<head>
<title><?=$this->pageTitle?></title>
<meta content="width=device-width,initial-scale=1, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" name="viewport">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="width=device-width,initial-scale=1, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" name="viewport">
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/plugins/jqm/jquery.mobile-1.2.0.min.css"); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/style/css/style.css"); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/jquery.min.js");?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/core.js");?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/plugins/jqm/jquery.mobile-1.2.0.min.js");?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/base.js");?>
<script type="text/javascript">
window.addEventListener("load", hideUrlBar);
window.addEventListener("resize", hideUrlBar);
window.addEventListener("orientationchange", hideUrlBar);
function resize(){
	var height = $(document.body).height();
	$("#pano_box").attr("height", height);
}
</script>
<style type="text/css" title="Default">
			
			/* fullscreen */
			html {
				height:100%;
			}
			body {
				height:100%;
				margin: 0px;
				overflow:hidden; /* disable scrollbars */
			}
			body {
			  font-size: 10pt;
			  background : #ffffff; 
			}

			.warning { 
				font-weight: bold;
			} 
			/* fix for scroll bars on webkit & Mac OS X Lion */ 
			::-webkit-scrollbar {
				background-color: rgba(0,0,0,0.5);
				width: 0.75em;
			}
			::-webkit-scrollbar-thumb {
    			background-color:  rgba(255,255,255,0.5);
			}
		</style>
		
</head>
<body onResize="resize">
<?php echo $content;?>
</body>
</html>