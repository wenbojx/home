<?php 
$this->pageTitle=$datas['pages']['title'];
$zhuangxiu = array('0'=>'', '1'=>'毛坯', '2'=>'简装', '3'=>'精装', '4'=>'豪装');
?>

<div data-role="page">

	<div data-role="header">
		<?php if(!$datas['back_hide']){?>
		<a data-rel="back"  href="#" data-role="button" data-mini="true">返回</a>
		<?php }else{?>
		<a href="<?=$this->createUrl('/home/sort/list/', array('id'=>1001));?>" data-role="button" data-icon="home" data-mini="true">首页</a>
		<?php }?>
		<h1><?=$datas['page']['title'] ?></h1>
	</div><!-- /header -->

	<div data-role="content">	
		<ul data-role="listview" class="projects" >
			<?php if($datas['fangDatas']){ foreach($datas['fangDatas'] as $v){?>
			<!-- 
			<li>
	        	<a href="/l/1014" class="ui-link-inherit">
		            <img src="http://img.dev.yiluhao.com/pp/21/6f/87/10259/thumb/150x110.jpg"/>
		            <h3><?=$v['biaoti']?></h3>
		            <p>(含10个场景)</p>
	            </a>
	        </li>
	         -->
	        <li>
	        	<a href="<?=$this->createUrl('/manage/addBasic/edit/', array('id'=>$v['id']));?>" class="ui-link-inherit">
	        		<?php if($datas['pic'][$v['id']]['url']){?>
		            <img src="/<?=$datas['pic'][$v['id']]['url'].'/thumb.'.$datas['pic'][$v['id']]['ftype']?>"/>
		            <?php }else{?>
		            
		            <?php }?>
		            <div>
		            <table width="100%">
			            		<tr>
			            			<td>
			            			<?=$v['biaoti']?>
			            			</td>
			            			<td align="right">
			            			<span class= "price">
			            			<?=$v['jiage']?><?=$v['shoumai']=='1'?'万':' / 月'?>【<?=$v['shoumai']=='1'?'售':'租'?>】
			            			</span>
			            			</td>
			            		</tr>
			            	</table>
		            </div>
		            <div class="project_list_info">
			            <div>
							<?=$v['guanjianci']?>
			            </div>
			            <div>
			            	<?=$v['shi']?>室<?=$v['ting']?>厅<?=$v['wei']?>卫  
			            	&nbsp;&nbsp;&nbsp;&nbsp;
			            	<?=$v['mianji']?>平米
			            	&nbsp;&nbsp;&nbsp;&nbsp;
			            	<?=$zhuangxiu[$v['zhuangxiu']]?>
			            </div>
		            </div>
	            </a>
	        </li>
			<?php }}?>
	    </ul>
	    <?php if($datas['page_next']){?>
	    <div class="next_page">
	    <a href="<?=$this->createUrl('/manage/list/a/', array('page'=>$datas['page']));?>" data-role="button" >下一页</a>
	    </div>
	    <?php }?>
	</div><!-- /content -->
	
	
	<div data-role="footer" style="overflow:hidden;">
	    <div data-role="navbar">
	        <ul>
	            <li><a href="/manage/addBasic/">发布房源</a></li>
	        </ul>
	    </div><!-- /navbar -->
	</div><!-- /footer -->
</div>