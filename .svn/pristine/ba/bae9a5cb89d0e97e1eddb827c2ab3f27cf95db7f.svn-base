<?php
session_start();
date_default_timezone_set("Asia/Taipei");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once("lib/config.php");
include_once("lib/pay2go_inc.php");
include_once("lib/WebDB.php");
include_once("lib/basePage.php");

$viewData = array();

class func_card_deposit extends basePage
{

    public function page_load()
    {
        //是否登入
        //$this->isLogin();

        //get 上有要特別處理的參數
        if (isset($_GET['m'])) {
            switch ($_GET['m']) {
                case    'deposit':
                    $this->deposit();
                    break;
            }
        }

        //6AN7kfNAuaAeav5M4fER
        //RTveNaFtNcMRW36H5N2M

        //YkhAJ3fcW6t2TFuAMcJA
        //3hWHeehF34Hhheh3ZEfR


        global $viewData;
        $viewData['pay2goinit'] = isset($pay2goinit) ? $pay2goinit : '';
    }

    public function deposit()
    {
        $carno = $_POST['carno'];
        $cardpass = $_POST['cardpass'];

        //用帳號找出會員
        $sql = 'select * from member where account = @account ';
        $member = $this->_db->single_check($sql, array('account' => $_SESSION["fuser_account"]));
        if (!$member)
            $this->alert('無此帳號,請聯絡管理員,卡號未消費');

        //寫入一筆儲值記錄
        $mapData = array();
        $mapData['member_id'] = $member['id'];
        $mapData['type'] = 1;
        $mapData['serial_number'] = $carno;
        $mapData['card_password'] = $cardpass;
        $mapData['points'] = 0;
        $mapData['status'] = 0;
        $mapData['create_date'] = date('Y-m-d H:i:s');
        $OrderID = $this->_db->Insert('card_deposit', $mapData);

        //要送給串接資料
        $ServiceCode = 'JID00171';
        $key = 'aabgguu12311jj';
        $SignCode = md5($OrderID . $key . $ServiceCode);

        $arrData = array();
        $arrData['do'] = 'order';
        $arrData['OrderID'] = $OrderID;
        $arrData['ServiceCode'] = $ServiceCode;
        $arrData['SignCode'] = $SignCode;
        $arrData['UserID'] = $member['id'];
        $arrData['Memo'] = '';
        $arrData['carno'] = $carno;
        $arrData['cardpass'] = $cardpass;

        //回覆
        $response = json_decode($this->httpPost('http://60.199.176.121/JCardAPI/japi.aspx', $arrData), 1);


        $arrDD = array();
        $arrDD['msg'] = $response['msg'];
        $arrDD['update_date'] = date('Y-m-d H:i:s');
        if ($response['prc'] == 1)    //交易成功
        {
            $arrDD['transactionid'] = $response['transactionid'];
            $arrDD['points'] = $response['points'];
            $arrDD['status'] = 1;
            $this->_db->Update('card_deposit', array('id' => $response['orderid']), $arrDD);

            //更新回使用者資料
            $arrMem = array();
            $arrMem['point'] = $member['point'] + $response['points'];
            $this->_db->Update('member', array('id' => $member['id']), $arrMem);

//            $logArr = [];
//            $logArr['member_id'] = $mapData['member_id'];
            $this->log_deposit($mapData['member_id'], $response['points']);
            $this->alert('儲值成功！');
        } else {
            $this->_db->Update('card_deposit', array('id' => $response['orderid']), $arrDD);
            $this->alert('儲值失敗，' . $arrDD['msg'] . '！');
        }

    }

    function log_deposit($member_id, $deposit)
    {
        $mapData = [];
        //找出之前紀錄
        $sql = 'select * from card_deposit_sum where member_id = @member_id ';
        $record = $this->_db->single_check($sql, array('member_id' => $member_id));
        if ($record) {
            $original = $record['deposit_sum'];
            $mapData['deposit_sum'] = $original + $deposit;
            $mapData['update_date'] = date("Y-m-d H:i:s");
            $this->_db->Update('card_deposit_sum', array('member_id' => $member_id), $mapData);;
        } else {
            $mapData['member_id'] = $member_id;
            $mapData['deposit_sum'] = $deposit;
            $mapData['create_date'] = date("Y-m-d H:i:s");
            $mapData['update_date'] = date("Y-m-d H:i:s");
            $this->_db->Insert('card_deposit_sum', $mapData);
        }
        return true;


    }


}

$aa = new func_card_deposit();
$aa->page_load();


?>