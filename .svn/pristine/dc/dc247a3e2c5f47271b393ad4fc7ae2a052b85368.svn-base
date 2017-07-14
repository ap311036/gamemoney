<?php
//載入程式設定檔
$id_id = "login";
require("inc/inc.php");
require(furl . "func/func_center.php");
require(furl . "func/func_newbie.php");
require(furl . "func/func_file.php");
require(furl . "head.php");
//ini_set("display_errors",1);
$target_path = realpath(furl . '../img/') . '/';

//========= 參數接收 op ==========

$act = ft($_POST['act'], 1);
$id = ft($_POST['id'], 0);
if (isset($_POST['title']))
    $arr_input['title'] = ft($_POST['title'], 1);
if (isset($_POST['order_id']))
    $arr_input['order_id'] = ft($_POST['order_id'], 0);
if (isset($_POST['content']))
    $arr_input['content'] = ft($_POST['content'], 7);


//log_file(json_encode($_POST));
//js_alert('111');
//js_alert(json_encode($_FILES['img_upload']));
//die;
if ($act == '') {
    $act = ft($_GET['act'], 1);
    $del_id = ft($_GET['id'], 0);
    $deleted = ft($_GET['deleted'], 0);
}
//js_alert($deleted);
//die;
//$act = "addsn";
//echo $act;

//========= 參數接收 ed ==========


switch ($act) {
    //新增
    case 'add':
        $pk = get_newbie_pkmax($admin_db);
        $pk++;
        $dup = get_dup_newbie($admin_db, $arr_input['order_id'], $arr_input['id']);
        if ($dup) {
            $arr_input['order_id'] = $pk;
            $dup_id = mod_newbie_guide($admin_db, $arr_input, $dup['id']);
        }

        $add_id = add_newbie_guide($admin_db, $arr_input);
        if ($add_id) {
            reload_js_top_href('新增成功!', "game_newbie_guide.php");
        } else {
            reload_js_top_href('新增失敗或沒有新增!', 'game_newbie_guide.php');
        }
        break;

    //更新
    case 'mod':
        //檢驗
//        $arr_input = cg_check_input_value($db, $arr_input, $act, $id);
        $game_original = get_newbie_guide_once($admin_db, $id);

//        if (check_file_upload('img_upload')) {
////            js_alert($target_path);
//
//            $icon_name = explode('.', $game_original['game_icon'])[0];
//            $at_pic = upload_image('img_upload', $target_path, $icon_name, 1);
////            js_alert($at_pic);
//            if (!$at_pic)
//                reload_js_top_href('圖片上傳失敗!', 'game_intro_manager.php');
//        }
        $dup = get_dup_newbie($admin_db, $arr_input['order_id'], $id);
        if ($dup) {
            $changer_arr = [];
            $changer_arr['order_id'] = $game_original['order_id'];
            $trigger = mod_newbie_guide($admin_db, $changer_arr, $dup['id']);
        }

        $mod_id = mod_newbie_guide($admin_db, $arr_input, $id);

        if ($trigger) {
            reload_js_top_href("更新並置換排序成功", 'game_newbie_guide.php');
        } else if ($mod_id) {
            reload_js_top_href('更新成功!', 'game_newbie_guide.php');
        } else {
            reload_js_top_href('更新失敗或沒有更新!', 'game_newbie_guide.php');
        }
        break;

    //是否刪除
    case 'switch':

        $sql_input = [];
        $sql_input  ['is_deleted'] = $deleted;
        if (mod_newbie_guide($admin_db, $sql_input, $del_id)) {
            reload_js_top_href('更新成功!', 'game_newbie_guide.php');
        } else {
            reload_js_top_href('更新失敗或沒有更新!', 'game_newbie_guide.php');
        }
        break;

    default:
        reload_js_top_href('異常', 'index.php');
        exit('異常');
}
//檢驗資料

?>