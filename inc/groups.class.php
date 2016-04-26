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
        $this->groups = $this->db->get('groups');
    }

    public function return_group_name($id){
        foreach ($this->groups as $group){
            if($group['ID'] == $id){
                return $group['name'];
            }
        }
    }

    public function return_select_with_groups($id = null){
        $result = '';
        if(!is_null($id) && $id == 0){
            $result .= '<option selected value="0"></option>';
        } else {
            $result .= '<option value="0"></option>';
        }
        foreach ($this->groups as $group){
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