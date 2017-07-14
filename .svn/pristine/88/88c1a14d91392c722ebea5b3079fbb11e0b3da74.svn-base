<?php

//var_dump($button);
include_once("lib/config.php");
include_once("lib/WebDB.php");
include_once("lib/basePage.php");

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//var_dump(12312312);
class check_button extends basePage {

    public function set_check() {
        $button = $_POST['button'];
        $id = $_POST['id'];
        // var_dump($user, 12312312);
        //       var_dump(222222);
        if ($button == "接受") {
            $this->save_point($id);
        }

        //var_dump($button);
        if ($button == "拒絕") {
            //var_dump($id);
            $this->return_pint($id);
            $sql = "UPDATE `transfer_money` SET `tm_status` = 0  WHERE `transfer_money`.`tm_id` = " . $id;
            $sql = $this->_db->execSql($sql);

            $sql = "UPDATE `member_transfer_log` SET `tr_recive` = 0  WHERE `member_transfer_log`.`id` = " . $id;
            $sql = $this->_db->execSql($sql);
            if ($sql) {
                $sql = "SELECT * FROM `transfer_money` WHERE  `transfer_money`.`tm_id` =" . $id;
                $checK_en = $this->_db->single($sql);
                $this->add_point($checK_en['tm_amount'], $checK_en['tm_smlid']);
                return $this->alert('交易已取消');
            }
        }
    }

    public function add_point($tm_amount, $tm_smlid) {
        $sql = "SELECT * FROM `member` WHERE  id =" . $tm_smlid;
        $checK_en = $this->_db->single($sql);

        $tm_amount += $checK_en['point'];

        $sql = "UPDATE `member` SET `point` = '" . $tm_amount . "' WHERE `member`.`id` = " . $tm_smlid;
        $sql = $this->_db->execSql($sql);
    }

    public function return_pint($id) {

        $sql = "SELECT * FROM `transfer_money` WHERE  tm_id =" . $id;
        $checK_en = $this->_db->single($sql);

        $sql = "SELECT * FROM `transfer_money` WHERE  tm_id =" . $id;
        $checK_en = $this->_db->single($sql);
    }

    public function save_point($id) {
        $ss = $id;
        $sql = "SELECT * FROM `transfer_money` WHERE  tm_id =" . $id;
        $checK_en = $this->_db->single($sql);
        $sql = "SELECT * FROM `member` WHERE  id =" . $checK_en['tm_smlid'];
        $checK_en = $this->_db->single($sql);
        $code = substr(md5(uniqid(rand(), true)), 0, 5);
        //請輸入以下註冊畫面代碼，若你未申請請忽略此封簡訊
        $text = "game money 遊戲網站簡訊認證。代碼：" . $code;
        $value = iconv("utf-8", "big5", $text); //轉換編碼
        $value = urlencode($value);
        // $phone = $_POST['phone'];
        $phone = $checK_en['phone'];
        //  var_dump($phone);
        $pass = 'grace623';
        $acc = 'graceanna';
        $url = 'https://api.kotsms.com.tw/kotsmsapi-1.php';
        $url .= '?username=' . $acc . '&password=' . $pass . '&dstaddr=' . $phone . '&%20smbody=' . $value;  //'&response=http://gamemoney.sammicorner.com/receiveMsg.php"';
        //var_dump($url);
        //檢查此電話，是不是30秒內已送過
        $today = date('Y-m-d h:i:s');
        $new_date = date('Y-m-d h:i:s', strtotime('-30 seconds', strtotime($today)));
        $result = $this->httpGet($url);

        //存進DB
        $type = $checK_en['tm_status'];
        $time = date('Y-m-d h:i:s');
        $sql = "UPDATE `transfer_money` SET `tm_status` = 3 , `tm_msg_2` = '" . $code . "'  WHERE `transfer_money`.`tm_id` = " . $ss;
        $sql = $this->_db->execSql($sql);
        return $this->alert('轉帳簡訊已送出');
    }

}

$aa = new check_button();
$aa->set_check();
