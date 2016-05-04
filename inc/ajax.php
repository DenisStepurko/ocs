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
include_once('../inc/phpqrcode/qrlib.php');
$authorization = new Authorization();
$hardware = new hardware();
$mb = new motherboards();
$cpu = new cpu();
$ram = new ram();
$gpu = new gpu();

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
    /*search*/

    case 'generate_qr_hardware':
        $hardware = $hardware->generate_qr_hardware($_POST['id']);
        echo json_encode($hardware);
        break;

}

?>