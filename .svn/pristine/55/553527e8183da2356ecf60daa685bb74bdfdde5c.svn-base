<?php

//ini_set('display_errors', 1);
//var_dump($button);
//include_once 'inc.php';
$id_id = "login";
require_once('/home/web/svnclient/gamemoney/admin/inc/inc.php');
require_once(furl.'class/db_class.php');
require_once(furl.'func/func_file.php');

//die;
//ini_set('display_startup_errors', 1);
//var_dump(12312312);
class check_button {

    public function set_check() {
        global $dbconfig;
        $db = new DB($dbconfig['admin']);
        $sql = "SELECT * FROM `transfer_money` WHERE `tm_status` != 0";
        $res = $db->dbSelectPrepare($sql);
        $datetime = date('Y-m-d h:i:s');
        $datetime = strtotime($datetime);
        //log_file($msg);
        foreach ($res as $key => $value) {
            if ($value['tm_ctime'] < $datetime) {
                $this->mod_common($db, $value['tm_id']);
                //  $sql = "UPDATE `transfer_money` SET `tm_status` = 0  WHERE `transfer_money`.`tm_id` = " . $value['tm_id'];
                //  $sql = $this->_db->execSql($sql);
                $this->add_point($db, $value['tm_amount'], $value['tm_smlid']);
            }
        }
    }

    public function add_point($db, $tm_amount, $tm_smlid) {
        $db->debug();
        $sql = "SELECT * FROM `member` WHERE  id =" . $tm_smlid;
        $checK_en = $db->dbSelectPrepare($sql, []);
        $checK_en = $db->getOneRow($checK_en);
        $tm_amount += $checK_en['point'];
        $arr_input['point'] = $tm_amount;
        $sql = "UPDATE member ";
        $sql_where_condition = 'id = ? ';
        $sql_where_value = array($tm_smlid);
        //$db->debug();
        $result = $db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);
    }

    function mod_common($db, $id) {
        $sql = "UPDATE transfer_money ";
        $sql_where_condition = 'tm_id = ? ';
        $sql_where_value = array($id);
        $arr_input['tm_status'] = 0;
        //$db->debug();
        $result = $db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);

        return $result;
    }

}

$aa = new check_button();
$aa->set_check();
