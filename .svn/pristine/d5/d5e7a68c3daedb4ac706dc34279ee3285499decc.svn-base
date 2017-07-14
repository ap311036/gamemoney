<?php

//取得一般會員遊玩資料內容
function get_mbgame($db, $arr_input, $page) {
    //$db->debug();
    $def = ' WHERE ml_del=0 AND ml_mtid=4 '; //篩選出有會員

    if ($arr_input['ml_name']) {
        $def .= ' AND ml_name like ? ';
        $sql_input[] = '%' . $arr_input['ml_name'] . '%';
    }

    if (count($page) > 0) {
        $def .= ' ORDER BY ml_id ASC ';

        $sql = ' SELECT a.*, b.ml_name FROM member_play_data AS a LEFT JOIN member_list AS b ON a.ml_id = b.ml_id  ' . $def;
        $sql .= $page->getSqlLimit();
    } else {
        $sql = ' SELECT COUNT(a.ml_id) as cnt FROM member_play_data AS a LEFT JOIN member_list AS b ON a.ml_id = b.ml_id ' . $def;
    }

    $res = $db->dbSelectPrepare($sql, $sql_input);
    return $res;
}

//篩選個別帳號期間PLAYLOG資料內容
function get_playlog($win7pk_db, $arr_input, $page, $id, $ml_id, $start_date, $end_date) {

   // var_dump(1111111111);
    $page_count = count($page);
    //var_dump($arr_input);
    //$win7pk_db->debug();

    if ($id >= 0) {
        $def = ' WHERE a.ml_id = ? ';
        $sql_input['ml_id'] = $id;
    }
    if ($arr_input['start_date'] && $arr_input['end_date']) {
        $def = ' WHERE a.ml_id = ? ';
        $def .= ' AND a.ps_time BETWEEN ? AND ? ';
        $sql_input['ml_id'] = $id;
        $sql_input[] = $arr_input['start_date'];
        $sql_input[] = $arr_input['end_date'];
    }
    if (count($page) > 0) {

        $sql = ' SELECT a.*, b.gml_name FROM play_station_log AS a LEFT JOIN game_member_list AS b ON a.ml_id = b.gml_id ' . $def;
        $sql .= $page->getSqlLimit();
    } else {
        $sql = ' SELECT COUNT(a.ml_id) as cnt FROM play_station_log AS a LEFT JOIN game_member_list AS b ON a.ml_id = b.gml_id ' . $def;
    }


    $res = $win7pk_db->dbSelectPrepare($sql, $sql_input);
    return $res;
}

?>