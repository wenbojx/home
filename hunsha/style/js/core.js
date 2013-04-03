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





