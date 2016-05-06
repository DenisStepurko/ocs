<?php
/**
 * Created by PhpStorm.
 * User: Денис Степурко
 * Date: 19.04.2016
 * Time: 10:57
 */
include_once('../inc/safemysql.class.php');
include_once('../inc/authorization.class.php');
include_once('../inc/hardware.class.php');
include_once('../inc/workers.class.php');
include_once('../inc/groups.class.php');
include_once('../inc/motherboards.class.php');
include_once('../inc/cpu.class.php');
include_once('../inc/ram.class.php');
include_once('../inc/gpu.class.php');
include_once('../inc/hdd.class.php');
include_once('../inc/network.class.php');
include_once('../inc/power_supply.class.php');
include_once('../inc/monitors.class.php');
include_once('../inc/peripheral.class.php');
include_once('../inc/network_device.class.php');
include_once('../inc/mobile_device.class.php');
include_once('../inc/workers.class.php');
include_once('../inc/users.class.php');
include_once('../inc/phpqrcode/qrlib.php');
include_once('../inc/xml.class.php');
$authorization = new Authorization();
$hardware = new hardware();
$mb = new motherboards();
$cpu = new cpu();
$ram = new ram();
$gpu = new gpu();
$hdd = new hdd();
$network = new network();
$power_supply = new power_supply();
$monitor = new monitor();
$peripheral = new peripheral();
$network_device = new network_device();
$mobile_device = new mobile_device();
$worker = new worker();
$users = new users();
$groups = new groups();
$xml = new xml();

switch ($_POST['method']){
    /*auth*/
    case 'login':
        $user = $authorization->login($_POST['login'],$_POST['password']);
        echo $user;
        break;
    case 'get_user_info':
        $user = $authorization->get_user_info();
        echo $user;
        break;
    /*auth*/

    /*get table values*/
    case 'get_table_header_hardware':
        $hardware_content = $hardware->get_all_hardware();
        $hardware_search = $hardware->show_search_bar_hardware();
        $get_table_header_hardware = $hardware->get_table_header_hardware();
        $result = array("searchbar" => $hardware_search, "table_header" => $get_table_header_hardware, "table_content" => $hardware_content);
        echo json_encode($result);
        break;
    case 'get_table_header_mb':
        $get_table_header_mb = $mb->get_table_headers_mb();
        $get_content_table = $mb->get_all_motherboards();
        $get_motherboard_search = $mb->get_searchbar_motherboards();
        $result = array("searchbar" => $get_motherboard_search, "table_header" => $get_table_header_mb, "table_content" => $get_content_table);
        echo json_encode($result);
        break;
    case 'get_table_header_cpu':
        $get_table_header_cpu = $cpu->get_table_header();
        $get_table_content_cpu = $cpu->get_all_cpu();
        $get_cpu_search = $cpu->get_searchbar_cpu();
        $result = array("searchbar" => $get_cpu_search, "table_header" => $get_table_header_cpu, "table_content" => $get_table_content_cpu);
        echo json_encode($result);
        break;
    case 'get_table_header_ram':
        $get_table_header_ram = $ram->get_table_headers_ram();
        $get_table_content_ram = $ram->get_all_ram();
        $get_ram_search = $ram->get_searchbar_ram();
        $result = array("searchbar" => $get_ram_search, "table_header" => $get_table_header_ram, "table_content" => $get_table_content_ram);
        echo json_encode($result);
        break;
    case 'get_table_header_gpu':
        $get_table_header_gpu = $gpu->get_table_headers_gpu();
        $get_table_content_gpu = $gpu->get_all_gpu();
        $get_gpu_search = $gpu->get_searchbar_gpu();
        $result = array("searchbar" => $get_gpu_search, "table_header" => $get_table_header_gpu, "table_content" => $get_table_content_gpu);
        echo json_encode($result);
        break;
    case 'get_table_header_hdd':
        $get_table_header_hdd = $hdd->get_table_headers_hdd();
        $get_table_content_hdd = $hdd->get_all_hdd();
        $get_hdd_search = $hdd->get_searchbar_hdd();
        $result = array("searchbar" => $get_hdd_search, "table_header" => $get_table_header_hdd, "table_content" => $get_table_content_hdd);
        echo json_encode($result);
        break;
    case 'get_table_header_network':
        $get_table_header_network = $network->get_table_headers_network();
        $get_table_content_network = $network->get_all_network();
        $get_network_search = $network->get_searchbar_network();
        $result = array("searchbar" => $get_network_search, "table_header" => $get_table_header_network, "table_content" => $get_table_content_network);
        echo json_encode($result);
        break;
    case 'get_table_header_power_supply':
        $get_table_header_network = $power_supply->get_table_headers_power_supply();
        $get_table_content_power_supply = $power_supply->get_all_power_supply();
        $get_power_supply_search = $power_supply->get_searchbar_power_supply();
        $result = array("searchbar" => $get_power_supply_search, "table_header" => $get_table_header_network, "table_content" => $get_table_content_power_supply);
        echo json_encode($result);
        break;
    case 'get_table_header_monitor':
        $get_table_header_monitor = $monitor->get_table_headers_monitor();
        $get_table_content_monitor = $monitor->get_all_monitor();
        $get_monitor_search = $monitor->get_searchbar_monitor();
        $result = array("searchbar" => $get_monitor_search, "table_header" => $get_table_header_monitor, "table_content" => $get_table_content_monitor);
        echo json_encode($result);
        break;
    case 'get_table_peripheral':
        $get_table_header_peripheral = $peripheral->get_table_headers_peripheral();
        $get_table_content_peripheral = $peripheral->get_all_peripheral();
        $get_peripheral_search = $peripheral->get_searchbar_peripheral();
        $result = array("searchbar" => $get_peripheral_search, "table_header" => $get_table_header_peripheral, "table_content" => $get_table_content_peripheral);
        echo json_encode($result);
        break;
    case 'get_table_network_device':
        $get_table_header_network_device = $network_device->get_table_headers_network_device();
        $get_table_content_network_device = $network_device->get_all_network_device();
        $get_network_device_search = $network_device->get_searchbar_network_device();
        $result = array("searchbar" => $get_network_device_search, "table_header" => $get_table_header_network_device, "table_content" => $get_table_content_network_device);
        echo json_encode($result);
        break;
    case 'get_table_mobile_device':
        $get_table_header_mobile_device = $mobile_device->get_table_headers_mobile_device();
        $get_table_content_mobile_device = $mobile_device->get_all_mobile_device();
        $get_mobile_device_search = $mobile_device->get_searchbar_mobile_device();
        $result = array("searchbar" => $get_mobile_device_search, "table_header" => $get_table_header_mobile_device, "table_content" => $get_table_content_mobile_device);
        echo json_encode($result);
        break;
    case 'get_table_worker':
        $get_table_header_worker = $worker->get_table_headers_worker();
        $get_table_content_worker = $worker->get_all_worker();
        $get_worker_search = $worker->get_searchbar_worker();
        $result = array("searchbar" => $get_worker_search, "table_header" => $get_table_header_worker, "table_content" => $get_table_content_worker);
        echo json_encode($result);
        break;
    case 'get_table_users':
        $get_table_header_users = $users->get_table_headers_users();
        $get_table_content_users = $users->get_all_users();
        $get_users_search = $users->get_searchbar_users();
        $result = array("searchbar" => $get_users_search, "table_header" => $get_table_header_users, "table_content" => $get_table_content_users);
        echo json_encode($result);
        break;
    case 'get_table_groups':
        $get_table_header_groups = $groups->get_table_headers_groups();
        $get_table_content_groups = $groups->get_all_groups();
        $get_groups_search = $groups->get_searchbar_groups();
        $result = array("searchbar" => $get_groups_search, "table_header" => $get_table_header_groups, "table_content" => $get_table_content_groups);
        echo json_encode($result);
        break;
    /*get table values*/

    /*update*/
    case 'update_hardware':
        $hardware = $hardware->update_hardware($_POST['id'],$_POST['name'],$_POST['os'],$_POST['fio'],$_POST['ip'],$_POST['group']);
        echo json_encode($hardware);
        break;
    case 'update_motherboard':
        $result = $mb->update_motherboard($_POST['id'],$_POST['hardware'],$_POST['vendor'],$_POST['serial_number'],$_POST['model'],$_POST['socket'],$_POST['slots'],$_POST['form_factor'],$_POST['internal_video']);
        echo json_encode($result);
        break;
    case 'update_cpu':
        $result = $cpu->update_cpu($_POST['id'],$_POST['hardware'],$_POST['vendor'],$_POST['model'],$_POST['type'],$_POST['cores']);
        echo json_encode($result);
        break;
    case 'update_ram':
        $result = $ram->update_ram($_POST['id'],$_POST['hardware'],$_POST['serial_number'],$_POST['interface'],$_POST['type'],$_POST['speed'],$_POST['size']);
        echo json_encode($result);
        break;
    case 'update_gpu':
        $result = $gpu->update_gpu($_POST['id'],$_POST['hardware'],$_POST['vendor'],$_POST['size'],$_POST['interfaces']);
        echo json_encode($result);
        break;
    case 'update_hdd':
        $result = $hdd->update_hdd($_POST['id'],$_POST['hardware'],$_POST['vendor'],$_POST['model'],$_POST['serial_number'],$_POST['size'],$_POST['type']);
        echo json_encode($result);
        break;
    case 'update_network':
        $result = $network->update_network($_POST['id'],$_POST['hardware'],$_POST['vendor'],$_POST['mac_address'],$_POST['type']);
        echo json_encode($result);
        break;
    case 'update_power_supply':
        $result = $power_supply->update_power_supply($_POST['id'],$_POST['hardware'],$_POST['vendor'],$_POST['interfaces'],$_POST['power']);
        echo json_encode($result);
        break;
    case 'update_monitor':
        $result = $monitor->update_monitor($_POST['id'],$_POST['hardware'],$_POST['vendor'],$_POST['size'],$_POST['interfaces']);
        echo json_encode($result);
        break;
    case 'update_peripheral':
        $result = $peripheral->update_peripheral($_POST['id'],$_POST['serial_number'],$_POST['type'],$_POST['description'],$_POST['status']);
        echo json_encode($result);
        break;
    case 'update_network_device':
        $result = $network_device->update_network_device($_POST['id'],$_POST['model'],$_POST['port_number'],$_POST['serial_number'],$_POST['type'],$_POST['mac_address'],$_POST['status']);
        echo json_encode($result);
        break;
    case 'update_mobile_device':
        $result = $mobile_device->update_mobile_device($_POST['id'],$_POST['model'],$_POST['imei'],$_POST['serial_number'],$_POST['platform'],$_POST['status']);
        echo json_encode($result);
        break;
    case 'update_worker':
        $result = $worker->update_worker($_POST['id'],$_POST['fio'],$_POST['birthday']);
        echo json_encode($result);
        break;
    case 'update_users':
        $result = $users->update_users($_POST['id'],$_POST['login'],$_POST['password'],$_POST['email'],$_POST['admin']);
        echo json_encode($result);
        break;
    case 'update_groups':
        $result = $groups->update_groups($_POST['id'],$_POST['name']);
        echo json_encode($result);
        break;
    /*update*/

    /*modal*/

    /*edit*/
    case 'get_hardware_edit':
        $hardware = $hardware->show_edit_hardware_in_modal($_POST['id']);
        echo $hardware;
        break;
    case 'edit_motherboard':
        $result = $mb->show_edit_motherboards_in_modal($_POST['id']);
        echo json_encode($result);
        break;
    case 'edit_cpu':
        $result = $cpu->show_edit_cpu_in_modal($_POST['id']);
        echo json_encode($result);
        break;
    case 'edit_ram':
        $result = $ram->show_edit_ram_in_modal($_POST['id']);
        echo json_encode($result);
        break;
    case 'edit_gpu':
        $result = $gpu->show_edit_gpu_in_modal($_POST['id']);
        echo json_encode($result);
        break;
    case 'edit_hdd':
        $result = $hdd->show_edit_hdd_in_modal($_POST['id']);
        echo json_encode($result);
        break;
    case 'edit_network':
        $result = $network->show_edit_network_in_modal($_POST['id']);
        echo json_encode($result);
        break;
    case 'edit_power_supply':
        $result = $power_supply->show_edit_power_supply_in_modal($_POST['id']);
        echo json_encode($result);
        break;
    case 'edit_monitor':
        $result = $monitor->show_edit_monitor_in_modal($_POST['id']);
        echo json_encode($result);
        break;
    case 'edit_peripheral':
        $result = $peripheral->show_edit_peripheral_in_modal($_POST['id']);
        echo json_encode($result);
        break;
    case 'edit_network_device':
        $result = $network_device->show_edit_network_device_in_modal($_POST['id']);
        echo json_encode($result);
        break;
    case 'edit_mobile_device':
        $result = $mobile_device->show_edit_mobile_device_in_modal($_POST['id']);
        echo json_encode($result);
        break;
    case 'edit_worker':
        $result = $worker->show_edit_worker_in_modal($_POST['id']);
        echo json_encode($result);
        break;
    case 'edit_users':
        $result = $users->show_edit_users_in_modal($_POST['id']);
        echo json_encode($result);
        break;
    case 'edit_groups':
        $result = $groups->show_edit_groups_in_modal($_POST['id']);
        echo json_encode($result);
        break;
    /*edit*/

    /*add*/
    case 'show_add_hardware_modal':
        $show_add_hardware = $hardware->show_add_hardware_in_modal();
        echo $show_add_hardware;
        break;
    case 'show_add_motherboard_modal':
        $result = $mb->show_add_motherboard_modal();
        echo $result;
        break;
    case 'show_add_cpu_modal':
        $result = $cpu->show_add_cpu_modal();
        echo $result;
        break;
    case 'show_add_ram_modal':
        $result = $ram->show_add_ram_modal();
        echo $result;
        break;
    case 'show_add_gpu_modal':
        $result = $gpu->show_add_gpu_modal();
        echo $result;
        break;
    case 'show_add_hdd_modal':
        $result = $hdd->show_add_hdd_modal();
        echo $result;
        break;
    case 'show_add_network_modal':
        $result = $network->show_add_network_modal();
        echo $result;
        break;
    case 'show_add_power_supply_modal':
        $result = $power_supply->show_add_power_supply_modal();
        echo $result;
        break;
    case 'show_add_monitor_modal':
        $result = $monitor->show_add_monitor_modal();
        echo $result;
        break;
    case 'show_add_peripheral_modal':
        $result = $peripheral->show_add_peripheral_modal();
        echo $result;
        break;
    case 'show_add_network_device_modal':
        $result = $network_device->show_add_network_device_modal();
        echo $result;
        break;
    case 'show_add_mobile_device_modal':
        $result = $mobile_device->show_add_mobile_device_modal();
        echo $result;
        break;
    case 'show_add_worker_modal':
        $result = $worker->show_add_worker_modal();
        echo $result;
        break;
    case 'show_add_users_modal':
        $result = $users->show_add_users_modal();
        echo $result;
        break;
    case 'show_add_groups_modal':
        $result = $groups->show_add_groups_modal();
        echo $result;
        break;
    /*add*/

    /*processing*/

    /*add*/
    case 'add_hardware':
        $hardware = $hardware->add_hardware($_POST['name'],$_POST['system'],$_POST['worker'],$_POST['ip'],$_POST['group']);
        echo json_encode($hardware);
        break;
    case 'add_motherboard':
        $result = $mb->add_motherboard($_POST['hardware'],$_POST['vendor'],$_POST['serial_number'],$_POST['model'],$_POST['socket'],$_POST['memory_slots'],$_POST['internal_video'],$_POST['form_factor']);
        echo json_encode($result);
        break;
    case 'add_cpu':
        $result = $cpu->add_cpu($_POST['hardware'],$_POST['vendor'],$_POST['model'],$_POST['type'],$_POST['cores']);
        echo json_encode($result);
        break;
    case 'add_ram':
        $result = $ram->add_ram($_POST['hardware'],$_POST['serail_number'],$_POST['interface'],$_POST['type'],$_POST['speed'],$_POST['size']);
        echo json_encode($result);
        break;
    case 'add_gpu':
        $result = $gpu->add_gpu($_POST['hardware'],$_POST['vendor'],$_POST['size'],$_POST['interfaces']);
        echo json_encode($result);
        break;
    case 'add_hdd':
        $result = $hdd->add_hdd($_POST['hardware'],$_POST['vendor'],$_POST['model'],$_POST['serial_number'],$_POST['size'],$_POST['type']);
        echo json_encode($result);
        break;
    case 'add_network':
        $result = $network->add_network($_POST['hardware'],$_POST['vendor'],$_POST['mac_address'],$_POST['type']);
        echo json_encode($result);
        break;
    case 'add_power_supply':
        $result = $power_supply->add_power_supply($_POST['hardware'],$_POST['vendor'],$_POST['interfaces'],$_POST['power']);
        echo json_encode($result);
        break;
    case 'add_monitor':
        $result = $monitor->add_monitor($_POST['hardware'],$_POST['vendor'],$_POST['size'],$_POST['interfaces']);
        echo json_encode($result);
        break;
    case 'add_peripheral':
        $result = $peripheral->add_peripheral($_POST['serial_number'],$_POST['type'],$_POST['description'],$_POST['status']);
        echo json_encode($result);
        break;
    case 'add_network_device':
        $result = $network_device->add_network_device($_POST['model'],$_POST['port_number'],$_POST['serial_number'],$_POST['type'],$_POST['mac_address'],$_POST['status']);
        echo json_encode($result);
        break;
    case 'add_mobile_device':
        $result = $mobile_device->add_mobile_device($_POST['model'],$_POST['imei'],$_POST['serial_number'],$_POST['platform'],$_POST['status']);
        echo json_encode($result);
        break;
    case 'add_worker':
        $result = $worker->add_worker($_POST['fio'],$_POST['birthday']);
        echo json_encode($result);
        break;
    case 'add_users':
        $result = $users->add_users($_POST['login'],$_POST['password'],$_POST['email'],$_POST['admin']);
        echo json_encode($result);
        break;
    case 'add_groups':
        $result = $groups->add_groups($_POST['name']);
        echo json_encode($result);
        break;
    /*add*/

    /*processing*/

    /*modal*/

    /*rmv*/
    case 'rmv_hardware':
        $hardware = $hardware->rmv_hardware($_POST['id']);
        break;
    case 'rmv_motherboard':
        $result = $mb->rmv_motherboard($_POST['id']);
        echo json_encode($result);
        break;
    case 'rmv_cpu':
        $result = $cpu->rmv_cpu($_POST['id']);
        echo json_encode($result);
        break;
    case 'rmv_ram':
        $result = $ram->rmv_ram($_POST['id']);
        echo json_encode($result);
        break;
    case 'rmv_gpu':
        $result = $gpu->rmv_gpu($_POST['id']);
        echo json_encode($result);
        break;
    case 'rmv_hdd':
        $result = $hdd->rmv_hdd($_POST['id']);
        echo json_encode($result);
        break;
    case 'rmv_network':
        $result = $network->rmv_network($_POST['id']);
        echo json_encode($result);
        break;
    case 'rmv_power_supply':
        $result = $power_supply->rmv_power_supply($_POST['id']);
        echo json_encode($result);
        break;
    case 'rmv_monitor':
        $result = $monitor->rmv_monitor($_POST['id']);
        echo json_encode($result);
        break;
    case 'rmv_peripheral':
        $result = $peripheral->rmv_peripheral($_POST['id']);
        echo json_encode($result);
        break;
    case 'rmv_network_device':
        $result = $network_device->rmv_network_device($_POST['id']);
        echo json_encode($result);
        break;
    case 'rmv_mobile_device':
        $result = $mobile_device->rmv_mobile_device($_POST['id']);
        echo json_encode($result);
        break;
    case 'rmv_worker':
        $result = $worker->rmv_worker($_POST['id']);
        echo json_encode($result);
        break;
    case 'rmv_users':
        $result = $users->rmv_users($_POST['id']);
        echo json_encode($result);
        break;
    case 'rmv_groups':
        $result = $groups->rmv_groups($_POST['id']);
        echo json_encode($result);
        break;
    /*rmv*/

    /*sort*/
    case 'sort_hardware_by':
        $hardware = $hardware->sort_hardware_by($_POST['by']);
        echo json_encode($hardware);
        break;
    case 'sort_motherboard_by':
        $hardware = $mb->sort_motherboards_by($_POST['by']);
        echo json_encode($hardware);
        break;
    case 'sort_cpu_by':
        $hardware = $cpu->sort_cpu_by($_POST['by']);
        echo json_encode($hardware);
        break;
    case 'sort_ram_by':
        $hardware = $ram->sort_ram_by($_POST['by']);
        echo json_encode($hardware);
        break;
    case 'sort_gpu_by':
        $hardware = $gpu->sort_gpu_by($_POST['by']);
        echo json_encode($hardware);
        break;
    case 'sort_hdd_by':
        $hardware = $hdd->sort_hdd_by($_POST['by']);
        echo json_encode($hardware);
        break;
    case 'sort_network_by':
        $hardware = $network->sort_network_by($_POST['by']);
        echo json_encode($hardware);
        break;
    case 'sort_power_supply_by':
        $hardware = $power_supply->sort_power_supply_by($_POST['by']);
        echo json_encode($hardware);
        break;
    case 'sort_monitor_by':
        $hardware = $monitor->sort_monitor_by($_POST['by']);
        echo json_encode($hardware);
        break;
    case 'sort_peripheral_by':
        $hardware = $peripheral->sort_peripheral_by($_POST['by']);
        echo json_encode($hardware);
        break;
    case 'sort_network_device_by':
        $hardware = $network_device->sort_network_device_by($_POST['by']);
        echo json_encode($hardware);
        break;
    case 'sort_mobile_device_by':
        $hardware = $mobile_device->sort_mobile_device_by($_POST['by']);
        echo json_encode($hardware);
        break;
    case 'sort_worker_by':
        $hardware = $worker->sort_worker_by($_POST['by']);
        echo json_encode($hardware);
        break;
    case 'sort_users_by':
        $hardware = $users->sort_users_by($_POST['by']);
        echo json_encode($hardware);
        break;
    case 'sort_groups_by':
        $hardware = $groups->sort_groups_by($_POST['by']);
        echo json_encode($hardware);
        break;
    /*sort*/

    /*search*/
    case 'search_hardware':
        $hardware = $hardware->search_hardware($_POST['where'],$_POST['what']);
        echo json_encode($hardware);
        break;
    case 'search_motherboard':
        $hardware = $mb->search_motherboard($_POST['where'],$_POST['what']);
        echo json_encode($hardware);
        break;
    case 'search_cpu':
        $cpus = $cpu->search_cpu($_POST['where'],$_POST['what']);
        echo json_encode($cpus);
        break;
    case 'search_ram':
        $rams = $ram->search_ram($_POST['where'],$_POST['what']);
        echo json_encode($rams);
        break;
    case 'search_gpu':
        $gpus = $gpu->search_gpu($_POST['where'],$_POST['what']);
        echo json_encode($gpus);
        break;
    case 'search_hdd':
        $hdds = $hdd->search_hdd($_POST['where'],$_POST['what']);
        echo json_encode($hdds);
        break;
    case 'search_power_supply':
        $result = $power_supply->search_power_supply($_POST['where'],$_POST['what']);
        echo json_encode($result);
        break;
    case 'search_monitor':
        $result = $monitor->search_monitor($_POST['where'],$_POST['what']);
        echo json_encode($result);
        break;
    case 'search_peripheral':
        $result = $peripheral->search_peripheral($_POST['where'],$_POST['what']);
        echo json_encode($result);
        break;
    case 'search_network_device':
        $result = $network_device->search_network_device($_POST['where'],$_POST['what']);
        echo json_encode($result);
        break;
    case 'search_mobile_device':
        $result = $mobile_device->search_mobile_device($_POST['where'],$_POST['what']);
        echo json_encode($result);
        break;
    /*search*/

    case 'generate_qr_hardware':
        $hardware = $hardware->generate_qr_hardware($_POST['id']);
        echo json_encode($hardware);
        break;

    case 'get_table_load_file':
        $search = $xml->get_table_content_load_file();
        $result = array("searchbar" => $search/*, "table_header" => $get_table_header_hardware, "table_content" => $content*/);
        echo json_encode($result);
        break;
    case 'get_table_content_file':
        $content = $xml->get_table_content();
        $result = array("table_content" => $content);
        echo json_encode($result);
        break;

}

?>