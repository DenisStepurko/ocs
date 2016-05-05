<?php
/**
 * Created by PhpStorm.
 * User: Денис Степурко
 * Date: 05.05.2016
 * Time: 10:54
 */

class users {
    private $db;

    public function __construct() {
        $this->db = new MysqliDb();
    }

    public function get_table_headers_users(){
        return '<tr>
                    <td id="table_center_text"><a href="#" onclick="sort_users_by(`ID`,event)">ID</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_users_by(`login`,event)">Логин</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_users_by(`password`,event)">Пароль</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_users_by(`email`,event)">e-mail</a></td>
                    <td id="table_center_text"><a href="#" onclick="sort_users_by(`admin`,event)">Уровень доступа</a></td>
                    <td id="table_center_text"><a href="#" onclick="show_add_users_modal(event)">Добавить</a></td>
                </tr>';
    }

    public function get_all_users(){
        $users = $this->db->get('users');
        if($this->db->count > 0 ){
            $result = array();
            foreach ($users as $users){
                array_push($result, "<tr>
                    <td>".$users['ID']."</td>
                    <td>".$users['login']."</td>
                    <td>".$users['password']."</td>
                    <td>".$users['email']."</td>
                    <td>".$this->return_users_admin($users['admin'])."</td>
                    <td><a href='#' onclick='edit_users(".$users['ID'].",event)' class='edit_index'><img src='images/edit.gif'></a>
                    <a href='#' onclick='rmv_users(".$users['ID'].",event)'  class='rmv_index'><img src='images/del.gif'></a></td>
                </tr>");
            }
            array_push($result,"<tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>");
            return $result;
        }
    }

    public function get_searchbar_users(){
        return "";
    }

    public function show_add_users_modal() {
        return '
            <div class="col-md-12">
            <h3>Добавить Пользователя</h3>
                <label for="users_add_login">Логин</label><input type="text" id="users_add_login">
                <label for="users_add_password">Пароль</label><input type="text" id="users_add_password">
                <label for="users_add_email">e-mail</label><input type="text" id="users_add_email">
                <label for="users_add_admin">Уровень доступа</label><select id="users_add_admin">'.$this->return_select_with_users().'</select>
                <input type="button" onclick="add_users(event);" value="Добавить">
            </div>
        ';
    }

    public function add_users($login,$password,$email,$admin){
        $data = array("login" => $login, "password" => md5($password), "email" => $email, "admin" => $admin);
        $this->db->insert('users',$data);
        $network_device = $this->get_all_users();
        return $network_device;
    }

    public function rmv_users($id){
        $this->db->where('ID',$id);
        $this->db->delete('users',1);
        $result = $this->get_all_users();
        return $result;
    }

    public function show_edit_users_in_modal($id){
        $users = $this->db->get('users');
        if($this->db->count > 0){
            foreach ($users as $user){
                if($user['ID'] == $id) {
                    return '
                            <div class="col-md-12">
                                <h3>Изменить Пользователя</h3>
                                <input type="hidden" value="' . $user['ID'] . '" id="users_id">
                                <label for="users_edit_login">Логин</label><input type="text" id="users_edit_login" value="'.$user['login'].'">
                                <label for="users_edit_password">Пароль</label><input type="text" id="users_edit_password" value="'.$user['password'].'">                 
                                <label for="users_edit_email">e-mail</label><input type="text" id="users_edit_email" value="'.$user['email'].'">                 
                                <label for="users_edit_admin">Уровень доступа</label><select id="users_edit_admin">'.$this->return_select_with_users($user['admin']).'</select>
                                <input type="button" value="Сохранить" onclick="update_users(event)" id="update_users">
                            </div>
                    ';
                }
            }
        }
    }

    public function update_users($id,$login,$password,$email,$admin){
        $this->db->where('ID',$id);
        $data = array("login" => $login, "password" => md5($password), "email" => $email, "admin" => $admin);
        $this->db->update('users',$data,1);
        $network_devices = $this->get_all_users();
        return $network_devices;
    }

    public function sort_users_by($by){
        $this->db->orderBy($by,"ASC");
        $hardware = $this->get_all_users();
        return $hardware;
    }

    public function return_users_admin($admin){
        if($admin == 1){
            return "Администратор";
        } else {
            return "Пользователь";
        }
    }

    public function return_select_with_users($admin = null){
        if($admin == 1){
            $result = "<option value='1' selected>Администратор</option>";
            $result .= "<option value='0'>Пользователь</option>";
        } else {
            $result = "<option value='1'>Администратор</option>";
            $result .= "<option value='0' selected>Пользователь</option>";
        }
        return $result;
    }
}

?>