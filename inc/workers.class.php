<?php
/**
 * Created by PhpStorm.
 * User: Денис Степурко
 * Date: 26.04.2016
 * Time: 10:06
 */

class worker {

    private $db;
    private $workers;

    public function __construct() {
        $this->db = new MysqliDb();
    }

    public function get_table_headers_worker(){
        return '<tr>
                    <td id="table_center_text"><a href="#" onclick="sort_worker_by(`ID`,event)">ID</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_worker_by(`fio`,event)">ФИО</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_worker_by(`birthday`,event)">Дата рождения (ГГГГ-ММ-ДД)</a></td>
                    <td id="table_center_text"><a href="#" onclick="show_add_worker_modal(event)">Добавить</a></td>
                </tr>';
    }

    public function get_all_worker(){
        $workers = $this->db->get('workers');
        if($this->db->count > 0 ){
            $result = array();
            foreach ($workers as $worker){
                array_push($result, "<tr>
                    <td>".$worker['ID']."</td>
                    <td>".$worker['fio']."</td>
                    <td>".$worker['birthday']."</td>
                    <td><a href='#' onclick='edit_worker(".$worker['ID'].",event)' class='edit_index'><img src='images/edit.gif'></a>
                    <a href='#' onclick='rmv_worker(".$worker['ID'].",event)'  class='rmv_index'><img src='images/del.gif'></a></td>
                </tr>");
            }
            array_push($result,"<tr><td></td><td></td><td></td><td></td></tr>");
            return $result;
        }
    }

    public function get_searchbar_worker(){
        return "";
    }

    public function show_add_worker_modal() {
        return '
            <div class="col-md-12">
            <h3>Добавить Работника</h3>
                <label for="worker_add_fio">ФИО</label><input type="text" id="worker_add_fio">
                <label for="worker_add_birthday">Дата рождения (ГГГГ-ММ-ДД)</label><input type="date" id="worker_add_birthday">
                <input type="button" onclick="add_worker(event);" value="Добавить">
            </div>
        ';
    }

    public function add_worker($fio,$birthday){
        $data = array("fio" => $fio, "birthday" => $birthday);
        $this->db->insert('workers',$data);
        $network_device = $this->get_all_worker();
        return $network_device;
    }

    public function rmv_worker($id){
        $this->db->where('ID',$id);
        $this->db->delete('workers',1);
        $result = $this->get_all_worker();
        return $result;
    }

    public function show_edit_worker_in_modal($id){
        $workers = $this->db->get('workers');
        if($this->db->count > 0){
            foreach ($workers as $worker){
                if($worker['ID'] == $id) {
                    return '
                            <div class="col-md-12">
                                <h3>Edit network_device</h3>
                                <input type="hidden" value="' . $worker['ID'] . '" id="worker_id">
                                <label for="worker_edit_fio">Модель</label><input type="text" id="worker_edit_fio" value="'.$worker['fio'].'">
                                <label for="worker_edit_birthday">Количество портов</label><input type="date" id="worker_edit_birthday" value="'.$worker['birthday'].'">                 
                                <input type="button" value="Сохранить" onclick="update_worker(event)" id="update_worker">
                            </div>
                    ';
                }
            }
        }
    }

    public function update_worker($id,$fio,$birthday){
        $this->db->where('ID',$id);
        $data = array("fio" => $fio, "birthday" => $birthday);
        $this->db->update('workers',$data,1);
        $network_devices = $this->get_all_worker();
        return $network_devices;
    }

    public function sort_worker_by($by){
        $this->db->orderBy($by,"ASC");
        $hardware = $this->get_all_worker();
        return $hardware;
    }

    public function return_worker_fio($id){
        $this->workers = $this->db->get('workers');
        foreach ($this->workers as $worker){
            if($worker['ID'] == $id){
                return $worker['fio'];
            }
        }
    }

    public function return_select_with_workers($id = null){
        $this->workers = $this->db->get('workers');
        if($id == 0){
            $result = '<option selected value="0"></option>';
        }
        else {
            $result = '<option value="0"></option>';
        }
        foreach ($this->workers as $worker){
            if(!is_null($id) && $worker['ID'] == $id){
                $result .= '<option selected value="'.$worker['ID'].'">'.$worker['fio'].'</option>';
            }
            else {
                $result .= '<option value="'.$worker['ID'].'">'.$worker['fio'].'</option>';
            }
        }
        return $result;
    }
    
}