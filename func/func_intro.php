<?php
session_start();
date_default_timezone_set("Asia/Taipei");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once("lib/config.php");
include_once("lib/WebDB.php");
include_once("lib/basePage.php");

$viewData = array();

class func_intro extends basePage
{

    public function page_load()
    {
        //是否登入
        //$this->isLogin();

        //get 上有要特別處理的參數
        $arrGetParam = array();
        //$arrGetParam['m'] = 'getMemberList';

        foreach ($arrGetParam as $k => $v) {
            if (isset($_GET[$k])) {
                /*if($_GET[$k] == 'getMemberList')
                {
                    $this->getMemberList();
                }*/
            }
        }


        global $viewData;
        $viewData['Guides'] = $this->getGuide();
        $viewData['Centers'] = $this->getCenterList();
        $viewData['GamesList'] = $this->getGamesList();

    }

    public function getGuide()
    {
//        $dbcon = new BackendDB();
//        $admin_db = $dbcon->getAdminDB();
        $sql = "select * from newbie_guide 
where is_deleted = 0
order by order_id asc";

        $result = $this->_db->query($sql);
        return $result;
    }

    public function getCenterList()
    {

        $sql = "select * from game_center_list order by order_id asc";
        $result = $this->_db->query($sql);
        return $result;

    }

    public function getGamesList()
    {
        $sql = "select a.title as center, b.* from game_center_list as a 
left outer join game_intro_list as b on a.id = b.gc_id where b.is_delete = 0 order by a.order_id ,b.order_id asc ";
        $tmp = $this->_db->query($sql);

        $result = [];
        $lists = $this->getCenterList();
//        var_dump($tmp);
//        var_dump($lists);
        foreach ($lists as $k => $v) {


            foreach ($tmp as $t=>$p) {
//                var_dump($p['gc_id']);
//                var_dump($v['id']);
                if ($p['gc_id'] == $v['id']) {
                    $l = $p['gc_id'];

                    if (!isset($result[$l]))
                        $result[$l] = [];
                    array_push($result[$l], $p);
                }
            }
        }

//        var_dump($result);
        return $result;

    }


}

$aa = new func_intro();
$aa->page_load();


?>