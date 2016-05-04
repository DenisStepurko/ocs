<?php
/**
 * Created by PhpStorm.
 * User: Денис Степурко
 * Date: 04.05.2016
 * Time: 13:22
 */

class network {
    private $db;
    private $hardware;

    public function __construct() {
        $this->db = new MysqliDb();
        $this->hardware = new hardware();
    }

    public function get_table_headers_network(){
        return '<tr>
                    <td id="table_center_text"><a href="#" onclick="sort_network_by(`h_id`,event)">Имя компьютера</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_network_by(`vendor`,event)">Производитель</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_network_by(`mac_address`,event)">MAC-адрес</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_network_by(`type`,event)">Тип</a></td>
                    <td id="table_center_text"><a href="#" onclick="show_add_network_modal(event)">Добавить</a></td>
                </tr>';
    }

    public function get_all_network() {
        $networks = $this->db->get('network');
        if($this->db->count > 0 ){
            $result = array();
            foreach ($networks as $network){
                $hardware_name = $this->hardware->get_some_info('name',$network['h_id']);
                array_push($result, "<tr>
                    <td>".$hardware_name."</td>
                    <td>".$network['vendor']."</td>
                    <td>".$network['mac_address']."</td>
                    <td>".$network['type']."</td>
                    <td><a href='#' onclick='edit_network(".$network['ID'].",event)' class='edit_index'><img src='images/edit.gif'></a>
                    <a href='#' onclick='rmv_network(".$network['ID'].",event)'  class='rmv_index'><img src='images/del.gif'></a></td>
                </tr>");
            }
            array_push($result,"<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>");
            return $result;
        }
    }

    public function get_searchbar_network(){
        return "
        <input type='text' id='network_search'>
        <select id='network_search_select'>
                <option value='h_id'>Название Компьютера</option>
                <option value='type'>Тип</option>
        </select>
        <input type='button' id='motherboard_search_button' onclick='search_network(event)' value='Поиск'>
        ";
    }

    public function show_add_network_modal(){
        return '
            <div class="col-md-12">
            <h3>Add network</h3>
                <label for="network_add_hardware">Компьютер</label><select id="network_add_hardware">
                    '.$this->hardware->return_all_hardware_in_select().'
                </select>
                <label for="network_add_vendor">Производитель</label><input type="text" id="network_add_vendor">
                <label for="network_add_mac_address">MAC-адрес</label><input type="text" id="network_add_mac_address">
                <label for="network_add_type">Тип</label><input type="text" id="network_add_type">
                <input type="button" onclick="add_network(event);" value="Добавить">
            </div>
        ';
    }

    public function add_network($hardware,$vendor,$mac_address,$type){
        $data = array("h_id" => $hardware, "vendor" => $vendor, "mac_address" => $mac_address, "type" => $type);
        $this->db->insert('network',$data);
        $network = $this->get_all_network();
        return $network;
    }

    public function rmv_network($id){
        $this->db->where('ID',$id);
        $this->db->delete('network',1);
        $result = $this->get_all_network();
        return $result;
    }

    public function show_edit_network_in_modal($id){
        $networks = $this->db->get('network');
        if($this->db->count > 0){
            foreach ($networks as $network){
                if($network['ID'] == $id) {
                    return '
                            <div class="col-md-12">
                                <h3>Edit network</h3>
                                <input type="hidden" value="' . $network['ID'] . '" id="network_id">
                                <label for="network_edit_hardware">Компьютер</label>
                                <select id="network_edit_hardware">
                                    ' . $this->hardware->return_all_hardware_in_select($network['h_id']) . '
                                </select>
                                <label for="network_edit_vendor">Производитель</label><input type="text" id="network_edit_vendor" value="' . $network['vendor'] . '">
                                <label for="network_edit_mac_address">Модель</label><input type="text" id="network_edit_mac_address" value="' . $network['mac_address'] . '">
                                <label for="network_edit_type">Тип</label><input type="text" id="network_edit_type" value="' . $network['type'] . '">                             
                                <input type="button" value="Сохранить" onclick="update_network(event)" id="update_network">
                            </div>
                    ';
                }
            }
        }
    }

    public function update_network($id,$hardware,$vendor,$mac_address,$type){
        $this->db->where('ID',$id);
        $data = array('h_id' => $hardware,'vendor' => $vendor, "mac_address" => $mac_address, "type" => $type);
        $this->db->update('network',$data,1);
        $networks = $this->get_all_network();
        return $networks;
    }

    public function search_network($where,$what) {
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
        $hardware = $this->get_all_network();
        return $hardware;
    }

    public function sort_network_by($by){
        $this->db->orderBy($by,"ASC");
        $hardware = $this->get_all_network();
        return $hardware;
    }
}

?>