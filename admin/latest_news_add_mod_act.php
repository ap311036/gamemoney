<?php

//載入程式設定檔
$id_id = "login";
require("inc/inc.php");
require("func/func_admin.php");
//ini_set("display_errors",1);
//========= 參數接收 op ==========


$act = $_POST['act'];






$id = ft($_POST['id'], 0);
$arr_input['title'] = ft($_POST['at_title'], 1);
$arr_input['content'] = $_POST['at_content'];

if ($_POST['cg_id'] == "遊戲") {
    $arr_input['news_type'] = 1;
}
if ($_POST['cg_id'] == "活動") {
    $arr_input['news_type'] = 2;
}
$arr_input['is_del'] = $_POST['is_del'];
$is_del = $_POST['is_del'];


if($act == '')
{
    $id = $_GET['id'];
    $act = $_GET['act'];
}
//var_dump($is_del);
//var_dump($arr_input['is_del']);
//js_alert($deleted);
//die;
//$act = "addsn";
//echo $act;
//========= 參數接收 ed ==========

switch ($act) {

    case 'add':
        $add_id = add_news($admin_db, $arr_input);

        if ($add_id) {
            reload_js_top_href('新增成功!', 'latest_news.php');
        } else {
            reload_js_top_href('新增失敗或沒有新增!', 'latest_news.php');
        }
        break;

    //更新
    case 'mod':
        //檢驗
//        $arr_input = cg_check_input_value($db, $arr_input, $act, $id);
        // var_dump($arr_input);
        $mod_id = mod_news($admin_db, $arr_input, $id, $is_del);
//			if($arr_input['ml_pass'])
//			{
//				reload_js_top_href('變更密碼，請重新登入!','login.php');
//			}
        if ($mod_id) {
            reload_js_top_href('更新成功!', 'latest_news.php');
        } else {
            reload_js_top_href('更新失敗或沒有更新!', 'latest_news.php');
        }
        break;

    //是否刪除
    case 'switch':

        if (mod_article($db, [], $del_id, $deleted)) {
            reload_js_top_href('更新成功!', 'latest_news.php');
        } else {
            reload_js_top_href('更新失敗或沒有更新!', 'latest_news.php');
        }
        break;

    case 'start':
        $arr_start['is_del'] = !($start);
        if (mod_latest_new($admin_db, $arr_start, $id)) {
            reload_js_top_href('更新成功!', 'latest_news.php');
        } else {
            reload_js_top_href('更新失敗或沒有更新!', 'latest_news.php');
        }
        break;

    default:
        reload_js_top_href('異常', 'index.php');
        exit('異常');
}
//檢驗資料
?>