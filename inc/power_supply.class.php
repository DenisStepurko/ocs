<?php
/**
 * Created by PhpStorm.
 * User: Денис Степурко
 * Date: 04.05.2016
 * Time: 13:54
 */

class power_supply {
    private $db;
    private $hardware;

    public function __construct() {
        $this->db = new MysqliDb();
        $this->hardware = new hardware();
    }

    public function get_table_headers_power_supply(){
        return '<tr>
                    <td id="table_center_text"><a href="#" onclick="sort_power_supply_by(`h_id`,event)">Имя компьютера</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_power_supply_by(`vendor`,event)">Производитель</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_power_supply_by(`interfaces`,event)">Интерфейс</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_power_supply_by(`power`,event)">Мощность</a></td>
                    <td id="table_center_text"><a href="#" onclick="show_add_power_supply_modal(event)">Добавить</a></td>
                </tr>';
    }

    public function get_all_power_supply() {
        $power_supplys = $this->db->get('power_supply');
        if($this->db->count > 0 ){
            $result = array();
            foreach ($power_supplys as $power_supply){
                $hardware_name = $this->hardware->get_some_info('name',$power_supply['h_id']);
                array_push($result, "<tr>
                    <td>".$hardware_name."</td>
                    <td>".$power_supply['vendor']."</td>
                    <td>".$power_supply['interfaces']."</td>
                    <td>".$power_supply['power']."</td>
                    <td><a href='#' onclick='edit_power_supply(".$power_supply['ID'].",event)' class='edit_index'><img src='images/edit.gif'></a>
                    <a href='#' onclick='rmv_power_supply(".$power_supply['ID'].",event)'  class='rmv_index'><img src='images/del.gif'></a></td>
                </tr>");
            }
            array_push($result,"<tr><td></td><td></td><td></td><td></td><td></td></tr>");
            return $result;
        }
    }

    public function get_searchbar_power_supply(){
        return "
        <input type='text' id='power_supply_search'>
        <select id='power_supply_search_select'>
                <option value='h_id'>Название Компьютера</option>
                <option value='interfaces'>Интерфейс</option>
                <option value='power'>Мощность</option>
        </select>
        <input type='button' id='motherboard_search_button' onclick='search_power_supply(event)' value='Поиск'>
        ";
    }

    public function show_add_power_supply_modal(){
        return '
            <div class="col-md-12">
            <h3>Add power_supply</h3>
                <label for="power_supply_add_hardware">Компьютер</label><select id="power_supply_add_hardware">
                    '.$this->hardware->return_all_hardware_in_select().'
                </select>
                <label for="power_supply_add_vendor">Производитель</label><input type="text" id="power_supply_add_vendor">
                <label for="power_supply_add_interfaces">Интерфейс</label><input type="text" id="power_supply_add_interfaces">
                <label for="power_supply_add_power">Мощность</label><input type="text" id="power_supply_add_power">
                <input type="button" onclick="add_power_supply(event);" value="Добавить">
            </div>
        ';
    }

    public function add_power_supply($hardware,$vendor,$interfaces,$power){
        $data = array("h_id" => $hardware, "vendor" => $vendor, "interfaces" => $interfaces, "power" => $power);
        $this->db->insert('power_supply',$data);
        $power_supply = $this->get_all_power_supply();
        return $power_supply;
    }

    public function rmv_power_supply($id){
        $this->db->where('ID',$id);
        $this->db->delete('power_supply',1);
        $result = $this->get_all_power_supply();
        return $result;
    }

    public function show_edit_power_supply_in_modal($id){
        $power_supplys = $this->db->get('power_supply');
        if($this->db->count > 0){
            foreach ($power_supplys as $power_supply){
                if($power_supply['ID'] == $id) {
                    return '
                            <div class="col-md-12">
                                <h3>Edit power_supply</h3>
                                <input type="hidden" value="' . $power_supply['ID'] . '" id="power_supply_id">
                                <label for="power_supply_edit_hardware">Компьютер</label>
                                <select id="power_supply_edit_hardware">
                                    ' . $this->hardware->return_all_hardware_in_select($power_supply['h_id']) . '
                                </select>
                                <label for="power_supply_edit_vendor">Производитель</label><input type="text" id="power_supply_edit_vendor" value="' . $power_supply['vendor'] . '">
                                <label for="power_supply_edit_interfaces">Интерфейс</label><input type="text" id="power_supply_edit_interfaces" value="' . $power_supply['interfaces'] . '">
                                <label for="power_supply_edit_power">Мощность</label><input type="text" id="power_supply_edit_power" value="' . $power_supply['power'] . '">                             
                                <input type="button" value="Сохранить" onclick="update_power_supply(event)" id="update_power_supply">
                            </div>
                    ';
                }
            }
        }
    }

    public function update_power_supply($id,$hardware,$vendor,$interfaces,$power){
        $this->db->where('ID',$id);
        $data = array('h_id' => $hardware,'vendor' => $vendor, "interfaces" => $interfaces, "power" => $power);
        $this->db->update('power_supply',$data,1);
        $power_supplys = $this->get_all_power_supply();
        return $power_supplys;
    }

    public function search_power_supply($where,$what) {
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
        $hardware = $this->get_all_power_supply();
        return $hardware;
    }

    public function sort_power_supply_by($by){
        $this->db->orderBy($by,"ASC");
        $hardware = $this->get_all_power_supply();
        return $hardware;
    }
}

?>