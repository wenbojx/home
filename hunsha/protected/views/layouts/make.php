<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/style/css/style.css"); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/plugins/uploadify/uploadify.css"); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/jquery.min.js");?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/core.js");?>
<link rel="stylesheet" type="text/css" media="all" href="<?=Yii::app()->baseUrl?>/plugins/jscalendar-1.0/calendar-blue.css" title="win2k-cold-1" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" href="/style/css/ie6.min.css" /><![endif]-->
<title><?=$this->pageTitle?></title>
</head>
<body>

<div class="container">
    <?php echo $content;?>
</div>
</body>
</html>