
var member = {};
member.login = function(){
	//member.login_clear();
    if($("#username").val() == "" || $("#passwd").val() == "" ){
    	$("#login_tip_flag").show();
    }
	
    var url = $("#member_login").attr('action');
    var datas = {'username':$("#username").val(), 'passwd':$("#passwd").val()};

    save_datas(url, datas, 'post', 'json' ,do_after);

    function do_after(datas){
    	if(datas.flag =='1'){
    		$("#login_tip_flag").show();
            $("#login_tip_flag").html('登陆成功');
            //var login_jump_url = "/manage/list";
            jump_to(login_jump_url);
        }
        else{
        	$("#login_tip_flag").show();
        }
    }
}

function showStep1(){
	if($("#step1").is(":hidden")){
		$("#step1").show();
		//$("#step2").hide();
	}
	else{
		$("#step1").hide();
	}
}
function showStep2(){
	if($("#step2").is(":hidden")){
		$("#step2").show();
		//$("#step1").hide();
	}
	else{
		$("#step2").hide();
	}
}
function itemBindClick(){
	$("#step2 dt").click(function(){
		var item_id = $(this).next().attr("id");
		$("#step2 dt").each(function(k,v){
			var item = $(this).next().attr("id");
			
			if(item != item_id){
				$(this).next().hide();
			}
			else{
				if($(this).next().is(":hidden")){
					$(this).next().show();
					if(item == "item6"){
						show_map();
					}
				}
				else{
					$(this).next().hide();
				}
			}
		});
	});
}

function image_box_upload(){
    var post_datas = {'from':'image_pic','SESSION_ID':session_id};
    $("#image_box_upload").uploadify({
        'swf': flash_url,
        'uploader': image_upload_url,
        'formData': post_datas,
        'uploadLimit':1,
        'buttonText':'上传图片',
        'debug':false,
        'width':70,
        'height':28,
        'fileSizeLimit':'2048KB',
        'fileTypeDesc' : 'jpg,png,gif格式',
        'fileTypeExts':'*.jpg;*.png;*.gif;',
        'buttonImage':image_button_img,
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

            }
        }
    });
}

function album_box_upload(){
	var project_id = $("#project_id").val();
    var post_datas = {'from':'album_pic', 'project_id':project_id, 'SESSION_ID':session_id};

    $("#album_box_upload").uploadify({
        'swf': flash_url,
        'uploader': image_upload_url,
        'formData': post_datas,
        'uploadLimit':10,
        'buttonText':'上传图片',
        'debug':false,
        'width':70,
        'height':28,
        'fileSizeLimit':'5120KB',
        'fileTypeDesc' : 'jpg,png,gif格式',
        'fileTypeExts':'*.jpg;*.png;*.gif;',
        'buttonImage':image_button_img,
        'multi': true,
        'removeTimeout':1,
        'auto': true,
        'onSelectError':function(file){
        },
        'onUploadError':function(file,data){
        	alert('出错了');
        },
        'onUploadSuccess':function(file, data, response){
            var dataObj = eval("("+data+")");
            if(dataObj.flag == '0'){
                alert(dataObj.msg);
            }
            else if(response>0){
            	var id = dataObj.id;
            	if(!id){
            		alert("参数错误");
            		return false;
            	}
            	var url = '/'+dataObj.path+"/w"+thumb_img_width+"."+dataObj.ftype;
            	var html = '<div class="album_pic" id="album_'+id+'"><img src="'+url+'"/>';
            	html += '<span id="album_pic_'+id+'">相片简介</span>';
            	html += '<span><a id="pic_edit_'+id+'" onclick="editPic('+id+')">编辑</a>';
            	html += '<a id="pic_save_'+id+'" style="display:none" onclick="savePic('+id+',\'desc\')">保存</a>';
            	html += '&nbsp;&nbsp;&nbsp;&nbsp;';
            	html += '<a onclick="savePic('+id+',\'del\')">删除</a>';
            	html += '</span></div>';
            	$("#album_box").append(html);
            }
        }
    });
}

function initMap(id){
	map = new BMap.Map(id);                        // 创建Map实例
	map.centerAndZoom(new BMap.Point(point.lat, point.lng), 12);     // 初始化地图,设置中心点坐标和地图级别
	map.addControl(new BMap.NavigationControl());               // 添加平移缩放控件
	map.addControl(new BMap.ScaleControl());                    // 添加比例尺控件
	map.addControl(new BMap.OverviewMapControl());              //添加缩略地图控件
	map.enableScrollWheelZoom();                            //启用滚轮放大缩小
	map.addControl(new BMap.MapTypeControl());          //添加地图类型控件
	map.setCurrentCity("上海");          // 设置地图显示的城市 此项是必须设置的
}
function searchMap(){
	var address = $("#map_search").val();
	//$.fn.baidumap.location(address);
	var local = new BMap.LocalSearch(map, {
		  renderOptions:{map: map}
	});
	local.search(address);
}
function addContextMenu(){
	var contextMenu = new BMap.ContextMenu();
	contextMenu.addItem(new BMap.MenuItem("添加标记点",
			createMarker));
	map.addContextMenu(contextMenu);
	return contextMenu;
}
function createMarker(point){
	marker = new BMap.Marker(point);
	map.addOverlay(marker);
	marker.enableDragging();
	return marker;
}
function myFun(result){
    var cityName = result.name;
    map.setCenter(cityName);
}
function show_map(){
	initMap('map_canvas');
	var point_marker = new BMap.Point(point.lng, point.lat);
	var setCenter = true;
	if(!point.lat){
		var myCity = new BMap.LocalCity();
		myCity.get(myFun);
	}
	else{
			map.addEventListener("tilesloaded",function(){//加载完成时,触发
				if(setCenter){
					map.centerAndZoom(point_marker,point.zoom);
					setCenter = false;
				}
			});
			marker = createMarker(point_marker);

	}
	if(!marker){
		addContextMenu();
	}
}
function saveBsic(){
	/*if(!confirm("确定要删除吗？")){
		return false;
	}*/
	datas = {};
	/*datas.member_id = $("#member_id").val();
	if(!datas.member_id){
		alert("参数错误");
		return false;
	}*/
	datas.id = $("#project_id").val();
	datas.name = $("#name").val();
	if(!datas.name){
		alert("请输入标题");
		return false;
	}
	datas.tab1 = $("#tab1").val();
	if(!datas.tab1){
		alert("请输入栏位一内容");
		return false;
	}
	datas.tab2 = $("#tab2").val();
	if(!datas.tab2){
		alert("请输入栏位二内容");
		return false;
	}
	datas.tab3 = $("#tab3").val();
	if(!datas.tab3){
		alert("请输入栏位三内容");
		return false;
	}
	datas.tab4 = $("#tab4").val();
	if(!datas.tab4){
		alert("请输入栏位四内容");
		return false;
	}
	datas.tab5 = $("#tab5").val();
	if(!datas.tab5){
		alert("请输入栏位五内容");
		return false;
	}
	datas.tab6 = $("#tab6").val();
	if(!datas.tab6){
		alert("请输入栏位六内容");
		return false;
	}
	var url = $("#manage_basic").attr('action');

    save_datas(url, datas, 'post', 'json' ,do_after);
    function do_after(datas){
    	if(datas.flag =='1' && datas.id){
    		$("#basic_tip_flag").show();
            $("#basic_tip_flag").html('操作成功');
            var addbase_jump_url = edit_jump_url+ "/id/"+$("#project_id").val();
            if(datas.id){
            	addbase_jump_url = edit_jump_url+ "/id/"+datas.id;
            }
            
            jump_to(addbase_jump_url);
        }
        else{
        	$("#basic_tip_flag").html("发生错误");
        	$("#basic_tip_flag").show();
        }
    }
}

function saveInfo(tab){
	datas = {};
	datas.project_id = $("#project_id").val();
	if(!datas.project_id){
		alert("参数错误");
		return false;
	}
	if(tab==2){
		datas.info = ua.getContent();
	}
	if(tab==4){
		datas.info = ub.getContent();
	}
	datas.tab = tab;
	if(!datas.info){
		alert("请输入内容");
		return false;
	}

	var url = $("#manage_info_1").attr('action');

    save_datas(url, datas, 'post', 'json' ,do_after);
    function do_after(datas){
    	if(datas.flag =='1' && datas.project_id){
    		$("#info"+tab+"_tip_flag").show();
    		
            $("#info"+tab+"_tip_flag").html('操作成功');
            var addbase_jump_url = edit_jump_url+ "/id/"+datas.project_id;
            jump_to(addbase_jump_url);
        }
        else{
        	$("#info"+tab+"_tip_flag").html("发生错误");
        	$("#info"+tab+"_tip_flag").show();
        }
    }
}

function savePano(){
	datas = {};
	datas.project_id = $("#project_id").val();
	if(!datas.project_id){
		alert("参数错误");
		return false;
	}
	
	datas.pano_id = $("#tab1_input").val();
	if(!datas.pano_id){
		alert("请输入全景ID");
		return false;
	}
	var re = /^\d+(?=\.{0,1}\d+$|$)/;
	if(!(re.test(datas.pano_id))) {
		$("#pano_tip_flag").html("全景ID必须为数字");
		$("#pano_tip_flag").show();
		return false;
	}
	
	var url = $("#manage_pano").attr('action');

    save_datas(url, datas, 'post', 'json' ,do_after);
    function do_after(datas){
    	if(datas.flag =='1' && datas.project_id){
    		$("#pano_tip_flag").show();
    		
            $("#pano_tip_flag").html('操作成功');
            var addbase_jump_url = edit_jump_url+ "/id/"+datas.project_id;
            jump_to(addbase_jump_url);
        }
        else{
        	$("#pano_tip_flag").html("发生错误");
        	$("#pano_tip_flag").show();
        }
    }
}
function saveMsgTab(){
	datas = {};
	datas.project_id = $("#project_id").val();
	if(!datas.project_id){
		alert("参数错误");
		return false;
	}
	
	datas.tab1 = $("#tab5_input_name").val();
	if(!datas.tab1){
		alert("请输入栏位一内容");
		return false;
	}
	datas.tab2 = $("#tab5_input_phone").val();
	if(!datas.tab2){
		alert("请输入栏位二内容");
		return false;
	}
	datas.tab3 = $("#tab5_input_content").val();
	if(!datas.tab3){
		alert("请输入栏位三内容");
		return false;
	}

	var url = $("#manage_msg").attr('action');

    save_datas(url, datas, 'post', 'json' ,do_after);
    function do_after(datas){
    	if(datas.flag =='1' && datas.project_id){
    		$("#msg_tip_flag").show();
    		
            $("#msg_tip_flag").html('操作成功');
            var addbase_jump_url = edit_jump_url+ "/id/"+datas.project_id;
            jump_to(addbase_jump_url);
        }
        else{
        	$("#msg_tip_flag").html("发生错误");
        	$("#msg_tip_flag").show();
        }
    }
}
function saveLianxi(){
	datas = {};
	datas.project_id = $("#project_id").val();
	if(!datas.project_id){
		alert("参数错误");
		return false;
	}
	
	datas.info = uc.getContent();
	if(!datas.info){
		alert("请输入交通指引说明");
		return false;
	}
	if(!marker){
		if(!confirm("确定不添加地图标记吗？")){
			return false;
		}
		
	}
	else{
		var p = marker.getPosition();
		datas.lat = p.lat;
		datas.lng = p.lng;
		datas.zoom = map.getZoom();
	}
	
	
	var url = $("#manage_contact").attr('action');

    save_datas(url, datas, 'post', 'json' ,do_after);
    function do_after(datas){
    	if(datas.flag =='1' && datas.project_id){
    		$("#contact_tip_flag").show();
    		
            $("#contact_tip_flag").html('操作成功');
            var addbase_jump_url = edit_jump_url+ "/id/"+datas.project_id;
            jump_to(addbase_jump_url);
        }
        else{
        	$("#contact_tip_flag").html("发生错误");
        	$("#contact_tip_flag").show();
        }
    }
}

function editPic(id){
	var text = $("#album_pic_"+id).html();
	var input = '<input type="text" name="pic_desc[]" id="pic_desc_'+id+'" value="'+text+'"/>';
	$("#album_pic_"+id).html(input);
	$("#pic_edit_"+id).hide();
	$("#pic_save_"+id).show();
}
function savePic(id, type){
	datas = {};
	datas.id = id;
	if(!id){
		alert("参数错误");
		return false;
	}
	if(type=='desc'){
		datas.desc = $("#pic_desc_"+id).val();
	}
	else{
		if(!confirm("确定删除该图片吗？")){
			return false;
		}
	}
	datas.type = type;
	var url = $("#form_album_pic").attr('action');
    save_datas(url, datas, 'post', 'json' ,do_after);
    function do_after(datas){
    	if(datas.flag =='1'){
    		if(type=='del'){
    			$("#album_"+id).hide();
    		}
    		else{
    			$("#album_pic_"+id).html(datas.desc);
    			$("#pic_save_"+id).hide();
    			$("#pic_edit_"+id).show();
    		}
        }
        else{
        	alert("出错了");
        }
    }
}










