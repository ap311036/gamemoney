<?php
session_start(); 
date_default_timezone_set("Asia/Taipei");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once("lib/config.php");
include_once("lib/WebDB.php");
include_once("lib/basePage.php");

$viewData  = array();
class func_sendSMS extends basePage
{

    public function page_load()
    {

        if( isset( $_POST['phone']))
        {

            $code = substr(md5(uniqid(rand(), true)),0,5);

          //  var_dump($code);
           // die;
            //請輸入以下註冊畫面代碼，若你未申請請忽略此封簡訊
            $text = "game money 遊戲網站簡訊認證。代碼：" . $code;
            $value =  iconv("utf-8", "big5", $text); //轉換編碼
            $value = urlencode($value);
            $phone = $_POST['phone'];

            $pass = 'grace623';
            $acc = 'graceanna';

            $url = 'https://api.kotsms.com.tw/kotsmsapi-1.php';
            $url  .= '?username='.$acc.'&password='.$pass.'&dstaddr='.$phone.'&%20smbody='.$value;  //'&response=http://gamemoney.sammicorner.com/receiveMsg.php"';

            //var_dump($url);

            //檢查此電話，是不是30秒內已送過
            $today = date('Y-m-d h:i:s');
            $new_date = date('Y-m-d h:i:s', strtotime('-30 seconds', strtotime($today) ));

            //var_dump($new_date);
            $sql = 'select * from register_sms where  create_date > \''. $new_date .'\' and phone= @phone ';
            
            $smsCheck = $this->_db->single_check($sql ,array('phone'=>$phone) );
            if($smsCheck != false)
            {
                return $this->jsonView('30秒內只能傳一封簡訊認證');
            }

            //執行送出簡訊
            $result = $this->httpGet($url);
            /*
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch, CURLOPT_HEADER, 0);


            $result = @curl_exec($ch);

             if($result === false)
            {
                echo "Error Number:".curl_errno($ch)."<br>";
                echo "Error String:".curl_error($ch);
            }

            curl_close($ch);
            */

            //存進DB
            $arrInput = array();
            $arrInput['code'] = $code;
            $arrInput['phone'] = $phone;
            $arrInput['return_code'] = $result;
            $arrInput['status'] = 0;
            $arrInput['create_date'] = date('Y-m-d h:i:s');

            $this->_db->Insert('register_sms',$arrInput);


            //echo json_encode(array('msg'=>'success'),1);
            return $this->jsonView('success');
        }

    }

  


   
}

 $aa = new func_sendSMS();
 $aa->page_load();










?>