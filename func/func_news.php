<?php

session_start();
date_default_timezone_set("Asia/Taipei");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once("lib/config.php");
include_once("lib/WebDB.php");
include_once("lib/basePage.php");

$viewData = array();

class func_news extends basePage {

    public function page_load() {
        //是否登入
        //$this->isLogin();
        //get 上有要特別處理的參數
        $arrGetParam = array();
        //$arrGetParam['m'] = 'getMemberList';

        foreach ($arrGetParam as $k => $v) {
            if (isset($_GET[$k])) {
                /* if($_GET[$k] == 'getMemberList')
                  {
                  $this->getMemberList();
                  } */
            }
        }


        global $viewData;
        $viewData['newsList'] = $this->getNewsList();
        $viewData['newsType'] = $this->getNewsType();
        $viewData['topDeposit'] = $this->getTopDeposit();
        //var_dump($viewData);
    }

    public function getNewsList() {
        $sql = 'select * from news where is_del = 0 ';
        $result = $this->_db->query($sql);
        return $result;
    }

    public function getNewsType() {
        $sql = 'select * from news_type where is_del = 0 ';
        $result = $this->_db->query($sql);
        return $result;
    }

    public function getTopDeposit() {
        $sql = 'SELECT * FROM `member` ORDER BY `member`.`point` DESC limit 15 ';
        //$sql = 'select a.*, b.name from card_deposit_sum as a  left join member as b  on a.member_id = b.id order by a.deposit_sum desc limit 15  ';
       // var_dump($sql);
       // die();
        $result = $this->_db->query($sql);
        return $result;
    }

}

$aa = new func_news();
$aa->page_load();
?>