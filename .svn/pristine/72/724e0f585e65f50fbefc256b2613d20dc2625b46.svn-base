<?php

if (!isset($_SESSION)) {
    session_start();
}

date_default_timezone_set("Asia/Taipei");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once("lib/config.php");
include_once("lib/WebDB.php");
include_once("lib/basePage.php");
require 'lib/Carbon.php';

use Carbon\Carbon;

$viewData = array();

class func_point extends basePage {

    public function page_load() {
        //是否登入
        $this->isLogin();
        //@$code = $_POST['code'];

        $arrGetParam = array();
        $arrGetParam['m'] = 'getMemberList';
        foreach ($arrGetParam as $k => $v) {
            if (isset($_GET[$k])) {
                if ($_GET[$k] == 'checke' && $_POST) {
                    // if ($code != NULL) {
                    $this->checke();
                    //  }
                }
            }
        }
    }

    public function getUser() {
        if (isset($_SESSION['fuser_account'])) {
            $account = $_SESSION['fuser_account'];
            $sql = 'select * from member where account = \'' . $account . '\'';
            $member = $this->_db->single($sql);
            //  var_dump($member);
            return $member;
        }

        return false;
    }

    public function checke() {
        @$code = $_POST['code'];
        $user = $this->getUser();
        $sql = "SELECT * FROM `transfer_money` WHERE  tm_smlid =  " . $user['id'] . " AND `tm_msg_1` LIKE '" . $code . "'";
        $checK_en = $this->_db->single($sql);

        $dastime = date('Y-m-d h:i:s');
        $dastime = strtotime($dastime);
        //$dastime += 172800;
        //var_dump($dastime);        
        if ($code == $checK_en['tm_msg_1']) {

            // var_dump($checK_en['tm_status']);
            if (2 == $checK_en['tm_status']) {
                //   var_dump($checK_en['tm_ctime']);
                // var_dump($dastime);
                if (($checK_en['tm_ctime'] + 172800) >= $dastime) {

                    $this->save_point($checK_en['tm_gmlid'], $checK_en['tm_id']);
                } else {
                    return $this->alert('此驗證碼已過期');
                }
            } else {
                //var_dump(222);
                return $this->alert('此驗證碼已過期');
            }
        } else {
            $sql = "SELECT * FROM `transfer_money` WHERE  tm_gmlid =  " . $user['id'] . " AND `tm_msg_2` LIKE '" . $code . "'";
            $checK_en = $this->_db->single($sql);
            if ($code == $checK_en['tm_msg_2']) {
                if (3 == $checK_en['tm_status']) {
                    $this->add_point($checK_en['tm_amount'], $checK_en['tm_gmlid'], $checK_en['tm_id']);
                    return $this->alert('轉點成功');
                } else {
                    return $this->alert('此驗證碼已過期');
                }
            } else {
                return $this->alert('簡訊碼錯誤');
            }
        }
    }

    public function add_point($tm_amount, $tm_gmlid, $tm_id) {
        $sql = "UPDATE `member` SET `point` = '" . $tm_amount . "' WHERE `member`.`id` = " . $tm_gmlid;
        $sql = $this->_db->execSql($sql);
        $time = date('Y-m-d h:i:s');
        $sql = "UPDATE `transfer_money` SET `tm_status` = 5 , `tm_msg_check_1_utime` = '" . $time . "',  `tm_msg_check_2` = '1' WHERE `transfer_money`.`tm_id` = " . $tm_id;
        $sql = $this->_db->execSql($sql);
    }

    public function save_point($tm_msg_1, $tm_id) {

        $sql = "SELECT * FROM `member` WHERE  id =" . $tm_msg_1;
        $checK_en = $this->_db->single($sql);


        $code = substr(md5(uniqid(rand(), true)), 0, 5);

        //請輸入以下註冊畫面代碼，若你未申請請忽略此封簡訊
        $text = "game money 遊戲網站簡訊認證。代碼：" . $code;
        $value = iconv("utf-8", "big5", $text); //轉換編碼
        $value = urlencode($value);
        // $phone = $_POST['phone'];
        $phone = $checK_en['phone'];
        //   var_dump($phone);
        $pass = 'grace623';
        $acc = 'graceanna';

        $url = 'https://api.kotsms.com.tw/kotsmsapi-1.php';
        $url .= '?username=' . $acc . '&password=' . $pass . '&dstaddr=' . $phone . '&%20smbody=' . $value;  //'&response=http://gamemoney.sammicorner.com/receiveMsg.php"';
        //var_dump($url);
        //檢查此電話，是不是30秒內已送過
        $today = date('Y-m-d h:i:s');
        $new_date = date('Y-m-d h:i:s', strtotime('-30 seconds', strtotime($today)));

//            //var_dump($new_date);
//        $sql = 'select * from register_sms where  create_date > \'' . $new_date . '\' and phone= @phone ';
//
//        $smsCheck = $this->_db->single_check($sql, array('phone' => $phone));
//        if ($smsCheck != false) {
//            return $this->alert('30秒內不得重複發送');
//        }
        //執行送出簡訊
        $result = $this->httpGet($url);
        //存進DB
        $time = date('Y-m-d h:i:s');
        $sql = "UPDATE `transfer_money` SET `tm_msg_2` = '" . $code . "' , `tm_status` = 3 , `tm_msg_check_1_utime` = '" . $time . "',  `tm_msg_check_1` = '1' WHERE `transfer_money`.`tm_id` = " . $tm_id;
        $sql = $this->_db->execSql($sql);

        return $this->alert('轉帳簡訊已送出');
    }

}

$aa = new func_point();
$aa->page_load();
?>