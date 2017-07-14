<?php

//取得資料內容
function get_marquee($admin_db) {

    $sql = "select * from marquee order by id asc";
    $res = $admin_db->dbSelectPrepare($sql, []);
    return $res;
}

function add_marquee($admin_db, $arr_input) {

    $admin_db->debug();
    $sql = "INSERT INTO marquee ";
    $arr_input['m_created_at'] = date('Y-m-d H:i:s');
    $result = $admin_db->dbInsertPrepare($sql, $arr_input);
    return $result;
}

?>