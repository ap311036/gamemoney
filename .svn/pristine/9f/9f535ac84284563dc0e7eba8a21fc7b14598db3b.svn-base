<?php
session_start(); 
date_default_timezone_set("Asia/Taipei");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once("lib/config.php");
include_once("lib/WebDB.php");
include_once("lib/basePage.php");

require_once  'lib/Facebook/autoload.php';


$viewData  = array();
class func_facebookTest extends basePage
{

    public function page_load()
    {
        //是否登入
        //$this->isLogin();

        $fb = new Facebook\Facebook([
            'app_id' => '1181751815224247',
            'app_secret' => '08ba4df80f3d88ebf128c740b75e23c6',
            'default_graph_version' => 'v2.5',
        ]);

        //$helper = $fb->getCanvasHelper();
        $helper = $fb->getJavaScriptHelper();
        try 
        {
            $accessToken = $helper->getAccessToken();
            if($accessToken == null)
            {
                $this->alert('請先登入');
                if(isset($_SESSION['facebook_access_token']))
                {
                    unset($_SESSION['facebook_access_token']);
                }
            }
            else
            {
                $this->alert('已登入認證過');
                $_SESSION['facebook_access_token'] = (string) $accessToken;

                $response = $fb->get('/me?fields=id,name,email,birthday', $accessToken);
                $user = $response->getGraphUser();


                var_dump($user);
                $this->alert($user['name']);
                //自動登入

            }
           // $this->alert($accessToken);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
            //echo 'Graph returned an error: ' . $e->getMessage();
            $this->alert('Graph returned an error: ' . $e->getMessage());
            //exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
            $this->alert('Facebook SDK returned an error: ' . $e->getMessage());
            //echo 'Facebook SDK returned an error: ' . $e->getMessage();
            //exit;
        }

        //if (isset($accessToken)) {
            // Logged in!
           
        //}

         //get 上有要特別處理的參數
        if( isset( $_GET['m']))
        {
            switch($_GET['m'])
            {
                case    'register':
                        $this->register();
                        break;
                case    'fbLogin':
                        $this->fbLogin();
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
        //$arrData['confirm_pass'] = $_POST['confirm_pass'];
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

 $aa = new func_facebookTest();
 $aa->page_load();




?>