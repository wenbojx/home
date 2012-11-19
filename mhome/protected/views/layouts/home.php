<!DOCTYPE html> 
<html> 
<head> 
	<title>My Page</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/plugins/jqm/jquery.mobile-1.2.0.min.css"); ?>
	<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/style/css/style.css"); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/jquery.min.js");?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/plugins/jqm/jquery.mobile-1.2.0.min.js");?>
<?php if($this->player){?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/plugins/threepano/three.min.js");?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/plugins/threepano/CSS3DRenderer.js");?>
<?php }?>
</head> 
<body> 
<?php echo $content;?>
</body>
</html>