<?php
class PanoPicTools{
    public $tile_info = array('11'=>2048, '10'=>1024, '9'=>512);
    private $myimage = null;
    public $water_pic_path = 'style/img/water.png';
    private $default_thumb_img = 'style/img/thumb_default.jpg';
    private $default_face_img = 'style/img/default_face.jpg';
    
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
		$path = $this->default_thumb_img;
		if($type == '2'){
			$path = $this->default_face_img;
		}
		//echo $path;
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
        $file = $folder . '/'. $file_name;
        if(!is_dir($folder)){
        	mkdir($folder);
        }
        $myimage = new Imagick($src_file);
        $ext = strtolower( $myimage->getImageFormat() );
        $myimage->setImageFormat($ext);
        //重置尺寸
        $myimage->resizeimage($this->tile_info[10], $this->tile_info[10], Imagick::FILTER_LANCZOS, 1, true);
        $sharpen = 0.5;
        $myimage->sharpenImage($sharpen, $sharpen);
        
        $x = 0 ;
        $y = 0;
        if(strstr($file_name, '1_0')){
        	$x = $maxW;
        }
        else if(strstr($file_name, '0_1')){
        	$y = $maxW;
        }
        else if(strstr($file_name, '1_1')){
        	$x = $maxW;
        	$y = $maxW;
        }
		
		$myimage->cropimage($maxW, $maxW, $x, $y);
		$myimage->writeImage($file);
		$myimage->clear();
		$myimage->destroy();
		
    }
}