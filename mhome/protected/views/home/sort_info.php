<?php $this->pageTitle=$datas['sort']['name'].'---yiluhao.com';?>
<div data-role="page">

	<div data-role="header">
		
		<h1><?=$datas['sort']['name']?>详细</h1>
		
		<a data-rel="back" href="#" data-role="button" data-mini="true">返回</a>
		
	</div><!-- /header -->

	<div data-role="content">	
		<div>
			<?php if($datas['sort']['desc']){echo $datas['sort']['desc'];}?>
			<br>
			<p>
				技术支持: 全景视界 <br>
				网址: <a href="http://www.yiluhao.com" target="_blank">http://www.yiluhao.com</a>
			</p>
			<br>
		</div>
	</div><!-- /content -->

</div>