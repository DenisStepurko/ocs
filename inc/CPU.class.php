<?php
/**
 * Created by PhpStorm.
 * User: Денис Степурко
 * Date: 26.04.2016
 * Time: 17:42
 */

class cpu {
    private $db;
    private $hardware;

    public function __construct() {
        $this->db = new MysqliDb();
        $this->hardware = new hardware();
    }
    
    public function get_table_header(){
        return '
        <tr>
            <td><a href="#" onclick="sort_cpu_by(`h_id`,event)">Название Компьютера</a></td>
            <td><a href="#" onclick="sort_cpu_by(`vendor`,event)">Производитель</a></td>
            <td><a href="#" onclick="sort_cpu_by(`model`,event)">Модель</a></td>
            <td><a href="#" onclick="sort_cpu_by(`type`,event)">Тип</a></td>
            <td><a href="#" onclick="sort_cpu_by(`core_number`,event)">Количество Ядер</a></td>
            <td><a href="#" onclick="show_add_cpu_modal(event)">Добавить</a></td>
        </tr>
        ';
    }

    public function get_all_cpu(){
        $cpus = $this->db->get('cpu');
        if($this->db->count > 0 ){
            $result = array();
            foreach ($cpus as $cpu){
                $hardware_name = $this->hardware->get_some_info('name',$cpu['h_id']);
                array_push($result, "<tr>
                    <td>".$hardware_name."</td>
                    <td>".$cpu['vendor']."</td>
                    <td>".$cpu['model']."</td>
                    <td>".$cpu['type']."</td>
                    <td>".$cpu['core_number']."</td>
                    <td><a href='#' onclick='edit_cpu(".$cpu['ID'].",event)' class='edit_index'><img src='images/edit.gif'></a>
                    <a href='#' onclick='rmv_cpu(".$cpu['ID'].",event)'  class='rmv_index'><img src='images/del.gif'></a></td>
                </tr>");
            }
            array_push($result,"<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>");
            return $result;
        }
    }

    public function show_add_cpu_modal() {
        return '
            <div class="col-md-12">
            <h3>Add CPU</h3>
                <label for="hardware">Компьютер</label><select id="cpu_add_hardware">
                    '.$this->hardware->return_all_hardware_in_select().'
                </select>
                <label for="cpu_add_vendor">Производитель</label><input type="text" id="cpu_add_vendor">
                <label for="cpu_add_model">Модель</label><input type="text" id="cpu_add_model">
                <label for="cpu_add_type">Тип</label><input type="text" id="cpu_add_type">
                <label for="cpu_add_count_cores">Количество Ядер</label><input type="text" id="cpu_add_count_cores">
                <input type="button" onclick="add_cpu(event);" value="Добавить">
            </div>
        ';
    }

    public function add_cpu($hardware,$vendor,$model,$type,$cores){
        $data = array("h_id" => $hardware, "vendor" => $vendor, "model" => $model, "type" => $type, "core_number" => $cores);
        $this->db->insert('cpu',$data);
        $motherboards = $this->get_all_cpu();
        return $motherboards;
    }

    public function rmv_cpu($id){
        $this->db->where('ID',$id);
        $this->db->delete('cpu',1);
        $result = $this->get_all_cpu();
        return $result;
    }

    public function show_edit_cpu_in_modal($id){
        $cpus = $this->db->get('cpu');
        if($this->db->count > 0){
            foreach ($cpus as $cpu){
                if($cpu['ID'] == $id){
                    return '
                            <div class="col-md-12">
                                <h3>Edit CPU</h3>
                                <input type="hidden" value="'.$cpu['ID'].'" id="cpu_id">
                                <label for="cpu_edit_hardware">Компьютер</label>
                                <select id="cpu_edit_hardware">
                                    '.$this->hardware->return_all_hardware_in_select($cpu['h_id']).'
                                </select>
                                <label for="cpu_edit_vendor">Производитель</label><input type="text" id="cpu_edit_vendor" value="'.$cpu['vendor'].'">
                                <label for="cpu_edit_model">Модель</label><input type="text" id="cpu_edit_model" value="'.$cpu['model'].'">
                                <label for="cpu_edit_type">Тип</label><input type="text" id="cpu_edit_type" value="'.$cpu['type'].'">
                                <label for="cpu_edit_core_number">Количество Ядер</label><input type="text" id="cpu_edit_core_number" value="'.$cpu['core_number'].'">
                                <input type="button" value="Сохранить" onclick="update_cpu(event)" id="update_cpu">
                            </div>
                    ';
                }
            }
        }
    }

    public function update_cpu($id,$hardware,$vendor,$model,$type,$cores){
        $this->db->where('ID',$id);
        $data = array('h_id' => $hardware,'vendor' => $vendor, 'model' => $model, 'type' => $type, 'core_number' => $cores);
        $this->db->update('cpu',$data,1);
        $motherboards = $this->get_all_cpu();
        return $motherboards;
    }

    public function get_searchbar_cpu(){
        return "
        <input type='text' id='cpu_search'>
        <select id='cpu_search_select'>
            <option value='h_id'>Название Компьютера</option>
            <option value='model'>Модель</option>
            <option value='core_number'>Количество ядер</option>
        </select>
        <input type='button' id='cpu_search_button' onclick='search_cpu(event)' value='Поиск'>
        ";
    }

    public function search_cpu($where,$what) {
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
        $hardware = $this->get_all_cpu();
        return $hardware;
    }

    public function sort_cpu_by($by){
    $this->db->orderBy($by,"ASC");
    $hardware = $this->get_all_cpu();
    return $hardware;
}

}


?>