<?php

session_start();
date_default_timezone_set("Asia/Taipei");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once("lib/config.php");
include_once("lib/WebDB.php");
include_once("lib/basePage.php");
include_once("lib/Carbon.php");

use Carbon\Carbon;

$viewData = array();
$mapData = array();

class func_game extends basePage {

    public function page_load() {

        if (!isset($_SESSION['fuser_account'])) {
            $this->redirect('index.php', '請先登入');
            return;
        }
        //是否登入
        //$this->isLogin();
        //get 上有要特別處理的參數
        $arrGetParam = array();
        $arrGetParam['m'] = [
            'getMarque',
            'getJpotData',
        ];

        foreach ($arrGetParam as $k => $v) {
            if (isset($_GET[$k])) {
                if ($_GET[$k] == 'logout') {
                    $this->logout();
                }
                if ($_GET[$k] == 'getMarque') {
                    $this->getMarque();
                }
                if ($_GET[$k] == 'getJpotData') {
                    $this->getJpotData();
                }
            }
        }


        global $viewData;
        global $mapData;
        $viewData['member'] = $this->getMember();
        // $viewData['marquee'] = $this->getMarque();
        // $viewData['JpotData'] = $this->getJpotData();
//        if (!$_COOKIE['member_account'] && !empty($viewData['member'])) {
        setcookie('member_point', $viewData['member']['point']);
        setcookie('member_account', $viewData['member']['account']);
        setcookie('member_name', $viewData['member']['name']);
        setcookie('user', $viewData['member']['account']);
        setcookie('member_id', $viewData['member']['id']);
//        }
        // var_dump($viewData);
        $sql = 'SELECT * FROM  `map_image` WHERE  `member_id` =' . $viewData['member']['id'];
        $member_id = $this->_db->execSql($sql);
        foreach ($member_id as $key => $value) {
            $sql = "SELECT * FROM  `image_group` WHERE  `group_type` =" . $value['mag_group'];
            //var_dump($sql);
            $mag_group = $this->_db->execSql($sql);
            foreach ($mag_group as $key => $value) {
                array_push($mapData, [
                    'image_name' => $value['image_name'],
                ]);
            }
        }
        //var_dump($mapData);
        // var_dump($viewData['map_group']);
        //var_dump($viewData);
    }

    public function getJpotData() {
        $sql = 'select * from jpot';
        $JpotData = $this->_db->query($sql);
        //var_dump($JpotData);
        //die;
        if (!$JpotData)
            $JpotData = [
                'id' => 0,
                'accumulation' => '',
            ];

        foreach ($JpotData as $k => $j) {
            $JpotData[$k]['accumulation'] = number_format($JpotData[$k]['accumulation'] / 100, 2);
        }

        $result = [
            'code' => 0,
            'JpotData' => $JpotData
        ];

        $JpotData_encode = json_encode($JpotData);
        //var_dump($JpotData_encode);
        die($JpotData_encode);
        //echo $JpotData_encode;
    }

    public function getMarque() {

        $start = Carbon::now()->subMinutes(2)->toDateTimeString();
        $buff = Carbon::now()->addMinutes(3)->toDateTimeString();

//        $sql = "select * from broadcast where start_date <'" . $buff . "' and end_date >'" . $start . "' order by priority,created_at,end_date limit 10";
////        $sql = "select * from broadcast where start_date <='2017-04-12 14:35:38' and end_date >='2017-01-1 18:36:06' order by priority,created_at,end_date limit 10";
//
//        $marquee = $this->_db->query($sql);
//        if (!$marquee)
//            $marquee = [[
//            'id' => 0,
//            'title' => '',
//            'msg' => '歡迎光臨，大聯盟！',
//            'start_date' => '',
//            'end_date' => '',
//            'created_at' => '',
//            'priority' => 0,
//            ]];
//        $result = [
//            'code' => 0,
//            'marquee' => $marquee
//        ];
//        $marquee = [
//                [
//                'id' => 1,
//                'title' => $start,
//                'msg' => $buff,
//                'start_date' => '2017-02-12 14:35:38',
//                'end_date' => '2017-02-12 14:42:38',
//                'created_at' => '2017-02-12 14:35:38',
//                'priority' => 1,
//            ]
//        ];

        $sql = "select * from marquee where m_start_date <'" . $buff . "' and m_end_date >'" . $start . "' and `m_del` !=1 order by m_priority,m_created_at,m_end_date limit 10 ";
        $emegency = $this->_db->query($sql);
        $marquee = [];
        if ($emegency != "") {
            for ($i = 0; $i < 10; $i++) {
                @$msg_ = $emegency[$i]['title'] . " " . $emegency[$i]['msg'];


                array_push($marquee, [
                    'id' => $i,
                    'title' => '',
                    'msg' => @$msg_ = ($emegency[$i]['title'] == "") ? "904" : $msg_,
                    'start_date' => @$emegency[$i]['m_start_date'] = ($emegency[$i]['m_start_date'] == "") ? "904" : $emegency[$i]['m_start_date'],
                    'end_date' => @$emegency[$i]['m_end_date'] = ($emegency[$i]['m_end_date'] == "") ? "904" : $emegency[$i]['m_end_date'],
                    'created_at' => @$emegency[$i]['m_created_at'] = ($emegency[$i]['m_created_at'] == "") ? "904" : $emegency[$i]['m_created_at'],
                    'priority' => @$emegency[$i]['m_priority'] = ($emegency[$i]['m_priority'] == "") ? "904" : $emegency[$i]['m_priority'],
                ]);
            }
        }

//$msg_ = $emegency[0]['title'] . " " . $emegency[0]['msg'];
//        $marquee = [[
//        'id' => "",
//        'title' => '',
//        'msg' => "",
//        'start_date' => '',
//        'end_date' => '',
//        'created_at' => '',
//        'priority' => "",
//        ]];

        $marqueeArray_encode = json_encode($marquee);

        die($marqueeArray_encode);
    }

    public function getMember() {

        $account = $_SESSION['fuser_account'];
        $member = $this->_db->single_check('select * from member where account= @account ', array('account' => $account));

        //var_dump($account);
        return $member;
    }

    public function logout() {
        if (isset($_SESSION["fuser_account"])) {
            unset($_SESSION["fuser_account"]);
        }
        echo '<script>alert("已登出");window.location="index.php";</script>';
    }

}

$aa = new func_game();
$aa->page_load();
?>