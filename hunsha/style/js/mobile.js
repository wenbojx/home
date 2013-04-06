
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


function onResize(){
	var win_width = window.innerWidth;
	var win_height = window.innerHeight;

	var tab_width = (parseInt(win_width)-70)/2;
	var tab_height = (parseInt(win_height)-(90+parseInt(num)*10))/(parseInt(num)+1);
	var flag_danshu = (total%2) == 0 ? false :true;
	if($("#tab1")){
		if(last_tap == 'tab1' && flag_danshu){
			$("#tab1").css("width", (tab_width*2)+"px");
		}
		else{
			$("#tab1").css("width", tab_width+"px");
		}
		$("#tab1").css("height", tab_height+"px");
		
	}
	if($("#tab2")){
		if(last_tap == 'tab2' && flag_danshu){
			$("#tab2").css("width", (tab_width*2)+"px");
		}
		else{
			$("#tab2").css("width", tab_width+"px");
		}
		$("#tab2").css("height", tab_height+"px");
	}
	if($("#tab3")){
		if(last_tap == 'tab3' && flag_danshu){
			$("#tab3").css("width", (tab_width*2)+"px");
		}
		else{
			$("#tab3").css("width", tab_width+"px");
		}
		$("#tab3").css("height", tab_height+"px");
	}
	if($("#tab4")){
		if(last_tap == 'tab4' && flag_danshu){
			$("#tab4").css("width", (tab_width*2)+"px");
		}
		else{
			$("#tab4").css("width", tab_width+"px");
		}
		$("#tab4").css("height", tab_height+"px");
	}
	if($("#tab5")){
		if(last_tap == 'tab5' && flag_danshu){
			$("#tab5").css("width", (tab_width*2)+"px");
		}
		else{
			$("#tab5").css("width", tab_width+"px");
		}
		$("#tab5").css("height", tab_height+"px");
	}
	if($("#tab6")){
		if(last_tap == 'tab6' && flag_danshu){
			$("#tab6").css("width", (tab_width*2+30)+"px");
		}
		else{
			$("#tab6").css("width", tab_width+"px");
		}
		$("#tab6").css("height", tab_height+"px");
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
function createMarker(point){
	marker = new BMap.Marker(point);
	map.addOverlay(marker);
	marker.enableDragging();
	return marker;
}
function show_map(object){
	initMap(object);
	var point_marker = new BMap.Point(point.lng, point.lat);
	map.centerAndZoom(point_marker,point.zoom);
	marker = createMarker(point_marker);
	
}
function map_width(){
	var win_width = window.innerWidth;
	var win_height = window.innerHeight;
	$("#map").css("width", ((parseInt(win_width)-30)));
	$("#map").css("height", ((parseInt(win_height)/2)));
}


function saveMsg(){
	datas = {};
	datas.project_id = $("#project_id").val();
	if(!datas.project_id){
		alert("参数错误");
		return false;
	}
	datas.tab1 = $("#tab1").val();
	if(!datas.tab1){
		alert("请输入"+tab1);
		return false;
	}
	datas.tab2 = $("#tab2").val();
	if(!datas.tab2){
		alert("请输入"+tab2);
		return false;
	}
	datas.tab3 = $("#tab3").val();
	if(!datas.tab3){
		alert("请输入"+tab3);
		return false;
	}

	var url = $("#submit_msg").attr('action');

    save_datas(url, datas, 'post', 'json' ,do_after);
    function do_after(data){
    	if(data.flag =='1'){
    		var html = msgHtml(datas);
    		$("#msg_list").prepend(html);
    		$("#tab3").val("");
    		last_id = data.project_id;
        }
        else{
        	alert("发生错误,请重新再试");
        }
    }
}
function loadMore(){
	//last_id
	datas = {};
	datas.project_id = $("#project_id").val();
	datas.last_id = last_id;
	
	var url = load_more_url;
    save_datas(url, datas, 'post', 'json' ,do_after);
    function do_after(data){
    	if(data.flag =='1'){
    		if(data.none){
    			$("#more_bt").html("无数据...");
    			return false;
    		}
    		var content = "";
    		if(data.list){
    			$.each(data.list, function(k,v){
    				content += msgHtml(v);
    				last_id = k;
    			});
    		}
    		$("#msg_list").append(content);
        }
        else{
        	alert("发生错误,请重新再试");
        }
    }
}
function msgHtml(datas){
	var html = "<dl>";
	html += "<dd>";
	html += nl2br(datas.tab3);
	html += "</dd>";
	html += "<dt>";
	var time = "";
	if(!datas.time){
		var myDate = new Date();
		var year = myDate.getFullYear();
		var month = myDate.getMonth();
		var day = myDate.getDate();
		var hour = myDate.getHours();
		var m = myDate.getMinutes();
		time = year+'-'+month+"-"+day+" "+hour+":"+m;
	}
	else{
		time = datas.time;
	}
	html += datas.tab1 + " | "+datas.tab2 + " | "+time;
	html += "</dt>";
	html += '</dl>';
	return html;
}
function nl2br(texts){
	if(!texts){
		return '';
	}
	return texts.replace(/\n/g,"<br />");
}









