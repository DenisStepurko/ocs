<?php
/**
 * Created by PhpStorm.
 * User: Денис Степурко
 * Date: 04.05.2016
 * Time: 17:09
 */

class mobile_device {
    private $db;
    private $workers;

    public function __construct() {
        $this->db = new MysqliDb();
        $this->workers = new worker();
    }

    public function get_table_headers_mobile_device(){
        return '<tr>
                    <td id="table_center_text"><a href="#" onclick="sort_mobile_device_by(`ID`,event)">ID</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_mobile_device_by(`model`,event)">Модель</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_mobile_device_by(`imei`,event)">Imei</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_mobile_device_by(`serial_number`,event)">Серийный номер</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_mobile_device_by(`platform`,event)">platform</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_mobile_device_by(`status`,event)">Статус</a></td>
                    <td id="table_center_text"><a href="#" onclick="show_add_mobile_device_modal(event)">Добавить</a></td>
                </tr>';
    }

    public function get_all_mobile_device() {
        $mobile_devices = $this->db->get('mobile_device');
        if($this->db->count > 0 ){
            $result = array();
            foreach ($mobile_devices as $mobile_device){
                array_push($result, "<tr>
                    <td>".$mobile_device['ID']."</td>
                    <td>".$mobile_device['model']."</td>
                    <td>".$mobile_device['imei']."</td>
                    <td>".$mobile_device['serial_number']."</td>
                    <td>".$mobile_device['platform']."</td>
                    <td>".$this->workers->return_worker_fio($mobile_device['status'])."</td>
                    <td><a href='#' onclick='edit_mobile_device(".$mobile_device['ID'].",event)' class='edit_index'><img src='images/edit.gif'></a>
                    <a href='#' onclick='rmv_mobile_device(".$mobile_device['ID'].",event)'  class='rmv_index'><img src='images/del.gif'></a></td>
                </tr>");
            }
            array_push($result,"<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>");
            return $result;
        }
    }

    public function get_searchbar_mobile_device(){
        return "
        <input type='text' id='mobile_device_search'>
        <select id='mobile_device_search_select'>
                <option value='model'>Модель</option>
                <option value='imei'>Imei</option>
        </select>
        <input type='button' id='motherboard_search_button' onclick='search_mobile_device(event)' value='Поиск'>
        ";
    }

    public function show_add_mobile_device_modal(){
        return '
            <div class="col-md-12">
            <h3>Add mobile_device</h3>
                <label for="mobile_device_add_model">Модель</label><input type="text" id="mobile_device_add_model">
                <label for="mobile_device_add_imei">Imei</label><input type="text" id="mobile_device_add_imei">
                <label for="mobile_device_add_serial_number">Серийный номер</label><input type="text" id="mobile_device_add_serial_number">
                <label for="mobile_device_add_platform">Платформа</label><input type="text" id="mobile_device_add_platform">
                <label for="mobile_device_add_status">Статус</label><select id="mobile_device_add_status">'.$this->workers->return_select_with_workers().'</select>
                <input type="button" onclick="add_mobile_device(event);" value="Добавить">
            </div>
        ';
    }

    public function add_mobile_device($model,$imei,$serial_number,$platform,$status){
        $data = array("model" => $model, "imei" => $imei, "serial_number" => $serial_number, "platform" => $platform, "status" => $status);
        $added_id = $this->db->insert('mobile_device',$data);
        $mobile_device = $this->get_all_mobile_device();
        return $mobile_device;
    }

    public function rmv_mobile_device($id){
        $this->db->where('ID',$id);
        $this->db->delete('mobile_device',1);
        $result = $this->get_all_mobile_device();
        return $result;
    }

    public function show_edit_mobile_device_in_modal($id){
        $mobile_devices = $this->db->get('mobile_device');
        if($this->db->count > 0){
            foreach ($mobile_devices as $mobile_device){
                if($mobile_device['ID'] == $id) {
                    return '
                            <div class="col-md-12">
                                <h3>Edit mobile_device</h3>
                                <input type="hidden" value="' . $mobile_device['ID'] . '" id="mobile_device_id">
                                <label for="mobile_device_edit_model">Модель</label><input type="text" id="mobile_device_edit_model" value="'.$mobile_device['model'].'">
                                <label for="mobile_device_edit_imei">Imei</label><input type="text" id="mobile_device_edit_imei" value="'.$mobile_device['imei'].'">
                                <label for="mobile_device_edit_serial_number">Серийный номер</label><input type="text" id="mobile_device_edit_serial_number" value="'.$mobile_device['serial_number'].'">
                                <label for="mobile_device_edit_platform">Тип</label><input type="text" id="mobile_device_edit_platform" value="'.$mobile_device['platform'].'">
                                <label for="mobile_device_edit_status">Статус</label><select id="mobile_device_edit_status" >'.$this->workers->return_select_with_workers($mobile_device['status']).'</select>                      
                                <input type="button" value="Сохранить" onclick="update_mobile_device(event)" id="update_mobile_device">
                            </div>
                    ';
                }
            }
        }
    }

    public function update_mobile_device($id,$model,$imei,$serial_number,$platform,$status){
        $this->db->where('ID',$id);
        $data = array("model" => $model, "imei" => $imei, "serial_number" => $serial_number, "platform" => $platform, "status" => $status);
        $this->db->update('mobile_device',$data,1);
        $mobile_devices = $this->get_all_mobile_device();
        return $mobile_devices;
    }

    public function search_mobile_device($where,$what) {
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
        $hardware = $this->get_all_mobile_device();
        return $hardware;
    }

    public function sort_mobile_device_by($by){
        $this->db->orderBy($by,"ASC");
        $hardware = $this->get_all_mobile_device();
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