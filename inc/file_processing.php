<?php
/**
 * Created by PhpStorm.
 * User: Денис Степурко
 * Date: 05.05.2016
 * Time: 14:38
 */
if(isset($_FILES['file']) && $_FILES['file']['type'] == "text/xml"){
    $file = $_FILES['file'];
    $xml = simplexml_load_file($file['tmp_name']);
    if($xml['formatversion']=="2.0" && $xml['version']=="1.28.709"){ // проверяем та ли версия xml,что нам нужна
        $count_mainsection = count($xml->mainsection);//количество секций
        $hardware_name = str_replace(".xml","",$file['name']); // ИМЯ ДЛЯ ГЛАВНОЙ СТРАНИЦЫ!
        for($cm = 0; $cm < $count_mainsection;$cm++) { //перебор секций
            $mainsecton = $xml->mainsection[$cm]; //упрощяем обращение к секции
            if($mainsecton['title'] == "Summary"){ //БЕРЕМЕ ИНФУ ИЗ "Summary"
                $count_section = count($mainsecton->section);//количество подсекций
                for($cs = 0; $cs < $count_section;$cs ++){ //перебор подсекций
                    $section = $mainsecton->section[$cs];//упрощяем обращение к подсекции
                    if($section['title'] == "Operating System"){
                        $hardware_os = $section->entry["title"]; //БЕРЕМ НАЗВАНИЕ СИСТЕМЫ!
                    }
                }
            }//БЕРЕМЕ ИНФУ ИЗ "Summary"
            if($mainsecton['title'] == "Network"){
                $count_entry = count($mainsecton->entry); //количество entry
                for($ce = 0; $ce < $count_entry;$ce++){
                    $entry = $mainsecton->entry[$ce];
                    if($entry['title'] == "IP Address"){
                        $hardware_ip = $entry['value'];
                    }
                }
                $count_section = count($mainsecton->section);
                for($cs = 0; $cs < $count_section; $cs++){
                    $section = $mainsecton->section[$cs];
                    if($section['title'] == "Adapters List"){
                        if($section->section['title'] == "Enabled"){
                            $enabled_section = $section->section;
                            $count_enabled_section = count($enabled_section->section);
                            for($ces = 0;$ces < $count_enabled_section; $ces ++){
                                $network_sections = $enabled_section->section[$ces];
                                $count_entry_in_enabled = count($network_sections->entry);
                                for($cee = 0;$cee <$count_entry_in_enabled;$cee++){
                                    $curent_entry = $network_sections->entry[$cee];
                                    if($curent_entry['title'] == "Connection Name" && $curent_entry['value'] == "Беспроводная сеть"){
                                        $wifi_vendor = $network_sections['title'];
                                        $wifi_status = "true";
                                        $wifi_mac = $network_sections->entry[$cee+2]['value'];
                                    }

                                    if($curent_entry['title'] == "Connection Name" && $curent_entry['value'] == "Ethernet"){
                                        $ethernet_vendor = $network_sections['title'];
                                        $ethernet_status = "true";
                                        $ethernet_mac = $network_sections->entry[$cee+3]['value'];
                                    }
                                }
                            }
                        }
                    }
                }
            }//БЕРЕМ ИНФУ ИЗ "Network"
            if($mainsecton['title'] == "Motherboard"){
                $count_entry = count($mainsecton->entry); //количество entry
                for($ce = 0; $ce < $count_entry;$ce++){
                    $entry = $mainsecton->entry[$ce];
                    if($entry['title'] == "Manufacturer"){
                        $motherboard_vendor = $entry['value'];
                    }
                    if($entry['title'] == "Model"){
                        $motherboard_model = $entry['value'];
                    }
                }
            }//БЕРЕМ ИНФУ ИЗ "Motherboard"
            if($mainsecton['title'] == "CPU"){
                $count_section = count($mainsecton->section);//количество подсекций
                for($cs = 0; $cs < $count_section;$cs ++){ //перебор подсекций
                    $section = $mainsecton->section[$cs];//упрощяем обращение к подсекции
                    if($section['title'] != "Caches" && $section['title'] != "Cores"){
                        $count_entry = count($section->entry); //количество entry
                        for($ce = 0; $ce < $count_entry;$ce++){
                            $entry = $section->entry[$ce];
                            if($entry['title'] == "Package"){
                                $motherboard_socket = $entry["value"]; //БЕРЕМ НАЗВАНИЕ СИСТЕМЫ!
                            }
                            if($entry['title'] == "Name") {
                                $cpu_name = $entry["value"];
                            }
                            if($entry['title'] == "Specification") {
                                $cpu_model = $entry["value"];
                            }
                            if($entry['title'] == "Package") {
                                $cpu_socket = $entry["value"];
                            }
                            if($entry['title'] == "Cores") {
                                $cpu_cores = $entry["value"];
                            }
                        }
                    }
                }
            }//БЕРЕМ ИНФУ ИЗ "CPU"
            if($mainsecton['title'] == "RAM"){
                $ram = Array();
                $counter = 0;
                $count_section = count($mainsecton->section);//количество подсекций
                for($cs = 0; $cs < $count_section;$cs ++){ //перебор подсекций
                    $section = $mainsecton->section[$cs];//упрощяем обращение к подсекции
                    if($section['title'] == "Memory slots"){
                        $count_entry = count($section->entry); //количество entry
                        for($ce = 0; $ce < $count_entry;$ce++){
                            $entry = $section->entry[$ce];
                            if($entry['title'] == "Total memory slots"){
                                $motherboard_memory_slots = $entry["value"]; //БЕРЕМ НАЗВАНИЕ СИСТЕМЫ!
                            }
                        }
                    }
                    if($section['title'] == "SPD"){
                        $count_section_spd = count($section->section);
                        for($i = 0; $i < $count_section_spd;$i++){
                            $counter ++;
                            $sections = $section->section[$i];
                            $count_entry = count($sections->entry);
                            for ($j = 0; $j < $count_entry ; $j++){
                                $entry = $sections->entry[$j];
                                if($entry['title'] == "Type"){
                                    $ram['type'][$i] = (string)$entry['value'];
                                }
                                if($entry['title'] == "Size"){
                                    $ram['size'][$i] = (string)$entry['value'];
                                }
                                if($entry['title'] == "Serial Number"){
                                    $ram['serial_number'][$i] = (string)$entry['value'];
                                }
                                if($entry['title'] == "Max Bandwidth"){
                                    $ram['speed'][$i] = (string)$entry['value'];
                                }
                            }
                        }
                        $ram['count_ram'] = $counter;
                    }
                }
            }//БЕРЕМ ИНФУ ИЗ "RAM"
            if($mainsecton['title'] == "Graphics"){
                $count_section = count($mainsecton->section);//количество подсекций
                $monitor = Array();
                for($cs = 0; $cs < $count_section;$cs ++){ //перебор подсекций
                    $section = $mainsecton->section[$cs];
                    $count_entry = count($section->entry);
                    for($ce = 0; $ce < $count_entry;$ce++){
                        $entry = $section->entry[$ce];
                        if($entry['title'] == "Manufacturer" && $entry['value'] == "Intel" ){
                            $motherboard_internal_video = '<option value="0">Не установлено</option><option selected value="1">Установлено</option>';
                        } else if($entry['title'] == "Manufacturer" && $entry['value'] != "Intel" ){
                            $motherboard_internal_video = '<option selected value="0">Не установлено</option><option value="1">Установлено</option>';
                        }
                    }//count entry

                    $pos = strpos($section['title'],"Monitor");
                    if($pos === 0){
                        $count_monitor_entry = count($section->entry);
                        for($i = 0; $i<$count_monitor_entry;$i++){
                            $monitor_entry = $section->entry[$i];
                            if($monitor_entry['title'] == "Name"){
                                $monitor['vendor'][$cs]= (string)$monitor_entry['value'];
                            }
                            if($monitor_entry['title'] == "Monitor Width"){
                                $monitor['width'][$cs] = (string)$monitor_entry['value'];
                            }
                            if($monitor_entry['title'] == "Monitor Height"){
                                $monitor['height'][$cs] = (string)$monitor_entry['value'];
                            }
                            if(isset($monitor['width'][$cs]) && isset($monitor['height'][$cs])){
                                $pow_width = pow($monitor['width'][$cs],2);
                                $pow_height = pow($monitor['height'][$cs],2);
                                $sum_width_height = $pow_height+$pow_width;
                                $sqrt_diag = sqrt($sum_width_height);
                                $diagonal = $sqrt_diag * 0.01041666666667;
                                $monitor['diagonal'][$cs] = round($diagonal);
                            }
                        }
                    }
                }
            }//БЕРЕМ ИНФУ ИЗ "Graphics"
            if($mainsecton['title'] == "Storage"){
                $count_section = count($mainsecton->section);//количество подсекций
                for($cs = 0; $cs < $count_section;$cs ++){ //перебор подсекций
                    $section = $mainsecton->section[$cs];//упрощяем обращение к подсекции
                    if($section['title'] == "Hard drives"){
                        $count_section = count($section->section);//количество подсекций
                        for($cs2 = 0; $cs2 < $count_section;$cs2 ++){ //перебор подсекций
                            $section2 = $section->section[$cs2];//упрощяем обращение к подсекции
                            $count_entry = count($section2->entry); //количество entry
                            for($ce = 0; $ce < $count_entry;$ce++){
                                $entry = $section2->entry[$ce];
                                $hdd_model = $section2['title'];
                                if($entry['title'] == "Manufacturer"){
                                    $hdd_vendor = $entry["value"]; //БЕРЕМ НАЗВАНИЕ СИСТЕМЫ!
                                }
                                if($entry['title'] == "Serial Number"){
                                    $hdd_serial_number = $entry["value"]; //БЕРЕМ НАЗВАНИЕ СИСТЕМЫ!
                                }
                                if($entry['title'] == "Capacity"){
                                    $hdd_size = $entry["value"]; //БЕРЕМ НАЗВАНИЕ СИСТЕМЫ!
                                }
                            }
                        }
                    }
                }
            }//БЕРЕМ ИНФУ ИЗ ""
            if($mainsecton['title'] == ""){}//БЕРЕМ ИНФУ ИЗ ""
        }
        $hardware = Array(
            "name" => $hardware_name,
            "os" => (string)$hardware_os,
            "ip" => (string)$hardware_ip
        );
        $motherboard = Array(
            "vendor" => (string)$motherboard_vendor,
            "model" => (string)$motherboard_model,
            "socket" => (string)$motherboard_socket,
            "memory_slots" => (string)$motherboard_memory_slots,
            "internal_video" => $motherboard_internal_video
        );
        $cpu = Array(
            "name" => (string)$cpu_name,
            "model" => (string)$cpu_model,
            "socket" => (string)$cpu_socket,
            "cores" => (string)$cpu_cores,
        );
        $hdd = Array (
            "vendor" => (string)$hdd_vendor,
            "model" => (string)$hdd_model,
            "serial_number" => (string)$hdd_serial_number,
            "size" => (string)$hdd_size
        );
        $wifi = Array (
            "status" => (string)$wifi_status,
            "vendor" => (string)$wifi_vendor,
            "mac" => (string)$wifi_mac
        );
        $ethernet = Array (
            "status" => (string)$ethernet_status,
            "vendor" => (string)$ethernet_vendor,
            "mac" => (string)$ethernet_mac
        );
        $result = Array(
            "status" => "ok",
            "hardware" => $hardware,
            "motherboard" => $motherboard,
            "cpu" => $cpu,
            "hdd" => $hdd,
            "wifi" => $wifi,
            "ethernet" => $ethernet,
            "monitor" => $monitor,
            "ram" => $ram
        );
        echo json_encode($result);
    }
    else {
        $result = Array(
            "status" => "Wrong XML Version!"
        );
        echo json_encode($result);
    }

}
?>