$(document).ready(function() {
    //bind_pano_btn();
})

function windows_size(){
	var win_width = window.innerWidth;
	if(win_width>=600){
		return 400;
	}
	else{
		return 250
	}
}

var jump_url = '';
function jump_to(jump_url, target){
    if(!jump_url){
        return false;
    }
    if(!target){
    	target = 'self';
    }
    if(target == 'blank'){
    	window.open(jump_url);
    }
    else{
    	window.location.href = jump_url;
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
				}
				else{
					$(this).next().hide();
				}
			}
		});
	});
}

function save_datas(url, data, type, dataType, done){
    if (!url){
        done_error(element_id, msg.error);
    }
    type = type ? type : 'post';
    dataType = dataType ? dataType : 'json';
    $.ajax({
        url: url,
        type: type,
        data: data,
        dataType: dataType,
        //timeout: 1000,
        error: function(){
        	done(datas);
        },
        success: function(datas){
            done(datas);
        }
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
    var post_datas = {'from':'album_pic','SESSION_ID':session_id};
    $("#album_box_upload").uploadify({
        'swf': flash_url,
        'uploader': image_upload_url,
        'formData': post_datas,
        'uploadLimit':10,
        'buttonText':'上传图片',
        'debug':false,
        'width':70,
        'height':28,
        'fileSizeLimit':'2048KB',
        'fileTypeDesc' : 'jpg,png,gif格式',
        'fileTypeExts':'*.jpg;*.png;*.gif;',
        'buttonImage':image_button_img,
        'multi': true,
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
            var login_jump_url = "/manage/list";
            jump_to(login_jump_url);
        }
        else{
        	$("#login_tip_flag").show();
        }
    }
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
	var options = {};
	options.point = point;
	marker = new BMap.Marker(options.point);
	if (options.icon) {
		marker.setIcon(options.icon);
	}
	if (options.label) {
		marker.setLabel(options.label);
	}
	map.addOverlay(marker);
	marker.enableDragging();
	return marker;
}
function myFun(result){
    var cityName = result.name;
    map.setCenter(cityName);
}






