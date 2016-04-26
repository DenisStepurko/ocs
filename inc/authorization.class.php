<?php
class Authorization{
    private $db;

    public function __construct() {
        $this->db = new MysqliDb();
    }

    public function login($login,$password){
        $params = array($login,md5($password));
        $user = $this->db->rawQueryOne("SELECT * FROM `users` WHERE login = ? AND password = ?",$params);
        if(isset($user['ID'])){
            $answer = Array("answer" => "true", "id" => $user["ID"]);
            return json_encode($answer);
        } else {
            $answer = Array("answer" => "false", "id" => -1);
            return json_encode($answer);
        }
    }

    public function get_user_info(){
        $params = array($_COOKIE['user']);
        $user = $this->db->rawQueryOne("SELECT * FROM `users` WHERE `ID` = ?",$params);
        return json_encode($user);
    }
}
?>