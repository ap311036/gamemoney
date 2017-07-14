
<?php
//session_start();
date_default_timezone_set("Asia/Taipei");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//include_once("../lib/config.php");
//include_once("../lib/WebDB.php");
//include_once("../lib/basePage.php");

//$viewData  = array();
class func_main_left extends basePage
{



    public function page_load()
    {
        //是否登入
//        $this->isLogin();

        //get 上有要特別處理的參數

//        $arrGetParam = array();
//        $arrGetParam['m'] = 'login';
//
//        foreach($arrGetParam as $k=>$v)
//        {
//            if( isset( $_GET[$k]))
//            {
//                if($_GET[$k] == 'login')
//                {
//                    $this->login();
//                }
//
//            }
//        }


        global $viewData ;
        $viewData['member'] = $this->getUser();
        
       
       // die;
        

    }

    public function getUser()
    {
        if(isset($_SESSION['fuser_account']))
        {
             //var_dump($_SESSION['fuser_account']);
            $account = $_SESSION['fuser_account'];
            $sql = 'select * from member where account = \'' . $account . '\'';
            $member = $this->_db->single($sql);

            return $member;
        }

        return false;

    }

   
   
}

 $aa = new func_main_left();
 $aa->page_load();




?>