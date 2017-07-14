<?php
//載入程式設定檔
$id_id = "login";
require("inc/inc.php");
require(furl . "func/func_jpot.php");
require(furl . "func/func_member.php");
require(furl . "head.php");
//ini_set("display_errors",1);

//========= 參數接收 op ==========


$act = ft($_POST['act'], 1);
$id = ft($_POST['id'], 0);
$arr_input['jpot_name'] = ft($_POST['jpot_name'], 1);
$arr_input['button_points'] = ft($_POST['button_points'], 0);
$arr_input['charge_points'] = ft($_POST['charge_points'], 0);
$arr_input['acc_limit'] = ft($_POST['acc_limit'], 0);
$arr_input['acc_ratio'] = ft($_POST['acc_ratio'], 0);
$arr_input['lottery_ratio'] = ft($_POST['lottery_ratio'], 0);
$arr_input['charge_ratio'] = ft($_POST['charge_ratio'], 0);


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
//    case 'add':
//        $gc_id = add_game_center($admin_db, $arr_input);
//        if ($gc_id) {
//            reload_js_top_href('新增成功!', 'game_center_list.php');
//        } else {
//            reload_js_top_href('新增失敗或沒有新增!', 'game_center_list.php');
//        }
//        break;

    //更新
    case 'mod':
        //檢驗

        $mod_id = mod_jpot_setting($jpot_db, $arr_input, $id);

        if ($mod_id) {
            reload_js_top_href('更新成功!', 'jpot_setting.php');
        } else {
            reload_js_top_href('更新失敗或沒有更新!', 'jpot_setting.php');
        }
        break;

//    //是否刪除
//    case 'switch':
//
//        if (mod_game_center($db, [], $del_id)) {
//            reload_js_top_href('更新成功!', 'articles_manager.php');
//        } else {
//            reload_js_top_href('更新失敗或沒有更新!', 'articles_manager.php');
//        }
//        break;

    default:
        reload_js_top_href('異常', 'index.php');
        exit('異常');
}
//檢驗資料

?>