<?php
/**
 * Created by PhpStorm.
 * User: Денис Степурко
 * Date: 04.05.2016
 * Time: 16:11
 */

class network_device {
    private $db;

    public function __construct() {
        $this->db = new MysqliDb();
    }

    public function get_table_headers_network_device(){
        return '<tr>
                    <td id="table_center_text"><a href="#" onclick="sort_network_device_by(`model`,event)">Модель</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_network_device_by(`port_number`,event)">Количество портов</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_network_device_by(`serial_number`,event)">Серийный номер</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_network_device_by(`type`,event)">Тип</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_network_device_by(`mac_address`,event)">MAC-адрес</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_network_device_by(`status`,event)">Статус</a></td>
                    <td id="table_center_text"><a href="#" onclick="show_add_network_device_modal(event)">Добавить</a></td>
                </tr>';
    }

    public function get_all_network_device() {
        $network_devices = $this->db->get('network_device');
        if($this->db->count > 0 ){
            $result = array();
            foreach ($network_devices as $network_device){
                array_push($result, "<tr>
                    <td>".$network_device['model']."</td>
                    <td>".$network_device['port_number']."</td>
                    <td>".$network_device['serial_number']."</td>
                    <td>".$this->return_type($network_device['type'])."</td>
                    <td>".$network_device['mac_address']."</td>
                    <td>".$this->return_usage($network_device['status'])."</td>
                    <td><a href='#' onclick='edit_network_device(".$network_device['ID'].",event)' class='edit_index'><img src='images/edit.gif'></a>
                    <a href='#' onclick='rmv_network_device(".$network_device['ID'].",event)'  class='rmv_index'><img src='images/del.gif'></a></td>
                </tr>");
            }
            array_push($result,"<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>");
            return $result;
        }
    }

    public function get_searchbar_network_device(){
        return "
        <input type='text' id='network_device_search'>
        <select id='network_device_search_select'>
                <option value='model'>Модель</option>
                <option value='port_number'>Количество портов</option>
                <option value='type'>Тип</option>
                <option value='mac_address'>Мак адрес</option>
                <option value='status'>Статус</option>
        </select>
        <input type='button' id='motherboard_search_button' onclick='search_network_device(event)' value='Поиск'>
        ";
    }

    public function show_add_network_device_modal(){
        return '
            <div class="col-md-12">
            <h3>Add network_device</h3>
                <label for="network_device_add_model">Модель</label><input type="text" id="network_device_add_model">
                <label for="network_device_add_port_number">Количество портов</label><input type="text" id="network_device_add_port_number">
                <label for="network_device_add_serial_number">Серийный номер</label><input type="text" id="network_device_add_serial_number">
                <label for="network_device_add_type">Тип</label><select id="network_device_add_type">'.$this->return_type_select().'</select>
                <label for="network_device_add_mac_address">MAC-адрес</label><input type="text" id="network_device_add_mac_address">
                <label for="network_device_add_status">Статус</label><select id="network_device_add_status">'.$this->return_usage_select().'</select>
                <input type="button" onclick="add_network_device(event);" value="Добавить">
            </div>
        ';
    }

    public function add_network_device($model,$port_number,$serial_number,$type,$mac_address,$status){
        $data = array("model" => $model, "port_number" => $port_number, "serial_number" => $serial_number, "type" => $type, "mac_address" => $mac_address, "status" => $status);
        $this->db->insert('network_device',$data);
        $network_device = $this->get_all_network_device();
        return $network_device;
    }

    public function rmv_network_device($id){
        $this->db->where('ID',$id);
        $this->db->delete('network_device',1);
        $result = $this->get_all_network_device();
        return $result;
    }

    public function show_edit_network_device_in_modal($id){
        $network_devices = $this->db->get('network_device');
        if($this->db->count > 0){
            foreach ($network_devices as $network_device){
                if($network_device['ID'] == $id) {
                    return '
                            <div class="col-md-12">
                                <h3>Edit network_device</h3>
                                <input type="hidden" value="' . $network_device['ID'] . '" id="network_device_id">
                                <label for="network_device_edit_model">Модель</label><input type="text" id="network_device_edit_model" value="'.$network_device['model'].'">
                                <label for="network_device_edit_port_number">Количество портов</label><input type="text" id="network_device_edit_port_number" value="'.$network_device['port_number'].'">
                                <label for="network_device_edit_serial_number">Серийный номер</label><input type="text" id="network_device_edit_serial_number" value="'.$network_device['serial_number'].'">
                                <label for="network_device_edit_type">Тип</label><select id="network_device_edit_type">'.$this->return_type_select($network_device['type']).'</select>
                                <label for="network_device_edit_mac_address">MAC-адрес</label><input type="text" id="network_device_edit_mac_address" value="'.$network_device['mac_address'].'">
                                <label for="network_device_edit_status">Статус</label><select id="network_device_edit_status" >'.$this->return_usage_select($network_device['status']).'</select>                      
                                <input type="button" value="Сохранить" onclick="update_network_device(event)" id="update_network_device">
                            </div>
                    ';
                }
            }
        }
    }

    public function update_network_device($id,$model,$port_number,$serial_number,$type,$mac_address,$status){
        $this->db->where('ID',$id);
        $data = array("model" => $model, "port_number" => $port_number, "serial_number" => $serial_number, "type" => $type, "mac_address" => $mac_address, "status" => $status);
        $this->db->update('network_device',$data,1);
        $network_devices = $this->get_all_network_device();
        return $network_devices;
    }

    public function search_network_device($where,$what) {
        if($where == 'h_id'){
            $hardwares = $this->db->get('hardware');
            foreach ($hardwares as $hardware){
                if(strtoupper($hardware['name']) == strtoupper($what)){
                    $this->db->where('h_id',$hardware['ID'],'LIKE');
                }
            }
        } else {
            $this->db->where($where,$what,'LIKE');
        }
        $hardware = $this->get_all_network_device();
        return $hardware;
    }

    public function sort_network_device_by($by){
        $this->db->orderBy($by,"ASC");
        $hardware = $this->get_all_network_device();
        return $hardware;
    }

    public function return_type($type){
        if($type == 1){
            return 'active';
        } else {
            return 'pasive';
        }
    }

    public function return_type_select($type = null){
        if($type == 1){
            $result = '<option value="1" selected>active</option>';
            $result .= '<option value="2">pasive</option>';
        } else {
            $result = '<option value="1">active</option>';
            $result .= '<option value="2" selected>pasive</option>';
        }
        return $result;
    }

    public function return_usage($usage) {
        if($usage == 2 ){
            return 'Не используется';
        }
        else {
            return 'Используется';
        }
    }

    public function return_usage_select($usage = null) {
        if($usage == 1){
            $result = '<option value="1" selected>Используется</option>';
            $result .= '<option value="2">Не используется</option>';
        } else {
            $result = '<option value="1">Используется</option>';
            $result .= '<option value="2" selected>Не используется</option>';
        }
        return $result;
    }
}

?>