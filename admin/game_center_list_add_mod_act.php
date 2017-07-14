<?php
//載入程式設定檔
$id_id = "login";
require("inc/inc.php");
require(furl . "func/func_center.php");
require(furl . "func/func_member.php");
require(furl . "head.php");
//ini_set("display_errors",1);

//========= 參數接收 op ==========

$act = ft($_POST['act'], 1);
$id = ft($_POST['id'], 0);
$arr_input['title'] = ft($_POST['title'], 1);
$arr_input['order_id'] = ft($_POST['order_id'], 0);


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
        $gc_id = add_game_center($admin_db, $arr_input);
        if ($gc_id) {
            reload_js_top_href('新增成功!', 'game_center_list.php');
        } else {
            reload_js_top_href('新增失敗或沒有新增!', 'game_center_list.php');
        }
        break;

    //更新
    case 'mod':
        //檢驗
//        $arr_input = cg_check_input_value($db, $arr_input, $act, $id);

        $dup = get_game_center_order_dup($admin_db, $arr_input['order_id'],$id);
        if ($dup) {
            $actor = get_game_center_id($admin_db, $id);
            $change_id = $actor['order_id'];
            $trigger = mod_game_center($admin_db, ['order_id'=>$change_id], $dup['id']);
        }

        $mod_id = mod_game_center($admin_db, $arr_input, $id);

        if ($trigger) {
            reload_js_top_href("更新並置換排序成功", 'game_center_list.php');
        } else if ($mod_id) {
            reload_js_top_href('更新成功!', 'game_center_list.php');
        } else {
            reload_js_top_href('更新失敗或沒有更新!', 'game_center_list.php');
        }
        break;

    //是否刪除
    case 'switch':

        if (mod_game_center($db, [], $del_id)) {
            reload_js_top_href('更新成功!', 'articles_manager.php');
        } else {
            reload_js_top_href('更新失敗或沒有更新!', 'articles_manager.php');
        }
        break;

    default:
        reload_js_top_href('異常', 'index.php');
        exit('異常');
}
//檢驗資料

?>