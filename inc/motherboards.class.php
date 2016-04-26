<?php
/**
 * Created by PhpStorm.
 * User: Денис Степурко
 * Date: 26.04.2016
 * Time: 17:42
 */

class motherboards {

    private $db;
    private $worker;
    private $groups;

    public function __construct() {
        $this->db = new MysqliDb();
    }

    public function get_table_headers_mb(){
        return '<tr>
            <td id="table_center_text"><a >Название Компьютера</a></td>
            <td id="table_center_text"><a >Производитель</a></td>
            <td id="table_center_text"><a >Серийный номер</a></td>
            <td id="table_center_text"><a >Модель</a></td>
            <td id="table_center_text"><a >Сокет</a></td>
            <td id="table_center_text"><a >Слоты памяти</a></td>
            <td id="table_center_text"><a >Встроеное видео</a></td>
            <td id="table_center_text"><a >Форм-фактор</a></td>
        </tr>';
    }
}

?>