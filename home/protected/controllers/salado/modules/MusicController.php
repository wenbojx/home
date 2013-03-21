<?php
class MusicController extends Controller{
	public $defaultAction = 'save';
    public function actionSave(){
        $request = Yii::app()->request;
        $datas['scene_id'] = $request->getParam('scene_id');
        $datas['file_id'] = $request->getParam('file_id');
        $datas['loop'] = $request->getParam('loop')?$request->getParam('loop'):0;
        $datas['volume'] = $request->getParam('volume')?$request->getParam('volume'):0.5;
        $datas['state'] = $request->getParam('state');
        $datas['music_id'] = $request->getParam('music_id');
        $this->check_scene_own($datas['scene_id']);
        $msg['flag'] = 0;
        $msg['msg'] = '操作失败';
        if(!$datas['file_id'] || !$datas['scene_id']){
        	$this->display_msg($msg);
        }
        $id = $this->save_scene_music($datas);
        //echo $id;
        if(!$id){
        	$this->display_msg($msg);
        }
        $msg['flag'] = 1;
        $msg['msg'] = '操作成功';
        $msg['id'] = $id;
        $this->display_msg($msg);
    }
    private function save_scene_music($datas){
    	$scene_music_db = new MpSceneMusic();
    	$datas['volume'] = $datas['volume']*10;
    	return $scene_music_db->save_datas($datas);
    }
    
}