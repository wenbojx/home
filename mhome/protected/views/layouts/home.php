<!DOCTYPE html> 
<html> 
<head> 
	<title><?=$this->pageTitle?></title> 
	
	<meta content="width=device-width,initial-scale=1, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" name="viewport">
	<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/plugins/jqm/jquery.mobile-1.2.0.min.css"); ?>
	<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/style/css/style.css"); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/jquery.min.js");?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/core.js");?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/plugins/jqm/jquery.mobile-1.2.0.min.js");?>
<?php if(isset($this->player) && $this->player){?>
<style>
	body {
		background-color: #000000;
		margin: 0;
		cursor: move;
		overflow: hidden;
	}
	.ui-content{
		padding:0;
	}
</style>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/plugins/threepano/three.min.js");?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/plugins/threepano/CSS3DRenderer.js");?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/player.js");?>
		
<?php }?>
</head> 
<body> 
<?php echo $content;?>
</body>
</html>