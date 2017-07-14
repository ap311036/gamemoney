<?php

/**
 * Created by PhpStorm.
 * User: Magus
 * Date: 2016/10/7
 * Time: 下午1:37
 */
namespace API\API;


class API
{

    protected $test_mode;
    protected $db;
    protected $admin_db;

    public function __construct()
    {
        try {
            // 載入基本的函式庫

            $this->initRequireFile();

            //初始
            date_default_timezone_set("Asia/Taipei");


        } catch (Exception $ex) {
            /*
             * TODO unimplement exception
             */
            echo $ex;
        }

    }

    public function execute()
    {
        try {


            $this->param = $_POST;

            $this->main();
        } catch (Exception $ex) {
            /*
             * TODO unimplement exception
             */
            echo $ex;
        }
    }


    public function checkIP()
    {

        $iptables = file_get_contents(ROOT . '/inc/iptable.json');
        $iptables = json_decode($iptables);
        if (!empty($iptables->deny))
            foreach ($iptables->deny as $ip)
                if ($_SERVER['REMOTE_ADDR'] == $ip)
                    $this->response('you can not access this area!' . __LINE__);

        foreach ($iptables->can_access as $ip)
            if ($_SERVER['REMOTE_ADDR'] == $ip)
                return true;
        $this->response('you can not access this area!' . __LINE__);


    }

    function checkInput($rule_arr)
    {
        foreach ($rule_arr as $input) {
//            log_file('ck input '.$input,date('Y-m-d H:i:s'));
//            log_file('ck input 2'.json_encode(array_key_exists($input, $_POST)),date('Y-m-d H:i:s'));
            if (!array_key_exists($input, $_POST))
                return false;
        }
        return true;
    }

    function testInput($arr)
    {
        foreach ($arr as $k => $input) {
            $_POST[$k] = $input;
        }
    }


    public function initRequireFile()
    {
        $id_id = "login";
        global $db, $admin_db;
        if (is_dir('../admin')) {
            require_once '../admin/inc/inc.php';
        } else if (is_dir('../../admin')) {
            require_once '../../admin/inc/inc.php';
        } else
            return false;
        $this->db = $db;
        $this->admin_db = $admin_db;

//        var_dump($admin_db);

    }

    protected function getParam($param_name)
    {

        if (isset($_POST[$param_name]))
            return $_POST[$param_name];
        else
            return null;
    }


    function checkPramExist($param_name)
    {
        if ($this->param[$param_name])
            return true;
        return FALSE;
    }


    public function response($data_arr, $enableLog = false)
    {
        $data_json = json_encode($data_arr);

        if ($enableLog == false)

            exit($data_json);
        else {
            //add some log
            exit($data_json);

        }
    }

    function main()
    {

    }


}
