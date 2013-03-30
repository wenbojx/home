<?php $this->pageTitle=$datas['page']['title'] ;
$ch2 = urlencode($datas['url']);
?>
<div data-role="page">
	<div data-role="header">
		<h1><?=$datas['page']['title'] ?></h1>
		<?php if($datas['id'] ){?>
		<a rel="external"
			href="/manage/addBasic/edit/id/<?=$datas['id']?>"
			data-role="button" data-icon="home" data-mini="true">返回</a>
		<?php }else{?>
		<a rel="external"
			href="/manage/list"
			data-role="button" data-icon="home" data-mini="true">返回</a>
		<?php }?>
	</div><!-- /header -->

	<div data-role="content">
		<lable>以下尺寸任选其一</lable><br><br>
		<img src="http://chart.apis.google.com/chart?chs=80x80&cht=qr&chld=L|0&chl=<?=$ch2?>" alt="QR code" widhtHeight="80" widhtHeight="80"/>
		<br><br>
		<img src="http://chart.apis.google.com/chart?chs=55x55&cht=qr&chld=L|0&chl=<?=$ch2?>" alt="QR code" widhtHeight="55" widhtHeight="55"/>
		<br><br>
		<img src="http://chart.apis.google.com/chart?chs=30x30&cht=qr&chld=L|0&chl=<?=$ch2?>" alt="QR code" widhtHeight="30" widhtHeight="30"/>

		</div><!-- /content -->

</div>