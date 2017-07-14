<?php
//載入程式設定檔
$id_id = "login";
require("inc/inc.php");
require("func/func_deposit.php");
require("func/func_member.php");
//ini_set("display_errors",1);
//brian brianlo
//========= 參數接收 op ==========
//$_SESSION['admin_name'];
$member_phone = ft($_POST['phone'], 1);
$account = ft($_POST['account'],1);
$arr_input['points'] = ft($_POST['deposit'], 0);
$deposit = $arr_input['points'];
$arr_input['admin_name'] = ft($_POST['admin_name'], 1);
$deposit_member = get_member_once_strict($admin_db, $member_phone, $account);
//var_dump($_POST);
//var_dump($deposit_member);
if (!$deposit_member)
{
    reload_js_top_href('無此帳號或手機號碼不符!', 'deposit_history.php');
    return;
}
//var_dump($deposit_member);
$arr_input['member_id'] = $deposit_member['id'];

$orginal_points = $deposit_member['point'];

//========= 參數接收 ed ==========


$add_id = add_deposit($admin_db, $arr_input);
$mod_member['point'] = $orginal_points + $deposit;

$mod = mod_member_admin($admin_db, $mod_member, $deposit_member['id']);
if ($add_id && $mod) {
    log_deposit($admin_db, $deposit_member['id'], $deposit);
    reload_js_top_href('新增成功!', 'deposit_history.php');
} else {
    reload_js_top_href('新增失敗或沒有新增!', 'deposit_history.php');
}
?>
