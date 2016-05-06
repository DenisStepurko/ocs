<?php
/**
 * Created by PhpStorm.
 * User: Денис Степурко
 * Date: 26.04.2016
 * Time: 10:38
 */

class groups {
    private $db;
    private $groups;

    public function __construct() {
        $this->db = new MysqliDb();

    }

    public function get_table_headers_groups(){
        return '<tr>
                    <td id="table_center_text"><a href="#" onclick="sort_groups_by(`ID`,event)">ID</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_groups_by(`name`,event)">Название</a></td>
                    <td id="table_center_text"><a href="#" onclick="show_add_groups_modal(event)">Добавить</a></td>
                </tr>';
    }

    public function get_all_groups(){
        $groups = $this->db->get('groups');
        if($this->db->count > 0 ){
            $result = array();
            foreach ($groups as $groups){
                array_push($result, "<tr>
                    <td>".$groups['ID']."</td>
                    <td>".$groups['name']."</td>
                    <td><a href='#' onclick='edit_groups(".$groups['ID'].",event)' class='edit_index'><img src='images/edit.gif'></a>
                    <a href='#' onclick='rmv_groups(".$groups['ID'].",event)'  class='rmv_index'><img src='images/del.gif'></a></td>
                </tr>");
            }
            array_push($result,"<tr><td></td><td></td><td></td></tr>");
            return $result;
        }
    }

    public function get_searchbar_groups(){
        return "";
    }

    public function show_add_groups_modal() {
        return '
            <div class="col-md-12">
            <h3>Добавить Группу</h3>
                <label for="groups_add_name">Название</label><input type="text" id="groups_add_name">
                <input type="button" onclick="add_groups(event);" value="Добавить">
            </div>
        ';
    }

    public function add_groups($name){
        $data = array("name" => $name);
        $this->db->insert('groups',$data);
        $network_device = $this->get_all_groups();
        return $network_device;
    }

    public function rmv_groups($id){
        $this->db->where('ID',$id);
        $this->db->delete('groups',1);
        $result = $this->get_all_groups();
        return $result;
    }

    public function show_edit_groups_in_modal($id){
        $groups = $this->db->get('groups');
        if($this->db->count > 0){
            foreach ($groups as $user){
                if($user['ID'] == $id) {
                    return '
                            <div class="col-md-12">
                                <h3>Изменить Группу</h3>
                                <input type="hidden" value="' . $user['ID'] . '" id="groups_id">
                                <label for="groups_edit_name">Название</label><input type="text" id="groups_edit_name" value="'.$user['name'].'">
                                <input type="button" value="Сохранить" onclick="update_groups(event)" id="update_groups">
                            </div>
                    ';
                }
            }
        }
    }

    public function update_groups($id,$name){
        $this->db->where('ID',$id);
        $data = array("name" => $name);
        $this->db->update('groups',$data,1);
        $network_devices = $this->get_all_groups();
        return $network_devices;
    }

    public function sort_groups_by($by){
        $this->db->orderBy($by,"ASC");
        $hardware = $this->get_all_groups();
        return $hardware;
    }

    public function return_group_name($id){
        $groups = $this->db->get('groups');
        foreach ($groups as $group){
            if($group['ID'] == $id){
                return $group['name'];
            }
        }
    }

    public function return_select_with_groups($id = null){
        $result = '';
        $groups = $this->db->get('groups');
        if(!is_null($id) && $id == 0){
            $result .= '<option selected value="0"></option>';
        } else {
            $result .= '<option value="0"></option>';
        }
        foreach ($groups as $group){
            if(!is_null($id) && $group['ID'] == $id){
                $result .= '<option selected value="'.$group['ID'].'">'.$group['name'].'</option>';
            }
            else {
                $result .= '<option value="'.$group['ID'].'">'.$group['name'].'</option>';
            }
        }
        return $result;
    }
}