<?php
/**
 * Created by PhpStorm.
 * User: Денис Степурко
 * Date: 04.05.2016
 * Time: 14:27
 */

class monitor {
    private $db;
    private $hardware;

    public function __construct() {
        $this->db = new MysqliDb();
        $this->hardware = new hardware();
    }

    public function get_table_headers_monitor(){
        return '<tr>
                    <td id="table_center_text"><a href="#" onclick="sort_monitor_by(`h_id`,event)">Имя компьютера</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_monitor_by(`vendor`,event)">Производитель</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_monitor_by(`size`,event)">Размер</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_monitor_by(`Interfaces`,event)">Интерфейс</a></td>
                    <td id="table_center_text"><a href="#" onclick="show_add_monitor_modal(event)">Добавить</a></td>
                </tr>';
    }

    public function get_all_monitor() {
        $monitors = $this->db->get('monitor');
        if($this->db->count > 0 ){
            $result = array();
            foreach ($monitors as $monitor){
                $hardware_name = $this->hardware->get_some_info('name',$monitor['h_id']);
                array_push($result, "<tr>
                    <td>".$hardware_name."</td>
                    <td>".$monitor['vendor']."</td>
                    <td>".$monitor['size']."</td>
                    <td>".$monitor['Interfaces']."</td>
                    <td><a href='#' onclick='edit_monitor(".$monitor['ID'].",event)' class='edit_index'><img src='images/edit.gif'></a>
                    <a href='#' onclick='rmv_monitor(".$monitor['ID'].",event)'  class='rmv_index'><img src='images/del.gif'></a></td>
                </tr>");
            }
            array_push($result,"<tr><td></td><td></td><td></td><td></td><td></td></tr>");
            return $result;
        }
    }

    public function get_searchbar_monitor(){
        return "
        <input type='text' id='monitor_search'>
        <select id='monitor_search_select'>
                <option value='h_id'>Название Компьютера</option>
                <option value='vendor'>Производитель</option>
                <option value='size'>Диагональ</option>
                <option value='Interfaces'>Интерфейс</option>
        </select>
        <input type='button' id='motherboard_search_button' onclick='search_monitor(event)' value='Поиск'>
        ";
    }

    public function show_add_monitor_modal(){
        return '
            <div class="col-md-12">
            <h3>Add monitor</h3>
                <label for="monitor_add_hardware">Компьютер</label><select id="monitor_add_hardware">
                    '.$this->hardware->return_all_hardware_in_select().'
                </select>
                <label for="monitor_add_vendor">Производитель</label><input type="text" id="monitor_add_vendor">
                <label for="monitor_add_size">Диагональ</label><input type="text" id="monitor_add_size">
                <label for="monitor_add_interfaces">Интерфейс</label>
                <div>
                    <label><input type="checkbox" value="VGA" checked="" id="monitor_add_interfaces[]"> VGA </label> 
                    <label><input type="checkbox" value="DVI" id="monitor_add_interfaces[]"> DVI</label>
                    <label><input type="checkbox" value="HDMI" checked="" id="monitor_add_interfaces[]"> HDMI</label> 
                    <label><input type="checkbox" value="Display port" id="monitor_add_interfaces[]"> Display port</label>
                </div>
                <input type="button" onclick="add_monitor(event);" value="Добавить">
            </div>
        ';
    }

    public function add_monitor($hardware,$vendor,$interfaces,$size){
        $data = array("h_id" => $hardware, "vendor" => $vendor, "size" => $size, "Interfaces" => $interfaces);
        $this->db->insert('monitor',$data);
        $monitor = $this->get_all_monitor();
        return $monitor;
    }

    public function rmv_monitor($id){
        $this->db->where('ID',$id);
        $this->db->delete('monitor',1);
        $result = $this->get_all_monitor();
        return $result;
    }

    public function show_edit_monitor_in_modal($id){
        $monitors = $this->db->get('monitor');
        if($this->db->count > 0){
            foreach ($monitors as $monitor){
                if($monitor['ID'] == $id) {
                    $checkboxes = '';
                    $vga = strpos($monitor['Interfaces'],'VGA');
                    $dvi = strpos($monitor['Interfaces'],'DVI');
                    $hdmi = strpos($monitor['Interfaces'],'HDMI');
                    $dp = strpos($monitor['Interfaces'],'Display port');
                    if($vga !== false){
                        $checkboxes .= '<label><input type="checkbox" value="VGA" checked id="gpu_interface[]"> VGA </label>';
                    }
                    else{
                        $checkboxes .=  ' <label><input type="checkbox" value="VGA" id="gpu_interface[]"> VGA</label>';
                    }
                    if($dvi !== false) {
                        $checkboxes .=  '<label><input type="checkbox" value="DVI" checked id="gpu_interface[]"> DVI</label>';
                    }
                    else{
                        $checkboxes .=  ' <label><input type="checkbox" value="DVI" id="gpu_interface[]"> DVI</label>';
                    }
                    if($hdmi !== false) {
                        $checkboxes .=  '<label><input type="checkbox" value="HDMI" checked id="gpu_interface[]"> HDMI</label>';
                    }
                    else{
                        $checkboxes .=  ' <label><input type="checkbox" value="HDMI" id="gpu_interface[]"> HDMI</label>';
                    }
                    if($dp !== false) {
                        $checkboxes .=  ' <label><input type="checkbox" value="Display port" checked id="gpu_interface[]"> Display port</label>';
                    }
                    else{
                        $checkboxes .=  ' <label><input type="checkbox" value="Display port" id="gpu_interface[]"> Display port</label>';
                    }
                    return '
                            <div class="col-md-12">
                                <h3>Edit monitor</h3>
                                <input type="hidden" value="' . $monitor['ID'] . '" id="monitor_id">
                                <label for="monitor_edit_hardware">Компьютер</label>
                                <select id="monitor_edit_hardware">
                                    ' . $this->hardware->return_all_hardware_in_select($monitor['h_id']) . '
                                </select>
                                <label for="monitor_edit_vendor">Производитель</label><input type="text" id="monitor_edit_vendor" value="' . $monitor['vendor'] . '">
                                <label for="monitor_edit_size">Диагональ</label><input type="text" id="monitor_edit_size" value="' . $monitor['size'] . '">    
                                <label for="monitor_edit_interfaces">Интерфейс</label><div>'.$checkboxes.'</div>
                                <input type="button" value="Сохранить" onclick="update_monitor(event)" id="update_monitor">
                            </div>
                    ';
                }
            }
        }
    }

    public function update_monitor($id,$hardware,$vendor,$size,$interfaces){
        $this->db->where('ID',$id);
        $data = array('h_id' => $hardware,'vendor' => $vendor, "size" => $size, "Interfaces" => $interfaces);
        $this->db->update('monitor',$data,1);
        $monitors = $this->get_all_monitor();
        return $monitors;
    }

    public function search_monitor($where,$what) {
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
        $hardware = $this->get_all_monitor();
        return $hardware;
    }

    public function sort_monitor_by($by){
        $this->db->orderBy($by,"ASC");
        $hardware = $this->get_all_monitor();
        return $hardware;
    }
}

?>