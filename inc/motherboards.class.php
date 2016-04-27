<?php
/**
 * Created by PhpStorm.
 * User: Денис Степурко
 * Date: 26.04.2016
 * Time: 17:42
 */

class motherboards {

    private $db;
    private $hardware;

    public function __construct() {
        $this->db = new MysqliDb();
        $this->hardware = new hardware();
    }

    public function get_table_headers_mb(){
        return '<tr>
            <td id="table_center_text"><a href="#" onclick="sort_motherboard_by(`h_id`,event);">Название Компьютера</a></td>
            <td id="table_center_text"><a href="#" onclick="sort_motherboard_by(`vendor`,event);">Производитель</a></td>
            <td id="table_center_text"><a href="#" onclick="sort_motherboard_by(`serial_number`,event);">Серийный номер</a></td>
            <td id="table_center_text"><a href="#" onclick="sort_motherboard_by(`model`,event);">Модель</a></td>
            <td id="table_center_text"><a href="#" onclick="sort_motherboard_by(`socket`,event);">Сокет</a></td>
            <td id="table_center_text"><a href="#" onclick="sort_motherboard_by(`memory_slots`,event);">Слоты памяти</a></td>
            <td id="table_center_text"><a href="#" onclick="sort_motherboard_by(`internal_video`,event);">Встроеное видео</a></td>
            <td id="table_center_text"><a href="#" onclick="sort_motherboard_by(`form_factor`,event);">Форм-фактор</a></td>
            <td id="table_center_text"><a href="#" onclick="show_add_motherboard_modal(event)">Добавить</a></td>
        </tr>';
    }

    public function get_all_motherboards() {
        $motherboards = $this->db->get('motherboard');
        if($this->db->count > 0 ){
            $result = array();
            foreach ($motherboards as $motherboard){
                if($motherboard['internal_video'] == 1){
                    $internal_video = "Установлено!";
                } else {
                    $internal_video = "Не установлено!";
                }
                $hardware_name = $this->hardware->get_some_info('name',$motherboard['h_id']);
                array_push($result, "<tr>
                    <td>".$hardware_name."</td>
                    <td>".$motherboard['vendor']."</td>
                    <td>".$motherboard['serial_number']."</td>
                    <td>".$motherboard['model']."</td>
                    <td>".$motherboard['socket']."</td>
                    <td>".$motherboard['memory_slots']."</td>
                    <td>".$internal_video."</td>
                    <td>".$motherboard['form_factor']."</td>
                    <td><a href='#' onclick='edit_motherboard(".$motherboard['ID'].",event)' class='edit_index'><img src='images/edit.gif'></a>
                    <a href='#' onclick='rmv_motherboard(".$motherboard['ID'].",event)'  class='rmv_index'><img src='images/del.gif'></a></td>
                </tr>");
            }
            array_push($result,"<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>");
            return $result;
        }
    }

    public function get_searchbar_motherboards(){
        return "
        <input type='text' id='motherboard_search'>
        <select id='motherboard_search_select'>
                <option value='hardware_name'>Название компьютера</option>
                <option value='memory_slots'>Слоты памяти</option>
        </select>
        <input type='button' id='motherboard_search_button' onclick='search_motherboard(event)' value='Поиск'>
        ";
    }
    
    public function show_edit_motherboards_in_modal($id){
        $motherboards = $this->db->get('motherboard');
        if($this->db->count > 0){
            foreach ($motherboards as $motherboard){
                if($motherboard['ID'] == $id){
                    if($motherboard['internal_video'] == 1){
                        $internal_video = '
                        <label for="motherboard_edit_internal_video_true"><input type="radio" checked id="motherboard_edit_internal_video_true" name="motherboard_edit_internal_video" value="1">Установлено</label> 
                        <label for="motherboard_edit_internal_video_false"><input type="radio" id="motherboard_edit_internal_video_false" name="motherboard_edit_internal_video" value="0">Не установлено</label>
                        ';
                    }
                    else {
                        $internal_video = '
                        <label for="motherboard_edit_internal_video_true"><input type="radio" id="motherboard_edit_internal_video_true" name="motherboard_edit_internal_video" value="1">Установлено</label> 
                        <label for="motherboard_edit_internal_video_false"><input type="radio" checked id="motherboard_edit_internal_video_false" name="motherboard_edit_internal_video" value="0">Не установлено</label>
                        ';
                    }
                    return '
                            <div class="col-md-12">
                                <h3>Edit Motherboard</h3>
                                <input type="hidden" value="'.$motherboard['ID'].'" id="motherboard_id">
                                <label for="motherboard_edit_hardware">Компьютер</label>
                                <select id="motherboard_edit_hardware">
                                    '.$this->hardware->return_all_hardware_in_select($motherboard['h_id']).'
                                </select>
                                <label for="motherboard_edit_vendor">Производитель</label><input type="text" id="motherboard_edit_vendor" value="'.$motherboard['vendor'].'">
                                <label for="motherboard_edit_serial_number">Серийный номер</label><input type="text" id="motherboard_edit_serial_number" value="'.$motherboard['serial_number'].'">
                                <label for="motherboard_edit_model">Модель</label><input type="text" id="motherboard_edit_model" value="'.$motherboard['model'].'">
                                <label for="motherboard_edit_socket">Сокет</label><input type="text" id="motherboard_edit_socket" value="'.$motherboard['socket'].'">
                                <label for="motherboard_edit_memory_slots">Слоты памяти</label><input type="text" id="motherboard_edit_memory_slots" value="'.$motherboard['memory_slots'].'">
                                <label for="internal_video_div">Встроеное видео</label>
                                <div id="internal_video_div">'.$internal_video.'</div>
                                <label for="motherboard_edit_form_factor">Форм-фактор</label><input type="text" id="motherboard_edit_form_factor" value="'.$motherboard['form_factor'].'">
                                <input type="button" value="Сохранить" onclick="update_motherboard(event)" id="update_hardware">
                            </div>
                    ';
                }
            }
        }
    }

    public function show_add_motherboard_modal() {
        return '
            <div class="col-md-12">
            <h3>Add Motherboard</h3>
                <label for="hardware">Компьютер</label><select id="motherboard_add_hardware">
                    '.$this->hardware->return_all_hardware_in_select().'
                </select>
                <label for="motherboard_add_vendor">Производитель</label><input type="text" id="motherboard_add_vendor">
                <label for="motherboard_add_serial_number">Серийный номер</label><input type="text" id="motherboard_add_serial_number">
                <label for="motherboard_add_model">Модель</label><input type="text" id="motherboard_add_model">
                <label for="motherboard_add_socket">Сокет</label><input type="text" id="motherboard_add_socket">
                <label for="motherboard_add_memory_slots">Слоты памяти</label><input type="text" id="motherboard_add_memory_slots">
                <label for="motherboard_add_internal_video_div">Встроеное видео</label>
                <div id="internal_video_div">
                    <label for="motherboard_add_internal_video_true"><input type="radio" id="motherboard_add_internal_video_true" name="motherboard_add_internal_video" value="1">Установлено</label>
                    <label for="motherboard_add_internal_video_false"><input type="radio" id="motherboard_add_internal_video_false" name="motherboard_add_internal_video" value="0">Не установлено</label>
                </div>
                <label for="form_factor">Форм-фактор</label><input type="text" id="motherboard_add_form_factor">
                <input type="button" onclick="add_motherboard(event);" value="Добавить">
            </div>
        ';
    }

    public function add_motherboard($hardware,$vendor,$serial_number,$model,$socket,$memory_slots,$internal_video,$form_factor){
        $data = array("h_id" => $hardware, "vendor" => $vendor, "serial_number" => $serial_number, "model" => $model, "socket" => $socket, "memory_slots" => $memory_slots, "internal_video" => $internal_video, "form_factor" => $form_factor);
        $this->db->insert('motherboard',$data);
        $motherboards = $this->get_all_motherboards();
        return $motherboards;
    }

    public function rmv_motherboard($id){
        $this->db->where('ID',$id);
        $this->db->delete('motherboard',1);
        $result = $this->get_all_motherboards();
        return $result;
    }

    public function update_motherboard($id,$hardware,$vendor,$serial_number,$model,$socket,$slots,$form_factor,$internal_video){
        $this->db->where('ID',$id);
        $data = array('h_id' => $hardware,'vendor' => $vendor, 'serial_number'=> $serial_number, 'model' => $model, 'socket' => $socket, 'memory_slots' => $slots, 'internal_video' => $internal_video, 'form_factor' => $form_factor);
        $this->db->update('motherboard',$data,1);
        $motherboards = $this->get_all_motherboards();
        return $motherboards;
    }

    public function sort_motherboards_by($by){
        $this->db->orderBy($by,"ASC");
        $hardware = $this->get_all_motherboards();
        return $hardware;
    }

    public function search_motherboard ($where,$what){
        if($where == 'hardware_name'){
            $hardwares = $this->db->get('hardware');
            foreach ($hardwares as $hardware){
                if(strtoupper($hardware['name']) == strtoupper($what)){
                    $this->db->where('h_id',$hardware['ID'],'LIKE');
                }
            }
        } else {
            $this->db->where($where,$what,'LIKE');
        }
        $hardware = $this->get_all_motherboards();
        return $hardware;
    }

}

?>