<!DOCTYPE html> 
<html> 
<head> 
	<title><?=$this->pageTitle?></title> 
	<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/plugins/jqm/jquery.mobile-1.3.0.min.css"); ?>
	
	<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/style/css/style.css"); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/jquery.min.js");?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/plugins/jqm/jquery.mobile-1.2.0.min.js");?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/core.js");?>

</head> 
<body> 
<?php echo $content;?>
</body>
</html>