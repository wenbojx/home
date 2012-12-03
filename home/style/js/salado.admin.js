$(document).ready(function() {
    bind_pano_btn();
})
function bind_pano_btn(){
    $('#btn_review').bind('click',function(){
        clean_pano_cache();
    });
    $('#btn_upload').bind('click',function(){
        load_page(upload_pano_url);
    });
    $('#btn_position').bind('click',function(){
        load_page(position_url);
    });
    $('#btn_thumb').bind('click',function(){
        load_page(thumb_url);
    });
    $('#btn_camera').bind('click',function(){
        load_page(camera_url);
    });
    $('#btn_map').bind('click',function(){
        load_page(map_url);
    });
    $('#btn_hotspot').bind('click',function(){
        load_page(hotspot_url);
        hotspot_click();
    });
    $('#btn_preview').bind('click',function(){
        jump_to(preview_url, 'blank');
    });
}
function clean_pano_cache(){
     window.location.href= clean_url;
}
function load_page(url){
    var ajax = {url: url, type: 'GET', dataType: 'html', cache: false, success: function(html) {
                $("#panel_box").html(html);
                show_edit_panel();
                return true;
            }
        };
    $.ajax(ajax);
}
function hide_edit_panel(){
    $('#edit_panel').hide();
}
function show_edit_panel(){
    $('#edit_panel').show();
}

function thumb_box_upload(){
    var post_datas = {'scene_id':scene_id,'from':'thumb_pic','SESSION_ID':session_id};
    $("#thumb_box_upload").uploadify({
        'swf': flash_url,
        'uploader': thumb_upload_url,
        'formData': post_datas,
        //'uploadLimit':1,
        'buttonText':'上传缩略图',
        'debug':false,
        'width':42,
        'height':19,
        'fileSizeLimit':'5120KB',
        'fileTypeDesc' : 'jpg,png,gif格式',
        'fileTypeExts':'*.jpg;*.png;*.gif;',
        'buttonImage':thumb_button_img,
        'multi': false,
        'removeTimeout':1,
        'auto': true,
        'onSelectError':function(file){
        },
        'onUploadError':function(file){
        },
        'onUploadSuccess':function(file, data, response){
            var dataObj = eval("("+data+")");
            if(dataObj.flag == '0'){
                alert(dataObj.msg);
            }
            else if(response>0){
                var url = pic_url+'/id/'+dataObj.file+'/size/200x100.jpg';
                var img_str = '<img width="200" height="100" src="'+url+'"/>';
                $("#thumb_img").html(img_str);
            }
        }
    });
}
var marker_obj = null;
function show_marker_comfirm(){
	$('#pano_marker').show();
	$('#marker_confirm').show();
	$("#marker_delete").hide();
	$("#marker_save").hide();
}
function save_marker(){
	var top = $(marker_obj).css('top');
	var left =  $(marker_obj).css('left');
	
	var msg = {};
    msg.error = '操作失败';
    msg.success = '操作成功';
    var data = {};
    data.scene_id = scene_id;
    data.map_id = map_id;
    data.top = top.replace('px','');
    data.left = left.replace('px','');

    if(!data.map_id || !data.scene_id){
    	alert('参数错误');
    	return false;
    }
    var url = save_map_marker_url+'/save/';
    save_datas(url, data, '', '', call_back);
    function call_back(datas){
        alert(datas.msg);
    }
}
function del_marker(){
	if(!confirm("确定删除吗")){
		return false;
	}
	var data = {};
	var marker_id = $(marker_obj).attr('id');
	var id_split = marker_id.split('_');
	if(id_split[0] == 'marker'){
		del_marker_do();
		return false;
	}
	var position_id = id_split[1];
	if(!position_id){
		alert('参数错误');
		return false;
	}
	data.id = position_id;
	data.scene_id = scene_id;
	var url = save_map_marker_url+'/del/';
    save_datas(url, data, '', '', call_back);
    function call_back(datas){
    	//alert(datas.msg);
    	if(!datas.flag){
    		return false;
    	}
    	del_marker_do();
    }
}
function del_marker_do(){
	$(marker_obj).remove();
	$("#marker_save").hide();
	$("#marker_delete").hide();
}

function map_box_upload(){
    var post_datas = {'scene_id':scene_id,'from':'map_pic','SESSION_ID':session_id};
    $("#map_box_upload").uploadify({
        'swf': flash_url,
        'uploader': map_upload_url,
        'formData': post_datas,
        //'uploadLimit':1,
        'buttonText':'上传地图',
        'debug':false,
        'width':74,
        'height':28,
        'fileSizeLimit':'5120KB',
        'fileTypeDesc' : 'jpg,png,gif格式',
        'fileTypeExts':'*.jpg;*.png;*.gif;',
        'buttonImage':map_button_img,
        'multi': false,
        'removeTimeout':1,
        'auto': true,
        'onSelectError':function(file){
        },
        'onUploadError':function(file,data){
        },
        'onUploadSuccess':function(file, data, response){
            var dataObj = eval("("+data+")");
            if(dataObj.flag == '0'){
                alert(dataObj.msg);
            }
            else if(response>0){
            	map_width = dataObj.w;
            	map_height = dataObj.h;
                var url = pic_url+'/id/'+dataObj.file+'/size/'+map_width+'x'+map_height+'.'+dataObj.type;
                var img_str = '<img src="'+url+'" class="imgMap"/>';
                $("#map_tips").hide();
                $("#map_container").html(img_str);
                bind_map('scene_map');
                $("#add_marker").show();
                $("#map_container").show();
                map_id = dataObj.id;
            }
        }
    });
}
function init_box_upload( position){
    //var img_w = 800;
    //var img_h = 800;
    var img_btn_w = 120;
    var img_btn_h = 120;
    var button_img = $("#box_"+position).attr('src');
    var post_datas = {'position':position,'scene_id':scene_id,'from':'box_pic','SESSION_ID':session_id};
    $("#box_"+position).uploadify({
        'swf': flash_url,
        'uploader': script_url,
        'formData': post_datas,
        //'uploadLimit':1,
        'buttonText':'上传',
        'debug':false,
        'width':img_btn_w,
        'height':img_btn_h,
        'fileSizeLimit':'10240KB',
        'fileTypeDesc' : 'jpg,png,gif格式',
        'fileTypeExts':'*.jpg;*.png;*.gif;',
        'buttonImage':button_img,
        'multi': false,
        'removeTimeout':1,
        'auto': true,
        'onSelect':function(file){
            change_z_index(500,400);
        },
        'onSelectError':function(file){
            change_z_index(400,500);
        },
        'onUploadError':function(file){
            change_z_index(400,500);
        },
        'onUploadSuccess':function(file, data, response){
            var dataObj = eval("("+data+")");
            if(dataObj.flag == '0'){
                alert(dataObj.msg);
            }
            else if(response>0){
                var url = pic_url+'/id/'+dataObj.file+"/size/"+img_btn_w+"x"+img_btn_h+'.jpg';
                //button_img = url;
                $("#"+file.id).hide();
                var img_str = '<img width="'+img_btn_w+'" height="'+img_btn_h+'" id="box_'+position+'" src="'+url+'"/>';
                $("#box_side_"+position).html(img_str);
                init_box_upload(position);
                $("#box_"+position+"-queue").hide();
            }
            change_z_index(400,500);
        }
    });
    function change_z_index(cap1, cap2){
        $("#box_"+position+"-queue").css('z-index', cap1);
        $("#box_"+position).css('z-index', cap2);
    }
}
function hotspot_click(){
        var img_width = $("#hotspot_icon").css("width");
        var img_height = $("#hotspot_icon").css("height");
        var box_width = $("#pano-detail").css("width");
        var box_height = $("#pano-detail").css("height");
        var top = (parseInt(box_height)-parseInt(img_height) )/2;
        var left = (parseInt(box_width)-parseInt(img_width) )/2;
        $("#hotspot_icon").css("top",top+"px");
        $("#hotspot_icon").css("left",left+"px");
        $("#hotspot_icon").show();
}
function hide_hotspot_icon(){
    $("#hotspot_icon").hide();
}

function onViewChange(pan, tilt, fov, direction){
    if($("#hotspot_icon") && !$("#hotspot_icon").is(":hidden")){
        $("#hotspot_info_pan").html(pan);
        $("#hotspot_info_tilt").html(tilt);
        $("#hotspot_info_fov").html(fov);
    }
    if($("#camera-info-pan")){
        $("#camera-info-pan").html(pan);
        $("#camera-info-tilt").html(tilt);
        $("#camera-info-fov").html(fov);
    }
}
function save_position_detail(scene_id){
    var msg = {};
    msg.error = '操作失败';
    msg.success = '操作成功';
    var element_id = 'position_save_msg';
    if(!scene_id){
        done_error(element_id, msg.error);
    }
    var data = {};
    data.glng = parseFloat ($("#span_lng").html());
    data.glat = parseFloat ($("#span_lat").html());
    data.zoom = parseInt ($("#span_zoom").html());
    data.scene_id = scene_id;

    var url = save_module_datas_url+'/position/save/';
    save_datas(url, data, '', '', call_back);
    function call_back(datas){
        alert(datas.msg);
    }
}
function save_camera_detail(scene_id){
    var msg = {};
    msg.error = '操作失败';
    msg.success = '操作成功';
    var element_id = 'camera_save_msg';
    if(!scene_id){
        done_error(element_id, msg.error);
    }
    var data = {};
    data.pan = parseInt ($("#camera-info-pan").html());
    data.tilt = parseInt ($("#camera-info-tilt").html());
    data.fov = parseInt ($("#camera-info-fov").html());
    data.scene_id = scene_id;

    var url = save_module_datas_url+'/global/camera/';
    save_datas(url, data, '', '', call_back);
    function call_back(datas){
        alert(datas.msg);
    }
}

function save_hotspot_detail(scene_id){
    var msg = {};
    msg.error = '操作失败';
    msg.success = '操作成功';
    var element_id = 'hotspot_save_msg';
    if(!scene_id){
        done_error(element_id, msg.error);
    }
    var data = {};
    data.pan = parseInt ($("#hotspot_info_pan").html());
    data.tilt = parseInt ($("#hotspot_info_tilt").html());
    data.fov = parseInt ($("#hotspot_info_fov").html());
    data.type = $("#hotspot_info_d_type").val();
    data.transform = $("#hotspot_angle_select").val();
    data.link_scene_id = $("#hotspot_info_d_link_scene_id").val();
    data.scene_id = scene_id;
    if(data.link_scene_id == '0'){
    	alert('请选择目标场景');
    	return false;
    }
    var url = $("#save_hotspot").attr('action');
    save_datas(url, data, '', '', call_back);
    function call_back(datas){
        alert(datas.msg);
    }
}
function publish_scene(scene_id, display){
    var msg = {};
    msg.error = '操作失败';
    msg.success = '操作成功';
    var element_id = 'publish_scene_msg';
    if(!scene_id){
        done_error(element_id, msg.error);
    }
    var data = {};
    data.scene_id = scene_id;
    data.display = display;
    var url = scene_publish_url;
    save_datas(url, data, '', '', call_back);
    function call_back(datas){
        alert(datas.msg);
        if(display == '2' && datas.flag){
        	$("#offline_pano").show();
        	$("#online_pano").hide();
        }
        if(display == '1' && datas.flag){
        	$("#online_pano").show();
        	$("#offline_pano").hide();
        }
    }
}

function publish_project(project_id, display){
	if(!project_id){
		alert("参数错误");
		return false;
	}
    var msg = {};
    msg.error = '操作失败';
    msg.success = '操作成功';

    var data = {};
    data.project_id = project_id;
    data.display = display;
    var url = project_publish_url;
    save_datas(url, data, '', '', call_back);
    function call_back(datas){
        alert(datas.msg);
        if(display == '2' && datas.flag){
        	$("#offline_project").show();
        	$("#online_project").hide();
        }
        if(display == '1' && datas.flag){
        	$("#online_project").show();
        	$("#offline_project").hide();
        }
    }
}

function change_hotspot_select(){
    var id = $('#hotspot_info_d_link_scene_id').val();
    var url = panos_thumb_url+'/id/'+id+'/size/'+size;
    $('#hotspot_pano_thumb').attr('src', url);
}
function change_hotspot_angle(){
	var num = $("#hotspot_angle_select").val();
	var src = hotspot_img_pre+'hotspot-'+num+'.png';
	$("#hotspot_angle").attr("src", src);
	$("#hotspot_icon_img").attr("src", src);
}
function edit_hotspot(id){
	var edit_url = hotspot_edit_url+'/hotspot_id/'+id;
	load_page(edit_url);
}
function hotspot_del(hotspot_id){
	var msg = {};
    msg.error = '操作失败';
    msg.success = '操作成功';
    var element_id = 'hotspot_del_msg';
    var data = {};
    data.hotspot_id = hotspot_id;
    if(!data.hotspot_id){
    	alert('参数错误');
    	return false;
    }
    var url = $("#del_hotspot").attr('action');
    save_datas(url, data, '', '', call_back);
    function call_back(datas){
        alert(datas.msg);
    }
}

