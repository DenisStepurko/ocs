/**
 * Created by Денис Степурко on 19.04.2016.
 */
var close_modal = function (event){
    event.preventDefault();
    $('.modal').hide(300);
}
var edit_hardware = function (id,event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"get_hardware_edit",id:id},function(data){
        $(".content_modal").html(data);
        $(".modal").show(300);
    });
}
var sort_hardware_by = function(by,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method:"sort_hardware_by",by:by}, function(data){
        $("#table_body").html(JSON.parse(data));
    });
}
var update_hardware = function (event){
    event.preventDefault();
    var name = $("#name").val();
    var system = $("#system").val();
    var fio = $("#fio").val();
    var ip = $("#ip").val();
    var group = $("#group").val();
    var hardware_id_update = $("#hardware_id_update").val();
    $.post("inc/ajax.php",{method: "update_hardware", id:hardware_id_update,name:name,os:system,fio:fio,ip:ip,group:group}, function (data) {
        $(".modal").hide(300);
        $("#all_hardware").trigger("click");
    });
};
var rmv_hardware = function(id,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method: "rmv_hardware",id:id}, function (data){
        $("#all_hardware").trigger("click");
    });
}
var search_hardware = function(event){
    event.preventDefault();
    var what = $("#hardware_search").val();
    var where = $("#hardware_search_select").val();
    var checked_what = check_input("hardware_search");
    var checked_where = check_input("hardware_search_select");
    if(checked_what == true && checked_where == true){
        $.post("inc/ajax.php",{method: "search_hardware",where:where,what:what}, function (data){
            $("#table_body").html(JSON.parse(data));
        });
    }
}
var add_hardware = function(event) {
    event.preventDefault();
    var name = $("#add_hardware_name").val();
    var os = $("#add_hardware_system").val();
    var fio = $("#add_hardware_fio").val();
    var ip = $("#add_hardware_ip").val();
    var group = $("#add_hardware_worker").val();

        var checked_name = check_input("add_hardware_name");
        var checked_os = check_input("add_hardware_system");
        var checked_fio = check_input("add_hardware_fio");
        var checked_ip = check_input("add_hardware_ip");
        var checked_group = check_input("add_hardware_worker");

    if(checked_name == true && checked_os == true && checked_fio == true && checked_ip == true && checked_group == true ){
        $.post("inc/ajax.php",{method:"add_hardware",name:name,system:os,worker:fio,ip:ip,group:group},function(data){
            $("#table_body").html(JSON.parse(data));
        });
    }

}
var check_input = function (input_id){
    var input_length = $("#"+input_id).val().replace(/\s+/,'').length;
    if(input_length == 0){
        $("#"+input_id).css('border','1px solid red');
        return false;
    }
    else {
        $("#"+input_id).css('border','');
        return true;
    }
}
var generate_qr_hardware = function (id,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method:"generate_qr_hardware",id:id},function(data){
        $("#table_body").html(JSON.parse(data));
    });
}
function openGallery(event,src){
    event.preventDefault();
    $.fancybox.open({
        href: src
    });
}

$(document).ready(function(){

    /*Get user info*/
    $.post("inc/ajax.php",{method:"get_user_info"},function(data){
        data = JSON.parse(data);
        $("#name_user_header").html(data["login"]);
        $("#all_hardware").trigger("click");
    });
    /*Get user info*/

    function setcookie(name, value, expires, path, domain, secure) {
        // Send a cookie
        //
        // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)

        expires instanceof Date ? expires = expires.toGMTString() : typeof(expires) == 'number' && (expires = (new Date(+(new Date) + expires * 1e3)).toGMTString());
        var r = [name + "=" + escape(value)], s, i;
        for(i in s = {expires: expires, path: path, domain: domain}){
            s[i] && r.push(i + "=" + s[i]);
        }
        return secure && r.push("secure"), document.cookie = r.join(";"), true;
    }


    $("#auth_submit").click(function(){
        var login = $("#auth_login").val();
        var password = $("#auth_password").val();

        var checked_login = check_input("auth_login");
        var checked_password = check_input("auth_password");

        if(checked_login == true && checked_password == true){
            $.post("inc/ajax.php",{method: "login",login:login,password:password},function (data) {
                data = JSON.parse(data);
                if(data['answer'] == "true"){
                    setcookie("user",data['id']);
                    window.location.reload();                    
                } else {
                    $("#errors_message_login_page").html("Логин или пароль не верный!");
                }
            });
        }
    });

    $("#exit_button").click(function (event){
        event.preventDefault();
        setcookie("user",-1);
        window.location.reload();
    });

    $("#all_hardware").click(function (event) {
        event.preventDefault();
        $.post("inc/ajax.php",{method:"get_table_header_hardware"},function(data){
            data = JSON.parse(data);
            $("#search_bar").html(data['searchbar']);
            $("#table_header").html(data['table_header']);
            $("#table_body").html(data['table_content']);
            $("#table_search").html(data['show_add_hardware']);
        });
        $("#all_hardwareLI").addClass("active");
    });

});