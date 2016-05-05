<?php
/**
 * Created by PhpStorm.
 * User: Денис Степурко
 * Date: 04.05.2016
 * Time: 15:14
 */

class peripheral {
    private $db;

    public function __construct() {
        $this->db = new MysqliDb();
    }

    public function get_table_headers_peripheral(){
        return '<tr>
                    <td id="table_center_text"><a href="#" onclick="sort_peripheral_by(`serial_number`,event)">Серийный номер</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_peripheral_by(`type`,event)">Тип</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_peripheral_by(`description`,event)">Описание</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_peripheral_by(`status`,event)">Статус</a></td>
                    <td id="table_center_text"><a href="#" onclick="show_add_peripheral_modal(event)">Добавить</a></td>
                </tr>';
    }

    public function get_all_peripheral() {
        $peripherals = $this->db->get('peripheral');
        if($this->db->count > 0 ){
            $result = array();
            foreach ($peripherals as $peripheral){
                array_push($result, "<tr>
                    <td>".$peripheral['serial_number']."</td>
                    <td>".$peripheral['type']."</td>
                    <td>".$peripheral['description']."</td>
                    <td>".$this->return_status($peripheral['status'])."</td>
                    <td><a href='#' onclick='edit_peripheral(".$peripheral['ID'].",event)' class='edit_index'><img src='images/edit.gif'></a>
                    <a href='#' onclick='rmv_peripheral(".$peripheral['ID'].",event)'  class='rmv_index'><img src='images/del.gif'></a></td>
                </tr>");
            }
            array_push($result,"<tr><td></td><td></td><td></td><td></td><td></td></tr>");
            return $result;
        }
    }

    public function get_searchbar_peripheral(){
        return "
        <input type='text' id='peripheral_search'>
        <select id='peripheral_search_select'>
                <option value='type'>Тип</option>
                <option value='description'>Описание</option>
        </select>
        <input type='button' id='motherboard_search_button' onclick='search_peripheral(event)' value='Поиск'>
        ";
    }

    public function return_status($status){
        if($status == 1){
            return 'Используется';
        } else {
            return 'Не используется';
        }
    }

    public function return_status_select($id = null){
        if($id == 2){
            $result = '<option value="1">Используется</option>';
            $result .= '<option selected value="2">Не используется</option>';
        }
        else {
            $result = '<option selected value="1">Используется</optionselected>';
            $result .= '<option value="2">Не используется</option>';
        }
        return $result;
    }

    public function show_add_peripheral_modal(){
        return '
            <div class="col-md-12">
            <h3>Add peripheral</h3>
                <label for="peripheral_add_hardware">Серийный номер</label><input type="text" id="peripheral_add_serial_number">
                <label for="peripheral_add_vendor">Тип</label><input type="text" id="peripheral_add_type">
                <label for="peripheral_add_mac_address">Описание</label><input type="text" id="peripheral_add_description">
                <label for="peripheral_add_status">Статус</label><select id="peripheral_add_status">'.$this->return_status_select().'</select>
                <input type="button" onclick="add_peripheral(event);" value="Добавить">
            </div>
        ';
    }

    public function add_peripheral($serial_number,$type,$description,$status){
        $data = array("serial_number" => $serial_number, "type" => $type, "description" => $description, "status" => $status);
        $this->db->insert('peripheral',$data);
        $peripheral = $this->get_all_peripheral();
        return $peripheral;
    }

    public function rmv_peripheral($id){
        $this->db->where('ID',$id);
        $this->db->delete('peripheral',1);
        $result = $this->get_all_peripheral();
        return $result;
    }

    public function show_edit_peripheral_in_modal($id){
        $peripherals = $this->db->get('peripheral');
        if($this->db->count > 0){
            foreach ($peripherals as $peripheral){
                if($peripheral['ID'] == $id) {
                    return '
                            <div class="col-md-12">
                                <h3>Edit peripheral</h3>
                                <input type="hidden" value="' . $peripheral['ID'] . '" id="peripheral_id">
                                <label for="peripheral_edit_serial_number">Серийный номер</label><input type="text" id="peripheral_edit_serial_number" value="' . $peripheral['serial_number'] . '">
                                <label for="peripheral_edit_type">Тип</label><input type="text" id="peripheral_edit_type" value="' . $peripheral['type'] . '">
                                <label for="peripheral_edit_description">Описание</label><input type="text" id="peripheral_edit_description" value="' . $peripheral['description'] . '">                             
                                <label for="peripheral_edit_status">Статус</label><select id="peripheral_edit_status"> ' . $this->return_status_select($peripheral['status']) . '</select>                             
                                <input type="button" value="Сохранить" onclick="update_peripheral(event)" id="update_peripheral">
                            </div>
                    ';
                }
            }
        }
    }

    public function update_peripheral($id,$serial_number,$type,$description,$status){
        $this->db->where('ID',$id);
        $data = array("serial_number" => $serial_number, "type" => $type, "description" => $description, "status" => $status);
        $this->db->update('peripheral',$data,1);
        $peripherals = $this->get_all_peripheral();
        return $peripherals;
    }

    public function search_peripheral($where,$what) {
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
        $hardware = $this->get_all_peripheral();
        return $hardware;
    }

    public function sort_peripheral_by($by){
        $this->db->orderBy($by,"ASC");
        $hardware = $this->get_all_peripheral();
        return $hardware;
    }
}

?>