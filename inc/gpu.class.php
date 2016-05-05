<?php
/**
 * Created by PhpStorm.
 * User: Денис Степурко
 * Date: 04.05.2016
 * Time: 9:55
 */

class gpu {
    private $db;
    private $hardware;

    public function __construct() {
        $this->db = new MysqliDb();
        $this->hardware = new hardware();
    }

    public function get_table_headers_gpu(){
        return '<tr>
                    <td id="table_center_text"><a href="#" onclick="sort_gpu_by(`h_id`,event)">Имя компьютера</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_gpu_by(`vendor`,event)">Производитель</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_gpu_by(`memory_size`,event)">Размер</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_gpu_by(`Interfaces`,event)">Интерфейс</a></td>
                    <td id="table_center_text"><a href="#" onclick="show_add_gpu_modal(event)">Добавить</a></td>
                </tr>';
    }

    public function get_all_gpu() {
        $gpus = $this->db->get('gpu');
        if($this->db->count > 0 ){
            $result = array();
            foreach ($gpus as $gpu){
                $hardware_name = $this->hardware->get_some_info('name',$gpu['h_id']);
                array_push($result, "<tr>
                    <td>".$hardware_name."</td>
                    <td>".$gpu['vendor']."</td>
                    <td>".$gpu['memory_size']."</td>
                    <td>".$gpu['Interfaces']."</td>
                    <td><a href='#' onclick='edit_gpu(".$gpu['ID'].",event)' class='edit_index'><img src='images/edit.gif'></a>
                    <a href='#' onclick='rmv_gpu(".$gpu['ID'].",event)'  class='rmv_index'><img src='images/del.gif'></a></td>
                </tr>");
            }
            array_push($result,"<tr><td></td><td></td><td></td><td></td><td></td></tr>");
            return $result;
        }
    }

    public function get_searchbar_gpu(){
        return "
        <input type='text' id='gpu_search'>
        <select id='gpu_search_select'>
                <option value='h_id'>Название Компьютера</option>
                <option value='memory_size'>Размер</option>
                <option value='Interfaces'>Интерфейс</option>
        </select>
        <input type='button' id='motherboard_search_button' onclick='search_gpu(event)' value='Поиск'>
        ";
    }

    public function show_add_gpu_modal(){
    return '
            <div class="col-md-12">
            <h3>Add GPU</h3>
                <label for="gpu_add_hardware">Компьютер</label><select id="gpu_add_hardware">
                    '.$this->hardware->return_all_hardware_in_select().'
                </select>
                <label for="gpu_add_vendor">Производитель</label><input type="text" id="gpu_add_vendor">
                <label for="gpu_add_size">Размер</label><input type="text" id="gpu_add_size">
                <label for="gpu_add_interface">Интерфейс</label>
                <div>
                    <label><input type="checkbox" value="VGA" id="gpu_interface[]"> VGA </label>
                    <label><input type="checkbox" value="DVI" id="gpu_interface[]"> DVI</label>
                    <label><input type="checkbox" value="HDMI" id="gpu_interface[]"> HDMI</label>
                    <label><input type="checkbox" value="Display port" id="gpu_interface[]"> Display port</label>
                </div>
                <input type="button" onclick="add_gpu(event);" value="Добавить">
            </div>
        ';
}

    public function add_gpu($hardware,$vendor,$size,$interfaces){
        $data = array("h_id" => $hardware, "vendor" => $vendor, "memory_size" => $size, "Interfaces" => $interfaces);
        $this->db->insert('gpu',$data);
        $gpu = $this->get_all_gpu();
        return $gpu;
    }

    public function rmv_gpu($id){
        $this->db->where('ID',$id);
        $this->db->delete('gpu',1);
        $result = $this->get_all_gpu();
        return $result;
    }

    public function show_edit_gpu_in_modal($id){
        $gpus = $this->db->get('gpu');
        if($this->db->count > 0){
            foreach ($gpus as $gpu){
                if($gpu['ID'] == $id){
                    $checkboxes = '';
                    $vga = strpos($gpu['Interfaces'],'VGA');
                    $dvi = strpos($gpu['Interfaces'],'DVI');
                    $hdmi = strpos($gpu['Interfaces'],'HDMI');
                    $dp = strpos($gpu['Interfaces'],'Display port');
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
                                <h3>Edit GPU</h3>
                                <input type="hidden" value="'.$gpu['ID'].'" id="gpu_id">
                                <label for="gpu_edit_hardware">Компьютер</label>
                                <select id="gpu_edit_hardware">
                                    '.$this->hardware->return_all_hardware_in_select($gpu['h_id']).'
                                </select>
                                <label for="gpu_edit_vendor">Производитель</label><input type="text" id="gpu_edit_vendor" value="'.$gpu['vendor'].'">
                                <label for="gpu_edit_size">Размер</label><input type="text" id="gpu_edit_size" value="'.$gpu['memory_size'].'">
                                <label for="gpu_add_interface">Интерфейс</label>
                                <div>
                                '.$checkboxes.'
                                </div>
                                <input type="button" value="Сохранить" onclick="update_gpu(event)" id="update_gpu">
                            </div>
                    ';
                }
            }
        }
    }

    public function update_gpu($id,$hardware,$vendor,$size,$interfaces){
        $this->db->where('ID',$id);
        $data = array('h_id' => $hardware,'vendor' => $vendor, 'memory_size' => $size, 'Interfaces' => $interfaces);
        $this->db->update('gpu',$data,1);
        $gpus = $this->get_all_gpu();
        return $gpus;
    }

    public function search_gpu($where,$what) {
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
        $hardware = $this->get_all_gpu();
        return $hardware;
    }

    public function sort_gpu_by($by){
        $this->db->orderBy($by,"ASC");
        $hardware = $this->get_all_gpu();
        return $hardware;
    }
}

?>