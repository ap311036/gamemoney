<?php

if (!isset($_SESSION)) {
    session_start();
}


date_default_timezone_set("Asia/Taipei");

//var_dump(123123);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

include_once("lib/config.php");
include_once("lib/WebDB.php");
include_once("lib/basePage.php");
require 'lib/Carbon.php';

use Carbon\Carbon;

$viewData = array();

//die;
class func_point extends basePage {

    public function page_load() {
        //是否登入
        $this->isLogin();

        //get 上有要特別處理的參數
        $arrGetParam = array();
        $arrGetParam['m'] = 'getMemberList';

        foreach ($arrGetParam as $k => $v) {
            if (isset($_GET[$k])) {
                if ($_GET[$k] == 'transferPoint' && $_POST) {
                    $this->transferPoint();
                }
            }
        }


        global $viewData;

        //var_dump($viewData['member']['id']);
        //die;
        $viewData['member'] = $this->getUser();
        // $reciever = $this->getAccount($_POST['account']);
        // var_dump($reciever);
        //  die;
        // var_dump($viewData['member']['id']);
        $viewData['production_package'] = $this->get_package();
        $viewData['jcord_data'] = $this->getjcord($viewData['member']['id']);
        $viewData['transferData'] = $this->gerTransferData($viewData['member']['id']);
        $viewData['transferRecord'] = $this->getTransferRecord($viewData['member']['id']);
        $viewData['transferstatus'] = $this->getstatus($viewData['member']['id']);
        $viewData['transferreciver'] = $this->reciever_recoud($viewData['member']['id']);
    }

    public function reciever_recoud($reciever_id) {
        // $sql = "select transfer_money.tm_status, b.name as transfer_name,b.account as transfer_acc,c.name as receiver_name,c.account as receiver_acc,a.* from member_transfer_log as a left outer join member as b on a.transfer_id = b.id left outer join member as c on a.reciever_id = c.id left outer join transfer_money ON a.id = transfer_money.tm_id WHERE a.reciever_id = ".$reciever_id." ORDER BY `transfer_money`.`tm_status` ASC";
        // $sql = "select transfer_money.tm_status, b.name as transfer_name,b.account as transfer_acc,c.name as receiver_name,c.account as receiver_acc,a.* from member_transfer_log as a left outer join member as b on a.transfer_id = b.id left outer join member as c on a.reciever_id = c.id left outer join transfer_money ON a.id = transfer_money.tm_id WHERE a.reciever_id = " . $reciever_id ." AND transfer_money.tm_status> 1 AND a.tr_recive >= 1 OR a.transfer_id =". $reciever_id . "  ORDER BY `transfer_money`.`tm_status` ASC";
        $sql = "SELECT transfer_money.tm_status, b.name AS transfer_name, b.account AS transfer_acc, c.name AS receiver_name, c.account AS receiver_acc, a. * 
FROM member_transfer_log AS a
LEFT OUTER JOIN member AS b ON a.transfer_id = b.id
LEFT OUTER JOIN member AS c ON a.reciever_id = c.id
LEFT OUTER JOIN transfer_money ON a.id = transfer_money.tm_id
WHERE transfer_money.tm_status >1
AND a.tr_recive >=1
OR a.transfer_id =" . $reciever_id . "
OR a.reciever_id =" . $reciever_id . "
ORDER BY  `transfer_money`.`tm_status` ASC 
LIMIT 0 , 30";
        $result = $this->_db->query($sql);

        // var_dump($result);
        // die;
        return $result;
    }

    public function gerTransferData($user_id) {

        $today = Carbon::today()->toDateTimeString();
        $torommow = Carbon::now()->endOfDay()->toDateTimeString();

        $sql = "select COUNT(*) as cnt ,SUM(receive_point) as total from member_transfer_log 
        where transfer_id=$user_id  and create_at between '$today' and '$torommow' AND tr_recive = 1";

        $result = $this->_db->single($sql);

        $sql = 'select * from game_tax where game_id = 1 ';

        $result2 = $this->_db->single($sql);

        $day_limit = $result2['daylimit'];
        $tax = $result2['tax'];
        $user_transfer_count = $result['cnt'];
        $user_transfer_total = $result['total'];
        $mapData = [];
        $mapData['daylimit'] = $day_limit;
        $mapData['daycount'] = $result2['daycount'];
        $mapData['tax_percent'] = $tax;
        $mapData['transfer_total'] = $user_transfer_total;
        $mapData['transfer_count'] = $user_transfer_count;
        return $mapData;
    }

    public function getTransferRecord($user_id) {

        //  var_dump($user_id);
        //    die;
        // $sql = "select transfer_money.tm_status, b.name as transfer_name,b.account as transfer_acc,c.name as receiver_name,c.account as receiver_acc,a.* from member_transfer_log as a left outer join member as b on a.transfer_id = b.id left outer join member as c on a.reciever_id = c.id left outer join transfer_money ON a.id = transfer_money.tm_id WHERE a.reciever_id = " . $user_id . " AND transfer_money.tm_status> 1 AND a.tr_recive >= 1 OR a.transfer_id =" . $user_id . "  ORDER BY `transfer_money`.`tm_status` ASC";

        $sql = "SELECT transfer_money.tm_status, b.name AS transfer_name, b.account AS transfer_acc, c.name AS receiver_name, c.account AS receiver_acc, a. * 
FROM member_transfer_log AS a
LEFT OUTER JOIN member AS b ON a.transfer_id = b.id
LEFT OUTER JOIN member AS c ON a.reciever_id = c.id
LEFT OUTER JOIN transfer_money ON a.id = transfer_money.tm_id
WHERE transfer_money.tm_status >1
AND a.tr_recive >=1
OR a.transfer_id =" . $user_id . "
OR a.reciever_id =" . $user_id . "
ORDER BY  `transfer_money`.`tm_status` ASC 
LIMIT 0 , 30";

        $result = $this->_db->query($sql);


        //   var_dump($result);
        // die;

        return $result;
    }

    public function getjcord($user_id) {
        $sql = "SELECT a.* , b.name , c.name as card_type FROM card_deposit AS a LEFT JOIN member AS b ON a.member_id = b.id LEFT JOIN card_deposit_type AS c ON a.type = c.id Where a.member_id = " . $user_id . " AND a.type = 3";
        $result = $this->_db->query($sql);
        return $result;
    }

    public function get_package() {
        $sql = "SELECT * FROM  `pay2go_items` WHERE  `pay_del` !=1 ORDER BY  `pay2go_items`.`id` ASC ";
        $result = $this->_db->query($sql);
        return $result;
    }

    public function getstatus($user_id) {

        $sql = "SELECT * FROM `transfer_money` WHERE `tm_smlid` = " . $user_id . " ORDER BY `transfer_money`.`tm_date` DESC";

        $result = $this->_db->query($sql);
        return $result;
    }

    public function transferPoint() {
        $user = $this->getUser();

        //   var_dump($user);
        //   die;

        if (!$user) {
            $this->alert('使用者不存在');
        }
        $reciever = $this->getAccount($_POST['account']);
        if (!$reciever) {
            $this->alert('此帳號不存在');
        } else {
            $transferpoint = $_POST['point'];
            $fee = $this->getFee($transferpoint); //去後台撈
            if ($user['point'] - $fee < $transferpoint) {
                return $this->alert('點數不足');
            } else {
                $limit_arr = $this->getTransferDayLimit($user['id']); //檢查當日紀錄
                $limit = $limit_arr['cnt'];
                $limitTotal = $limit_arr['total'];
                if ($limit >= 5 || (($limitTotal + $transferpoint ) > 2000000)) {
                    return $this->alert('已達今日上限');
                } else {
                    $this->transferReal($user, $reciever, $transferpoint, $fee);
                    $this->submit_phone($user['phone'], $user['id'], $reciever['id']);
                    $this->transferRecord($user, $reciever, $transferpoint, $fee);
                }
            }
        }
//        $adb = new AdminDB();
//        $fee =5;
        //   $this->transferReal($user, $reciever, $transferpoint, $fee);
    }

    public function submit_phone($user_phone, $user_id, $reciever_id) {

        //  if (isset($_POST['phone'])) {
        // var_dump($reciever_phone);

        $code = substr(md5(uniqid(rand(), true)), 0, 5);
        $transferpoint = $_POST['point'];
        //請輸入以下註冊畫面代碼，若你未申請請忽略此封簡訊
        $text = "game money 遊戲網站簡訊認證。代碼：" . $code;
        $value = iconv("utf-8", "big5", $text); //轉換編碼
        $value = urlencode($value);
        // $phone = $_POST['phone'];
        $phone = $user_phone;
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
//        $sql = 'select * from transfer_money where  create_date > \'' . $new_date . '\' and phone= @phone ';
//        $arrInput = array();
//        
//        $this->_db->Insert('transfer_money', $arrInput);
        $sql = 'select * from transfer_money where  tm_date > \'' . $new_date . '\' AND tm_smlid =' . $user_id;

        $smsCheck = $this->_db->single_check($sql, array('phone' => $phone));
        //if ($smsCheck != false) {
        //  return $this->alert('30秒內不得重複發送');
        // }

        $dastime = date('Y-m-d h:i:s');
        $dastime = strtotime($dastime);

        //執行送出簡訊
        $result = $this->httpGet($url);
        //存進DB
        $arrInput = array();
        $arrInput['tm_msg_1'] = $code;
        $arrInput['tm_smlid'] = $user_id;
        $arrInput['tm_gmlid'] = $reciever_id;
        $arrInput['tm_amount'] = $transferpoint;
        $arrInput['tm_status'] = 1;
        $arrInput['tm_ctime'] = $dastime;
        $arrInput['tm_date'] = date('Y-m-d h:i:s');
        $this->_db->Insert('transfer_money', $arrInput);
        return $this->redirect('point_receive.php', '請填寫驗證碼');
        //return $this->alert('簡訊已發送');
    }

    public function getFee($point) {
        $sql = 'select tax from game_tax where game_id = 1';
        $fee = $this->_db->single($sql);
        return (int) ($point * ($fee['tax'] / 100));
    }

    public function getTransferDayLimit($transfer_id) {
        $today = Carbon::today()->toDateTimeString();
        $torommow = Carbon::now()->endOfDay()->toDateTimeString();

        $sql = "select COUNT(*) as cnt ,SUM(receive_point) as total from member_transfer_log 
        where transfer_id=$transfer_id  and create_at between '$today' and '$torommow' and tr_recive = 1";
        $result = $this->_db->single($sql);
        return $result;
    }

    public function transferReal($user, $reciever, $transferpoint, $fee) {
        $reduce = $transferpoint + $fee;
        $user_id = $user['id'];
        $reciever_id = $reciever['id'];
        $sql = "update member set point = point - $reduce where id=$user_id and point > 0";
        $trigger = $this->_db->execSql($sql);
        if (!$trigger) {
            $this->alert('扣除點數失敗');
        }
    }

    public function transferRecord($user, $reciever, $transferpoint, $fee) {
        $mapData = [];
        $mapData['transfer_id'] = $user['id'];
        $mapData['reciever_id'] = $reciever['id'];
        $mapData['fee'] = $fee;
        $mapData['receive_point'] = $transferpoint;
        $mapData['reduce_point'] = $transferpoint + $fee;
        $mapData['create_at'] = date('Y-m-d H:i:s');
        $mapData['tr_recive'] = 1;

        $trigger = $this->_db->Insert('member_transfer_log', $mapData);

        if (!$trigger) {
            $this->alert('轉移紀錄失敗');
        }
    }

    public function getUser() {
        if (isset($_SESSION['fuser_account'])) {
            $account = $_SESSION['fuser_account'];
            $sql = 'select * from member where account = \'' . $account . '\'';
            $member = $this->_db->single($sql);
            return $member;
        }

        return false;
    }

    public function getAccount($account) {

        $sql = 'select * from member where account = \'' . $account . '\'';
        $member = $this->_db->single($sql);
        return $member;
    }

}

$aa = new func_point();
$aa->page_load();
?>
