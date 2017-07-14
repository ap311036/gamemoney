<?php

//載入程式設定檔
$id_id = "login";
require("inc/inc.php");
require(furl . "func/func_center.php");
require(furl . "func/func_member.php");
require(furl . "func/func_file.php");
require(furl . "head.php");
//ini_set("display_errors",1);
$target_path = realpath(furl . '../img/') . '/';

//========= 參數接收 op ==========




$act = ft($_POST['act'], 1);
$id = ft($_POST['id'], 0);
if (isset($_POST['game_title']))
    $arr_input['game_title'] = ft($_POST['game_title'], 1);
if (isset($_POST['order_id']))
    $arr_input['order_id'] = ft($_POST['order_id'], 0);
if (isset($_POST['gc_id']))
    $arr_input['gc_id'] = ft($_POST['gc_id'], 0);
if (isset($_POST['game_intro']))
    $arr_input['game_intro'] = ft($_POST['game_intro'], 7);
if (isset($_POST['game_rules']))
    $arr_input['game_rules'] = ft($_POST['game_rules'], 7);

$img = $_POST['game_intro'];

$img = img_date($img);

//var_dump($img);
$aa = count($img);

for ($i = 0; $i < $aa; $i++) {
    $arr_input['imgs_url'] = $img[$i].",";
   // var_dump($arr_input['img_url']);
}

if ($act == '') {
    $act = ft($_GET['act'], 1);
    $del_id = ft($_GET['id'], 0);
    $deleted = ft($_GET['del'], 0);
}
//js_alert($deleted);
//die;
//$act = "addsn";
//echo $act;
//========= 參數接收 ed ==========


switch ($act) {
    //新增
    case 'add':

        $pk = get_game_intro_pkmax($admin_db);
        $pk++;
        if (check_file_upload('img_upload')) {
            $icon_name = 'game_icon' . $pk . '.png';
            $at_pic = upload_image('img_upload', $target_path, $icon_name);
            if (!$at_pic)
                reload_js_top_href('圖片上傳失敗!', 'game_intro_manager.php');
            $arr_input['game_icon'] = $icon_name;
        }
        $dup = get_dup_game_intro($admin_db, $arr_input['order_id'], $arr_input['gc_id']);
        if ($dup) {
            $next_order_id = get_max_game_intro_order($admin_db, $gc_id) + 1;
            $changer_arr = [];
            $changer_arr['order_id'] = $next_order_id;
            $dup_id = mod_game_intro($admin_db, $changer_arr, $dup['id']);
        }

        $gi_id = add_game_intro($admin_db, $arr_input);
        if ($gi_id) {
            reload_js_top_href('新增成功!請繼續新增遊戲規則', "game_rules_add_mod.php?id=$gi_id");
        } else {
            reload_js_top_href('新增失敗或沒有新增!', 'game_intro_manager.php');
        }
        break;
    case 'rules':
        $gi_id = mod_game_intro($admin_db, $arr_input, $id);
        if ($gi_id) {
            reload_js_top_href('新增成功!', 'game_intro_manager.php');
        } else {
            reload_js_top_href('新增失敗或沒有新增!', 'game_intro_manager.php');
        }
        break;

    //更新
    case 'mod':
        //檢驗
//        $arr_input = cg_check_input_value($db, $arr_input, $act, $id);
        $game_original = get_game_intro_once($admin_db, $id);

        if (check_file_upload('img_upload')) {
//            js_alert($target_path);

            $icon_name = explode('.', $game_original['game_icon'])[0];
            $at_pic = upload_image('img_upload', $target_path, $icon_name, 1);
//            js_alert($at_pic);
            if (!$at_pic)
                reload_js_top_href('圖片上傳失敗!', 'game_intro_manager.php');
        }
//        $admin_db->debug();
        $dup = get_dup_game_intro($admin_db, $arr_input['order_id'], $arr_input['gc_id'], $id);
        if ($dup) {
            $changer_arr = [];
            $changer_arr['order_id'] = $game_original['order_id'];
            $trigger = mod_game_intro($admin_db, $changer_arr, $dup['id']);
        }

        $mod_id = mod_game_intro($admin_db, $arr_input, $id);

        if ($trigger) {
            reload_js_top_href("更新並置換排序成功", 'game_intro_manager.php');
        } else if ($mod_id) {
            reload_js_top_href('更新成功!', 'game_intro_manager.php');
        } else {
            reload_js_top_href('更新失敗或沒有更新!', 'game_intro_manager.php');
        }
        break;

    //是否刪除
    case 'switch':

        $sql_input = [];
        $sql_input ['is_delete'] = $deleted;
//        $admin_db->debug();
        if (mod_game_intro($admin_db, $sql_input, $del_id)) {
            reload_js_top_href('更新成功!', 'game_intro_manager.php');
        } else {
            reload_js_top_href('更新失敗或沒有更新!', 'game_intro_manager.php');
        }
        break;

    default:
        reload_js_top_href('異常', 'index.php');
        exit('異常');
}
//檢驗資料
?>