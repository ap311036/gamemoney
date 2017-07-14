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


class func_pay2go extends basePage
{

    function log_file($msg, $file = false)
    {
//    if(empty($t))
        $t = time();
        if (!$file)
            $file = "testlog/pay.log";
        $file_path = Pay2goLOG_PATH;

        $f_handle = fopen($file_path . "/" . $file, "a");

        if (!$f_handle) return false;

        $msg = date("Y-m-d H:i:s", $t) . " -- $msg\n";
        fwrite($f_handle, $msg);
        fclose($f_handle);

        return true;
    }


    public function page_load()
    {
        //是否登入
        //$this->isLogin();

        //get 上有要特別處理的參數
        if (isset($_GET['m'])) {
            switch ($_GET['m']) {
                case    'pay2goinit':
                    $pay2goinit = $this->pay2goInit($_GET['item_id']);
                    break;
                case    'pay2backend':
                    $pay2goinit = $this->pay2goBackend();
                    break;
//                case    'custom':
//                    $pay2goinit = $this->customUrl();
//                    break;
            }
        }


        global $viewData;
        $viewData['pay2goinit'] = isset($pay2goinit) ? $pay2goinit : '';
        if (empty($viewData['pay2goinit']))
            $this->alert('無此商品！');
    }

//    public function customUrl()
//    {
//
//        $paytype = [
//            'CREDIT' => 'realTimeDeal',
//            'WEBATM' => 'realTimeDeal',
//            'VACC' => 'nonRealTimeDeal',
//            'CVS' => 'nonRealTimeDeal',
//            'BARCODE' => 'nonRealTimeDeal',
//        ];
//
////string(485) "{\"Status\":\"SUCCESS\",\"Message\":\"\\u4ee3\\u78bc\\u53d6\\u865f\\u6210\\u529f\",\"Result\":\"{\\\"MerchantID\\\":\\\"MS311674042\\\",\\\"Amt\\\":\\\"50\\\",\\\"TradeNo\\\":\\\"17030717042393790\\\",\\\"MerchantOrderNo\\\":\\\"58be778b86883\\\",\\\"CheckCode\\\":\\\"546868CCB965C3FBD52C0DCEE8F56B621DA06051F27698722D7E42CF32AB90C2\\\",\\\"PaymentType\\\":\\\"CVS\\\",\\\"ExpireDate\\\":\\\"2017-03-10\\\",\\\"ExpireTime\\\":\\\"11:04:11\\\",\\\"CodeNo\\\":\\\"CVS70307073855\\\"}\"}"
////        $_POST['JSONData'] = file_get_contents("pay2gojson.json", false);
//        $invalid = [
//            "\r" => '',
//            '\t' => ' ',
//            '\"' => '"',
//            '＼' => '\\',
//        ];
//        $JSONData = str_replace(array_keys($invalid), array_values($invalid), $_POST['JSONData']);
//        $JSONData = str_replace(array_keys($invalid), array_values($invalid), $JSONData);
//        echo($JSONData);
////        str_replace("\\",'\'',$_POST['JSONData']);
//
//        $JSONData = json_decode($JSONData);
//        var_dump($JSONData);
//        $Status = $JSONData->Status;
//        $Message = $JSONData->Message;
//        $Result = json_decode($JSONData->Result, true);
//        var_dump($JSONData);
//        var_dump($Result);
////        var_dump($_POST);
////        $x = json_encode($_POST);
////        var_dump($x);
////        var_dump(json_decode(json_decode($x)->JSONData));
//        global $pay2go_setting;
//
//        $HashKey = $pay2go_setting['HashKey'];
//        $HashIV = $pay2go_setting['HashIV'];
//
//        $MerchantID = $Result['MerchantID'];
//        $Amt = $Result['Amt'];
//        $MerchantOrderNo = $Result['MerchantOrderNo'];
//        $TradeNo = $Result['TradeNo'];
//        $PaymentType = $Result['PaymentType'];
//
//
////        $sql_pay2go = "select * from pay2go_items where id = $item_id ";
////        $item = $this->_db->single_check($sql_pay2go,[]);
//
//
//        $check_code = array(
//            "MerchantID" => $MerchantID,
//            "Amt" => $Amt,
//            "MerchantOrderNo" => $MerchantOrderNo,
//            "TradeNo" => $TradeNo,
//        );
//        ksort($check_code);
//        $check_str = http_build_query($check_code);
//        $CheckCodeFromPay2Go = "HashIV=$HashKey&$check_str&HashKey=$HashIV";
//        $CheckCodeFromPay2Go = strtoupper(hash("sha256", $CheckCodeFromPay2Go));
//
//        $sql_pay2go = "select * from pay2go_init where MerchantOrderNo = @MerchantOrderNo ";
//        $pay2go = $this->_db->single_check($sql_pay2go, ['MerchantOrderNo' => $MerchantOrderNo]);
//        if (!$pay2go)
//            $this->jsonView("沒有此筆交易資訊！");
//
//        $CheckCodeFromDB = $this->getCheckCodeFromDB($pay2go, $TradeNo);
//        if ($CheckCodeFromDB !== $CheckCodeFromPay2Go)
//            $this->jsonView("驗證失敗！");
//        $mapData = array();
//
//        $this->nonRealTimeDeal($Result, $Status, $Message, $pay2go, $CheckCodeFromPay2Go);
////        call_user_func_array([$this, $paytype[$PaymentType]], [$Result, $Status, $Message, $pay2go, $CheckCodeFromPay2Go]);
//
//
//        $html = "<div class=\"row\">
//                            <div class=\"col-sm-12\">
//                                            <div class=\"alert alert-success nomal_text\" style=\"font-size: 30px;margin-top: 20px;display: block;width: 100%;text-align: center \">
//                            <span style=\"font-size: \">
//                                超商繳費代碼 ：                             </span>
//                            <span style=\"font-size: \">
//                                CVS70307071326                            </span>
//                                            </div>
//                </div>
//                                    <div class=\"col-md-5\">
//                <div class=\"nomal_title \" style=\"margin-top: 20px;display: block \">
//                    付款資訊                </div>
//                <div class=\"oge_line\" style=\"width: 100%; margin-bottom: 10px\"></div>
//                <div class=\"pay_data\" style=\"margin-bottom: 10px\">
//                    <table cellpadding=\"0\" cellspacing=\"0\" class=\"paycard2 \" width=\"100%\" style=\"float: left\">
//                                                                            <tbody><tr>
//                                <td class=\"order_td_name\">
//                                    超商繳費代碼                                </td>
//                                <td class=\"order_td_content\">
//
//                                    CVS70307071326                                </td>
//                            </tr>
//                                                                                                                            <tr>
//                                <td class=\"order_td_name\">訂單金額</td>
//                                <td class=\"order_td_content\">NT$50</td>
//                            </tr>
//
//                                                    <tr>
//                                <td class=\"order_td_name\">實際付款金額</td>
//                                <td class=\"order_td_content\">NT$50</td>
//                            </tr>
//
//
//                                                    <tr>
//                                <td class=\"order_td_name\">交易結果訊息</td>
//                                <td class=\"order_td_content\">
//                                    訂單成立, 代碼取號成功 (Success)                                </td>
//                            </tr>
//
//
//
//
//                                                    <tr style=\"color:red\">
//                                <td class=\"order_td_name\">有效繳費時間</td>
//                                <td class=\"order_td_content\">2017-03-10 10:40:34</td>
//                            </tr>
//
//                    </tbody></table>
//                </div>
//
//
//
//            </div>
//            <div class=\"col-xs-12 col-md-6\">
//
//                    <div class=\"nomal_title \" style=\"margin-top: 20px;display:inline-block \">商店資訊                        <span class=\" glyphicon glyphicon-plus switch_shop\" id=\"open_order_data\"></span>
//                        <span class=\" glyphicon glyphicon-minus switch_shop\" id=\"close_order_data\"></span>
//                    </div>
//                    <div class=\"oge_line\" style=\"width: 100%;margin-bottom: 10px\"></div>
//
//                                            <div class=\" order_data\">  <!--小螢幕則縮小-->
//                            <table cellpadding=\"0\" cellspacing=\"0\" class=\"paycard2 \" width=\"100%\" style=\"float: left;　\">
//                                                                    <tbody><tr>
//                                        <td class=\"order_td_name\">商店名稱</td>
//                                        <td class=\"order_td_content\">大聯盟娛樂城(MS311674042)</td>
//                                    </tr>
//                                                                                                    <tr>
//                                        <td class=\"order_td_name\">商品名稱</td>
//                                        <td class=\"order_td_content\">這是500點哦</td>
//                                    </tr>
//                                                                <tr>
//                                    <td class=\"order_td_name\">商店訂單編號</td>
//                                    <td class=\"order_td_content\">58be7202db381</td>
//                                </tr>
//                                <tr>
//                                    <td class=\"order_td_name\">智付通交易序號</td>
//                                    <td class=\"order_td_content\">17030716405685476</td>
//                                </tr>
//                            </tbody></table>
//                            <div class=\" clearfix\"></div>
//                        </div>
//
//
//
//                            </div>
//            <!--教學資訊-->
//            <div class=\"col-xs-12\">
//                <div class=\"nomal_text\" style=\" width: 100%;margin-top: 10px\">
//                    <ul class=\"disc\" style=\"margin-left: 25px;line-height: 35px;font-size: 15px\">
//                        <li>請記錄您的付款資訊，並於繳費期限內完成支付，逾繳費時間該繳費代碼將失效。</li><li>您可至全台全家、OK超商店內之多媒體機台(FamiPort、OK-go)上列印繳費單至超商櫃台以現金繳費。</li><li>四大超商繳費<a href=\"https://www.spgateway.com/info/site_description/payment_teach\" target=\"_blank\">操作流程說明</a>：<a href=\"https://www.spgateway.com/info/site_description/family_embedded\" target=\"_blank\"><img src=\"https://core.spgateway.com/images/main_icon/s2kiosk.png\" title=\"全家\" style=\"vertical-align: sub;width: 30px;\"></a>&nbsp;<a href=\"https://www.spgateway.com/info/site_description/okshop_embedded\" target=\"_blank\"><img src=\"https://core.spgateway.com/images/main_icon/s4kiosk.png\" title=\"OK超商\" style=\"vertical-align:sub;width:30px;\"></a></li>
//                    </ul>
//                </div>
//            </div>
//
//        </div>";
//
//    }

    public function pay2goInit($item_id)
    {

        global $pay2go_setting;
        //用帳號找出會員
        $sql = 'select * from member where account = @account ';
        $member = $this->_db->single_check($sql, array('account' => $_SESSION["fuser_account"]));


        if (!$member) {
            $this->alert('無此帳號,請聯絡管理員');
            die;
        }
        if (!is_numeric(($item_id)))
            $this->alert('無此商品！');

        $sql_pay2go = "select * from pay2go_items where id = $item_id ";
        $item = $this->_db->single_check($sql_pay2go, []);
        if (!$item)
            $this->alert('無此商品！');


        //order init
        $MerchantOrderNo = uniqid();
        $timestamp = time();
        $HashKey = $pay2go_setting['HashKey'];
        $HashIV = $pay2go_setting['HashIV'];

        /**
         * 將回傳資料其中的四個欄位，分別是 Amt(金額)、MerchantID(商店代號)、
         * MerchantOrderNo(商店訂單編號)、TradeNo(智付寶交易序號)，且參數需照英文字
         * 母 A~Z 排序，若第一字母相同比較第二字母，以此類推。
         *
         */        
        $mer_array = array(
            'MerchantID' => $pay2go_setting['MerchantID'],
            'TimeStamp' => $timestamp,
            'MerchantOrderNo' => $MerchantOrderNo,
            'Version' => $pay2go_setting['Version'],
            'Amt' => $item['Amt'],
        );
        ksort($mer_array);
        $check_merstr = http_build_query($mer_array);
        $CheckValue_str =
            "HashKey=$HashKey&$check_merstr&HashIV=$HashIV";
        $CheckValue = strtoupper(hash("sha256", $CheckValue_str));


        $mapData = array();
        $mapData['member_account'] = $_SESSION["fuser_account"];
        $mapData['member_email'] = $member["email"];
        $mapData['MerchantID'] = $pay2go_setting['MerchantID'];
        $mapData['TimeStamp'] = $timestamp;
        $mapData['MerchantOrderNo'] = $MerchantOrderNo;
        $mapData['Version'] = $pay2go_setting['Version'];
        $mapData['Amt'] = $item['Amt'];
        $mapData['CheckValue'] = $CheckValue;
        $mapData['ItemDesc'] = $item['ItemDesc'];
        $mapData['OrderComment'] = $item['OrderComment'];
        $mapData['points'] = $item['points'];

        $init_result = json_encode($mapData);
        $mapData['init_result_json'] = $init_result;
        $this->_db->Insert('pay2go_init', $mapData);


        $result = $mapData;
        return $result;

//
//        //要送給串接資料
//        $ServiceCode = 'JID00171';
//        $key = 'aabgguu12311jj';
//        $SignCode = md5($OrderID . $key . $ServiceCode);
//
//        $arrData = array();
//        $arrData['do'] = 'order';
//        $arrData['OrderID'] = $OrderID;
//        $arrData['ServiceCode'] = $ServiceCode;
//        $arrData['SignCode'] = $SignCode;
//        $arrData['UserID'] = $member['id'];
//        $arrData['Memo'] = '';
//        $arrData['carno'] = $carno;
//        $arrData['cardpass'] = $cardpass;
//
//        //回覆
//        $response = json_decode($this->httpPost('http://60.199.176.121/JCardAPI/japi.aspx', $arrData), 1);
//
//
//        $arrDD = array();
//        $arrDD['msg'] = $response['msg'];
//        $arrDD['update_date'] = date('Y-m-d H:i:s');
//        if ($response['prc'] == 1)    //交易成功
//        {
//            $arrDD['transactionid'] = $response['transactionid'];
//            $arrDD['points'] = $response['points'];
//            $arrDD['status'] = 1;
//            $this->_db->Update('card_deposit', array('id' => $response['orderid']), $arrDD);
//
//            //更新回使用者資料
//            $arrMem = array();
//            $arrMem['point'] = $member['point'] + $response['points'];
//            $this->_db->Update('member', array('id' => $member['id']), $arrMem);
//
////            $logArr = [];
////            $logArr['member_id'] = $mapData['member_id'];
//            $this->log_deposit($mapData['member_id'], $response['points']);
//            $this->alert('儲值成功！');
//        } else {
//            $this->_db->Update('card_deposit', array('id' => $response['orderid']), $arrDD);
//            $this->alert('儲值失敗，' . $arrDD['msg'] . '！');
//        }

    }


    public function testpay2goInit($item_id)
    {

        global $pay2go_setting;


        //order init
        $MerchantOrderNo = "58bcda88cf585";
//        $MerchantOrderNo = uniqid();
//        var_dump(uniqid());
        $timestamp = "1488771720";
        $HashKey = $pay2go_setting['HashKey'];
        $HashIV = $pay2go_setting['HashIV'];

        /**
         * 將回傳資料其中的四個欄位，分別是 Amt(金額)、MerchantID(商店代號)、
         * MerchantOrderNo(商店訂單編號)、TradeNo(智付寶交易序號)，且參數需照英文字
         * 母 A~Z 排序，若第一字母相同比較第二字母，以此類推。
         *
         */

        $mer_array = array(
            'MerchantID' => $pay2go_setting['MerchantID'],
            'TimeStamp' => $timestamp,
            'MerchantOrderNo' => $MerchantOrderNo,
            'Version' => $pay2go_setting['Version'],
            'Amt' => 50,
        );
        ksort($mer_array);
        $check_merstr = http_build_query($mer_array);
        $CheckValue_str =
            "HashKey=$HashKey&$check_merstr&HashIV=$HashIV";
    //    var_dump($CheckValue_str);
        $CheckValue = strtoupper(hash("sha256", $CheckValue_str));
      //  var_dump($CheckValue);

//4CC6F8B8F4F4CB810F4AD3C3275359F32C7E41BAB50AB222E540082FDE568917
        die;

        $mapData = array();
        $mapData['member_account'] = $_SESSION["fuser_account"];
        $mapData['member_email'] = $member["email"];
        $mapData['MerchantID'] = $pay2go_setting['MerchantID'];
        $mapData['TimeStamp'] = $timestamp;
        $mapData['MerchantOrderNo'] = $MerchantOrderNo;
        $mapData['Version'] = $pay2go_setting['Version'];
        $mapData['Amt'] = $item['Amt'];
        $mapData['CheckValue'] = $CheckValue;
        $mapData['ItemDesc'] = $item['ItemDesc'];

        $init_result = json_encode($mapData);
        $mapData['init_result_json'] = $init_result;
        $InitID = $this->_db->Insert('pay2go_init', $mapData);

        $result = $mapData;
        return $result;

//
//        //要送給串接資料
//        $ServiceCode = 'JID00171';
//        $key = 'aabgguu12311jj';
//        $SignCode = md5($OrderID . $key . $ServiceCode);
//
//        $arrData = array();
//        $arrData['do'] = 'order';
//        $arrData['OrderID'] = $OrderID;
//        $arrData['ServiceCode'] = $ServiceCode;
//        $arrData['SignCode'] = $SignCode;
//        $arrData['UserID'] = $member['id'];
//        $arrData['Memo'] = '';
//        $arrData['carno'] = $carno;
//        $arrData['cardpass'] = $cardpass;
//
//        //回覆
//        $response = json_decode($this->httpPost('http://60.199.176.121/JCardAPI/japi.aspx', $arrData), 1);
//
//
//        $arrDD = array();
//        $arrDD['msg'] = $response['msg'];
//        $arrDD['update_date'] = date('Y-m-d H:i:s');
//        if ($response['prc'] == 1)    //交易成功
//        {
//            $arrDD['transactionid'] = $response['transactionid'];
//            $arrDD['points'] = $response['points'];
//            $arrDD['status'] = 1;
//            $this->_db->Update('card_deposit', array('id' => $response['orderid']), $arrDD);
//
//            //更新回使用者資料
//            $arrMem = array();
//            $arrMem['point'] = $member['point'] + $response['points'];
//            $this->_db->Update('member', array('id' => $member['id']), $arrMem);
//
////            $logArr = [];
////            $logArr['member_id'] = $mapData['member_id'];
//            $this->log_deposit($mapData['member_id'], $response['points']);
//            $this->alert('儲值成功！');
//        } else {
//            $this->_db->Update('card_deposit', array('id' => $response['orderid']), $arrDD);
//            $this->alert('儲值失敗，' . $arrDD['msg'] . '！');
//        }

    }

    public function pay2goBackend()
    {

        define('DEBUG_ENABLE', true);
        //HashKey=aqvIG0kGFNqMADyXBzRT7L5H54P2ZkX9&Amt=49&MerchantID=31220036&MerchantOrderNo=1488797888&TimeStamp=1488797888&Version=1.2&HashIV=KsRrtb78ZxVAbtxM
//test pay2go
//        $return = [];
//        $return['MerchantID'] = '316120815';
//        $return['Amt'] = '50';
//        $return['MerchantOrderNo'] = '58b9291fa036c';
//        $return['TradeNo'] = '14061313541640927';
//        $return['Status'] = 'SUCCESS';
//        $return['Message'] = 'Message Test';

//        $return ='{"Status":"SUCCESS","Message":"\u4fe1\u7528\u5361\u6388\u6b0a\u6210\u529f","Result":"{\"MerchantID\":\"316120815\",\"Amt\":50,\"TradeNo\":\"14073109503001857\",\"MerchantOrderNo\":\"58b9291fa036c\",\"RespondType\":\"JSON\",\"CheckCode\":\"C3E6ED72D3641558DA5F701DEFB01B4A9636F1D100F06BEC06027BF5D8873733\",\"PaymentType\":\"CREDIT\",\"RespondCode\":\"54\",\"Auth\":\"\",\"Card6No\":\"457958\",\"Card4No\":\"5509\",\"ECI\":\"\",\"PayTime\":\"2014-07-31 09:50:38\"}"}';

        $paytype = [
            'CREDIT' => 'realTimeDeal',
            'WEBATM' => 'realTimeDeal',
            'VACC' => 'nonRealTimeDeal',
            'CVS' => 'nonRealTimeDeal',
            'BARCODE' => 'nonRealTimeDeal',
        ];


//        $_POST['JSONData'] = file_get_contents("pay2gojson.json", false);

        $invalid = [
            "\r" => '',
            '\t' => ' ',
            '\"' => '"',
            '＼' => '\\',
        ];
        $JSONData = str_replace(array_keys($invalid), array_values($invalid), $_POST['JSONData']);
        $JSONData = str_replace(array_keys($invalid), array_values($invalid), $JSONData);
//        $this->log_file('$JSONData' . json_encode($JSONData));
        $JSONData = json_decode($JSONData);

        $Status = $JSONData->Status;
        $Message = $JSONData->Message;
        $Result = json_decode($JSONData->Result, true);
//        $this->log_file('$Result' . json_encode($Result));
//        var_dump($JSONData);
//        var_dump($_POST);
//        $x = json_encode($_POST);
//        var_dump($x);
//        var_dump(json_decode(json_decode($x)->JSONData));
        global $pay2go_setting;

        $HashKey = $pay2go_setting['HashKey'];
        $HashIV = $pay2go_setting['HashIV'];

        $MerchantID = $Result['MerchantID'];
        $Amt = $Result['Amt'];
        $MerchantOrderNo = $Result['MerchantOrderNo'];
        $TradeNo = $Result['TradeNo'];
        $PaymentType = $Result['PaymentType'];


//        $sql_pay2go = "select * from pay2go_items where id = $item_id ";
//        $item = $this->_db->single_check($sql_pay2go,[]);


        $check_code = array(
            "MerchantID" => $MerchantID,
            "Amt" => $Amt,
            "MerchantOrderNo" => $MerchantOrderNo,
            "TradeNo" => $TradeNo,
        );
        ksort($check_code);
        $check_str = http_build_query($check_code);
        $CheckCodeFromPay2Go = "HashIV=$HashKey&$check_str&HashKey=$HashIV";
        $CheckCodeFromPay2Go = strtoupper(hash("sha256", $CheckCodeFromPay2Go));
        $sql_pay2go = "select * from pay2go_init where MerchantOrderNo = @MerchantOrderNo ";
        $pay2go = $this->_db->single_check($sql_pay2go, ['MerchantOrderNo' => $MerchantOrderNo]);

        if (!$pay2go)
            $this->log_file("沒有此筆交易資訊！");

        $CheckCodeFromDB = $this->getCheckCodeFromDB($pay2go, $TradeNo);
        $this->log_file('$CheckCodeFromDB' . $CheckCodeFromDB);
        if ($CheckCodeFromDB !== $CheckCodeFromPay2Go)
            $this->log_file("$MerchantOrderNo 驗證失敗! :$CheckCodeFromPay2Go");
        $this->dealPay2go($Result, $Status, $Message, $pay2go, $CheckCodeFromPay2Go);
//        call_user_func_array([$this, $paytype[$PaymentType]],
//            [$Result, $Status, $Message, $pay2go, $CheckCodeFromPay2Go]);


//
//        //要送給串接資料
//        $ServiceCode = 'JID00171';
//        $key = 'aabgguu12311jj';
//        $SignCode = md5($OrderID . $key . $ServiceCode);
//
//        $arrData = array();
//        $arrData['do'] = 'order';
//        $arrData['OrderID'] = $OrderID;
//        $arrData['ServiceCode'] = $ServiceCode;
//        $arrData['SignCode'] = $SignCode;
//        $arrData['UserID'] = $member['id'];
//        $arrData['Memo'] = '';
//        $arrData['carno'] = $carno;
//        $arrData['cardpass'] = $cardpass;
//
//        //回覆
//        $response = json_decode($this->httpPost('http://60.199.176.121/JCardAPI/japi.aspx', $arrData), 1);
//
//
//        $arrDD = array();
//        $arrDD['msg'] = $response['msg'];
//        $arrDD['update_date'] = date('Y-m-d H:i:s');
//        if ($response['prc'] == 1)    //交易成功
//        {
//            $arrDD['transactionid'] = $response['transactionid'];
//            $arrDD['points'] = $response['points'];
//            $arrDD['status'] = 1;
//            $this->_db->Update('card_deposit', array('id' => $response['orderid']), $arrDD);
//
//            //更新回使用者資料
//            $arrMem = array();
//            $arrMem['point'] = $member['point'] + $response['points'];
//            $this->_db->Update('member', array('id' => $member['id']), $arrMem);
//
////            $logArr = [];
////            $logArr['member_id'] = $mapData['member_id'];
//            $this->log_deposit($mapData['member_id'], $response['points']);
//            $this->alert('儲值成功！');
//        } else {
//            $this->_db->Update('card_deposit', array('id' => $response['orderid']), $arrDD);
//            $this->alert('儲值失敗，' . $arrDD['msg'] . '！');
//        }

    }

    private function getCheckCodeFromDB($pay2go, $TradeNo)
    {

        global $pay2go_setting;

        $HashKey = $pay2go_setting['HashKey'];
        $HashIV = $pay2go_setting['HashIV'];


        $check_code = array(
            "MerchantID" => $pay2go['MerchantID'],
            "Amt" => $pay2go['Amt'],
            "MerchantOrderNo" => $pay2go['MerchantOrderNo'],
            "TradeNo" => $TradeNo,
        );
        ksort($check_code);
        $check_str = http_build_query($check_code);
        $CheckCodeFromDB = "HashIV=$HashKey&$check_str&HashKey=$HashIV";
        $CheckCodeFromDB = strtoupper(hash("sha256", $CheckCodeFromDB));

        return $CheckCodeFromDB;

    }

    private function dealPay2go($Result, $Status, $Message, $pay2go, $CheckCode)
    {

        /**
         *
         * VACC
         * ATM 轉帳
         * 非即時交易
         * CVS
         * 超商代碼繳費
         * 非即時交易
         * BARCODE
         * 條碼繳費
         *
         * 非即時交易
         */


        $MerchantID = $Result['MerchantID'];
        $Amt = $Result['Amt'];
        $MerchantOrderNo = $Result['MerchantOrderNo'];
        $TradeNo = $Result['TradeNo'];

        $sql = 'select * from card_deposit where serial_number = @serial_number ';

        $card_deposit = $this->_db->single_check($sql, ['serial_number' => $MerchantOrderNo]);

        $this->log_file("card_deposit:" . json_encode($card_deposit));
        $this->log_file("MerchantOrderNo:" . $MerchantOrderNo);
        if ($card_deposit['status'] == 2) {
            $this->log_file("此交易以成功付款");
            die;
        }

        $mapData['return_post_json'] = json_encode($Result);
        //所有支付方式共同回傳參數
        $mapData['TradeNo'] = $TradeNo;
        $mapData['Status'] = $Status;
        $mapData['Message'] = $Message;
        $mapData['PaymentType'] = $Result['PaymentType'];
        $mapData['RespondType'] = $Result['RespondType'];
        $mapData['CheckCode'] = $CheckCode;
        $mapData['PayTime'] = $Result['PayTime'];
//        $this->log_file(" valideMapData first:" . json_encode($Result));

        $this->valideMapData($mapData, $Result, 'IP');
        $this->valideMapData($mapData, $Result, 'EscrowBank');

        //信用卡支付回傳參數
        $this->valideMapData($mapData, $Result, 'RespondCode');
        $this->valideMapData($mapData, $Result, 'Auth');
        $this->valideMapData($mapData, $Result, 'Card6No');
        $this->valideMapData($mapData, $Result, 'Card4No');
        $this->valideMapData($mapData, $Result, 'ECI');
        $this->valideMapData($mapData, $Result, 'TokenUseStatus');

        //WEBATM、ATM 繳費回傳參數
        $this->valideMapData($mapData, $Result, 'PayBankCode');
        $this->valideMapData($mapData, $Result, 'PayerAccount5Code');
        $mapData['status_code'] = $Status == 'SUCCESS' ? 2 : -1;

        //超商代碼繳費回傳參數
        $this->valideMapData($mapData, $Result, 'CodeNo');

        //條碼繳費回傳參數
        $this->valideMapData($mapData, $Result, 'Barcode_1');
        $this->valideMapData($mapData, $Result, 'Barcode_2');
        $this->valideMapData($mapData, $Result, 'Barcode_3');
        $this->valideMapData($mapData, $Result, 'PayStore');
//        $this->log_file("valideMapData end:" . $mapData);

        $mapData['status_code'] = $Status == 'SUCCESS' ? 2 : -1;
        $res = $this->_db->Update('pay2go_init', ['MerchantOrderNo' => $MerchantOrderNo], $mapData);
        $this->log_file("res update:" . json_encode($res));
        if (!$res) {
            $this->log_file("err:pay2go_init update failed");
            die;
        }

        /**
         * 編號    儲值類別    儲值者名稱    儲值人員名稱    卡片序號或交易序號    儲值金額    廠商交易單號    回傳訊息    交易狀態    建立時間
         *      pay2go  X           X                   amt     TradeNo     Message Successed
         *
         */


        $sql = 'select * from member where account = @account ';
        $member = $this->_db->single_check($sql, array('account' => $pay2go["member_account"]));

        //建立儲值資訊
        $cardData = [];
        $cardData['member_id'] = $member['id'];
        $cardData['type'] = 3;//pay2go
        $cardData['serial_number'] = $MerchantOrderNo;
        $cardData['points'] = $pay2go['points'];
        $cardData['transactionid'] = $TradeNo;
        $cardData['msg'] = $Message;
        $cardData['status'] = 'SUCCESS' ? 2 : -1;
        $cardData['create_date'] = date('Y-m-d H:i:s');
        $cardData['update_date'] = date('Y-m-d H:i:s');
        if (!$this->_db->Insert('card_deposit', $cardData)) {
            $this->log_file("err:card_deposit insert failed");
            die;
        }
        //更新回使用者資料
        $arrMem = array();
        $arrMem['point'] = $member['point'] + $pay2go['points'];
        if (!$this->_db->Update('member', array('id' => $member['id']), $arrMem)) {
            $this->log_file("err:member add points failed");
            die;
        }
        $this->log_file('000');
    }

    private function nonRealTimeDeal($Result, $Status, $Message, $pay2go, $CheckCode)
    {


        $MerchantOrderNo = $Result['MerchantOrderNo'];

        $sql = 'select * from card_deposit where serial_number = @MerchantOrderNo ';

        $card_deposit = $this->_db->single_check($sql, ['MerchantOrderNo' => $MerchantOrderNo]);
        if (!$card_deposit)//第一次交易會不存在
            $this->nonRealTimeDealFirst($Result, $Status, $Message, $pay2go, $CheckCode);
        if ($card_deposit['status'] == 1)
            $this->nonRealTimeDealUpdate($Result, $Status, $Message, $pay2go, $CheckCode);
        else
            $this->jsonView(['msg' => 'card_deposit not deal']);

    }

    private function nonRealTimeDealFirst($Result, $Status, $Message, $pay2go, $CheckCode)
    {

        $Amt = $Result['Amt'];
        $MerchantOrderNo = $Result['MerchantOrderNo'];
        $TradeNo = $Result['TradeNo'];


        $mapData['return_post_json2'] = json_encode($Result);
        $mapData['CheckCode'] = $CheckCode;
        $mapData['TradeNo'] = $TradeNo;
        $mapData['NonRealStatus'] = $Status;
        $mapData['NonRealMessage'] = $Message;
        $mapData['PaymentType'] = $Result['PaymentType'];
        $mapData['ExpireDate'] = $Result['ExpireDate'];
        $this->valideMapData($mapData, $Result, 'BankCode');
        $this->valideMapData($mapData, $Result, 'CodeNo');
        $this->valideMapData($mapData, $Result, 'Barcode_1');
        $this->valideMapData($mapData, $Result, 'Barcode_2');
        $this->valideMapData($mapData, $Result, 'Barcode_3');
        $mapData['status_code'] = $Status == 'SUCCESS' ? 1 : -1;//交易中
        $this->_db->Update('pay2go_init', ['MerchantOrderNo' => $MerchantOrderNo], $mapData);

        /**
         * 編號    儲值類別    儲值者名稱    儲值人員名稱    卡片序號或交易序號    儲值金額    廠商交易單號    回傳訊息    交易狀態    建立時間
         *      pay2go  X           X                   amt     TradeNo     Message Successed
         *
         */


        $sql = 'select * from member where account = @account ';
        $member = $this->_db->single_check($sql, array('account' => $pay2go["member_account"]));

        //建立儲值資訊
        $cardData = [];
        $cardData['member_id'] = $member['id'];
        $cardData['type'] = 3;//pay2go
        $cardData['serial_number'] = $MerchantOrderNo;
        $cardData['points'] = $pay2go['points'];
        $cardData['transactionid'] = $TradeNo;
        $cardData['msg'] = '交易中';
        $cardData['status'] = 1;//交易中
        $cardData['create_date'] = date('Y-m-d H:i:s');
        $cardData['update_date'] = date('Y-m-d H:i:s');
        $this->_db->Insert('card_deposit', $cardData);


    }

    private function nonRealTimeDealUpdate($Result, $Status, $Message, $pay2go, $CheckCode)
    {

        $MerchantOrderNo = $Result['MerchantOrderNo'];
        $TradeNo = $Result['TradeNo'];


        $mapData['return_post_json'] = json_encode($Result);
        //所有支付方式共同回傳參數
        $mapData['TradeNo'] = $TradeNo;
        $mapData['Status'] = $Status;
        $mapData['Message'] = $Message;
        $mapData['PaymentType'] = $Result['PaymentType'];
        $mapData['RespondType'] = $Result['RespondType'];
        $mapData['CheckCode'] = $CheckCode;
        $mapData['PayTime'] = $Result['PayTime'];
        $this->valideMapData($mapData, $Result, 'IP');
        $this->valideMapData($mapData, $Result, 'EscrowBank');

        //WEBATM、ATM 繳費回傳參數
        $this->valideMapData($mapData, $Result, 'PayBankCode');
        $this->valideMapData($mapData, $Result, 'PayerAccount5Code');

        //超商代碼繳費回傳參數
        $this->valideMapData($mapData, $Result, 'CodeNo');

        //條碼繳費回傳參數
        $mapData['Barcode_1'] = $Result['Barcode_1'];
        $this->valideMapData($mapData, $Result, 'Barcode_1');
        $this->valideMapData($mapData, $Result, 'Barcode_2');
        $this->valideMapData($mapData, $Result, 'Barcode_3');
        $this->valideMapData($mapData, $Result, 'PayStore');
        $mapData['status_code'] = $Status == 'SUCCESS' ? 2 : -1;
        $this->_db->Update('pay2go_init', ['MerchantOrderNo' => $MerchantOrderNo], $mapData);


        /**
         * 編號    儲值類別    儲值者名稱    儲值人員名稱    卡片序號或交易序號    儲值金額    廠商交易單號    回傳訊息    交易狀態    建立時間
         *      pay2go  X           X                   amt     TradeNo     Message Successed
         *
         */


        $sql = 'select * from member where account = @account ';
        $member = $this->_db->single_check($sql, array('account' => $pay2go["member_account"]));

        //建立儲值資訊

        $cardData = [];
        $cardData['type'] = 3;//pay2go
        $cardData['msg'] = $Message;
        $cardData['status'] = 'SUCCESS' ? 0 : -1;
        $cardData['update_date'] = date('Y-m-d H:i:s');
        $this->_db->Update('card_deposit', ['serial_number' => $MerchantOrderNo], $cardData);
        //更新回使用者資料
        $arrMem = array();
        $arrMem['point'] = $member['point'] + $pay2go['points'];
        $this->_db->Update('member', array('id' => $member['id']), $arrMem);
        $this->jsonView(['code' => '000']);

    }

    private function valideMapData(&$mapData, $Result, $ResultName)
    {

        if (isset($Result[$ResultName]))
            $mapData[$ResultName] = $Result[$ResultName];

    }


}

$aa = new func_pay2go();
$aa->page_load();


?>