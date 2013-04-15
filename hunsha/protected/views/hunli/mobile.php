<?php 
$this->pageTitle=$datas['page']['title'];
$this->resize = true;
$num = 0;
$last_tap = '';
?>
<div data-role="page" id="page1">
	<div data-role="content">
		<div class="main_title">
			邱艳辉&王卓奕婚礼邀约
		</div>
		
		<div class="main_content">

		</div>
		<div class="footer">
			<div class="item_bg">
				<table class="item_table" width="100%">
					<tr>
						<td></td>
						<td align="center"><a href="/tab3/1"><img src="/style/hunli/item-1.png" /></a></td>
						<td><img src="/style/hunli/item_split.png" /></td>
						<td align="center"><a href="/tab2/1"><img src="/style/hunli/item-2.png" /></a></td>
						<td><img src="/style/hunli/item_split.png" /></td>
						<td align="center"><a href="/tab5/1"><img src="/style/hunli/item-3.png" /></a></td>
						<td></td>
					</tr>
				</table>
			</div>
		</div>
		
	</div><!-- /content -->
</div>
<script>
var num = '<?=(ceil($num/2)-1)?>';
var last_tap = '<?=$last_tap?>';
var total = <?=$num?>;
onResize();
</script>
 
 