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










