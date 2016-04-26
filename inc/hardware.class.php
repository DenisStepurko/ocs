<?php
/**
 * Created by PhpStorm.
 * User: Денис Степурко
 * Date: 20.04.2016
 * Time: 11:06
 */
class hardware{

    private $db;
    private $worker;
    private $groups;

    public function __construct() {
        $this->db = new MysqliDb();
        $this->worker = new worker();
        $this->groups = new groups();
    }

    public function get_all_hardware () {
        $hardwares = $this->db->get('hardware');
        if($this->db->count > 0){
            $result = array();
            foreach ($hardwares as $hardware){
                $worker = $this->worker->return_worker_fio($hardware['worker']);
                $group = $this->groups->return_group_name($hardware['group']);
                array_push($result,"<tr>
                        <td>".$hardware['ID']."</td>
                        <td>".$hardware['name']."</td>
                        <td>".$hardware['os']."</td>
                        <td>".$worker."</td>
                        <td>".$hardware['ip']."</td>
                        <td>".$group."</td>
                        <td><a href='#' onclick='edit_hardware(".$hardware['ID'].",event)' class='edit_index'><img src='images/edit.gif'></a></td>
                        <td><a href='#' onclick='rmv_hardware(".$hardware['ID'].")'  class='rmv_index'><img src='images/del.gif'></a></td>
                    </tr>
                ");
            }
            return $result;
        }
    }

    public function get_table_header_hardware (){
        return "<tr>
                <td><a href='#' onclick='sort_hardware_by(`ID`)'>ID</a></td>
                <td><a href='#' onclick='sort_hardware_by(`name`)'>Имя</a></td>
                <td><a href='#' onclick='sort_hardware_by(`os`)'>Система</a></td>
                <td><a href='#' onclick='sort_hardware_by(`worker`)'>ФИО</a></td>
                <td><a href='#' onclick='sort_hardware_by(`ip`)'>IP</a></td>
                <td><a href='#' onclick='sort_hardware_by(`group`)'>Группа</a></td>
            </tr>
        ";
    }

    public function show_search_bar_hardware (){
        return "
            <input type='text' id='hardware_search'>
            <select id='hardware_search_select'>
                <option value='ID'>ID</option>
                <option value='name'>Имя</option>
                <option value='os'>Система</option>
                <option value='workers'>ФИО</option>
                <option value='ip'>IP</option>
            </select>
            <input type='button' id='hardware_search_button' onclick='search_hardware()' value='Поиск'>
        ";
    }

    public function show_edit_hardware_in_modal($id){
        $hardwares = $this->db->get('hardware');
        if($this->db->count > 0){
            foreach ($hardwares as $hardware){
                if($hardware['ID'] == $id){
                    return '
                            <div class="col-md-12">
                                <h3>Edit Modal</h3>
                                    <label for="name">Имя </label><input type="text" id="name" value="'.$hardware['name'].'">
                                    <label for="system">Система</label><input type="text" id="system" value="'.$hardware['os'].'">
                                    <label for="fio">ФИО</label><select type="text" id="fio">'.$this->worker->return_select_with_workers($hardware['worker']).'</select>
                                    <label for="ip">IP</label><input type="text" id="ip" value="'.$hardware['ip'].'">
                                    <label for="group">Группа</label><select type="text" id="group">'.$this->groups->return_select_with_groups($hardware['group']).'</select>
                                    <input type="hidden" id="hardware_id_update" value="'.$hardware['ID'].'">
                                <input type="button" value="Сохранить" onclick="update_hardware()" id="update_hardware">
                            </div>
                    ';
                }
            }
        }
    }

    public function show_add_hardware(){
        return "
        <tr>
            <td></td>
            <td><input type='text' id='add_hardware_name'></td>
            <td><input type='text' id='add_hardware_system'></td>
            <td><select id='add_hardware_fio'>".$this->worker->return_select_with_workers()."</select></td>
            <td><input type='text' id='add_hardware_ip'</td>
            <td><select id='add_hardware_worker'>".$this->groups->return_select_with_groups()."</select></td>
            <td><input type='button' value='Добавить' onclick='add_hardware()'</td>
        </tr>
        ";
    }

    public function update_hardware($id,$name,$os,$fio,$ip,$group){
        $data = array('name' => $name,'os' => $os, 'worker' => $fio, 'ip' => $ip, 'group' => $group);
        $this->db->where('ID',$id);
        $result = $this->db->update('hardware',$data,1);
        return $result ;
    }

    public function rmv_hardware($id){
        $this->db->where('ID',$id);
        $result = $this->db->delete('hardware',1);
        return $result;
    }

    public function search_hardware ($where,$what){
        $this->db->where($where,$what);
        $hardware = $this->get_all_hardware();
        return $hardware;
    }

    public function sort_hardware_by($by){
        $this->db->orderBy($by);
        $hardware = $this->get_all_hardware();
        return $hardware;
    }

    public function add_hardware($name,$os,$worker,$ip,$group){
        $data = array("name" => $name,"os" => $os, "worker" => $worker, "ip" => $ip, "group" =>$group);
        $this->db->insert('hardware',$data);
        $hardware = $this->get_all_hardware();
        return $hardware;
    }
}

?>