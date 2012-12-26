<?php
class PanoPicTools{
    public $tile_info = array('11'=>2048, '10'=>1024, '9'=>512);
    private $myimage = null;
    public $water_pic_path = 'style/img/water.png';
    private $default_thumb_img = 'style/img/thumb_default.gif';
    private $default_thumb_pano = 'style/img/thumb_pano.gif';
    private $default_face_img = 'style/img/default_face.jpg';
    private $face_box = array ('s_f'=>'style/img/box_front.gif', 's_r'=>'style/img/box_right.gif', 's_l'=>'style/img/box_left.gif', 's_b'=>'style/img/box_back.gif', 's_u'=>'style/img/box_up.gif', 's_d'=>'style/img/box_down.gif');

    private function _extensionToMime($ext){
		static $mime = array(
			'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',
		);
		if( !array_key_exists( $ext, $mime ) ){
			exit('error');
		}
		return $mime[$ext];
	}
	/**
	 * 输出默认图片
	 */
	public function show_default_pic($type = 1){
		if($type == '2'){
			$path = $this->default_face_img;
		}
		else if($type =='1'){
			$path = $this->default_thumb_img;
		}
		else if($type == '3'){
			$path = $this->default_thumb_pano;
		}
		else {
			$path = $this->face_box[$type];
		}
		$myimage = new Imagick($path);
		$ext = strtolower( $myimage->getImageFormat() );
		$myimage->setImageFormat($ext);

		header( 'Content-Type: '.$this->_extensionToMime($ext) );
		echo $myimage->getImagesBLOB();

		$myimage->clear();
		$myimage->destroy();
		exit();
	}
    /**
     * 添加水印
     * @return boolean
     */
    public function water_pic(){
    	$rand = rand(0, 8);
    	$time = substr(time(), $rand, 2);
    	$rand = rand(0, 5);
    	$ox = $time*$rand;
    	$rand = rand(0, 5);
    	$oy = $time*$rand;
    	$water = new Imagick($this->water_pic_path);
    	$dw = new ImagickDraw();
    	$dw -> composite($water->getImageCompose(),$ox,$oy,50,0,$water);
    	$this->myimage -> drawImage($dw);
    	$water->clear();
    	$water->destroy();
    	return true;
    }

    public function turnToStatic ($from, $to, $size, $quality=100, $water=1, $sharpen=0){
    	if(!file_exists($from) || !$to || !$size){
    		return false;
    	}
    	$size_explode = explode ('x', $size);
    	$width = (int) $size_explode[0];
    	$height = (int) $size_explode[0];
    	if(!$width || !$height){
    		return false;
    	}
    	$this->myimage = new Imagick($from);
    	$ext = strtolower( $this->myimage->getImageFormat() );
    	$this->myimage->setImageFormat($ext);
    	//重置尺寸
    	$this->myimage->resizeimage($width, $height, Imagick::FILTER_LANCZOS, 1, true);
    	//图片质量
    	if( $quality && $quality != 100){
    		$this->myimage->setImageCompression(imagick::COMPRESSION_JPEG);
    		$this->myimage->setImageCompressionQuality($quality);
    	}
    	if($water){
    		$this->water_pic();
    	}
    	if($sharpen){
    		$this->myimage->sharpenImage($sharpen, $sharpen);
    	}
    	$this->myimage->writeImage($to);

    	header( 'Content-Type: '.$this->_extensionToMime($ext) );
		echo $this->myimage->getImagesBLOB();

    	$this->myimage->clear();
    	$this->myimage->destroy();
    	exit();
    }

    public function get_exif_imagetype($file_path){
        if ( ( list($width, $height, $type, $attr) = getimagesize( $file_path ) ) !== false ) {
            return $type;
        }
        return false;
    }
    /**
     * 切割图片
     */
    public function split_img_ten($src_file, $file_name, $file_type='jpg'){

        $maxW = $maxH = $this->tile_info[10]/2;
        $folder = substr($src_file, 0, strlen($src_file)-4);
        if(!is_dir($folder)){
        	mkdir($folder);
        }
        $folder .= '/10';
    	if(!is_dir($folder)){
        	mkdir($folder);
        }
        $file = $folder . '/'. $file_name;

        $myimage = new Imagick($src_file);
        $ext = strtolower( $myimage->getImageFormat() );
        $myimage->setImageFormat($ext);
        $p_width = $myimage->getImageWidth();
        $p_height = $myimage->getImageHeight();
        //重置尺寸
        //$myimage->resizeimage($this->tile_info[10], $this->tile_info[10], Imagick::FILTER_LANCZOS, 1, true);
        //$sharpen = 0.5;
        //$myimage->sharpenImage($sharpen, $sharpen);


        $x = 0 ;
        $y = 0;
        $half_x = $p_width/2;
        $half_y = $p_height/2;
        if(strstr($file_name, '1_0')){
        	$x = $half_x;
        }
        else if(strstr($file_name, '0_1')){
        	$y = $half_y;
        }
        else if(strstr($file_name, '1_1')){
        	$x = $half_x;
        	$y = $half_y;
        }

		$myimage->cropimage($half_x, $half_y, $x, $y);
		$myimage->resizeimage($maxW, $maxW, Imagick::FILTER_LANCZOS, 1, true);
		
		$quality = 80;
		$sharpen = 0.5;
		$myimage->setImageCompression(imagick::COMPRESSION_JPEG);
		$myimage->setImageCompressionQuality($quality);
       $myimage->sharpenImage($sharpen, $sharpen);

		$myimage->writeImage($file);
		$myimage->clear();
		$myimage->destroy();

    }
}