<!DOCTYPE html> 
<html> 
<head> 
	<title><?=$this->pageTitle?></title> 
	<meta content="width=device-width,initial-scale=1, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" name="viewport">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/base.js");?>
	<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/style/hunli/style.css"); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/jquery-1.6.2.min.js");?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/mobile.js");?>
<script type="text/javascript">
window.addEventListener("load", hideUrlBar);
window.addEventListener("resize", hideUrlBar);
window.addEventListener("orientationchange", hideUrlBar);
</script>
</head> 
<body> 
<?php echo $content;?>
</body>
</html>