<?php
session_start(); 
date_default_timezone_set("Asia/Taipei");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once("lib/config.php");
include_once("lib/WebDB.php");
include_once("lib/basePage.php");

$viewData  = array();
class func_signup extends basePage
{

    public function page_load()
    {
        //是否登入
        //$this->isLogin();

         //get 上有要特別處理的參數
        if( isset( $_GET['m']))
        {
            switch($_GET['m'])
            {
                case    'register':
                        $this->register();
                        break;
               
           
            }
        }


        global $viewData ;
      
    }


    public function register()
    {
        $arrData = array();
        $arrData['account'] = $_POST['account'];
        $arrData['password'] = $_POST['password'];
        $arrData['name'] = $_POST['nick_name'];
        $arrData['email'] = $_POST['email'];
        $arrData['phone'] = $_POST['phone'];
        //$arrData['code'] = $_POST['code'];

        if($arrData['account'] =='')
        {
             $this->alert('請輸入帳號');
             return;
        }

        if($arrData['password'] =='')
        {
             $this->alert('請輸入密碼');
             return;
        }

         if($arrData['password'] !=$_POST['confirm_pass'])
        {
             $this->alert('密碼和確認密碼不相符');
             return;
        }

         if($arrData['email'] == '')
        {
             $this->alert('請輸入電子信箱');
             return;
        }

        //檢查重複重帳號
        $memberChk = $this->_db->single_check('select * from member where account= @account ',array('account'=>$arrData['account']));
        if($memberChk)
        {
             $this->alert('有重複帳號！');
             return;
        }
//        //檢查重複暱稱
//        $memberChk = $this->_db->single_check('select * from member where name= @name ',array('name'=>$arrData['name']));
//        if($memberChk)
//        {
//             $this->alert('有重複名稱！');
//             return;
//        }


        //檢查簡訊認證碼
        $today = date('Y-m-d h:i:s');

        $new_date = date('Y-m-d h:i:s', strtotime('+1 minutes', strtotime($today) ));
        $smsCheck = $this->_db->single_check('select * from register_sms where status=0 and create_date < \''. $new_date .'\'   and  code= @code ',array('code'=>$_POST['code']));
        if($smsCheck == false)
        {
             $this->alert('找不到已送出的簡訊或過期。請重新認證！');
             return;
        }
        else
        {
            //標記此簡訊已使用
            $arrInput = array();
            $arrInput['status'] = 1;
            $this->_db->Update('register_sms',array('id'=>$smsCheck['id']),$arrInput);
        }

        //新增
        $arrData['password'] = md5($this->encrypt($_POST['password']));
        $result = $this->_db->Insert('member',$arrData);
        if(!$result)
        {
            $this->alert('註冊失敗');
        }
        else
        {
            $this->redirect('index.php','註冊成功');
        }

    }

  
}

 $aa = new func_signup();
 $aa->page_load();




?>