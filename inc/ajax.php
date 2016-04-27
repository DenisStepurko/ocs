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
include_once('../inc/phpqrcode/qrlib.php');
$authorization = new Authorization();
$hardware = new hardware();
$mb = new motherboards();

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
    /*edit*/

    /*add*/
    case 'show_add_motherboard_modal':
        $result = $mb->show_add_motherboard_modal();
        echo $result;
        break;
    case 'show_add_hardware_modal':
        $show_add_hardware = $hardware->show_add_hardware_in_modal();
        echo $show_add_hardware;
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
    /*search*/

    case 'generate_qr_hardware':
        $hardware = $hardware->generate_qr_hardware($_POST['id']);
        echo json_encode($hardware);
        break;

}

?>