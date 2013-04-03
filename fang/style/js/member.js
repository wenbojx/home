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
            
            jump_to(login_jump_url);
        }
        else{
        	$("#login_tip_flag").show();
        }
    }
}

