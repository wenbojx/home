<?php
class AddBasicController extends Controller{

    public $defaultAction = 'a';
    public $layout = 'home';

    public function actionA(){
    	$request = Yii::app()->request;
        $datas['page']['title'] = '发布房源';
        $this->render('/manage/addBasic', array('datas'=>$datas));
    }
    public function actionAdd(){
    	$request = Yii::app()->request;
    	$id = $request->getParam('id');
    	$del = $request->getParam('del');
    	if($del != ''){
    		if($del == '0'){
    			$this->edit($id, array('is_del'=>0));
    		}
    		elseif($del == '1'){
    			$this->edit($id, array('is_del'=>1));
    		}
    		$msg['flag'] = '1';
    		$msg['id'] = $id;
    		$this->display_msg($msg);
    	}
    	
    	
    	$datas['biaoti'] = $request->getParam('biaoti');
    	$datas['mianji'] = $request->getParam('mianji');
    	$datas['jiage'] = $request->getParam('jiage');
    	if(!$datas['biaoti'] || !$datas['mianji'] || !$datas['jiage']){
    		$msg['flag'] = '0';
    		$this->display_msg($msg);
    	}
    	$datas['shi'] = $request->getParam('shi');
    	$datas['ting'] = $request->getParam('ting');
    	$datas['wei'] = $request->getParam('wei');
    	$datas['shoumai'] = $request->getParam('shoumai');
    	$datas['zhuangxiu'] = $request->getParam('zhuangxiu');
    	$datas['guanjianci'] = $request->getParam('guanjianci');
    	$datas['desc'] = $request->getParam('desc');
    	if($id){
    		$this->check_fang_own($id);
    		if(!$this->edit($id, $datas)){
    			$msg['flag'] = '0';
	    		$this->display_msg($msg);
    		}
    	}
    	else{
	    	if(!$id = $this->add($datas)){
	    		$msg['flag'] = '0';
	    		$this->display_msg($msg);
	    	}
    	}
    	$msg['flag'] = '1';
    	$msg['id'] = $id;
    	$this->display_msg($msg);
    }
    public function add($datas){
    	$datas['mid'] = $this->member_id;
    	$addFang_db = new Fang();
    	return $addFang_db->addFang($datas);
    }
    private function edit($id, $datas){
    	$addFang_db = new Fang();
    	return $addFang_db->editFang($id, $datas);
    }
    public function actionEdit(){
    	$request = Yii::app()->request;
    	$id = $request->getParam('id');
    	$this->check_fang_own($id);
    	$datas['info'] = $this->getFangInfo($id);
    	//print_r($datas);
    	$datas['page']['title'] = '编辑房源';
    	$this->render('/manage/addBasic', array('datas'=>$datas));
    }
    private function getFangInfo($id){
    	if(!$id){
    		return false;
    	}
    	$fang_db = new Fang();
    	return $fang_db->getFangInfo($id);
    }
    
    
    
    
    
}






