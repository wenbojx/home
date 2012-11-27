var container = 'imgContent';
	var width = 1994;
	var height = 1303;
	
	function add_marker(){
		var half_w = parseInt($("#map_container").css('width'))/2;
		var half_h = parseInt($("#map_container").css('height'))/2;
		var con_top = 0-parseInt($("#"+container).css('top'));
		var con_left = 0-parseInt($("#"+container).css('left'));
		var top = half_h+con_top;
		var left = half_w+con_left;
		var marker = $('<div />').attr('id','ccc').addClass('marker_green').attr('data-coords', top+", "+left);
		$(marker).css('position','absolute').css('z-index', 2).css('top', top).css('left', left);
		$("#"+container).prepend(marker);
		$(marker).bind({
			mousedown: function(e){
				currentElement = this;
				xmousedown(e);
				var marker_obj = $(this);
				//S.marker.mouseDown.call(this, marker_obj);
			},
			mousemove: function(e){
				xmousemove(e);
				return false;
			},
			mouseup: function(e){
				var pos = xmouseup(e);
				var marker_obj = $(this);
				//S.marker.mouseUp.call(this, marker_obj, pos);
				return false;
			}
		});
	}



function bind_map(){
	$('.demo1').craftmap({
		image: {
			width: width,
			height: height
		},
		container: {
			name: container,
			id: container,
		},
		marker: {
			name: 'marker',
			center: false,
			popup: false,
			move: true,
			onClick: function(marker, popup){
				//alert($(marker).attr('id'));
			},
			mouseDown: function(marker){
				$(marker).addClass('marker_green');
				$(marker).removeClass('marker');
			},
			mouseUp: function(marker, pos){
				//alert(pos.x);
				//alert($(marker).attr('id')+'a');
			}
		}
	});
}
