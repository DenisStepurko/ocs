<?php
/**
 * Created by PhpStorm.
 * User: Денис Степурко
 * Date: 04.05.2016
 * Time: 12:56
 */

class hdd {
    private $db;
    private $hardware;

    public function __construct() {
        $this->db = new MysqliDb();
        $this->hardware = new hardware();
    }

    public function get_table_headers_hdd(){
        return '<tr>
                    <td id="table_center_text"><a href="#" onclick="sort_hdd_by(`h_id`,event)">Имя компьютера</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_hdd_by(`vendor`,event)">Производитель</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_hdd_by(`model`,event)">Модель</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_hdd_by(`serial_number`,event)">Серийный номер</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_hdd_by(`size`,event)">Размер</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_hdd_by(`type`,event)">Тип</a></td>
                    <td id="table_center_text"><a href="#" onclick="show_add_hdd_modal(event)">Добавить</a></td>
                </tr>';
    }

    public function get_all_hdd() {
        $hdds = $this->db->get('hdd');
        if($this->db->count > 0 ){
            $result = array();
            foreach ($hdds as $hdd){
                $hardware_name = $this->hardware->get_some_info('name',$hdd['h_id']);
                array_push($result, "<tr>
                    <td>".$hardware_name."</td>
                    <td>".$hdd['vendor']."</td>
                    <td>".$hdd['model']."</td>
                    <td>".$hdd['serial_number']."</td>
                    <td>".$hdd['size']."</td>
                    <td>".$hdd['type']."</td>
                    <td><a href='#' onclick='edit_hdd(".$hdd['ID'].",event)' class='edit_index'><img src='images/edit.gif'></a>
                    <a href='#' onclick='rmv_hdd(".$hdd['ID'].",event)'  class='rmv_index'><img src='images/del.gif'></a></td>
                </tr>");
            }
            array_push($result,"<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>");
            return $result;
        }
    }

    public function get_searchbar_hdd(){
        return "
        <input type='text' id='hdd_search'>
        <select id='hdd_search_select'>
                <option value='h_id'>Название Компьютера</option>
                <option value='size'>Размер</option>
        </select>
        <input type='button' id='motherboard_search_button' onclick='search_hdd(event)' value='Поиск'>
        ";
    }

    public function show_add_hdd_modal(){
        return '
            <div class="col-md-12">
            <h3>Add hdd</h3>
                <label for="hdd_add_hardware">Компьютер</label><select id="hdd_add_hardware">
                    '.$this->hardware->return_all_hardware_in_select().'
                </select>
                <label for="hdd_add_vendor">Производитель</label><input type="text" id="hdd_add_vendor">
                <label for="hdd_add_model">Модель</label><input type="text" id="hdd_add_model">
                <label for="hdd_add_serial_number">Серийный номер</label><input type="text" id="hdd_add_serial_number">
                <label for="hdd_add_size">Размер</label><input type="text" id="hdd_add_size">
                <label for="hdd_add_type">Тип</label><input type="text" id="hdd_add_type">
                <input type="button" onclick="add_hdd(event);" value="Добавить">
            </div>
        ';
    }

    public function add_hdd($hardware,$vendor,$model,$serial_number,$size,$type){
        $data = array("h_id" => $hardware, "vendor" => $vendor, "model" => $model, "serial_number" => $serial_number, "size" => $size, "type" => $type);
        $this->db->insert('hdd',$data);
        $hdd = $this->get_all_hdd();
        return $hdd;
    }

    public function rmv_hdd($id){
        $this->db->where('ID',$id);
        $this->db->delete('hdd',1);
        $result = $this->get_all_hdd();
        return $result;
    }

    public function show_edit_hdd_in_modal($id){
        $hdds = $this->db->get('hdd');
        if($this->db->count > 0){
            foreach ($hdds as $hdd){
                if($hdd['ID'] == $id) {
                    return '
                            <div class="col-md-12">
                                <h3>Edit hdd</h3>
                                <input type="hidden" value="' . $hdd['ID'] . '" id="hdd_id">
                                <label for="hdd_edit_hardware">Компьютер</label>
                                <select id="hdd_edit_hardware">
                                    ' . $this->hardware->return_all_hardware_in_select($hdd['h_id']) . '
                                </select>
                                <label for="hdd_edit_vendor">Производитель</label><input type="text" id="hdd_edit_vendor" value="' . $hdd['vendor'] . '">
                                <label for="hdd_edit_model">Модель</label><input type="text" id="hdd_edit_model" value="' . $hdd['model'] . '">
                                <label for="hdd_edit_serial_number">Серийный номер</label><input type="text" id="hdd_edit_serial_number" value="' . $hdd['serial_number'] . '">
                                <label for="hdd_edit_size">Размер</label><input type="text" id="hdd_edit_size" value="' . $hdd['size'] . '">
                                <label for="hdd_edit_type">Тип</label><input type="text" id="hdd_edit_type" value="' . $hdd['type'] . '">                             
                                <input type="button" value="Сохранить" onclick="update_hdd(event)" id="update_hdd">
                            </div>
                    ';
                }
            }
        }
    }

    public function update_hdd($id,$hardware,$vendor,$model,$serial_number,$size,$type){
        $this->db->where('ID',$id);
        $data = array('h_id' => $hardware,'vendor' => $vendor, 'model' => $model, 'serial_number' => $serial_number, 'size' => $size, 'type' => $type);
        $this->db->update('hdd',$data,1);
        $hdds = $this->get_all_hdd();
        return $hdds;
    }

    public function search_hdd($where,$what) {
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
        $hardware = $this->get_all_hdd();
        return $hardware;
    }

    public function sort_hdd_by($by){
        $this->db->orderBy($by,"ASC");
        $hardware = $this->get_all_hdd();
        return $hardware;
    }
}

?>