<?php

session_start();
date_default_timezone_set("Asia/Taipei");
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
include_once("lib/config.php");
include_once("lib/WebDB.php");
include_once("lib/basePage.php");

require_once 'lib/Facebook/autoload.php';

//require_once __DIR__ . '/Facebook/autoload.php';

$viewData = array();

// print_r($_SESSION['fb_test']);
//echo json_encode($_SESSION['fb_test']);


class func_login extends basePage {

    public function page_load() {
        //是否登入
        //$this->isLogin();
        //get 上有要特別處理的參數
        $arrGetParam = array();
        $arrGetParam['m'] = 'login';

        foreach ($arrGetParam as $k => $v) {
            if (isset($_GET[$k])) {
                if ($_GET[$k] == 'login') {
                    $this->login();
                }
                if ($_GET[$k] == 'logout') {
                    $this->logout();
                }
                if ($_GET[$k] == 'fbLogin') {
                    $this->fbLogin();
                }
                if ($_GET[$k] == 'fbloginTest') {
                    $this->fbloginTest();
                }
            }
        }
    }

    public function login() {
        global $viewData;


        $acc = $_POST['account'];
        $pass = $_POST['password'];
        $code = $_POST['code'];

        $viewData['last_account'] = $acc;
        $viewData['last_pass'] = $pass;

        if ($acc == '') {
            $this->redirect('index.php', '請輸入帳號');
            return;
        }

        if ($pass == '') {
            $this->redirect('index.php', '請輸入密碼');
            return;
        }

        if ($code == '') {
            $this->redirect('index.php', '請輸入驗證碼');
            return;
        }
        if ($code != $_SESSION['CAPTCHA']) {
            $this->redirect('index.php', '驗證碼有誤，請重新輸入');
            return;
        }

        $sql = 'select * from member where type=0 and  account= \'' . $acc . '\'';
        $member = $this->_db->single($sql);



        //  var_dump($member);
        //  die;
        if (!$member) {
            echo '<script>alert("找不到該帳號");window.location="index.php";</script>';
            return;
        }

        if ($member['password'] != md5($this->encrypt($pass))) {
//            $test = md5( $this->encrypt($pass) );
//            echo "md5( $this->encrypt($pass) )";
            echo '<script>alert("密碼錯誤");window.location="index.php";</script>';
        } else {
            $_SESSION['fuser_account'] = $acc;
            $this->loginRecord($member);
            echo '<script>alert("登入成功");window.location="index.php";</script>';
        }
    }

    public function logout() {
        if (isset($_SESSION["fuser_account"])) {
            unset($_SESSION["fuser_account"]);
        }
        if (isset($_SESSION["fb_login"])) {
            unset($_SESSION["fb_login"]);
        }
        if (isset($viewData['member'])) {
            unset($viewData['member']);
        }
        if (isset($_SESSION['fb_login'])) {
            unset($_SESSION['fb_login']);
        }
        if (isset($_SESSION['fb_test'])) {
            unset($_SESSION['fb_test']);
        }

        echo '<script>alert("已登出");window.location="index.php";</script>';
    }

    public function fbLogin() {

//        $_SESSION['fb_test']=1;
//        $this->alert($_SESSION['fb_test']);
        global $FbAppid, $FbAppkey, $target_personal_avatar;
        $fb = new Facebook\Facebook([
            'app_id' => $FbAppid,
            'app_secret' => $FbAppkey,
            'default_graph_version' => 'v2.7',
        ]);

        //$helper = $fb->getCanvasHelper();
        $helper = $fb->getJavaScriptHelper();
        try {
            $accessToken = $helper->getAccessToken();
            if ($accessToken == null) {
                $this->alert('請先登入');
//                $this->jsonView('請先登入facebook');
                if (isset($_SESSION['facebook_access_token'])) {
                    $this->alert($_SESSION['facebook_access_token']);
                    unset($_SESSION['facebook_access_token']);
                }
            } else {
                //$this->alert('已登入認證過');
                //$this->jsonView('已登入認證過');
//                echo"已登入認證過";

                $_SESSION['facebook_access_token'] = (string) $accessToken;
//                $this->alert($_SESSION['facebook_access_token']);
                $response = $fb->get('/me?fields=id,name,picture,email,birthday', $accessToken);
                $user = $response->getGraphUser();
                $fb_id = $user->getId();
                $fb_picture = $user->getPicture();
                $fb_picture = $fb_picture['url'];
                if(!empty($user['email']))
                {
                    $fb_mail = $user['email'];
                } else {
                    $fb_mail = "";
                }
                
                //var_dump($user);
                
                //die;
                $img = file_get_contents($fb_picture);
                $name = 'cg_' . (string) time();
                $target_file = $target_personal_avatar . $name . ".png";
                file_put_contents($target_file, $img);
                //var_dump($fb_picture['url']);
                //die;
                $fb_account = 'FB_' . $fb_id;

                //var_dump($user);
                //$this->alert($user['name']);
                //自動登入

                $sql = 'select * from member where type=1 and account =\'' . $fb_account . '\'';
                $result = $this->_db->query($sql);
                if (!$result) {   //找不到以此mail註冊的帳號
                    $newData = array();
                    $newData['account'] = $fb_account;
                    $newData['name'] = $user['name'];
                    $newData['personal_avatar'] = $name . ".png";
//                    $newData['nick_name'] = $user['name'];
                    $newData['birthday'] = $user['birthday'];
                    $newData['password'] = '';
                    $newData['phone'] = '';
                    $newData['tel'] = '';
                    $newData['type'] = '1';
                    $newData['createDate'] = date('Y-m-d H:i:s');

                    $newID = $this->_db->Insert('member', $newData);
                    if (!$newID) {
                        $this->jsonView('建立帳號失敗');
                    }
                    $_SESSION["fuser_account"] = $fb_account;
                    $user_id = $newID;
                } else {            //找到此帳號，登入
//                    echo"找到此帳號";
                    $arrData = array();
                    $arrData['personal_avatar'] = $name . ".png";
                    $result = $this->_db->Update('member', array('account' => $fb_account), $arrData);
                    $user_id = $result[0]['id'];
                    $_SESSION["fuser_account"] = $fb_mail;
                }
//                $this->alert('alert');
                $_SESSION["fb_login"] = 1;
//                $this->alert($_SESSION["fb_login"]);
                $this->loginRecord(['id' => $user_id]);

                if (!isset($_SESSION['fb_test'])) {
                    $_SESSION['fb_test'] = array();
                }

                if (isset($_GET['log'])) {
                    $_SESSION['fb_test']['log'] = "1";
                    $this->alert($_SESSION['fb_test']['log']);
                }
                $_SESSION['fuser_account'] = $fb_account;

                echo '<script>window.location="index.php";</script>';

//                $this->jsonView('success');
            }
            // $this->alert($accessToken);
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
//            echo"FacebookResponseException".$e->getMessage();
            // When Graph returns an error
            //echo 'Graph returned an error: ' . $e->getMessage();
            //$this->alert('Graph returned an error: ' . $e->getMessage());
            $this->jsonView("FacebookResponseException" . $e->getMessage());

            echo '<script>window.location="index.php";</script>';
            //exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
//            echo"FacebookSDKException".$e->getMessage();
            // When validation fails or other local issues
            //$this->alert('Facebook SDK returned an error: ' . $e->getMessage());
            //echo 'Facebook SDK returned an error: ' . $e->getMessage();
            //exit;
            $this->jsonView("FacebookSDKException" . $e->getMessage());
            echo '<script>window.location="index.php";</script>';
        }
    }

    function loginRecord($member) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $mapData = [];
        $mapData['member_id'] = $member['id'];
        $mapData['login_ip'] = $ip;
        $mapData['createDate'] = date('Y-m-d H:i:s');
        $this->_db->Insert('member_login_log', $mapData);
    }

    function fbloginTest() {


        if (!isset($_SESSION['fb_test'])) {
            $_SESSION['fb_test'] = array();
        }

        if (isset($_GET['log'])) {
            $_SESSION['fb_test']['log'] = "1";
            $this->alert($_SESSION['fb_test']['log']);
        }
//        echo '<script>alert("已登入");window.location="index.php";</script>';
        $this->alert($_SESSION['fb_test']['log']);
    }

}

$aa = new func_login();
$aa->page_load();
?>