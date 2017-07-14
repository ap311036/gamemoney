<?php
$id_id = "login";
require("inc/inc.php");
require("func/func_member.php");

$res = ["code" => 1];
$account = ft($_POST['account'], 1);
$member_array = get_member_by_account($admin_db, $account);
if ($member_array == null) {
    die(json_encode($res));
}

$member_data = $member_array[0];
$act = ft($_POST['A'], 1);
switch ($act) {
    case "LGVF":    // LOGIN_VERIFY
        $res = ["code" => 0, "account" => $member_data['account'], "name" => $member_data['name'], "money" => (int)$member_data['point'], "sex" => (int)$member_data['sex']];
        break;
    case "TRMO":    // TRANS_MONEY
        $trans_money = ft($_POST['m'], 0);
        $user_money = $member_data['point'];
        if ($user_money >= $trans_money) {
            $sql = "UPDATE member SET point = point - " . $trans_money . " WHERE id = " . $member_data['id'] . " AND point >= " . $trans_money . " ";
            $sql_res = $admin_db->execSQL($sql, array(), 'wu');
            if ($sql_res > 0) {
                $res = ["code" => 0, "m" => $user_money];
            }
        }
        break;
    case "RETM":    // RESET_TRANS_MONEY
        $trans_money = ft($_POST['m'], 0);
        if ($trans_money > 0) {
            $sql = "UPDATE member SET point = point + " . $trans_money . " WHERE id = " . $member_data['id'] . " ";
            $sql_res = $admin_db->execSQL($sql, array(), 'wu');
            if ($sql_res > 0) {
                $user_money = $member_data['point'] + $trans_money;
                $res = ["code" => 0, "m" => (int)$user_money];
            }
        } else if ($trans_money == 0) {
            $user_money = $member_data['point'];
            $res = ["code" => 0, "m" => (int)$user_money];
        }
        break;
    case "RETMWIN":    // RESET_TRANS_MONEY_FOR_WIN7PK
        $trans_money = ft($_POST['m'], 0);
        if ($trans_money > 0) {
            $sql = "UPDATE member SET point = point + " . $trans_money . " WHERE id = " . $member_data['id'] . " ";
            $sql_res = $admin_db->execSQL($sql, array(), 'wu');
            if ($sql_res > 0) {
                $user_money = $member_data['point'] + $trans_money;
                $res = ["code" => 0, "m" => (int)$user_money, 'trans' => (int)$trans_money];
            }
        } else if ($trans_money == 0) {
            $user_money = $member_data['point'];
            $res = ["code" => 0, "m" => (int)$user_money, 'trans' => (int)$trans_money];
        }
        break;
}

die(json_encode($res));