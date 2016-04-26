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
        $this->workers = $this->db->get('workers');
    }

    public function get_worker_info(){

    }

    public function return_worker_fio($id){
        foreach ($this->workers as $worker){
            if($worker['ID'] == $id){
                return $worker['fio'];
            }
        }
    }

    public function return_select_with_workers($id = null){
        $result = '';
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