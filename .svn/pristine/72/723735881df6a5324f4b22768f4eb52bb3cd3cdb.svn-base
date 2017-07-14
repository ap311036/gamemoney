<?php

//載入程式設定檔
$id_id = "login";
require("inc/inc.php");
require(furl . "func/func_marquee.php");
require(furl . "head.php");
//ini_set("display_errors", 1);
//========= 參數接收 op ==========

$act = ft($_POST['act'], 1);
$id = ft($_POST['id'], 0);
//$arr_input['title'] = ft($_POST['title'], 1);
//$arr_input['order_id'] = ft($_POST['order_id'], 0);
//$arr_input['Amt'] = ft($_POST['Amt'], 0);
//$arr_input['ItemDesc'] = ft($_POST['ItemDesc'], 1);
//$arr_input['points'] = ft($_POST['points'], 0);
//$arr_input['OrderComment'] = ft($_POST['OrderComment'], 1);
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
$arr_input['title'] = ft($_POST['title'], 1);
$arr_input['msg'] = ft($_POST['msg'], 1);
$arr_input['m_start_date'] = ft($_POST['start_date'], 1);
$arr_input['m_end_date'] = ft($_POST['end_date'], 1);

$immediately = $_POST['immediately'];

if ($immediately != "") {
    date_default_timezone_set('Asia/Taipei');
    $datetime = date('Y-m-d H:i:s', strtotime('+5 sec'));
    $arr_input['m_start_date'] = $datetime;
}

//
//
//========= 參數接收 ed ==========
//var_dump($_POST);
//die;
//var_dump($act);
switch ($act) {
    //新增
    case 'add':
        $gc_id = add_marquee($admin_db, $arr_input);
        if ($gc_id) {
            reload_js_top_href('新增成功!', 'marquee.php');
        } else {
            reload_js_top_href('新增失敗或沒有新增!', 'marquee.php');
        }
        break;

    //更新
    case 'mod':
        //檢驗
//        $arr_input = cg_check_input_value($db, $arr_input, $act, $id);
        $mod_id = mod_marquee($admin_db, $arr_input, $id);
        if ($mod_id) {
            reload_js_top_href('更新成功!', 'marquee.php');
        } else {
            reload_js_top_href('更新失敗或沒有更新!', 'marquee.php');
        }
        break;

    //是否刪除
    case 'switch':
        if (delete_marquee($admin_db, [], $del_id)) {
            reload_js_top_href('刪除成功!', 'marquee.php');
        } else {
            reload_js_top_href('更新失敗或沒有更新!', 'marquee.php');
        }
        break;

    default:
        reload_js_top_href('異常', 'index.php');
        exit('異常');
}
//檢驗資料
?>