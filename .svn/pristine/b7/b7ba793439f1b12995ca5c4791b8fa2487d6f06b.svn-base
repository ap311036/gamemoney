<?php
session_start();
date_default_timezone_set("Asia/Taipei");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once("lib/config.php");
include_once("lib/WebDB.php");
include_once("lib/basePage.php");

$viewData = array();

class func_forgetpassword extends basePage
{

    public function page_load()
    {
        //是否登入
        //$this->isLogin();

        //get 上有要特別處理的參數
        if (isset($_GET['m'])) {
            switch ($_GET['m']) {
                case    'send':
                    $this->sendPass();
                    break;
            }
        }
        global $viewData;
    }

    public function sendPass()
    {
        $arrData = array();
        $account = $_POST['account'];
        $sendType = $_POST['sendType'];

        $sql = 'select * from member where account = @account ';
        $member = $this->_db->single_check($sql, array('account' => $account));

        //var_dump($member);

        if ($member == false) {
            $this->alert('找不到帳號！');
            return;
        }

        if ($member['phone'] == null) {
            $this->alert('找不到使用者電話！');
            return;
        }

        if ($sendType == 'sms') {
            $pass = $this->randPassword(6);
            $pass_hash = md5($this->encrypt($pass));
            $arrMem = [];
            $arrMem['password'] = $pass_hash;
            $this->_db->Update('member', array('id' => $member['id']), $arrMem);


            $text = "game money 遊戲網站 忘記密碼申請補送。已將您的密碼改為：" . $pass . ",請儘速更換";
            $value = iconv("utf-8", "big5", $text); //轉換編碼
            $value = urlencode($value);
            $phone = $member['phone'];
            $pass = 'grace623';
            $acc = 'graceanna';
            $url = 'https://api.kotsms.com.tw/kotsmsapi-1.php';
            $url .= '?username=' . $acc . '&password=' . $pass . '&dstaddr=' . $phone . '&%20smbody=' . $value . '&response=http://gamemoney.sammicorner.com/receiveMsg.php"';

            //檢查此電話，是不是30秒內已送過
            $today = date('Y-m-d h:i:s');
            $new_date = date('Y-m-d h:i:s', strtotime('-30 seconds', strtotime($today)));

            $sql = 'select * from register_sms where  create_date > \'' . $new_date . '\' and phone= @phone ';

            $smsCheck = $this->_db->single_check($sql, array('phone' => $phone));
            if ($smsCheck != false) {
                //return $this->jsonView('30秒內只能傳一封簡訊認證');
                $this->alert('30秒內只能傳一封簡訊認證');
                return false;
            }
            //執行送出簡訊
            $ch = curl_init();
            //CURLOPT_RETURNTRANSFER= false;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $result = @curl_exec($ch);
            curl_close($ch);

            //存進DB
            $arrInput = array();
            $arrInput['content'] = $text;
            $arrInput['phone'] = $phone;
            $arrInput['return_code'] = $result;
            $arrInput['status'] = 0;
            $arrInput['create_date'] = date('Y-m-d h:i:s');

            $this->_db->Insert('register_sms', $arrInput);
        } else {
            //mail server

        }

        $this->alert('密碼已送出');
        return;
    }

}

$aa = new func_forgetpassword();
$aa->page_load();


?>