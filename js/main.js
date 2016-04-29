/**
 * Created by Денис Степурко on 19.04.2016.
 */
/*modal*/
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
var add_hardware_modal = function (event){
    event.preventDefault();
    $.post("inc/ajax.php",{method:"show_add_hardware_modal"},function(data){
        $(".content_modal").html(data);
        $(".modal").show(300);
    });
}
var edit_motherboard = function (id,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method:"edit_motherboard",id:id},function(data){
        $(".content_modal").html(JSON.parse(data));
        $(".modal").show(300);
    });
}
var show_add_motherboard_modal = function (event){
    event.preventDefault();
    $.post("inc/ajax.php",{method:"show_add_motherboard_modal"},function(data){
        $(".content_modal").html(data);
        $(".modal").show(300);
    });
}
var show_add_cpu_modal = function (event){
    event.preventDefault();
    $.post("inc/ajax.php",{method:"show_add_cpu_modal"},function(data){
        $(".content_modal").html(data);
        $(".modal").show(300);
    });
}
var edit_cpu = function (id,event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"edit_cpu",id:id},function(data){
        $(".content_modal").html(JSON.parse(data));
        $(".modal").show(300);
    });
}
var show_add_ram_modal = function (event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"show_add_ram_modal"},function(data){
        $(".content_modal").html(data);
        $(".modal").show(300);
    });
}
var edit_ram = function (id,event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"edit_ram",id:id},function(data){
        $(".content_modal").html(JSON.parse(data));
        $(".modal").show(300);
    });
}
/*modal*/

/*modal processing*/
/*add*/
var add_hardware = function (event) {
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
            $('.modal').hide(300);
        });
    }

}
var add_motherboard = function (event){
    event.preventDefault();
    var hardware = $("#motherboard_add_hardware").val();
    var vendor = $("#motherboard_add_vendor").val();
    var serial_number = $("#motherboard_add_serial_number").val();
    var model = $("#motherboard_add_model").val();
    var socket = $("#motherboard_add_socket").val();
    var slots = $("#motherboard_add_memory_slots").val();
    var radios = document.getElementsByName('motherboard_add_internal_video');
    var form_factor = $("#motherboard_add_form_factor").val();

    var internal_video = '';
    for (var i = 0, length = radios.length; i < length; i++) {
        if (radios[i].checked) {
            internal_video = radios[i].value;
            break;
        }
    }
    var checked_hardware = check_input("motherboard_add_hardware");
    var checked_vendor = check_input("motherboard_add_vendor");
    var checked_serial_number = check_input("motherboard_add_serial_number");
    var checked_model = check_input("motherboard_add_model");
    var checked_socket = check_input("motherboard_add_socket");
    var checked_slots = check_input("motherboard_add_memory_slots");
    var checked_form_factor = check_input("motherboard_add_form_factor");

    if(checked_hardware == true && checked_vendor == true && checked_serial_number == true && checked_model == true && checked_socket == true && checked_slots == true && checked_form_factor == true){
        $.post("inc/ajax.php",{method:"add_motherboard",hardware:hardware,vendor:vendor,serial_number:serial_number,model:model,socket:socket,memory_slots:slots,internal_video:internal_video,form_factor:form_factor}, function(data){
            $("#table_body").html(JSON.parse(data));
            $('.modal').hide(300);
        });
    }
}
var add_cpu = function (event){
    event.preventDefault();
    var hardware = $("#cpu_add_hardware").val();
    var vendor = $("#cpu_add_vendor").val();
    var model = $("#cpu_add_model").val();
    var type = $("#cpu_add_type").val();
    var cores = $("#cpu_add_count_cores").val();

    var checked_hardware = check_input("cpu_add_hardware");
    var checked_vendor = check_input("cpu_add_vendor");
    var checked_model = check_input("cpu_add_model");
    var checked_socket = check_input("cpu_add_type");
    var checked_slots = check_input("cpu_add_count_cores");

    if(checked_hardware == true && checked_vendor == true && checked_model == true && checked_socket == true && checked_slots == true){
        $.post("inc/ajax.php",{method:"add_cpu",hardware:hardware,vendor:vendor,model:model,type:type,cores:cores}, function(data){
            $("#table_body").html(JSON.parse(data));
            $('.modal').hide(300);
        });
    }
}
var add_ram = function (event){
    event.preventDefault();
    var hardware = $("#ram_add_hardware").val();
    var serail_number = $("#ram_add_serial_number").val();
    var interface = $("#ram_add_interface").val();
    var type = $("#ram_add_type").val();
    var speed = $("#ram_add_speed").val();
    var size = $("#ram_add_size").val();

    var checked_hardware = check_input("ram_add_hardware");
    var checked_serial_number = check_input("ram_add_serial_number");
    var checked_interface = check_input("ram_add_interface");
    var checked_type = check_input("ram_add_type");
    var checked_speed = check_input("ram_add_speed");
    var checked_size = check_input("ram_add_size");

    if(checked_hardware == true && checked_serial_number == true && checked_interface == true && checked_type == true && checked_speed == true && checked_size == true){
        $.post("inc/ajax.php",{method:"add_ram",hardware:hardware,serail_number:serail_number,interface:interface,type:type,speed:speed,size:size}, function(data){
            $("#table_body").html(JSON.parse(data));
            $('.modal').hide(300);
        });
    }
}
/*add*/

/*update*/
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
}
var update_motherboard = function (event) {
    event.preventDefault();
    var hardware = $("#motherboard_edit_hardware").val();
    var vendor = $("#motherboard_edit_vendor").val();
    var serial_number = $("#motherboard_edit_serial_number").val();
    var model = $("#motherboard_edit_model").val();
    var socket = $("#motherboard_edit_socket").val();
    var slots = $("#motherboard_edit_memory_slots").val();
    var radios_edit = document.getElementsByName('motherboard_edit_internal_video');
    var form_factor = $("#motherboard_edit_form_factor").val();
    var id = $("#motherboard_id").val();

    var checked_hardware = check_input("motherboard_edit_hardware");
    var checked_vendor = check_input("motherboard_edit_vendor");
    var checked_serial_number = check_input("motherboard_edit_serial_number");
    var checked_model = check_input("motherboard_edit_model");
    var checked_socket = check_input("motherboard_edit_socket");
    var checked_slots = check_input("motherboard_edit_memory_slots");
    var checked_form_factor = check_input("motherboard_edit_form_factor");
    var checked_id = check_input("motherboard_id");

    var internal_video_edit = '';
    for (var i = 0, length = radios_edit.length; i < length; i++) {
        if (radios_edit[i].checked) {
            internal_video_edit = radios_edit[i].value;

            break;
        }
    }
    console.log(internal_video_edit);

    if(checked_hardware == true && checked_vendor == true && checked_serial_number == true && checked_model == true && checked_socket == true && checked_slots == true && checked_form_factor == true && checked_id == true){
        $.post("inc/ajax.php",{method: "update_motherboard", id:id,hardware:hardware,vendor:vendor,serial_number:serial_number,model:model,socket:socket,slots:slots,form_factor:form_factor,internal_video:internal_video_edit}, function (data) {
            $("#table_body").html(JSON.parse(data));
            $(".modal").hide(300);
        });
    }
}
var update_cpu = function (event) {
    event.preventDefault();
    var hardware = $("#cpu_edit_hardware").val();
    var vendor = $("#cpu_edit_vendor").val();
    var model = $("#cpu_edit_model").val();
    var type = $("#cpu_edit_type").val();
    var cores = $("#cpu_edit_core_number").val();
    var id = $("#cpu_id").val();

    var checked_hardware = check_input("cpu_edit_hardware");
    var checked_vendor = check_input("cpu_edit_vendor");
    var checked_model = check_input("cpu_edit_model");
    var checked_type = check_input("cpu_edit_type");
    var checked_cores = check_input("cpu_edit_core_number");
    var checked_id = check_input("cpu_id");

    if(checked_hardware == true && checked_vendor == true && checked_type == true && checked_model == true && checked_cores == true && checked_id == true){
        $.post("inc/ajax.php",{method: "update_cpu", id:id,hardware:hardware,vendor:vendor,model:model,type:type,cores:cores}, function (data) {
            $("#table_body").html(JSON.parse(data));
            $(".modal").hide(300);
        });
    }
}
var update_ram = function (event) {
    event.preventDefault();
    var hardware = $("#ram_edit_hardware").val();
    var serial_number = $("#ram_edit_serial_number").val();
    var interface = $("#ram_edit_interface").val();
    var type = $("#ram_edit_type").val();
    var speed = $("#ram_edit_speed").val();
    var size = $("#ram_edit_size").val();
    var id = $("#ram_id").val();

    var checked_hardware = check_input("ram_edit_hardware");
    var checked_serial_number = check_input("ram_edit_serial_number");
    var checked_interface = check_input("ram_edit_interface");
    var checked_type = check_input("ram_edit_type");
    var checked_speed = check_input("ram_edit_speed");
    var checked_size = check_input("ram_edit_size");
    var checked_id = check_input("ram_id");

    if(checked_hardware == true && checked_serial_number == true && checked_interface == true && checked_type == true && checked_speed == true && checked_size == true && checked_id == true){
        $.post("inc/ajax.php",{method: "update_ram", id:id,hardware:hardware,serial_number:serial_number,interface:interface,type:type,speed:speed,size:size}, function (data) {
            $("#table_body").html(JSON.parse(data));
            $(".modal").hide(300);
        });
    }
}
/*update*/

/*rmv*/
var rmv_hardware = function (id,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method: "rmv_hardware",id:id}, function (data){
        $("#all_hardware").trigger("click");
    });
}
var rmv_motherboard = function (id,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method: "rmv_motherboard",id:id}, function (data){
        $("#table_body").html(JSON.parse(data));
    });
}
var rmv_cpu = function (id,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method: "rmv_cpu",id:id}, function (data){
        $("#table_body").html(JSON.parse(data));
    });
}
var rmv_ram = function (id,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method: "rmv_ram",id:id}, function (data){
        $("#table_body").html(JSON.parse(data));
    });
}
/*rmv*/
/*modal processing*/

/*sort*/
var sort_hardware_by = function (by,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method:"sort_hardware_by",by:by}, function(data){
        $("#table_body").html(JSON.parse(data));
    });
}
var sort_motherboard_by = function (by,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method:"sort_motherboard_by",by:by}, function(data){
        $("#table_body").html(JSON.parse(data));
    });
}
var sort_cpu_by = function (by,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method:"sort_cpu_by",by:by}, function(data){
        $("#table_body").html(JSON.parse(data));
    });
}
var sort_ram_by = function (by,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method:"sort_ram_by",by:by}, function(data){
        $("#table_body").html(JSON.parse(data));
    });
}
/*sort*/

/*search*/
var search_hardware = function (event){
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
var search_motherboard = function (event){
    event.preventDefault();
    var what = $("#motherboard_search").val();
    var where = $("#motherboard_search_select").val();
    var checked_what = check_input("motherboard_search");
    var checked_where = check_input("motherboard_search_select");
    if(checked_what == true && checked_where == true){
        $.post("inc/ajax.php",{method: "search_motherboard",where:where,what:what}, function (data){
            $("#table_body").html(JSON.parse(data));
        });
    }
    else {
        $("#motherboard").trigger("click");
    }
}
var search_cpu = function (event){
    event.preventDefault();
    var what = $("#cpu_search").val();
    var where = $("#cpu_search_select").val();
    var checked_what = check_input("cpu_search");
    if(checked_what == true){
        $.post("inc/ajax.php",{method: "search_cpu",where:where,what:what}, function (data){
            $("#table_body").html(JSON.parse(data));
        });
    }
    else {
        $("#cpu").trigger("click");
    }
}
var search_ram = function (event){
    event.preventDefault();
    var what = $("#ram_search").val();
    var where = $("#ram_search_select").val();
    var checked_what = check_input("ram_search");
    if(checked_what == true){
        $.post("inc/ajax.php",{method: "search_ram",where:where,what:what}, function (data){
            $("#table_body").html(JSON.parse(data));
        });
    }
    else {
        $("#cpu").trigger("click");
    }
}
/*search*/

/*qr*/
var generate_qr_hardware = function (id,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method:"generate_qr_hardware",id:id},function(data){
        $("#table_body").html(JSON.parse(data));
    });
}
/*qr*/

/*another functions*/
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
function openGallery(event,src){
    event.preventDefault();
    $.fancybox.open({
        href: src
    });
}
function clear_active() {
    $("#myTab").find("li").removeClass("active");
}
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
/*another functions*/

$(document).ready(function(){
    /*Get user info*/
    $.post("inc/ajax.php",{method:"get_user_info"},function(data){
        data = JSON.parse(data);
        $("#name_user_header").html(data["login"]);
        $("#all_hardware").trigger("click");
    });
    /*Get user info*/

    /*processing auth*/
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
    /*processing auth*/

    /*processing tabs*/
    $("#all_hardware").click(function (event) {
        event.preventDefault();
        $.post("inc/ajax.php",{method:"get_table_header_hardware"},function(data){
            data = JSON.parse(data);
            $("#search_bar").html(data['searchbar']);
            $("#table_header").html(data['table_header']);
            $("#table_body").html(data['table_content']);
        });
        clear_active();
        $("#all_hardwareLI").addClass("active");
    });
    $("#motherboard").click(function (event) {
        event.preventDefault();
        $.post("inc/ajax.php",{method:"get_table_header_mb"},function(data){
            data = JSON.parse(data);
            $("#search_bar").html(data['searchbar']);
            $("#table_header").html(data['table_header']);
            $("#table_body").html(data['table_content']);
        });
        clear_active();
        $("#motherboardLI").addClass("active");
    });
    $("#cpu").click(function (event) {
        event.preventDefault();
        $.post("inc/ajax.php",{method:"get_table_header_cpu"},function(data){
            data = JSON.parse(data);
            $("#search_bar").html(data['searchbar']);
            $("#table_header").html(data['table_header']);
            $("#table_body").html(data['table_content']);
        });
        clear_active();
        $("#cpuLI").addClass("active");
    });
    $("#ram").click(function (event) {
        event.preventDefault();
        $.post("inc/ajax.php",{method:"get_table_header_ram"},function(data){
            data = JSON.parse(data);
            $("#search_bar").html(data['searchbar']);
            $("#table_header").html(data['table_header']);
            $("#table_body").html(data['table_content']);
        });
        clear_active();
        $("#ramLI").addClass("active");
    });
    /*processing tabs*/

});