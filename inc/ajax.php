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
$authorization = new Authorization();
$hardware = new hardware();

switch ($_POST['method']){
    case 'login':
        $user = $authorization->login($_POST['login'],$_POST['password']);
        echo $user;
        break;
    case 'get_user_info':
        $user = $authorization->get_user_info();
        echo $user;
        break;
    case 'get_table_header_hardware':
        $hardware_content = $hardware->get_all_hardware();
        $hardware_search = $hardware->show_search_bar_hardware();
        $get_table_header_hardware = $hardware->get_table_header_hardware();
        $show_add_hardware = $hardware->show_add_hardware();
        $result = array("searchbar" => $hardware_search, "table_header" => $get_table_header_hardware, "table_content" => $hardware_content, "show_add_hardware" => $show_add_hardware);
        echo json_encode($result);
        break;
    case 'get_hardware_edit':
        $hardware = $hardware->show_edit_hardware_in_modal($_POST['id']);
        echo $hardware;
        break;
    case 'update_hardware':
        $hardware = $hardware->update_hardware($_POST['id'],$_POST['name'],$_POST['os'],$_POST['fio'],$_POST['ip'],$_POST['group']);
        echo json_encode($hardware);
        break;
    case 'rmv_hardware':
        $hardware = $hardware->rmv_hardware($_POST['id']);
        break;
    case 'sort_hardware_by':
        $hardware = $hardware->sort_hardware_by($_POST['by']);
        echo json_encode($hardware);
        break;
    case 'search_hardware':
        $hardware = $hardware->search_hardware($_POST['where'],$_POST['what']);
        echo json_encode($hardware);
        break;
    case 'add_hardware':
        $hardware = $hardware->add_hardware($_POST['name'],$_POST['system'],$_POST['worker'],$_POST['ip'],$_POST['group']);
        echo json_encode($hardware);
        break;
}

?>