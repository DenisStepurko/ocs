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
                        <td><img class='qr_preview' onclick='openGallery(event,`".$hardware['qr']."`)' src='".$hardware['qr']."'></td>
                        <td>".$hardware['ID']."</td>
                        <td>".$hardware['name']."</td>
                        <td>".$hardware['os']."</td>
                        <td>".$worker."</td>
                        <td>".$hardware['ip']."</td>
                        <td>".$group."</td>
                        <td><a href='#' onclick='edit_hardware(".$hardware['ID'].",event)' class='edit_index'><img src='images/edit.gif'></a>
                        <a href='#' onclick='rmv_hardware(".$hardware['ID'].",event)'  class='rmv_index'><img src='images/del.gif'></a>
                        <a href='#' onclick='generate_qr_hardware(".$hardware['ID'].",event)' class='qr_index'><img src='images/qr.png'></a></td>
                    </tr>
                ");
            }
            array_push($result,"<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>");
            return $result;
        }
    }

    public function get_table_header_hardware (){
        return "<tr>
                <td></td>
                <td><a href='#' onclick='sort_hardware_by(`ID`,event)'>ID</a></td>
                <td><a href='#' onclick='sort_hardware_by(`name`,event)'>Имя</a></td>
                <td><a href='#' onclick='sort_hardware_by(`os`,event)'>Система</a></td>
                <td><a href='#' onclick='sort_hardware_by(`worker`,event)'>ФИО</a></td>
                <td><a href='#' onclick='sort_hardware_by(`ip`,event)'>IP</a></td>
                <td><!--a href='#' onclick='sort_hardware_by(`group`,event)'-->Группа<!--/a--></td>
                <td><a href='#' onclick='add_hardware_modal(event)'>Добавить</a> </td>
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
            <input type='button' id='hardware_search_button' onclick='search_hardware(event)' value='Поиск'>
        ";
    }

    public function show_edit_hardware_in_modal($id){
        $hardwares = $this->db->get('hardware');
        if($this->db->count > 0){
            foreach ($hardwares as $hardware){
                if($hardware['ID'] == $id){
                    return '
                            <div class="col-md-12">
                                <h3>Edit Hardware</h3>
                                    <label for="name">Имя </label><input type="text" id="name" value="'.$hardware['name'].'">
                                    <label for="system">Система</label><input type="text" id="system" value="'.$hardware['os'].'">
                                    <label for="fio">ФИО</label><select type="text" id="fio">'.$this->worker->return_select_with_workers($hardware['worker']).'</select>
                                    <label for="ip">IP</label><input type="text" id="ip" value="'.$hardware['ip'].'">
                                    <label for="group">Группа</label><select type="text" id="group">'.$this->groups->return_select_with_groups($hardware['group']).'</select>
                                    <input type="hidden" id="hardware_id_update" value="'.$hardware['ID'].'">
                                <input type="button" value="Сохранить" onclick="update_hardware(event)" id="update_hardware">
                            </div>
                    ';
                }
            }
        }
    }

    public function show_add_hardware_in_modal(){
        return "
        <div class='col-md-12'>
            <h3>Add Hardware</h3>
            <label for='add_hardware_name'>Имя</label><input type='text' id='add_hardware_name'>
            <label for='add_hardware_system'>Система</label><input type='text' id='add_hardware_system'>
            <label for='add_hardware_fio'>ФИО</label><select id='add_hardware_fio'>".$this->worker->return_select_with_workers()."</select>
            <label for='add_hardware_ip'>IP</label><input type='text' id='add_hardware_ip'>
            <label for='add_hardware_worker'>Группа</label><select id='add_hardware_worker'>".$this->groups->return_select_with_groups()."</select>
            <input type='button' value='Добавить' onclick='add_hardware(event)'>
        </div>
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
        $this->db->where($where,$what,'LIKE');
        $hardware = $this->get_all_hardware();
        return $hardware;
    }

    public function sort_hardware_by($by){
        $this->db->orderBy($by,"ASC");
        $hardware = $this->get_all_hardware();
        return $hardware;
    }

    public function add_hardware($name,$os,$worker,$ip,$group){
        $data = array("name" => $name,"os" => $os, "worker" => $worker, "ip" => $ip, "group" =>$group);
        $id = $this->db->insert('hardware',$data);
        $this->generate_qr_hardware($id);
        $hardware = $this->get_all_hardware();
        return $hardware;
    }

    public function generate_qr_hardware($id){
        $PNG_TEMP_DIR = $_SERVER['DOCUMENT_ROOT'].'/inventory/qr/hardware/';
        $filename = $PNG_TEMP_DIR.'HARDWARE_'.$id.'.jpg';
        QRcode::png('http://it-dimension.ath.cx:11180/inventory/index.php?view=mobileinfo&id='.$id, $filename, 'L', 4, 2);
        $this->db->where('ID',$id);
        $data = array('qr' => 'http://192.168.5.144/inventory/qr/hardware/HARDWARE_'.$id.'.jpg');
        $this->db->update('hardware',$data,1);
        $result = $this->get_all_hardware();
        return $result;
    }
}

?>