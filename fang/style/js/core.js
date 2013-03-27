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

var fang = {};
fang.del = function(del){
	if(!confirm("确定要删除吗？")){
		return false;
	}
	var id = $("#fid").val();
	var url = $("#manage_add").attr('action');
    var datas = {'del':del, 'id':id};

    save_datas(url, datas, 'post', 'json' ,do_after);
    function do_after(datas){
    	if(datas.flag =='1' && datas.id){
    		$("#add_tip_flag").show();
            $("#add_tip_flag").html('操作成功');
            var addbase_jump_url = "/manage/addBasic/edit/"+ "id/"+datas.id;
            jump_to(addbase_jump_url);
        }
        else{
        	$("#add_tip_flag").html("发生错误，请重新再试");
        	$("#add_tip_flag").show();
        }
    }
}
fang.add = function(){
	var biaoti = $("#biaoti").val();
	if( biaoti == "" ){
		$("#add_tip_flag").html("请输入标题");
		$("#add_tip_flag").show();
		return false;
	}
	var mianji = $("#mianji").val();
	if( mianji == "" ){
		$("#add_tip_flag").html("请输入面积");
		$("#add_tip_flag").show();
		return false;
	}
	var re = /^\d+(?=\.{0,1}\d+$|$)/;
	if(!(re.test(mianji))) {
		$("#add_tip_flag").html("面积请输入数字");
		$("#add_tip_flag").show();
		return false;
	}
	var jiage = $("#jiage").val();
	if( jiage == "" ){
		$("#add_tip_flag").html("请输入价格");
		$("#add_tip_flag").show();
		return false;
	}
	if(!(re.test(jiage))) {
		$("#add_tip_flag").html("价格请输入数字");
		$("#add_tip_flag").show();
		return false;
	}
	var shoumai = $("#shoumai").val();
	var zhuangxiu = $("#zhuangxiu").val();
	var shi = $("#shi").val();
	var ting = $("#ting").val();
	var wei = $("#wei").val();
	var guanjianci = $("#guanjianci").val();
	var desc = $("#desc").val();
	var id = $("#fid").val();
	
	
	var url = $("#manage_add").attr('action');
    var datas = {'biaoti':biaoti, 'mianji':mianji, 'jiage':jiage, 'shoumai':shoumai, 'zhuangxiu':zhuangxiu, 'shi':shi,
    		'ting':ting, 'wei':wei, 'guanjianci':guanjianci, 'desc':desc, 'id':id
    };

    save_datas(url, datas, 'post', 'json' ,do_after);
    $("#submit_button").attr("disabled", true);
    function do_after(datas){
    	if(datas.flag =='1' && datas.id){
    		$("#add_tip_flag").show();
            $("#add_tip_flag").html('添加成功');
            var addbase_jump_url = "/manage/addBasic/edit/"+ "id/"+datas.id;
            jump_to(addbase_jump_url);
        }
        else{
        	$("#add_tip_flag").html("发生错误，请重新再试");
        	$("#add_tip_flag").show();
        	$("#submit_button").attr("disabled", false);
        }
    }
}








