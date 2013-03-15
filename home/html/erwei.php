<div style="padding:0 0 0 50px;">
<div style="margin:50px auto;">
<?php
$widhtHeight = $widhtHeight = 80;
$url = $_GET['url'];
$ch2 = urlencode($url);
?>
<?php echo '<img src="http://chart.apis.google.com/chart?chs='.$widhtHeight.'x'.$widhtHeight.'&cht=qr&chld=L|0&chl='.$ch2.'" alt="QR code" widhtHeight="'.$widhtHeight.'" widhtHeight="'.$widhtHeight.'"/>';?>
   </div>     </div>        