<?php 
ini_set('memory_limit', '100M');
class Pano2CubesCommand extends CConsoleCommand {
	
	public $width = '3724';  //cube
	public $swidth = '11700'; //sphere
	public $sheight = '5850'; //sphere
	
	private $linux_path_prefix = '/var/www/home/home';
	private $linux_pttool_path = '/usr/local/libpano13/bin/PTmender';
	//public $linux_shpere_prefix = '/tmp';
	private $script_num = '';
	private $script_path = '';
	
	public function actionRun(){
		
		$scene_ids = $this->get_queue_list();
		//print_r($scene_ids);
		if(!$scene_ids){
			return false;
		}
		
		$pano_pics = $this->get_pano_pic_path($scene_ids);
		//print_r($pano_pics);
		if(!$pano_pics){
			return false;
		}
		
		$num = $this->get_script_path();
		if(!$num){
			return false;
		}
		$this->script_num = $num;
		foreach($scene_ids as $v){
			$pano_queue = new PanoQueue();
			$pano_queue->update_lock($v, 1);
		}
		
		foreach($pano_pics as $k=>$v){
			$this->turn_to_cube($v);
			//$this->update_item_state_lock($k);
		}
		if (file_exists($this->script_path)) {
			//unlink ($this->script_path);
		}
	}
	/**
	 * 获取script 线程ID
	 */
	private function get_script_path(){
		$num = '';
		$prefix = '';
		$flag = false; //是否有位置
		$prefix = $this->linux_path_prefix . '/tmp';
		$path_1 = $prefix . '/' . 'script-1.txt';
		$path_2 = $prefix . '/' . 'script-2.txt';

			if(!file_exists($path_1)){
				$num = 1;
				file_put_contents($path_1, 1);
				$this->script_path = $path_1;
			}
			elseif(!file_exists($path_2)){
				$num = 2;
				file_put_contents($path_2, 1);
				$this->script_path = $path_2;
			}
			/* elseif(!file_exists($path_3)){
				$num = 3;
				file_put_contents($path_3, 1);
				$this->script_path = $path_3;
			} */
		return $num;
	}
	/**
	 * 系统处理图片
	 */
	public function turn_to_cube($path){
		$this->cube($path);
		$this->exec_libpano($path);
	}
	
	public function cube($path){
		$script = "p w{$this->width} h{$this->width} f0 v90 u20 n\"TIFF_m\"\n
		i n\"{$path}\"\n
		o f4 y0 r0 p0 v360\n
		i n\"{$path}\"\n
		o f4 y-90 r0 p0 v360\n
		i n\"{$path}\"\n
		o f4 y-180 r0 p0 v360\n
		i n\"{$path}\"\n
		o f4 y90 r0 p0 v360\n
		i n\"{$path}\"\n
		o f4 y0 r0 p-90 v360\n
		i n\"{$path}\"\n
		o f4 y0 r0 p90 v360";
		echo $this->script_path;
	        return file_put_contents($this->script_path, $script);
	    }
	    public function exec_libpano($path){
	    	$str = "/usr/local/libpano13/bin/PTmender {$this->script_path}";
	    	echo "----cube pano {$path}----\r\n";
	    	echo $str;
	    	//system($str);
	    	echo "----cube pano down {$path}----\r\n";
	    	//$this->covert();
	    }
	    public function covert(){
	    $panos = array( 'pano0005'=>'bottom',
	    	'pano0000'=>'front',
	    			'pano0001'=>'right',
	    			'pano0002'=>'back',
	    					'pano0003'=>'left',
	    					'pano0004'=>'top', );
	    					foreach($panos as $k=>$v){
	    					$old = $k.'.tif';
	    					$new = $v.'.jpg';
	    							echo "----covering tifToJpg {$old}----\n";
	    									$this->tifToJpg($old, $new);
	    									echo "----covering tifToJpg success {$old}----\n";
	    									$this->move_cube_file($new);
	    									}
	    									}
	    									public function move_cube_file($file){
	    	$explode = explode('/', $this->split_file);
	    	$num = count($explode)-2;
	    	$new_folder = $this->cube_path.'/'.$explode[$num].'/cube';
	    	$new_file = $new_folder.'/'.$file;
	    		if(!file_exists($new_folder)){
	    		mkdir($new_folder);
	    	}
	    
	    	copy($file, $new_file);
	    	unlink($file);
	    	echo "....moving to {$new_file}\n";
	    	}
	    	public function tifToJpg($old, $new){
	    	if(!file_exists($old)){
	    	$this->error[] = $old;
	    	return false;
	    	}
	    	$myimage = new Imagick($old);
	    	$myimage->setImageFormat("jpeg");
	    	$myimage->setCompressionQuality( 100 );
	    	$myimage->writeImage($new);
	    	$myimage->clear();
	    	$myimage->destroy();
	    		if(!file_exists($new)){
	    		$this->error[] = $old;
	    		return false;
	    	}
	    	}
	    	
	    	
	    	
	
	/**
	 * 获取需处理的队列
	 */
	private function get_queue_list(){
		$pano_queue = new PanoQueue();
		$queue_list = $pano_queue->get_undeal_list();
		if(!$queue_list){
			return false;
		}
		$scene_ids = array();
		foreach ($queue_list as $v){
			$scene_ids[] = $v['scene_id'];
		}
		return $scene_ids;
	}
	/**
	 * 更新队列项目状态
	 */
	private function update_item_state_lock ($scene_id){
		$pano_queue = new PanoQueue();
		return $pano_queue->update_state_locked($scene_id, 0, 0);
	}
	/**
	 * 更新队列项目锁定
	 */
	private function update_item_locked ($scene_id){
		$pano_queue = new PanoQueue();
		return $pano_queue->update_lock($scene_id, 0);
	}
	
	/**
	 * 获取需处理图片
	 */
	private function get_pano_pic_path($scene_ids){
		$scene = new Scene();
		$scene_datas = $scene->get_by_scene_ids($scene_ids);
		if(!$scene_datas){
			return false;
		}
		//print_r($scene_datas);
		$scene_file = array();
		foreach($scene_datas as $v){
			if($v['file_id']){
				$scene_file[$v['id']] = $v['file_id'];
			}
		}
		if(!$scene_file){
			return false;
		}
		$file_path = $this->get_path_by_file_ids($scene_file);
		return $this->linux_path_prefix. '/' . $file_path;
	}
	/**
	 * 获取图片地址
	 */
	private function get_path_by_file_ids ($file_ids){
		$file_path_db = new FilePath();
		$file_path = array();
		foreach($file_ids as $k=>$v){
			$file_path[$k] = $file_path_db->get_file_path($v, 'original');
		}
		return $file_path;
	}

}
?>

