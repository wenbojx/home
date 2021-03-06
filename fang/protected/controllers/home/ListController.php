<?php
class ListController extends FController{

    public $defaultAction = 'a';
    public $layout = 'home';
    private $page_size = 5;
    public $page_next = true; //是否有下页
    private $id = 0;

    public function actionA(){
    	$request = Yii::app()->request;
    	$this->id = $request->getParam('id');
    	$datas['id'] = $this->id;
    	//echo $this->id;
    	
    	$page = $request->getParam('page')?$request->getParam('page'):1;
    	$datas['back_hide'] = false;
    	if($page == '1'){
    		$datas['back_hide'] = true;
    	}
    	$datas['fangDatas'] = $this->getFangList($page);
    	if($datas['fangDatas']){
    		$ids = array_keys($datas['fangDatas']);
    		$datas['pic'] = $this->getFangPic($ids);
    	}

    	$datas['page_next'] = $this->page_next;
    	$datas['page'] = $page+1;
    	$datas['back'] = $page==1?false:true;
    	$datas['member_id'] = $this->member_id;
    	
        $datas['pages']['title'] = '房源列表';
        $this->render('/home/list', array('datas'=>$datas));
    }
    private function getFangPic($ids){
    	if(!$ids){
    		return false;
    	}
    	//print_r($ids);
    	$fangPic_db = new FangPic();
    	return $fangPic_db->getByFids($ids);
    }
    private function getFangList($page){
    	$datas = array();
    	$fang_db = new Fang();
    
    	$total = $fang_db->getFangnum($this->id, '0');
    	$page_num = ceil($total/$this->page_size);
    	if($page_num<2 || $page_num == $page){
    		$this->page_next = false;
    	}
    	if($total>0){
    		$offset = ($page-1)*$this->page_size;
    		//获取场景信息
    		$Fangdatas = $fang_db->getFangList($this->id, 0, $this->page_size, $offset);
    	}
    	//print_r($Fangdatas);
    	if($Fangdatas){
    		$datas = $Fangdatas;
    	}
    	return $datas;
    }
}




