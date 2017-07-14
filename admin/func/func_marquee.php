<?php

//取得資料內容
function get_marquee($admin_db) {

    $sql = "SELECT * FROM  `marquee` WHERE  `m_del` !=1 ";
    $res = $admin_db->dbSelectPrepare($sql, []);
    return $res;
}

function add_marquee($admin_db, $arr_input) {

    //$admin_db->debug();
    $sql = "INSERT INTO marquee ";
    $arr_input['m_created_at'] = date('Y-m-d H:i:s');
    $result = $admin_db->dbInsertPrepare($sql, $arr_input);
    return $result;
}

function get_marquee_one($admin_db, $id) {

    //$admin_db->debug();
    $sql = "SELECT * FROM  `marquee` WHERE  `id` =" . $id;
    $res = $admin_db->dbSelectPrepare($sql, $sql_input);
    return $res[0];
}

function mod_marquee($admin_db, $arr_input, $id) {
    $sql = "UPDATE marquee ";
    $sql_where_condition = 'id = ? ';
    $sql_where_value = array($id);
    $result = $admin_db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);
    return $result;
}

function delete_marquee($admin_db, $arr_input, $id) {
    //$admin_db->debug();
    $sql = "UPDATE marquee ";
    $sql_where_condition = 'id = ? ';
    $arr_input['m_del'] = 1;
    $sql_where_value = array($id);
    //var_dump($id);
    //  var_dump($admin_db);

    $result = $admin_db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);
    return $result;
}

?>