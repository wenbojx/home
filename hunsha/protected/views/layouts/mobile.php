<!DOCTYPE html> 
<html> 
<head> 
	<title><?=$this->pageTitle?></title> 
	<meta content="width=device-width,initial-scale=1, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" name="viewport">
	
	<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/plugins/jqm/jquery.mobile-1.3.0.min.css"); ?>
	<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/style/default/mobile.css"); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/jquery.min.js");?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/plugins/jqm/jquery.mobile-1.2.0.min.js");?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/mobile.js");?>

	
</head> 
<body> 
<?php echo $content;?>
</body>
</html>