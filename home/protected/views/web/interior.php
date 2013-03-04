<?php $this->pageTitle='全景，三维，上海';?>
<style>
.index_banner{height:238px;}
.index_banner .click{padding:180px 0 0 0; font-size:24px}
.index_banner .tips{padding:10px 0 0 0; font-size:14px}
</style>
	<div class="hero-unit padding5" id="static_banner">
		<div class="banner_box">
			<div class="index_banner" style="background:url(<?=Yii::app()->baseUrl . '/style/banner/'.$datas['baner_scene_id'].'.jpg'?>)">
				<div class="click" onclick="show_banner_pano()">点击，开始奇妙之旅！</div>
				<div class="tips">拖动鼠标，享受不一样的视觉体验！</div>
			</div>
			
		</div>
	</div>
	<div class="hero-unit banner_box padding5 display_none" id="pano_banner">
		<div class="banner_box">
			<div>
				<iframe src="<?=$this->createUrl('/web/single/a/', array('id'=>$datas['baner_scene_id'],'w'=>'932','h'=>'600','auto'=>'1', 'nobtb'=>1));?>" frameborder=0 width="930" height="600" scrolling="no">
				</iframe>
			</div>
			<p class="r_top">
				<a href="javascript::" onclick="show_banner_pic()">收起</a>
			</p>
		</div>
	</div>
	
		<div class="row project">
	<?php if($datas['projects']){ foreach($datas['projects'] as $v){?>
		<div class="span12">
			<div class="list_title">
				<h3 class="float_left title">
					<a href="<?=$this->createUrl('/web/view/a/', array('id'=>$v['project']['id']));?>">
					<?=$v['project']['name']?>
					</a>
					<span> (共 <?=$v['total_num']?> 个场景)</span>
				</h3>
				<span class="float_right info">
					<a href="<?=$this->createUrl('/web/view/a/', array('id'=>$v['project']['id']));?>">
					浏览更多...
					</a>
				</span>
				<div class="clear"></div>
			</div>
			<div class="row">
			<?php if ($v['scene']){ foreach($v['scene'] as $v1){?>
				<div class="span3">
					<div class="thumbnail">
					<a href="<?=$this->createUrl('/web/detail/a/', array('id'=>$v1['id']));?>">
						<img src="<?=PicTools::get_pano_small($v1['id'], '200x100')?>"/>
					</a>
					</div>
				</div>
			<?php }}?>
			</div>
		</div>
	<?php }}?>
		
	</div>
		<div class="page-footer">
					<div class="pagination">
                    <?php if(isset($datas['pages'])){  $this->widget('CLinkPager',array(
                        'header'=>'',
                        //'firstPageLabel' => '首页',
                        //'lastPageLabel' => '末页',
                        'prevPageLabel' => '上一页',
                        'nextPageLabel' => '下一页',
                        'pages' => $datas['pages'],
                        'maxButtonCount'=>10
                        )
                    );}?>
	</div>
</div>
