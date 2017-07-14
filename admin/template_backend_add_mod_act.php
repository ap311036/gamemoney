<?php
//載入程式設定檔
$id_id = "login";
require("../inc/inc.php");
require(furl . "common/func_member.php");
require(furl . "common/func_file.php");
require(furl . "common/func_articles.php");
require(furl . "common/common_function.php");
$target_path = fileroot . 'storage/image/articles/';
//ini_set("display_errors",1);

//========= 參數接收 op ==========

$act = ft($_POST['act'], 1);
$id = ft($_POST['id'], 0);
$arr_input['at_title'] = ft($_POST['at_title'], 1);
$arr_input['at_content'] = ft($_POST['at_content'], 7);
$arr_input['cg_id'] = ft($_POST['cg_id'], 1);
if (!empty($_POST['at_pic']))
    $arr_input['at_pic'] = ft($_POST['at_pic'], 1);
$number = ft($_POST["number"], 0);
log_file(json_encode($_FILES));
log_file(json_encode($target_path));
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
        if (check_file_upload('img_upload')) {

            $at_pic = upload_image('img_upload', $target_path, 'at_' . (string)time());
            $arr_input['at_pic'] = $at_pic;
            if (!$at_pic)
                reload_js_top_href('圖片上傳失敗!', 'articles_manager.php');
        }
        $add_id = add_articles($db, $arr_input);
        if ($add_id) {
            reload_js_top_href('新增成功!', 'articles_manager.php');
        } else {
            reload_js_top_href('新增失敗或沒有新增!', 'articles_manager.php');
        }
        break;

    //更新
    case 'mod':
        //檢驗
//        $arr_input = cg_check_input_value($db, $arr_input, $act, $id);
        $overwrite = 1;
        if (check_file_upload('img_upload')) {
            if (empty($arr_input['at_pic'])) {
                $at_pic = upload_image('img_upload', $target_path, 'at_' . (string)time());
            } else
                $at_pic = upload_image('img_upload', $target_path, $arr_input['at_pic'], $overwrite);
            if (!$at_pic)
                reload_js_top_href('圖片上傳失敗!', 'articles_manager.php');
            $arr_input['at_pic'] = $at_pic;
        }
        //更新基本資料
        var_dump(check_file_upload('img_upload'));
        var_dump($arr_input);
        $mod_id = mod_article($db, $arr_input, $id, $deleted);
//			if($arr_input['ml_pass'])
//			{
//				reload_js_top_href('變更密碼，請重新登入!','login.php');
//			}
        if ($mod_id) {
            reload_js_top_href('更新成功!', 'articles_manager.php');
        } else {
            reload_js_top_href('更新失敗或沒有更新!', 'articles_manager.php');
        }
        break;

    //是否刪除
    case 'switch':

        if (mod_article($db, [], $del_id, $deleted)) {
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