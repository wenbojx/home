<?php
class PanoramAdminDatas{
    public $hotspots_info = array(); //热点信息
    public $scenes_info = array(); //当前场景包含的所有全景
    public $self_hotspots = array(); // 当前场景的热点
    public $pano_thumb_size = '240x120'; //全景图缩略图尺寸
    public $hotspots_num = 5;
    public $panoram_pre = 'pano_';
    public $hotspot_pre = 'hotspot_';
    public $link_open_pre = 'link_open_';
    public $link_open_id_pre = 'link_pano_';
    public $edit_hotspot_pre = 'edit_hotspot_';
    public $edit_imghotspot_pre = 'edit_imghotspot_';
    public $edit_hotspot_js_pre = 'edit_hotspot_js_';
    public $edit_imghotspot_js_pre = 'edit_imghotspot_js_';
    public $module_type_link_open = 70; //link_open默认type值
    public $module_type_button_bar = 10; //button_bar默认type值
    public $module_type_menu_scroller = 40; //MenuScroller默认type值
    public $module_type_img_button = 20; //MenuScroller默认type值
    public $module_type_jsgateway = 60; //jsgateway默认type值
    public $module_type_infoBubble = 30; //infoBubble默认type值
    public $prifix_js_id = 'js_'; //js模块ID前缀
    public $js_hotspot_loading = 'js_action_loading';
    public $js_hotspot_loaded = 'js_action_loaded';

    //public $actions_pre = 'act_';
    private $scene_id = 0;
    public $modules_datas = array(); //模块数据
    public $action_datas = array(); //动作数据
    public $global_datas = array(); //全局数据
    public $panoram_datas = array(); //图片数据
    public function get_panoram_datas($id = 0){
        $datas = array();
        if(!(int)$id){
            return $datas;
        }
        $this->scene_id = $id;
        $this->get_global_info();
        $this->get_panorams_info();
        $this->get_modules_info();
        $this->get_actions_info();
        $datas['global'] = $this->global_datas;
        $datas['panorams'] = $this->panoram_datas;
        $datas['modules'] = $this->modules_datas;
        $datas['actions'] = $this->action_datas;
        return $datas;
        //return $this->modules_datas;
    }
    /**
     * 获取global信息
     */
    private function get_global_info(){
        $global_obj = new ScenesGlobal();
        $datas = $global_obj->find_by_scene_id($this->scene_id);
        if($datas['content']){
            $this->global_datas = @json_decode($datas['content'], true);
        }
        if(!isset($this->global_datas['s_attribute']['debug'])){
            $this->global_datas['s_attribute']['debug'] = 'false';
        }
        // $this->global_datas['control']['s_attribute']['autorotation'] = 'enabled:false';
        $this->global_datas['branding']['s_attribute']['visible'] = 'false';
        $this->global_datas['panoramas']['s_attribute']['firstPanorama'] = $this->panoram_pre.$this->scene_id;
        return $this->global_datas;
    }
    /**
     * 获取actions信息
     */
    public function get_actions_info(){
        //$actions_datas = array();
        return $this->action_datas;
    }
    /**
     *
     */
    public function add_single_action($id, $content){
        $this->action_datas[$id]['s_attribute']['id'] = $id;
        $this->action_datas[$id]['s_attribute']['content'] = $content;
        return $this->action_datas[$id];
    }
    /**
     * 场景xml文件地址
     */
    public function panoram_xml_path($id){
    	$key = $id%2 == 0? '0':'1';
    	//$key = 0;
    	//$pic_tools_obj = new PicTools();
    	//$tag = $pic_tools_obj->get_scene_file_tag($id);
        return PicTools::get_pano_path($id) . '/s_f.xml';
    	//return PicTools::get_img_domain($key).'/salado/index/b/id/'.$id.'/tag/'.$tag.'/s_f.xml';
    }
    /**
     * 获取场景全景数信息
     */
    private function get_panorams_info(){
        $scene_id = $this->scene_id;
        //获取场景热点
        $hotspot_db = new ScenesHotspot();
        $hotspot_datas = $hotspot_db->find_by_scene_id($scene_id);
        if($hotspot_datas){
            foreach ($hotspot_datas as $v){
                $hotspots[] = $v['link_scene_id'];
                $this->self_hotspots = $hotspots;
            }
        }
        $datas = array();
        //获取场景基本信息
        $panoram_db = new ScenesPanoram();
        $hotspots[] = $scene_id; //加入当前的全景ID
        $this->scenes_info = $hotspots;
        //获取全景图的属性信息
        $panoram_datas = $panoram_db->find_by_scene_ids($hotspots);
        //解析全景图信息
        foreach ($hotspots as $v){
            $pano_attribute = array();
            $datas[$v]['s_attribute']['id'] = $this->panoram_pre.$v;
            $datas[$v]['s_attribute']['path'] = $this->panoram_xml_path($v);
            $datas[$v]['s_attribute']['onEnter'] = 'js_action_loaded';
            //$datas[$v]['s_attribute']['onEnter'] = 'onEnterPano';
            //$datas[$v]['s_attribute']['onTransitionEnd'] = 'onTransitionEnd';
            if(isset($panoram_datas[$v])){
                if (isset($panoram_datas[$v]['content']) && $panoram_datas[$v]['content']){
                    $pano_attribute = @json_decode($panoram_datas[$v]['content'],true);
                }
                if (is_array($pano_attribute) && isset($pano_attribute['s_attribute'])){
                    $datas[$v]['s_attribute'] = array_merge($datas[$v]['s_attribute'], $pano_attribute['s_attribute']);
                }
            }
        }
        $hotspot_db = new ScenesHotspot();
        $hotspot_datas = $hotspot_db->find_by_scene_ids($hotspots);
        //print_r($hotspot_datas);
        $hotspots_info = array(); //所有场景的热点信息
        if($hotspot_datas){
            foreach ($hotspot_datas as $v){
                $scene_id_snap = $v['scene_id'];
                $hotspots_info[$v['id']]['scene_id'] = $v['scene_id'];
                $hotspots_info[$v['id']]['link_scene_id'] = $v['link_scene_id'];
                $hotspots_info[$v['id']]['type'] = $v['type'];
                $datas[$scene_id_snap]['hotspots'][$v['id']] = $this->get_hotspot_info($v);
            }
        }
        $this->hotspots_info = $hotspots_info;
        //print_r($hotspots_info);
        if($hotspots_info){
            $this->add_hotspot_action($hotspots_info, $scene_id);
        }

        $this->panoram_datas = $datas;
        return $datas;
    }
    /**
     * 添加hotspot模块的action
     */
    public function add_hotspot_action($hotspots_info, $scene_id){
    	//print_r($hotspots_info);
        foreach($hotspots_info as $k=>$v){
            /* if (in_array($v['link_scene_id'], $this->scenes_info)){
                $id = $this->edit_hotspot_pre.$v['link_scene_id'];
                //添加外部JS loading事件
                $content = "SaladoPlayer.advancedMoveToHotspot({$this->hotspot_pre}$k,50,40,Expo.easeIn)";
                $content .= ';JSGateway.run(jsf_hotspot_loading)';
                $content .= ';SaladoPlayer.loadPano('.$this->panoram_pre.$v['link_scene_id'].')';

            }
            else{
                $id = $this->link_open_id_pre.$v['link_scene_id'];
                $content = 'LinkOpener.open('.$this->link_open_pre.$v['link_scene_id'].')';

            } */
        	
            $id = $this->edit_hotspot_pre.$k;
            $content = "JSGateway.run({$this->edit_hotspot_js_pre}{$k})";
            if($v['type'] == 4){
            	$id = $this->edit_imghotspot_pre.$k;
            	$content = "JSGateway.run({$this->edit_imghotspot_js_pre}{$k})";
            }
            
            $this->add_single_action($id, $content);
            
            
            //添加js function
            $id = $this->edit_hotspot_js_pre.$k;
            $name = 'edit_hotspot';
            if($v['type'] == 4){
            	$name = 'edit_imghotspot';
            	$id = $this->edit_imghotspot_js_pre.$k;
            }
            $text = $k;
            $this->add_single_js_fun($id, $id, $name, $text);
        }
        return $this->action_datas;
    }
    /**
     * 处理hotspot数据
     */
    public function get_hotspot_info($datas){
        $hotspot = array();
        $hotspot_attribute = array();
        $hotspot['type'] = $datas['type'] ? $datas['type'] : 2;
        $hotspot['link_scene_id'] = $datas['link_scene_id'];
        $hotspot['s_attribute']['id'] = $this->hotspot_pre.$datas['id'];
        //$datas['fov'] = $datas['fov'] < 10 ? 90 : $datas['fov'];
        $hotspot['s_attribute']['location'] = "pan:{$datas['pan']},tilt:{$datas['tilt']}";

        if ($datas['content']){
            $hotspot_attribute = @json_decode($datas['content'],true);
        }
        //如果hotspot的链接在本场景内则load_pano
        $mouse = 'onClick:'.$this->edit_hotspot_pre.$datas['id'];
        if($hotspot['type'] == 4){
        	$mouse = 'onClick:'.$this->edit_imghotspot_pre.$datas['id'];
        }
        //合并属性
        if(is_array($hotspot_attribute) && isset($hotspot_attribute['s_attribute']['mouse']) && $hotspot_attribute['s_attribute']['mouse']){
            $hotspot_attribute['s_attribute']['mouse'] .= ','.$mouse;
        }
        else{
            $hotspot_attribute['s_attribute']['mouse'] = $mouse;
        }
        if (is_array($hotspot_attribute) && $hotspot_attribute['s_attribute']){
            $hotspot['s_attribute'] = array_merge($hotspot['s_attribute'], $hotspot_attribute['s_attribute']);
        }
        //热点类型；
        if ($datas['type'] == '1'){
            $hotspot['s_attribute']['path'] = $this->module_hotspot_path($datas['transform']);
        }
        elseif ($datas['type'] == '2'){
            $hotspot['s_attribute']['path'] = $this->module_path('Hotspot');
            $hotspot['settings']['s_attribute']['path'] = $this->module_hotspot_path($datas['transform']);
            $hotspot['settings']['s_attribute']['beatUp'] = 'scale:0.7';
            $hotspot['settings']['s_attribute']['mouseOver'] = 'scale:1.1';
        }
        elseif ($datas['type'] == '4'){
        	$hotspot['s_attribute']['path'] = $this->module_path('Hotspot');
        	$hotspot['settings']['s_attribute']['path'] = $this->module_imghotspot_path($datas['transform']);
        	$hotspot['settings']['s_attribute']['beatUp'] = 'scale:0.7';
        	$hotspot['settings']['s_attribute']['mouseOver'] = 'scale:1.1';
        }
        return $hotspot;
    }
    /**
     * 模块地址
     */
    public function module_path($name){
        $path['LinkOpener'] = Yii::app()->baseUrl.'/pages/salado/modules/LinkOpener.swf';
        $path['Hotspot'] = Yii::app()->baseUrl.'/pages/salado/modules/AdvancedHotspot.swf';
        $path['ButtonBar'] = Yii::app()->baseUrl.'/pages/salado/modules/ButtonBar.swf';
        $path['MenuScroller'] = Yii::app()->baseUrl.'/pages/salado/modules/MenuScroller.swf';
        $path['ImageButton'] = Yii::app()->baseUrl.'/pages/salado/modules/ImageButton.swf';
        $path['JSGateway'] = Yii::app()->baseUrl.'/pages/salado/modules/JSGateway.swf';
        $path['InfoBubble'] = Yii::app()->baseUrl.'/pages/salado/modules/InfoBubble.swf';
        if(!isset($path[$name])){
            return '';
        }
        return $path[$name];
    }
    /**
     * 模块默认素材地址
     */
    public function module_media_path($name){
        $path['button_bar'] = Yii::app()->baseUrl.'/pages/salado/media/buttons_dark_30x30.png';
        $path['menu_scroller_show_btn'] = Yii::app()->baseUrl.'/pages/salado/media/MenuScroller_show.png';
        $path['menu_scroller_hide_btn'] = Yii::app()->baseUrl.'/pages/salado/media/MenuScroller_hide.png';
        if(!isset($path[$name])){
            return '';
        }
        return $path[$name];
    }
    /**
     * 热点素材地址
     */
    public function module_hotspot_path($num=10){
    	$path = Yii::app()->baseUrl.'/style/img/hotspot/hotspot-'.$num.'.png';
    	return $path;
    }
    public function module_imghotspot_path($num=10){
    	$path = Yii::app()->baseUrl.'/style/img/imghotspot.png';
    	return $path;
    }
    /**
     * 全景图缩略图地址
     */
    public function pano_thumb_path($id){
        //return Yii::app()->baseUrl.'/pages/images/thumbs/1.jpg';
        return Yii::app()->createUrl('/panos/thumb/pic/', array('id'=>$id, 'size'=>$this->pano_thumb_size.'.jpg'));
    }
    /**
     * 全景图显示地址
     */
    public function get_pano_address($id){
    	return Yii::app()->createUrl('/pano/salado/edit/', array('id'=>$id));
    }
    /**
     * 获取modules信息
     */
    public function get_modules_info(){
        $scene_id = $this->scene_id;
        $this->get_module_list($scene_id);
        return $this->modules_datas;
    }
    /**
     * 获取场景使用的模块
     * @param int $id
     */
    public function get_module_list($scene_id){
        $module_db = new ScenesModule();
        $datas = $module_db->find_by_scene_id($scene_id);
        $no_button_bar = true;
        $no_menuscroller = true;
        if (is_array($datas)){
            foreach($datas as $v){
                if($v['content']){
                    $this->modules_datas[$v['type']] = @json_decode($v['content'], true);
                    //是否含有button_bar
                    if($v['type'] == $this->module_type_link_open){
                        $no_button_bar = false;
                    }
                    //是否含menu_scroller
                    if($v['type'] == $this->module_type_menu_scroller){
                        $no_menuscroller = false;
                    }
                }
            }
        }
        //$this->add_menuscroller_extend();
        if($no_menuscroller){
            //$this->get_default_menu_scroller($scene_id);
        }
        //添加js模块
        $this->get_js_gateway_module();
        if($no_button_bar){
            //获取默认button_bar
            $this->get_default_button_bar();
        }
        return $this->modules_datas;
    }
    /**
     * js gateway模块
     */
    public function get_js_gateway_module(){
        $type = $this->module_type_jsgateway;
        $this->modules_datas[$type]['s_attribute']['path'] = $this->module_path('JSGateway');
        $this->modules_datas[$type]['settings']['s_attribute']['callOnEnter'] = 'true';
        $this->modules_datas[$type]['settings']['s_attribute']['callOnTransitionEnd'] = 'true';
        $this->modules_datas[$type]['settings']['s_attribute']['callOnMoveEnd'] = 'true';
        $this->modules_datas[$type]['settings']['s_attribute']['callOnViewChange'] = 'true';

        return $this->modules_datas[$type];
    }
    /**
     * 添加单个js function
     */
    private function add_single_js_fun( $key, $id, $name, $text){
    	$type = $this->module_type_jsgateway;
    	$this->modules_datas[$type]['jsfunctions'][$key]['s_attribute']['id'] = $id;
    	$this->modules_datas[$type]['jsfunctions'][$key]['s_attribute']['name'] = $name;
    	$this->modules_datas[$type]['jsfunctions'][$key]['s_attribute']['text'] = $text;
    }
    /**
     * menu_scoller附加信息
     */
    public function add_menuscroller_extend(){
        $this->add_img_button_for_menu_scoller();
        $this->add_action_for_menu_scoller();
    }
    /**
     * 添加menu_scoller的按钮及action
     */
    public function add_img_button_for_menu_scoller(){
        $id = 'buttonMenuScroller_show';
        $path = $this->module_media_path('menu_scroller_show_btn');
        $action = 'menuScrollerOpen';
        $window['align'] = 'vertical:bottom,horizontal:right';
        $window['move'] = 'horizontal:-216,vertical:-6';
        $window['open'] = 'true';
        $this->add_single_img_button($id, $path, $action, $window);
        $id = 'buttonMenuScroller_hide';
        $path = $this->module_media_path('menu_scroller_hide_btn');
        $action = 'menuScrollerClose';
        $window['open'] = 'false';
        $this->add_single_img_button($id, $path,$action, $window);
    }
    public function add_action_for_menu_scoller(){
        $id = 'menuScrollerOpen';
        $content = 'MenuScroller.setOpen(true);ImageButton.setOpen(buttonMenuScroller_show,false);ImageButton.setOpen(buttonMenuScroller_hide,true)';
        $this->add_single_action($id, $content);
        $id = 'menuScrollerClose';
        $content = 'MenuScroller.setOpen(false);ImageButton.setOpen(buttonMenuScroller_show,true);ImageButton.setOpen(buttonMenuScroller_hide,true)';
        $this->add_single_action($id, $content);
        return false;
    }
    public $img_button_id_num = 100;
    /**
     * 添加单个img_button
     */
    public function add_single_img_button($id, $path, $action, $windows){
        $type = $this->module_type_img_button;
        if (!isset($this->modules_datas[$type]['s_attribute']['path'])){
            $this->modules_datas[$type]['s_attribute']['path'] = $this->module_path('ImageButton');
        }
        $num = $this->img_button_id_num;
        $this->modules_datas[$type]['buttons'][$num]['s_attribute']['id'] = $id;
        $this->modules_datas[$type]['buttons'][$num]['s_attribute']['path'] = $path;
        $this->modules_datas[$type]['buttons'][$num]['s_attribute']['action'] = $action;
        $this->modules_datas[$type]['buttons'][$num]['window']['s_attribute'] = $windows;
        $this->img_button_id_num++;
        return $this->modules_datas[$type];
    }
    /**
     * 获取默认menu_scroller
     */
    public function get_default_menu_scroller($scene_id){
        $type = $this->module_type_menu_scroller;
        $extend_panos = $this->get_extend_panos($scene_id);
        if(!$extend_panos){
            return false;
        }
        //print_r($extend_panos);
        $menu['s_attribute']['path'] = $this->module_path('MenuScroller');
        $menu['window']['s_attribute']['size'] = 'width:440,height:90';
        $menu['window']['s_attribute']['open'] = 'false';
        $menu['window']['s_attribute']['alpha'] = '0.5';
        $menu['window']['s_attribute']['align'] = 'horizontal:left,vertical:bottom';
        $menu['window']['s_attribute']['transition'] = 'type:slideLeft';

        $menu['scroller']['s_attribute']['scrollsVertical'] = 'false';
        $menu['scroller']['s_attribute']['sizeLimit'] = '70';
        if(is_array($extend_panos)){
            foreach($extend_panos as $k=>$v){
                if (in_array($v, $this->scenes_info)){
                    $menu['elements'][$k]['s_attribute']['target'] = $this->panoram_pre.$v;
                    $menu['elements'][$k]['s_attribute']['path'] = $this->pano_thumb_path($v);
                }
                else{
                    $menu['extraElements'][$k]['s_attribute']['id'] = 'extra_'.$k;
                    $menu['extraElements'][$k]['s_attribute']['path'] = $this->pano_thumb_path($v);
                    $menu['extraElements'][$k]['s_attribute']['action'] = $this->link_open_id_pre.$v;
                    $id = $this->link_open_id_pre.$v;
                    $this->action_datas[$id]['s_attribute']['id'] = $id;
                    $this->action_datas[$id]['s_attribute']['content'] = 'LinkOpener.open('.$this->link_open_pre.$v.')';
                    $this->add_signle_link_open($v);
                }
            }
        }
        //print_r($menu);
        $this->modules_datas[$type] = $menu;
    }
    /**
     * 获取相邻的场景
     */
    public function get_extend_panos($scene_id){
        $all_hotspots = array();
        if(is_array($this->hotspots_info)){
            foreach($this->hotspots_info as $v){
                if($v['link_scene_id'] != $scene_id){
                    $all_hotspots[] = $v['link_scene_id'];
                }
            }
            $all_hotspots = array_unique($all_hotspots);
        }
        $limit = $this->hotspots_num-count($all_hotspots);
        if($limit>0){
            $scene_db = new Scene();
            $panorams = $scene_db->find_extend_scene($scene_id, $all_hotspots, $limit);
            if($panorams){
                foreach($panorams as $v){
                    $all_hotspots[] = $v['id'];
                }
            }
        }
        return $all_hotspots;
    }
    /**
     * 获取默认的button_bar
     */
    public function get_default_button_bar(){
        $type = $this->module_type_button_bar;
        $this->modules_datas[$type]['s_attribute']['path'] = $this->module_path('ButtonBar');
        $this->modules_datas[$type]['window']['s_attribute']['align'] = 'horizontal:right,vertical:bottom';
        $this->modules_datas[$type]['buttons']['s_attribute']['path'] = $this->module_media_path('button_bar');
        $this->modules_datas[$type]['buttons']['button']['1']['s_attribute']['name'] = 'autorotation';
        //$this->modules_datas[$type]['buttons']['button']['2']['s_attribute']['name'] = 'left';
        //$this->modules_datas[$type]['buttons']['button']['3']['s_attribute']['name'] = 'right';
        //$this->modules_datas[$type]['buttons']['button']['4']['s_attribute']['name'] = 'down';
        //$this->modules_datas[$type]['buttons']['button']['5']['s_attribute']['name'] = 'up';
        $this->modules_datas[$type]['buttons']['button']['6']['s_attribute']['name'] = 'out';
        $this->modules_datas[$type]['buttons']['button']['7']['s_attribute']['name'] = 'in';
        $this->modules_datas[$type]['buttons']['button']['8']['s_attribute']['name'] = 'fullscreen';
        return $this->modules_datas[$type];
    }
    protected $extra_button_id_num = 1; //
    /**
    * 添加单个extra_button
    */
    public function add_single_extra_button($name, $action){
        $type = $this->module_type_button_bar;
        $num = $this->extra_button_id_num;
        $this->modules_datas[$type]['buttons']['extraButton'][$num]['s_attribute']['name'] = $name;
        $this->modules_datas[$type]['buttons']['extraButton'][$num]['s_attribute']['action'] = $action;
        $this->extra_button_id_num++;
    }
}

