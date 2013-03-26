<?php $this->pageTitle = $datas['sort']['name'].'----yiluhao.com';?>
<div data-role="page">
	<div data-role="header">

		<h1><?php echo $datas['sort']['name'];?></h1>
		
		<a rel="external" href="<?=$this->createUrl('/home/sortInfo/a/', array('id'=>$datas['sort']['id']));?>/" data-role="button" data-icon="info" data-mini="true">关于</a>
		
	</div><!-- /header -->

	<div data-role="content">	
		<ul data-role="listview" class="projects" >
			<?php if($datas['projects']){ foreach($datas['projects'] as $k=>$v){?>
	        <li>
	        	<a href="<?=$this->createUrl('/home/panos/list/', array('id'=>$v['id']));?>" class="ui-link-inherit">
		            <img src="<?=PicTools::get_pano_thumb($v['thumb'], '150x110')?>"/>
		            <div>
		            <table width="100%">
			            		<tr>
			            			<td>
			            			<?=$v['name']?>
			            			</td>
			            			<td align="right">
			            			<span class= "price">
			            			<?php echo $v['extend']['price']?$v['extend']['price'].'万':'';?>
			            			</span>
			            			</td>
			            		</tr>
			            	</table>
		            </div>
		            <div class="project_list_info">
			            <div>
			            	<?php echo $v['extend']['region'];?>
			            	
			            </div>
			            <div>
			            	<?php echo $v['extend']['unit'];?> &nbsp;&nbsp;&nbsp;
			            	<?php echo $v['extend']['acreage'] ? $v['extend']['acreage'].'平米': '';?>
			            </div>
		            </div>
	            </a>
	        </li>
	        <?php }}?>
	    </ul>
	    
		</div><!-- /content -->
	
		
</div>