<?php

session_start();
date_default_timezone_set("Asia/Taipei");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once("lib/config.php");
include_once("lib/WebDB.php");
include_once("lib/basePage.php");



$viewData = array();

class func_member extends basePage {

    public function page_load() {
        //判斷有沒有登入
        if (!isset($_SESSION['fuser_account'])) {
            $this->redirect('index.php', '請先登入');
            return;
        }


        //get 上有要特別處理的參數
        if (isset($_GET['m'])) {
            switch ($_GET['m']) {
                case 'save_password':
                    $this->savePassword();
                    break;
                case 'save_account':
                    $this->saveAccount();
                    break;
                case 'nickname':
                    $this->nickname();
                    break;
                case 'save_friend':
                    $this->save_friend();
                    break;
                case 'save_badfriend':
                    $this->save_friend();
                    break;
            }
        }


        global $viewData;
    }

    public function nickname() {
        $account = $_SESSION['fuser_account'];
       // $newPass = $_POST['new_pass'];
       // $confirmPass = $_POST['comfirm_pass'];
        $nickName = $_POST['nick_name'];

//        if ($newPass == '') {
//            $this->alert('請輸入新密碼');
//            return;
//        }
//
//        if ($confirmPass == '') {
//            $this->alert('請輸入確認密碼');
//            return;
//        }
//        if ($newPass != $confirmPass) {
//            $this->alert('密碼和確認密碼不同');
//            return;
//        }

        $sql = 'select * from member where account= @account ';
        $member = $this->_db->single_check($sql, array('account' => $account));

        //$newPass = md5($this->encrypt($newPass));
        $arrData = array();
//        $arrData['password'] = $newPass;
        $arrData['name'] = $nickName;

        $result = $this->_db->Update('member', array('account' => $account), $arrData);

        if (!$result) {
            $this->alert('更新失敗');
            return;
        }

        $this->redirect('index.php?m=logout', '暱稱修改成功');
    }

    public function savePassword() {
        $account = $_SESSION['fuser_account'];
        $newPass = $_POST['new_pass'];
        $confirmPass = $_POST['comfirm_pass'];
        //$nickName = $_POST['nick_name'];

        if ($newPass == '') {
            $this->alert('請輸入新密碼');
            return;
        }

        if ($confirmPass == '') {
            $this->alert('請輸入確認密碼');
            return;
        }
        if ($newPass != $confirmPass) {
            $this->alert('密碼和確認密碼不同');
            return;
        }

        $sql = 'select * from member where account= @account ';
        $member = $this->_db->single_check($sql, array('account' => $account));

        $newPass = md5($this->encrypt($newPass));
        $arrData = array();
        $arrData['password'] = $newPass;
        //$arrData['name'] = $nickName;

        $result = $this->_db->Update('member', array('account' => $account), $arrData);

        if (!$result) {
            $this->alert('更新失敗');
            return;
        }

        $this->redirect('login.php?m=logout', '修改成功，請使用新密碼登入');


        //if($member['password'] )
        //echo $account;
        //var_dump($result);
        //$this->alert($result[0]['name']);
    }

    //好友新增
    function save_friend() {
        $member_id = $_POST['name'];
        //var_dump($id);
        $mbFriend = $_POST['mbFriend'];
        if (!$_POST['mbFriend']) {
            $this->redirect('member.php?tab=0', '請輸入ID');
        }
        $sql = "SELECT * FROM `member` WHERE `name` LIKE '" . $mbFriend . "'";
        $res = $this->_db->query($sql);

        if ($res == FALSE) {
            $this->redirect('member.php?tab=0', '未找找此ID');
        }
        foreach ($res as $key => $value) {
            $sql = "SELECT * FROM `member_friend` WHERE `member_id` =" . $member_id . " AND `id` = '" . $value['id'] . "'";
            $res = $this->_db->query($sql);

            if ($res == FALSE) {
                $input = array();
                $input['member_id'] = $member_id;
                $input['friend_member_id'] = $value['id'];
                $input['createDate'] = date('Y-m-d H:i:s');
                $this->_db->Insert('member_friend', $input);
                $res = $this->_db->query($sql);
                $this->redirect('member.php?tab=0', '新增好友成功');
            } else {
                $this->redirect('member.php?tab=0', '此好友已新增');
            }
        }
    }

    //黑名單新增

    function save_badfriend() {
        $member_id = $_POST['name'];
        //var_dump($id);
        $mbFriend = $_POST['mbFriend'];
        if (!$_POST['mbFriend']) {
            $this->redirect('member.php?tab=0', '請輸入ID');
        }
        $sql = "SELECT * FROM `member` WHERE `name` LIKE '" . $mbFriend . "'";
        $res = $this->_db->query($sql);

        if ($res == FALSE) {
            $this->redirect('member.php?tab=0', '未找找此ID');
        }
        foreach ($res as $key => $value) {
            $sql = "SELECT * FROM `member_friend` WHERE `member_id` =" . $member_id . " AND `id` = '" . $value['id'] . "'";
            $res = $this->_db->query($sql);

            if ($res == FALSE) {
                foreach ($res as $key => $value) {
                    var_dump($value);
                }


// $result = $this->_db->Update('member_friend', array('is_del' => $account), $arrData);
//                $input = array();
//                $input['member_id'] = $member_id;
//                $input['friend_member_id'] = $value['id'];
//                $input['createDate'] = date('Y-m-d H:i:s');
//                $this->_db->Insert('member_friend', $input);
//                $res = $this->_db->query($sql);
//                $this->redirect('member.php?tab=0', '新增好友成功');
            } else {
                //  $this->redirect('member.php?tab=0', '此好友已新增');
            }
        }

        die();
    }

    //帳號篩遠資料
    function get_slotlog_select($db, $arr_input, $page, $id, $gml_id, $start_date, $end_date) {

//        $page_count = count($page);
//        //var_dump($arr_input);
//        //$db->debug();
//
//        if ($id >= 0) {
//            $def = ' WHERE a.gml_id = ? ';
//            $sql_input['gml_id'] = $id;
//        }
//        if ($arr_input['start_date'] && $arr_input['end_date']) {
//            $def = ' WHERE a.gml_id = ? ';
//            $def .= ' AND a.sl_time BETWEEN ? AND ? ';
//            $sql_input['gml_id'] = $id;
//            $sql_input[] = $arr_input['start_date'];
//            $sql_input[] = $arr_input['end_date'];
//        }
//        if (count($page) > 0) {
//
//            $sql = ' SELECT a.*, b.ml_account FROM spin_log AS a LEFT JOIN game_member_list AS b ON a.gml_id = b.gml_id ' . $def;
//            $sql .= $page->getSqlLimit();
//        } else {
//            $sql = ' SELECT COUNT(a.gml_id) as cnt  FROM spin_log AS a LEFT JOIN game_member_list AS b ON a.gml_id = b.gml_id ' . $def;
//        }
//
//
//        $res = $db->dbSelectPrepare($sql, $sql_input);
//        return $res;
    }

    public function saveAccount() {
        $arrData = array();
        $arrData['name'] = $_POST['name'];
        // var_dump($_POST['name']);
        // die();
        $arrData['birthday'] = $_POST['birthday'];
        $arrData['tel'] = $_POST['tel'];
        //$arrData['country'] = $_POST['country'];
        //$arrData['phone'] = $_POST['phone'];
        $arrData['email'] = $_POST['email'];
        $arrData['address'] = $_POST['address'];
        $arrData['invoice_type'] = $_POST['mdReceipt'];
        $arrData['invoice_name'] = $_POST['invoice_name'];
        $arrData['invoice_address'] = $_POST['invoice_address'];

        $arrData['zip_code'] = $_POST['mbZipcode'];
        $arrData['invoice_zip_code'] = $_POST['rcZipcode'];

        $account = $_SESSION['fuser_account'];

        $result = $this->_db->Update('member', array('account' => $account), $arrData);

        if (!$result) {
            $this->alert('更新失敗');
        } else {
            $this->redirect('member.php', '更新成功');
        }
    }

    public function get_game_slot() {

//        $id = $_POST['name'];
//        //var_dump($id);
//        $mbGameType = $_POST['mbGameType'];
//        //var_dump($mbGameType);
//        $mbGameName = $_POST['mbGameName'];
//
//        $start_date = $_POST['start_date'];
//        $end_date = $_POST['end_date'];
//
//        $start_date = explode("T", $start_date);
//        $start_date = "$start_date[0] $start_date[1]";
//
//        $end_date = explode("T", $end_date);
//        $end_date = "$end_date[0] $end_date[1]";
//
//        $res = $this->_slotdb->query("SELECT * FROM `spin_log` WHERE sl_time BETWEEN '" . $start_date . "' AND '" . $end_date . "' AND gml_id =" . $id);
        //return $res;
    }

}

$aa = new func_member();
$aa->page_load();
?>

