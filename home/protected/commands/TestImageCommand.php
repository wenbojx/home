<?php
ini_set('memory_limit', '500M');
class TestImageCommand extends CConsoleCommand {
	private $file = "/var/www/home/home/html/test.jpg";
	
	public function actionImage(){
		$image = Yii::app()->image->load($this->file);
		$maxW =2048;
		$maxH = 1024;
		$image->resize($maxW, $maxH)->quality(70);
		$new_file = "/var/www/home/home/html/image.jpg";
		$image->save($new_file);
		
	}

	public function actionImagick(){
		$myimage = new Imagick($this->file);
		$myimage->setImageFormat("jpeg");
		$myimage->setCompressionQuality( 70 );
		$maxW =2048;
		$maxH = 1024;
		$myimage->resizeimage($maxW, $maxH, Imagick::FILTER_LANCZOS, 1, true);
		$new_file = "/var/www/home/home/html/imagick.jpg";
		$myimage->writeImage($new_file);
		$myimage->clear();
		$myimage->destroy();
	}
	public function actionImagickSingle(){
		$myimage = new Imagick($this->file);
		$myimage->setImageFormat("jpeg");
		//$myimage->setCompressionQuality( 70 );
		//$maxW =2048;
		//$maxH = 1024;
		//$myimage->resizeimage($maxW, $maxH, Imagick::FILTER_LANCZOS, 1, true);
		$new_file = "/var/www/home/home/html/imagick.jpg";
		$myimage->writeImage($new_file);
		$myimage->clear();
		$myimage->destroy();
	}
}
?>

