<?php
/**
 * Created by PhpStorm.
 * User: Денис Степурко
 * Date: 05.05.2016
 * Time: 11:48
 */

class xml{
    private $db;
    private $workers;
    private $groups;

    public function __construct(){
        $this->workers = new worker();
        $this->groups = new groups();
    }

    public function get_table_content_load_file(){
        return '
        <h3><a href="inc/CCleaner ProPlus 5.06.5219.zip">Программа для создания xml (Устанавливать английскую версию!)</h3>
        <input type="file" id="userfile" onchange="load_xml_file(this,event)">
        ';
    }

    public function get_table_content(){
        return '
        <tr><td></td><td></td><td><h2>HARDWARE</h2></td><td></td><td></td></tr>
        <tr>
            <td>Имя</td>
            <td>Система</td>
            <td>ФИО</td>
            <td>IP</td>
            <td>Группа</td>
        </tr>
        <tr>
            <td><input type="text" id="hardware_name"></td>
            <td><input type="text" id="hardware_os"></td>
            <td><select id="hardware_fio">'.$this->workers->return_select_with_workers().'</select></td>
            <td><input type="text" id="hardware_ip"></td>
            <td><select id="hardware_group">'.$this->groups->return_select_with_groups().'</select></td>
        </tr>
        <tr><td></td><td></td><td></td><td></td><td><h2>MOTHERBOARD</h2></td><td></td><td></td><td></td><td></td><td></td></tr>
        <tr>
            <td>Название Компьютера</td>
            <td>Производитель</td>
            <td>Серийный номер</td>
            <td>Модель</td>
            <td>Сокет</td>
            <td>Слоты памяти</td>
            <td>Встроеное видео</td>
            <td>Форм-фактор</td>
        </tr>
        <tr>
            <td><input type="text" id="motherboard_hardware_name"></td>
            <td><input type="text" id="motherboard_vendor"></td>
            <td><input type="text" id="motherboard_serial_number"></td>
            <td><input type="text" id="motherboard_model"></td>
            <td><input type="text" id="motherboard_socket"></td>
            <td><input type="text" id="motherboard_memory_slots"></td>
            <td><select id="motherboard_internal_video"></select></td>
            <td><input type="text" id="motherboard_form_factor"></td>
        </tr>
        <tr><td></td><td></td><td><h2>CPU</h2></td><td></td><td></td></tr>
        <tr>
            <td>Название Компьютера</td>
            <td>Производитель</td>
            <td>Модель</td>
            <td>Тип</td>
            <td>Количество Ядер</td>
        </tr>
        <tr>
            <td><input type="text" id="cpu_hardware"></td>
            <td><input type="text" id="cpu_vendor"></td>
            <td><input type="text" id="cpu_model"></td>
            <td><input type="text" id="cpu_type"></td>
            <td><input type="text" id="cpu_count_cores"></td>
        </tr>
        <tr><td><h2>RAM</h2></td></tr>
        <tr>
            <td>Имя компьютера</td>
            <td>Серийный номер</td>
            <td>Интерфейс</td>
            <td>Тип</td>
            <td>Скорость</td>
            <td>Размер</td>
        </tr>
        <tr>
            <td><input type="text" id="ram_hardware"></td>
            <td><input type="text" id="ram_serial_number"></td>
            <td><input type="text" id="ram_interface"></td>
            <td><input type="text" id="ram_type"></td>
            <td><input type="text" id="ram_speed"></td>
            <td><input type="text" id="ram_size"></td>
        </tr>
        <tr><td><h2>GPU</h2></td></tr>
        <tr>
            <td>Имя компьютера</td>
            <td>Производитель</td>
            <td>Размер</td>
            <td>Интерфейс</td>
        </tr>
        <tr>
            <td><input type="text" id="gpu_hardware"></td>
            <td><input type="text" id="gpu_vendor"></td>
            <td><input type="text" id="gpu_size"></td>
            <td><input type="text" id="gpu_interface"></td>
        </tr>
        <tr><td><h2>HDD</h2></td></tr>
        <tr>
            <td>Имя компьютера</td>
            <td>Производитель</td>
            <td>Модель</td>
            <td>Серийный номер</td>
            <td>Размер</td>
            <td>Тип</td>
        </tr>
        <tr>
            <td><input type="text" id="hdd_hardware"></td>
            <td><input type="text" id="hdd_vendor"></td>
            <td><input type="text" id="hdd_model"></td>
            <td><input type="text" id="hdd_serial_number"></td>
            <td><input type="text" id="hdd_size"></td>
            <td><input type="text" id="hdd_type"></td>
        </tr>
        <tr><td><h2>LAN</h2></td></tr>
        <tr>
            <td>Имя компьютера</td>
            <td>Производитель</td>
            <td>MAC-адрес</td>
            <td>Тип</td>
        </tr>
        <tr>
            <td><input type="text" id="lan_hardware"></td>
            <td><input type="text" id="lan_vendor"></td>
            <td><input type="text" id="lan_mac"></td>
            <td><input type="text" id="lan_type"></td>
        </tr>
        <tr><td><h2>Мониторы</h2></td></tr>
        <tr>
            <td>Имя компьютера</td>
            <td>Производитель</td>
            <td>Размер</td>
            <td>Интерфейс</td>
        </tr>
        <tr>
            <td><input type="text" id="monitor_hardware"></td>
            <td><input type="text" id="monitor_vendor"></td>
            <td><input type="text" id="monitor_size"></td>
            <td><input type="text" id="monitor_interface"></td>
        </tr>
        ';
    }
}

?>