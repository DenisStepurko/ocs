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
var show_add_gpu_modal = function (event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"show_add_gpu_modal"},function(data){
        $(".content_modal").html(data);
        $(".modal").show(300);
    });
}
var edit_gpu = function (id,event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"edit_gpu",id:id},function(data){
        $(".content_modal").html(JSON.parse(data));
        $(".modal").show(300);
    });
}
var show_add_hdd_modal = function (event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"show_add_hdd_modal"},function(data){
        $(".content_modal").html(data);
        $(".modal").show(300);
    });
}
var edit_hdd = function (id,event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"edit_hdd",id:id},function(data){
        $(".content_modal").html(JSON.parse(data));
        $(".modal").show(300);
    });
}
var show_add_network_modal = function (event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"show_add_network_modal"},function(data){
        $(".content_modal").html(data);
        $(".modal").show(300);
    });
}
var edit_network = function (id,event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"edit_network",id:id},function(data){
        $(".content_modal").html(JSON.parse(data));
        $(".modal").show(300);
    });
}
var show_add_power_supply_modal = function (event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"show_add_power_supply_modal"},function(data){
        $(".content_modal").html(data);
        $(".modal").show(300);
    });
}
var edit_power_supply = function (id,event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"edit_power_supply",id:id},function(data){
        $(".content_modal").html(JSON.parse(data));
        $(".modal").show(300);
    });
}
var show_add_monitor_modal = function (event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"show_add_monitor_modal"},function(data){
        $(".content_modal").html(data);
        $(".modal").show(300);
    });
}
var edit_monitor = function (id,event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"edit_monitor",id:id},function(data){
        $(".content_modal").html(JSON.parse(data));
        $(".modal").show(300);
    });
}
var show_add_peripheral_modal = function (event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"show_add_peripheral_modal"},function(data){
        $(".content_modal").html(data);
        $(".modal").show(300);
    });
}
var edit_peripheral = function (id,event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"edit_peripheral",id:id},function(data){
        $(".content_modal").html(JSON.parse(data));
        $(".modal").show(300);
    });
}
var show_add_network_device_modal = function (event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"show_add_network_device_modal"},function(data){
        $(".content_modal").html(data);
        $(".modal").show(300);
    });
}
var edit_network_device = function (id,event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"edit_network_device",id:id},function(data){
        $(".content_modal").html(JSON.parse(data));
        $(".modal").show(300);
    });
}
var show_add_mobile_device_modal = function (event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"show_add_mobile_device_modal"},function(data){
        $(".content_modal").html(data);
        $(".modal").show(300);
    });
}
var edit_mobile_device = function (id,event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"edit_mobile_device",id:id},function(data){
        $(".content_modal").html(JSON.parse(data));
        $(".modal").show(300);
    });
}
var show_add_worker_modal = function (event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"show_add_worker_modal"},function(data){
        $(".content_modal").html(data);
        $(".modal").show(300);
    });
}
var edit_worker = function (id,event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"edit_worker",id:id},function(data){
        $(".content_modal").html(JSON.parse(data));
        $(".modal").show(300);
    });
}
var show_add_users_modal = function (event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"show_add_users_modal"},function(data){
        $(".content_modal").html(data);
        $(".modal").show(300);
    });
}
var edit_users = function (id,event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"edit_users",id:id},function(data){
        $(".content_modal").html(JSON.parse(data));
        $(".modal").show(300);
    });
}
var show_add_groups_modal = function (event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"show_add_groups_modal"},function(data){
        $(".content_modal").html(data);
        $(".modal").show(300);
    });
}
var edit_groups = function (id,event) {
    event.preventDefault();
    $.post("inc/ajax.php",{method:"edit_groups",id:id},function(data){
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
var add_gpu = function (event){
    event.preventDefault();
    var checkboxes = $("input:checkbox:checked");
    var interfaces ='';
    for(var i = 0; i < 4;i++){
        if(typeof $(checkboxes[i]).val() == "undefined" && !$(checkboxes[i]).val()){

        } else {
            interfaces += $(checkboxes[i]).val();
            interfaces += ',';
        }
    }
    var hardware = $("#gpu_add_hardware").val();
    var vendor = $("#gpu_add_vendor").val();
    var size = $("#gpu_add_size").val();

    var checked_hardware = check_input("gpu_add_hardware");
    var checked_vendor = check_input("gpu_add_vendor");
    var checked_size = check_input("gpu_add_size");

    if(checked_hardware == true && checked_vendor == true && checked_size == true) {
        $.post("inc/ajax.php", {
            method: "add_gpu",
            hardware: hardware,
            vendor: vendor,
            size: size,
            interfaces: interfaces
        }, function (data) {
            $("#table_body").html(JSON.parse(data));
            $('.modal').hide(300);
        });
    }
}
var add_hdd = function (event){
    event.preventDefault();
    var hardware = $("#hdd_add_hardware").val();
    var vendor = $("#hdd_add_vendor").val();
    var model = $("#hdd_add_model").val();
    var serial_number = $("#hdd_add_serial_number").val();
    var size = $("#hdd_add_size").val();
    var type = $("#hdd_add_type").val();

    var checked_hardware = check_input("hdd_add_hardware");
    var checked_vendor = check_input("hdd_add_vendor");
    var checked_model = check_input("hdd_add_model");
    var checked_serial_number = check_input("hdd_add_serial_number");
    var checked_size = check_input("hdd_add_size");
    var checked_type = check_input("hdd_add_type");

    if(checked_hardware == true && checked_vendor == true && checked_model == true && checked_serial_number == true && checked_size == true && checked_type == true) {
        $.post("inc/ajax.php", {
            method: "add_hdd",
            hardware: hardware,
            vendor: vendor,
            model: model,
            serial_number: serial_number,
            size: size,
            type: type
        }, function (data) {
            $("#table_body").html(JSON.parse(data));
            $('.modal').hide(300);
        });
    }
}
var add_network = function (event){
    event.preventDefault();
    var hardware = $("#network_add_hardware").val();
    var vendor = $("#network_add_vendor").val();
    var mac_address = $("#network_add_mac_address").val();
    var type = $("#network_add_type").val();

    var checked_hardware = check_input("network_add_hardware");
    var checked_vendor = check_input("network_add_vendor");
    var checked_mac_address = check_input("network_add_mac_address");
    var checked_type = check_input("network_add_type");

    if(checked_hardware == true && checked_vendor == true && checked_mac_address == true && checked_type == true) {
        $.post("inc/ajax.php", {
            method: "add_network",
            hardware: hardware,
            vendor: vendor,
            mac_address: mac_address,
            type: type
        }, function (data) {
            $("#table_body").html(JSON.parse(data));
            $('.modal').hide(300);
        });
    }
}
var add_power_supply = function (event){
    event.preventDefault();
    var hardware = $("#power_supply_add_hardware").val();
    var vendor = $("#power_supply_add_vendor").val();
    var interfaces = $("#power_supply_add_interfaces").val();
    var power = $("#power_supply_add_power").val();

    var checked_hardware = check_input("power_supply_add_hardware");
    var checked_vendor = check_input("power_supply_add_vendor");
    var checked_interfaces = check_input("power_supply_add_interfaces");
    var checked_power = check_input("power_supply_add_power");

    if(checked_hardware == true && checked_vendor == true && checked_interfaces == true && checked_power == true) {
        $.post("inc/ajax.php", {
            method: "add_power_supply",
            hardware: hardware,
            vendor: vendor,
            interfaces: interfaces,
            power: power
        }, function (data) {
            $("#table_body").html(JSON.parse(data));
            $('.modal').hide(300);
        });
    }
}
var add_monitor = function (event){
    event.preventDefault();
    var hardware = $("#monitor_add_hardware").val();
    var vendor = $("#monitor_add_vendor").val();
    var size = $("#monitor_add_size").val();

    var checkboxes = $("input:checkbox:checked");
    var interfaces ='';
    for(var i = 0; i < 4;i++){
        if(typeof $(checkboxes[i]).val() == "undefined" && !$(checkboxes[i]).val()){

        } else {
            interfaces += $(checkboxes[i]).val();
            interfaces += ',';
        }
    }

    var checked_hardware = check_input("monitor_add_hardware");
    var checked_vendor = check_input("monitor_add_vendor");
    var checked_size = check_input("monitor_add_interfaces");

    if(checked_hardware == true && checked_vendor == true && checked_size == true) {
        $.post("inc/ajax.php", {
            method: "add_monitor",
            hardware: hardware,
            vendor: vendor,
            size: size,
            interfaces: interfaces
        }, function (data) {
            $("#table_body").html(JSON.parse(data));
            $('.modal').hide(300);
        });
    }
}
var add_peripheral = function (event){
    event.preventDefault();
    var serial_number = $("#peripheral_add_serial_number").val();
    var type = $("#peripheral_add_type").val();
    var description = $("#peripheral_add_description").val();
    var status = $("#peripheral_add_status").val();

    var checked_serial_number = check_input("peripheral_add_serial_number");
    var checked_type = check_input("peripheral_add_type");
    var checked_description = check_input("peripheral_add_description");
    var checked_status = check_input("peripheral_add_status");

    if(checked_serial_number == true && checked_type == true && checked_description == true && checked_status == true) {
        $.post("inc/ajax.php", {
            method: "add_peripheral",
            serial_number: serial_number,
            type: type,
            description: description,
            status: status
        }, function (data) {
            $("#table_body").html(JSON.parse(data));
            $('.modal').hide(300);
        });
    }
}
var add_network_device = function (event){
    event.preventDefault();
    var model = $("#network_device_add_model").val();
    var port_number = $("#network_device_add_port_number").val();
    var serial_number = $("#network_device_add_serial_number").val();
    var type = $("#network_device_add_type").val();
    var mac_address = $("#network_device_add_mac_address").val();
    var status = $("#network_device_add_status").val();

    var checked_model = check_input("network_device_add_model");
    var checked_port_number = check_input("network_device_add_port_number");
    var checked_serial_number = check_input("network_device_add_serial_number");
    var checked_type = check_input("network_device_add_type");
    var checked_mac_address = check_input("network_device_add_mac_address");
    var checked_status = check_input("network_device_add_status");

    if(checked_model == true && checked_port_number == true && checked_serial_number == true && checked_type == true && checked_mac_address == true && checked_status == true) {
        $.post("inc/ajax.php", {
            method: "add_network_device",
            model: model,
            port_number: port_number,
            serial_number: serial_number,
            type: type,
            mac_address: mac_address,
            status: status
        }, function (data) {
            $("#table_body").html(JSON.parse(data));
            $('.modal').hide(300);
        });
    }
}
var add_mobile_device = function (event){
    event.preventDefault();
    var model = $("#mobile_device_add_model").val();
    var imei = $("#mobile_device_add_imei").val();
    var serial_number = $("#mobile_device_add_serial_number").val();
    var platform = $("#mobile_device_add_platform").val();
    var status = $("#mobile_device_add_status").val();

    var checked_model = check_input("mobile_device_add_model");
    var checked_port_number = check_input("mobile_device_add_imei");
    var checked_serial_number = check_input("mobile_device_add_serial_number");
    var checked_type = check_input("mobile_device_add_platform");
    var checked_status = check_input("mobile_device_add_status");

    if(checked_model == true && checked_port_number == true && checked_serial_number == true && checked_type == true && checked_status == true) {
        $.post("inc/ajax.php", {
            method: "add_mobile_device",
            model: model,
            imei: imei,
            serial_number: serial_number,
            platform: platform,
            status: status
        }, function (data) {
            $("#table_body").html(JSON.parse(data));
            $('.modal').hide(300);
        });
    }
}
var add_worker = function (event){
    event.preventDefault();
    var fio = $("#worker_add_fio").val();
    var birthday = $("#worker_add_birthday").val();
    $.post("inc/ajax.php", {
        method: "add_worker",
        fio: fio,
        birthday: birthday
    }, function (data) {
        $("#table_body").html(JSON.parse(data));
        $('.modal').hide(300);
    });
}
var add_users = function (event){
    event.preventDefault();
    var login = $("#users_add_login").val();
    var password = $("#users_add_password").val();
    var email = $("#users_add_email").val();
    var admin = $("#users_add_admin").val();
    $.post("inc/ajax.php", {
        method: "add_users",
        login: login,
        password: password,
        email: email,
        admin: admin
    }, function (data) {
        $("#table_body").html(JSON.parse(data));
        $('.modal').hide(300);
    });
}
var add_groups = function (event){
    event.preventDefault();

    var checked_name = check_input("groups_add_name");
    var name = $("#groups_add_name").val();

    if(checked_name == true){
        $.post("inc/ajax.php", {
            method: "add_groups",
            name: name,
        }, function (data) {
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
var update_gpu = function (event) {
    event.preventDefault();
    var hardware = $("#gpu_edit_hardware").val();
    var vendor = $("#gpu_edit_vendor").val();
    var size = $("#gpu_edit_size").val();
    var id = $("#gpu_id").val();

    var checkboxes = $("input:checkbox:checked");
    var interfaces ='';
    for(var i = 0; i < 4;i++){
        if(typeof $(checkboxes[i]).val() == "undefined" && !$(checkboxes[i]).val()){

        } else {
            interfaces += $(checkboxes[i]).val();
            interfaces += ',';
        }
    }


    var checked_hardware = check_input("gpu_edit_hardware");
    var checked_vendor = check_input("gpu_edit_vendor");
    var checked_size = check_input("gpu_edit_size");
    var checked_id = check_input("gpu_id");

    if(checked_hardware == true && checked_vendor == true && checked_size == true && checked_id == true){
        $.post("inc/ajax.php",{method: "update_gpu", id:id,hardware:hardware,vendor:vendor,size:size,interfaces:interfaces}, function (data) {
            $("#table_body").html(JSON.parse(data));
            $(".modal").hide(300);
        });
    }
}
var update_hdd = function (event) {
    event.preventDefault();
    var hardware = $("#hdd_edit_hardware").val();
    var vendor = $("#hdd_edit_vendor").val();
    var model = $("#hdd_edit_model").val();
    var serial_number = $("#hdd_edit_serial_number").val();
    var size = $("#hdd_edit_size").val();
    var type = $("#hdd_edit_type").val();
    var id = $("#hdd_id").val();

    var checked_hardware = check_input("hdd_edit_hardware");
    var checked_vendor = check_input("hdd_edit_vendor");
    var checked_model = check_input("hdd_edit_model");
    var checked_serial_number = check_input("hdd_edit_serial_number");
    var checked_size = check_input("hdd_edit_size");
    var checked_type = check_input("hdd_edit_type");
    var checked_id = check_input("hdd_id");

    if(checked_hardware == true && checked_vendor == true && checked_model == true && checked_serial_number == true && checked_size == true && checked_type == true && checked_id == true){
        $.post("inc/ajax.php",{
            method: "update_hdd",
            id:id,
            hardware:hardware,
            vendor:vendor,
            model:model,
            serial_number:serial_number,
            size:size,
            type:type
        }, function (data) {
            $("#table_body").html(JSON.parse(data));
            $(".modal").hide(300);
        });
    }
}
var update_network = function (event) {
    event.preventDefault();
    var hardware = $("#network_edit_hardware").val();
    var vendor = $("#network_edit_vendor").val();
    var mac_address = $("#network_edit_mac_address").val();
    var type = $("#network_edit_type").val();
    var id = $("#network_id").val();

    var checked_hardware = check_input("network_edit_hardware");
    var checked_vendor = check_input("network_edit_vendor");
    var checked_mac_address = check_input("network_edit_mac_address");
    var checked_type = check_input("network_edit_type");
    var checked_id = check_input("network_id");

    if(checked_hardware == true && checked_vendor == true && checked_mac_address == true && checked_type == true && checked_id == true){
        $.post("inc/ajax.php",{
            method: "update_network",
            id:id,
            hardware:hardware,
            vendor:vendor,
            mac_address:mac_address,
            type:type
        }, function (data) {
            $("#table_body").html(JSON.parse(data));
            $(".modal").hide(300);
        });
    }
}
var update_power_supply = function (event) {
    event.preventDefault();
    var hardware = $("#power_supply_edit_hardware").val();
    var vendor = $("#power_supply_edit_vendor").val();
    var interfaces = $("#power_supply_edit_interfaces").val();
    var power = $("#power_supply_edit_power").val();
    var id = $("#power_supply_id").val();

    var checked_hardware = check_input("power_supply_edit_hardware");
    var checked_vendor = check_input("power_supply_edit_vendor");
    var checked_interfaces = check_input("power_supply_edit_interfaces");
    var checked_power = check_input("power_supply_edit_power");
    var checked_id = check_input("power_supply_id");

    if(checked_hardware == true && checked_vendor == true && checked_interfaces == true && checked_power == true && checked_id == true){
        $.post("inc/ajax.php",{
            method: "update_power_supply",
            id:id,
            hardware:hardware,
            vendor:vendor,
            interfaces:interfaces,
            power:power
        }, function (data) {
            $("#table_body").html(JSON.parse(data));
            $(".modal").hide(300);
        });
    }
}
var update_monitor = function (event) {
    event.preventDefault();
    var hardware = $("#monitor_edit_hardware").val();
    var vendor = $("#monitor_edit_vendor").val();
    var size = $("#monitor_edit_size").val();
    var id = $("#monitor_id").val();

    var checkboxes = $("input:checkbox:checked");
    var interfaces ='';
    for(var i = 0; i < 4;i++){
        if(typeof $(checkboxes[i]).val() == "undefined" && !$(checkboxes[i]).val()){

        } else {
            interfaces += $(checkboxes[i]).val();
            interfaces += ',';
        }
    }

    var checked_hardware = check_input("monitor_edit_hardware");
    var checked_vendor = check_input("monitor_edit_vendor");
    var checked_power = check_input("monitor_edit_size");
    var checked_id = check_input("monitor_id");

    if(checked_hardware == true && checked_vendor == true && checked_power == true && checked_id == true){
        $.post("inc/ajax.php",{
            method: "update_monitor",
            id:id,
            hardware:hardware,
            vendor:vendor,
            size:size,
            interfaces:interfaces
        }, function (data) {
            $("#table_body").html(JSON.parse(data));
            $(".modal").hide(300);
        });
    }
}
var update_peripheral = function (event) {
    event.preventDefault();
    var id = $("#peripheral_id").val();
    var serial_number = $("#peripheral_edit_serial_number").val();
    var type = $("#peripheral_edit_type").val();
    var description = $("#peripheral_edit_description").val();
    var status = $("#peripheral_edit_status").val();

    var checked_serial_number = check_input("peripheral_edit_serial_number");
    var checked_type = check_input("peripheral_edit_type");
    var checked_description = check_input("peripheral_edit_description");
    var checked_status = check_input("peripheral_edit_status");
    if(checked_serial_number == true && checked_type == true && checked_description == true && checked_status == true){
        $.post("inc/ajax.php",{
            method: "update_peripheral",
            id:id,
            serial_number:serial_number,
            type:type,
            description:description,
            status:status
        }, function (data) {
            $("#table_body").html(JSON.parse(data));
            $(".modal").hide(300);
        });
    }
}
var update_network_device = function (event){
    event.preventDefault();
    var model = $("#network_device_edit_model").val();
    var port_number = $("#network_device_edit_port_number").val();
    var serial_number = $("#network_device_edit_serial_number").val();
    var type = $("#network_device_edit_type").val();
    var mac_address = $("#network_device_edit_mac_address").val();
    var status = $("#network_device_edit_status").val();
    var id = $("#network_device_id").val();

    var checked_model = check_input("network_device_edit_model");
    var checked_port_number = check_input("network_device_edit_port_number");
    var checked_serial_number = check_input("network_device_edit_serial_number");
    var checked_type = check_input("network_device_edit_type");
    var checked_mac_address = check_input("network_device_edit_mac_address");
    var checked_status = check_input("network_device_edit_status");

    if(checked_model == true && checked_port_number == true && checked_serial_number == true && checked_type == true && checked_mac_address == true && checked_status == true) {
        $.post("inc/ajax.php", {
            method: "update_network_device",
            id: id,
            model: model,
            port_number: port_number,
            serial_number: serial_number,
            type: type,
            mac_address: mac_address,
            status: status
        }, function (data) {
            $("#table_body").html(JSON.parse(data));
            $('.modal').hide(300);
        });
    }
}
var update_mobile_device = function (event){
    event.preventDefault();
    var model = $("#mobile_device_edit_model").val();
    var imei = $("#mobile_device_edit_imei").val();
    var serial_number = $("#mobile_device_edit_serial_number").val();
    var platform = $("#mobile_device_edit_platform").val();
    var status = $("#mobile_device_edit_status").val();
    var id = $("#mobile_device_id").val();

    var checked_model = check_input("mobile_device_edit_model");
    var checked_port_number = check_input("mobile_device_edit_imei");
    var checked_serial_number = check_input("mobile_device_edit_serial_number");
    var checked_type = check_input("mobile_device_edit_platform");
    var checked_status = check_input("mobile_device_edit_status");

    if(checked_model == true && checked_port_number == true && checked_serial_number == true && checked_type == true && checked_status == true) {
        $.post("inc/ajax.php", {
            method: "update_mobile_device",
            id: id,
            model: model,
            imei: imei,
            serial_number: serial_number,
            platform: platform,
            status: status
        }, function (data) {
            $("#table_body").html(JSON.parse(data));
            $('.modal').hide(300);
        });
    }
}
var update_worker = function (event){
    event.preventDefault();
    var fio = $("#worker_edit_fio").val();
    var birthday = $("#worker_edit_birthday").val();
    var id = $("#worker_id").val();

    $.post("inc/ajax.php", {
        method: "update_worker",
        id: id,
        fio: fio,
        birthday: birthday
    }, function (data) {
        $("#table_body").html(JSON.parse(data));
        $('.modal').hide(300);
    });
}
var update_users = function (event){
    event.preventDefault();
    var login = $("#users_edit_login").val();
    var password = $("#users_edit_password").val();
    var email = $("#users_edit_email").val();
    var admin = $("#users_edit_admin").val();
    var id = $("#users_id").val();

    $.post("inc/ajax.php", {
        method: "update_users",
        id: id,
        login: login,
        password: password,
        email: email,
        admin: admin
    }, function (data) {
        $("#table_body").html(JSON.parse(data));
        $('.modal').hide(300);
    });
}
var update_groups = function (event){
    event.preventDefault();
    var name = $("#groups_edit_name").val();
    var id = $("#groups_id").val();
    var checked_name = check_input("groups_edit_name");
    if(checked_name == true) {
        $.post("inc/ajax.php", {
            method: "update_groups",
            id: id,
            name: name,
        }, function (data) {
            $("#table_body").html(JSON.parse(data));
            $('.modal').hide(300);
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
var rmv_gpu = function (id,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method: "rmv_gpu",id:id}, function (data){
        $("#table_body").html(JSON.parse(data));
    });
}
var rmv_hdd = function (id,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method: "rmv_hdd",id:id}, function (data){
        $("#table_body").html(JSON.parse(data));
    });
}
var rmv_network = function (id,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method: "rmv_network",id:id}, function (data){
        $("#table_body").html(JSON.parse(data));
    });
}
var rmv_power_supply = function (id,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method: "rmv_power_supply",id:id}, function (data){
        $("#table_body").html(JSON.parse(data));
    });
}
var rmv_monitor = function (id,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method: "rmv_monitor",id:id}, function (data){
        $("#table_body").html(JSON.parse(data));
    });
}
var rmv_peripheral = function (id,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method: "rmv_peripheral",id:id}, function (data){
        $("#table_body").html(JSON.parse(data));
    });
}
var rmv_network_device = function (id,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method: "rmv_network_device",id:id}, function (data){
        $("#table_body").html(JSON.parse(data));
    });
}
var rmv_mobile_device = function (id,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method: "rmv_mobile_device",id:id}, function (data){
        $("#table_body").html(JSON.parse(data));
    });
}
var rmv_worker = function (id,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method: "rmv_worker",id:id}, function (data){
        $("#table_body").html(JSON.parse(data));
    });
}
var rmv_users = function (id,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method: "rmv_users",id:id}, function (data){
        $("#table_body").html(JSON.parse(data));
    });
}
var rmv_groups = function (id,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method: "rmv_groups",id:id}, function (data){
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
var sort_gpu_by = function (by,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method:"sort_gpu_by",by:by}, function(data){
        $("#table_body").html(JSON.parse(data));
    });
}
var sort_hdd_by = function (by,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method:"sort_hdd_by",by:by}, function(data){
        $("#table_body").html(JSON.parse(data));
    });
}
var sort_network_by = function (by,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method:"sort_network_by",by:by}, function(data){
        $("#table_body").html(JSON.parse(data));
    });
}
var sort_power_supply_by = function (by,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method:"sort_power_supply_by",by:by}, function(data){
        $("#table_body").html(JSON.parse(data));
    });
}
var sort_monitor_by = function (by,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method:"sort_monitor_by",by:by}, function(data){
        $("#table_body").html(JSON.parse(data));
    });
}
var sort_peripheral_by = function (by,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method:"sort_peripheral_by",by:by}, function(data){
        $("#table_body").html(JSON.parse(data));
    });
}
var sort_network_device_by = function (by,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method:"sort_network_device_by",by:by}, function(data){
        $("#table_body").html(JSON.parse(data));
    });
}
var sort_mobile_device_by = function (by,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method:"sort_mobile_device_by",by:by}, function(data){
        $("#table_body").html(JSON.parse(data));
    });
}
var sort_worker_by = function (by,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method:"sort_worker_by",by:by}, function(data){
        $("#table_body").html(JSON.parse(data));
    });
}
var sort_users_by = function (by,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method:"sort_users_by",by:by}, function(data){
        $("#table_body").html(JSON.parse(data));
    });
}
var sort_groups_by = function (by,event){
    event.preventDefault();
    $.post("inc/ajax.php",{method:"sort_groups_by",by:by}, function(data){
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
var search_gpu = function (event){
    event.preventDefault();
    var what = $("#gpu_search").val();
    var where = $("#gpu_search_select").val();
    var checked_what = check_input("gpu_search");
    if(checked_what == true){
        $.post("inc/ajax.php",{method: "search_gpu",where:where,what:what}, function (data){
            $("#table_body").html(JSON.parse(data));
        });
    }
    else {
        $("#gpu").trigger("click");
    }
}
var search_hdd = function (event){
    event.preventDefault();
    var what = $("#hdd_search").val();
    var where = $("#hdd_search_select").val();
    var checked_what = check_input("hdd_search");
    if(checked_what == true){
        $.post("inc/ajax.php",{method: "search_hdd",where:where,what:what}, function (data){
            $("#table_body").html(JSON.parse(data));
        });
    }
    else {
        $("#gpu").trigger("click");
    }
}
var search_network = function (event){
    event.preventDefault();
    var what = $("#network_search").val();
    var where = $("#network_search_select").val();
    var checked_what = check_input("network_search");
    if(checked_what == true){
        $.post("inc/ajax.php",{method: "search_network",where:where,what:what}, function (data){
            $("#table_body").html(JSON.parse(data));
        });
    }
    else {
        $("#gpu").trigger("click");
    }
}
var search_power_supply = function (event){
    event.preventDefault();
    var what = $("#power_supply_search").val();
    var where = $("#power_supply_search_select").val();
    var checked_what = check_input("power_supply_search");
    if(checked_what == true){
        $.post("inc/ajax.php",{method: "search_power_supply",where:where,what:what}, function (data){
            $("#table_body").html(JSON.parse(data));
        });
    }
    else {
        $("#power_supply").trigger("click");
    }
}
var search_monitor = function (event){
    event.preventDefault();
    var what = $("#monitor_search").val();
    var where = $("#monitor_search_select").val();
    var checked_what = check_input("monitor_search");
    if(checked_what == true){
        $.post("inc/ajax.php",{method: "search_monitor",where:where,what:what}, function (data){
            $("#table_body").html(JSON.parse(data));
        });
    }
    else {
        $("#power_supply").trigger("click");
    }
}
var search_peripheral = function (event){
    event.preventDefault();
    var what = $("#peripheral_search").val();
    var where = $("#peripheral_search_select").val();
    var checked_what = check_input("peripheral_search");
    if(checked_what == true){
        $.post("inc/ajax.php",{method: "search_peripheral",where:where,what:what}, function (data){
            $("#table_body").html(JSON.parse(data));
        });
    }
    else {
        $("#power_supply").trigger("click");
    }
}
var search_network_device = function (event){
    event.preventDefault();
    var what = $("#network_device_search").val();
    var where = $("#network_device_search_select").val();
    var checked_what = check_input("network_device_search");
    if(checked_what == true){
        $.post("inc/ajax.php",{method: "search_network_device",where:where,what:what}, function (data){
            $("#table_body").html(JSON.parse(data));
        });
    }
    else {
        $("#power_supply").trigger("click");
    }
}
var search_mobile_device = function (event){
    event.preventDefault();
    var what = $("#mobile_device_search").val();
    var where = $("#mobile_device_search_select").val();
    var checked_what = check_input("mobile_device_search");
    if(checked_what == true){
        $.post("inc/ajax.php",{method: "search_mobile_device",where:where,what:what}, function (data){
            $("#table_body").html(JSON.parse(data));
        });
    }
    else {
        $("#power_supply").trigger("click");
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
    $("#gpu").click(function (event) {
        event.preventDefault();
        $.post("inc/ajax.php",{method:"get_table_header_gpu"},function(data){
            data = JSON.parse(data);
            $("#search_bar").html(data['searchbar']);
            $("#table_header").html(data['table_header']);
            $("#table_body").html(data['table_content']);
        });
        clear_active();
        $("#gpuLI").addClass("active");
    });
    $("#hdd").click(function (event) {
        event.preventDefault();
        $.post("inc/ajax.php",{method:"get_table_header_hdd"},function(data){
            data = JSON.parse(data);
            $("#search_bar").html(data['searchbar']);
            $("#table_header").html(data['table_header']);
            $("#table_body").html(data['table_content']);
        });
        clear_active();
        $("#hddLI").addClass("active");
    });
    $("#network").click(function (event) {
        event.preventDefault();
        $.post("inc/ajax.php",{method:"get_table_header_network"},function(data){
            data = JSON.parse(data);
            $("#search_bar").html(data['searchbar']);
            $("#table_header").html(data['table_header']);
            $("#table_body").html(data['table_content']);
        });
        clear_active();
        $("#networkLI").addClass("active");
    });
    $("#power_supply").click(function (event) {
        event.preventDefault();
        $.post("inc/ajax.php",{method:"get_table_header_power_supply"},function(data){
            data = JSON.parse(data);
            $("#search_bar").html(data['searchbar']);
            $("#table_header").html(data['table_header']);
            $("#table_body").html(data['table_content']);
        });
        clear_active();
        $("#power_supplyLI").addClass("active");
    });
    $("#monitor").click(function (event) {
        event.preventDefault();
        $.post("inc/ajax.php",{method:"get_table_header_monitor"},function(data){
            data = JSON.parse(data);
            $("#search_bar").html(data['searchbar']);
            $("#table_header").html(data['table_header']);
            $("#table_body").html(data['table_content']);
        });
        clear_active();
        $("#monitorLI").addClass("active");
    });
    $("#peripheral").click(function (event) {
        event.preventDefault();
        $.post("inc/ajax.php",{method:"get_table_peripheral"},function(data){
            data = JSON.parse(data);
            $("#search_bar").html(data['searchbar']);
            $("#table_header").html(data['table_header']);
            $("#table_body").html(data['table_content']);
        });
        clear_active();
        $("#peripheralLI").addClass("active");
    });
    $("#network_device").click(function (event) {
        event.preventDefault();
        $.post("inc/ajax.php",{method:"get_table_network_device"},function(data){
            data = JSON.parse(data);
            $("#search_bar").html(data['searchbar']);
            $("#table_header").html(data['table_header']);
            $("#table_body").html(data['table_content']);
        });
        clear_active();
        $("#network_deviceLI").addClass("active");
    });
    $("#mobile_device").click(function (event) {
        event.preventDefault();
        $.post("inc/ajax.php",{method:"get_table_mobile_device"},function(data){
            data = JSON.parse(data);
            $("#search_bar").html(data['searchbar']);
            $("#table_header").html(data['table_header']);
            $("#table_body").html(data['table_content']);
        });
        clear_active();
        $("#mobile_deviceLI").addClass("active");
    });
    $("#workers").click(function (event) {
        event.preventDefault();
        $.post("inc/ajax.php",{method:"get_table_worker"},function(data){
            data = JSON.parse(data);
            $("#search_bar").html(data['searchbar']);
            $("#table_header").html(data['table_header']);
            $("#table_body").html(data['table_content']);
        });
        clear_active();
        $("#workersLI").addClass("active");
    });
    $("#users").click(function (event) {
        event.preventDefault();
        $.post("inc/ajax.php",{method:"get_table_users"},function(data){
            data = JSON.parse(data);
            $("#search_bar").html(data['searchbar']);
            $("#table_header").html(data['table_header']);
            $("#table_body").html(data['table_content']);
        });
        clear_active();
        $("#usersLI").addClass("active");
    });
    $("#groups").click(function (event) {
        event.preventDefault();
        $.post("inc/ajax.php",{method:"get_table_groups"},function(data){
            data = JSON.parse(data);
            $("#search_bar").html(data['searchbar']);
            $("#table_header").html(data['table_header']);
            $("#table_body").html(data['table_content']);
        });
        clear_active();
        $("#groupsLI").addClass("active");
    });
    /*processing tabs*/

});