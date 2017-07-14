<?php

//載入程式設定檔
$id_id = "login";
require("inc/inc.php");
require("func/func_play_station.php");
//ini_set("display_errors",1);
//========= 參數接收 op ==========

$act = ft($_POST['act'], 1);
$id = ft($_POST['id'], 0);
if ($act == null) {
    $act = ft($_GET['act'], 1);
    $id = ft($_GET['id'], 0);
}

//========= 參數接收 ed ==========
switch ($act) {
    //清空
    case 'clear':
        $arr_input['play_count'] = 0;
        $arr_input['twinstar_count'] = 0;
        $arr_input['jp_pool'] = 0;
        $arr_input['jp_win'] = 0;
        $arr_input['total_bet'] = 0;
        $arr_input['total_win'] = 0;
        $arr_input['total_open'] = 0;
        $arr_input['total_close'] = 0;
        if (mod_play_station_data($win7pk_db, $arr_input, $id)) {
            reload_js_top_href('清除成功!', 'slot_machine.php?game=ps_zone_data');
        } else {
            reload_js_top_href('清除失敗或沒有清除!', 'slot_machine.php?game=ps_zone_data');
        }
        break;
    default:
        reload_js_top_href('異常', 'ps_zone_data.php');
        exit('異常');
}
?>