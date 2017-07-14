<?php

//載入程式設定檔
$id_id = "login";
require("inc/inc.php");
require("func/func_play_station.php");
//ini_set("display_errors",1);
//========= 參數接收 op ==========

$act = ft($_POST['act'], 1);
$id = ft($_POST['id'], 0);
$zoneId = ft($_POST['zone'], 0);
if ($act == null) {
    $act = ft($_GET['act'], 1);
    $id = ft($_GET['id'], 0);
}


//var_dump($_POST);
//die;


$array_print['flush7'] = $_POST['flush7'];
$array_print['four_kind'] = $_POST['four_kind'];
$array_print['royal_straight_flush'] = $_POST['royal_straight_flush'];
$array_print['straight_flush'] = $_POST['straight_flush'];
$array_print['full_house'] = $_POST['full_house'];
$array_print['five_kind'] = $_POST['five_kind'];
//
//
//
//
//
//var_dump($_POST);
//die;
//========= 參數接收 ed ==========
switch ($act) {
    //新增
    case 'add':
        $ps_input['psz_id'] = $zoneId;
        $ps_input['ps_name'] = ft($_POST['ps_name'], 1);
        $add_id = add_play_station($win7pk_db, $ps_input);
        //die;
        if ($add_id) {
            $arr_input['ps_id'] = $add_id;
            $arr_input = fill_ps_prob_data($win7pk_db, $zoneId, $arr_input);
            $arr_input = fill_ps_zone_data($win7pk_db, $zoneId, $arr_input);
            add_play_station_prob($win7pk_db, $arr_input);

            $data_input['ps_id'] = $add_id;
            add_play_station_data($win7pk_db, $data_input);

            //$shift_member = get_shift_member($win7pk_db);
            // $log_input['mo_ml_id'] = $shift_member[0]['cs_mlid'];
            // $log_input['mo_ps_id'] = $id;
            // $log_input['mo_op_type'] = 2;
            // $log_input['mo_time'] = date("Y-m-d H:i:s");
            // $log_input['mo_note'] = json_encode($arr_input);
            //add_member_op_log($win7pk_db, $log_input);
            reload_js_top_href('更新成功!', 'slot_machine.php?game=ps_zone_data');
            //  die;
        } else {
            reload_js_top_href('更新失敗或沒有更新!', 'slot_machine.php?game=ps_zone_data');
        }
        break;
    //更新
    case 'mod':
        $mod_ps_zone_date = mod_ps_gift_date($win7pk_db, $array_print, $id);

        $array_print = json_encode($array_print);
        $url = "http://60.250.122.219:8080/7pk/".$id.'/';
        $result = excuteApi($url, $array_print);
        die;
        //var_dump($result);
        //$simple[''] = [],
        // if ($mod_ps_zone_date) {
        //    reload_js_top_href('更新成功!', 'slot_machine.php?game=ps_zone_data');
        //} else {
        //    reload_js_top_href('更新失敗或沒有更新!', 'slot_machine.php?game=ps_zone_data');
        // }
        break;
    //刪除
    default:
        reload_js_top_href('異常', 'ps_list.php');
        exit('異常');
}

function excuteApi($url, $simple) {
    // var_dump($this->apiUrl);
    //var_dump(  $this->getApiInput());
   // var_dump($simple);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true); // 啟用POST
    $simple = json_encode($simple);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($simple));
    $result = curl_exec($ch);
 //   curl_close($ch);

    return $result;
}

?>