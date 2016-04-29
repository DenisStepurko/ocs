<?php
/**
 * Created by PhpStorm.
 * User: Денис Степурко
 * Date: 29.04.2016
 * Time: 11:43
 */

class ram {

    private $db;
    private $hardware;

    public function __construct() {
        $this->db = new MysqliDb();
        $this->hardware = new hardware();
    }

    public function get_table_headers_ram(){
        return '<tr>
                    <td id="table_center_text"><a href="#" onclick="sort_ram_by(`h_id`,event)">Имя компьютера</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_ram_by(`serial_number`,event)">Серийный номер</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_ram_by(`interface`,event)">Интерфейс</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_ram_by(`type`,event)">Тип</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_ram_by(`speed`,event)">Скорость</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_ram_by(`size`,event)">Размер</a></td>
                    <td id="table_center_text"><a href="#" onclick="show_add_ram_modal(event)">Добавить</a></td>
                </tr>';
    }

    public function get_all_ram() {
        $rams = $this->db->get('ram');
        if($this->db->count > 0 ){
            $result = array();
            foreach ($rams as $ram){
                $hardware_name = $this->hardware->get_some_info('name',$ram['h_id']);
                array_push($result, "<tr>
                    <td>".$hardware_name."</td>
                    <td>".$ram['serial_number']."</td>
                    <td>".$ram['interface']."</td>
                    <td>".$ram['type']."</td>
                    <td>".$ram['speed']."</td>
                    <td>".$ram['size']."</td>
                    <td><a href='#' onclick='edit_ram(".$ram['ID'].",event)' class='edit_index'><img src='images/edit.gif'></a>
                    <a href='#' onclick='rmv_ram(".$ram['ID'].",event)'  class='rmv_index'><img src='images/del.gif'></a></td>
                </tr>");
            }
            array_push($result,"<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>");
            return $result;
        }
    }

    public function get_searchbar_ram(){
        return "
        <input type='text' id='ram_search'>
        <select id='ram_search_select'>
                <option value='h_id'>Название Компьютера</option>
                <option value='interface'>Интерфейс</option>
                <option value='type'>Тип</option>
                <option value='speed'>Скорость</option>
                <option value='size'>Размер</option>
        </select>
        <input type='button' id='motherboard_search_button' onclick='search_ram(event)' value='Поиск'>
        ";
    }

    public function show_add_ram_modal(){
        return '
            <div class="col-md-12">
            <h3>Add RAM</h3>
                <label for="ram_add_hardware">Компьютер</label><select id="ram_add_hardware">
                    '.$this->hardware->return_all_hardware_in_select().'
                </select>
                <label for="ram_add_serial_number">Серийный номер</label><input type="text" id="ram_add_serial_number">
                <label for="ram_add_interface">Интерфейс</label><input type="text" id="ram_add_interface">
                <label for="ram_add_type">Тип</label><input type="text" id="ram_add_type">
                <label for="ram_add_speed">Скорость</label><input type="text" id="ram_add_speed">
                <label for="ram_add_size">Размер</label><input type="text" id="ram_add_size">
                <input type="button" onclick="add_ram(event);" value="Добавить">
            </div>
        ';
    }

    public function add_ram($hardware,$serial_number,$interface,$type,$speed,$size){
        $data = array("h_id" => $hardware, "serial_number" => $serial_number, "interface" => $interface, "type" => $type, "speed" => $speed, "size" => $size);
        $this->db->insert('ram',$data);
        $ram = $this->get_all_ram();
        return $ram;
    }

    public function rmv_ram($id){
        $this->db->where('ID',$id);
        $this->db->delete('ram',1);
        $result = $this->get_all_ram();
        return $result;
    }

    public function show_edit_ram_in_modal($id){
        $rams = $this->db->get('ram');
        if($this->db->count > 0){
            foreach ($rams as $ram){
                if($ram['ID'] == $id){
                    return '
                            <div class="col-md-12">
                                <h3>Edit RAM</h3>
                                <input type="hidden" value="'.$ram['ID'].'" id="ram_id">
                                <label for="ram_edit_hardware">Компьютер</label>
                                <select id="ram_edit_hardware">
                                    '.$this->hardware->return_all_hardware_in_select($ram['h_id']).'
                                </select>
                                <label for="ram_edit_serial_number">Серийный номер</label><input type="text" id="ram_edit_serial_number" value="'.$ram['serial_number'].'">
                                <label for="ram_edit_interface">Интерфейс</label><input type="text" id="ram_edit_interface" value="'.$ram['interface'].'">
                                <label for="ram_edit_type">Тип</label><input type="text" id="ram_edit_type" value="'.$ram['type'].'">
                                <label for="ram_edit_speed">Скорость</label><input type="text" id="ram_edit_speed" value="'.$ram['speed'].'">
                                <label for="ram_edit_size">Размер</label><input type="text" id="ram_edit_size" value="'.$ram['size'].'">
                                <input type="button" value="Сохранить" onclick="update_ram(event)" id="update_ram">
                            </div>
                    ';
                }
            }
        }
    }

    public function update_ram($id,$hardware,$serial_number,$interface,$type,$speed,$size){
        $this->db->where('ID',$id);
        $data = array('h_id' => $hardware,'serial_number' => $serial_number, 'interface' => $interface, 'type' => $type, 'speed' => $speed, 'size' => $size);
        $this->db->update('ram',$data,1);
        $motherboards = $this->get_all_ram();
        return $motherboards;
    }

    public function search_ram($where,$what) {
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
        $hardware = $this->get_all_ram();
        return $hardware;
    }

    public function sort_ram_by($by){
        $this->db->orderBy($by,"ASC");
        $hardware = $this->get_all_ram();
        return $hardware;
    }
}

?>