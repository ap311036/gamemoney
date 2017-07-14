<?php

function add_ps_zone_date($db, $arr_input) {
    $sql = "INSERT INTO play_station_prob ";
    $result = $db->dbInsertPrepare($sql, $arr_input);
    return $result;
}

function get_pokername($win7pk_db, $id) {
    $sql = ' SELECT * FROM  `poker_set` WHERE  `brand_value` =' . $id;
    return $win7pk_db->dbSelectPrepare($sql, array());
}

function select_mod_id($win7pk_db, $id, $tid, $sid) {

    $win7pk_db->debug();
    $sql = "SELECT * FROM  `play_station_cycle_table` WHERE  `psct_ps_id` =$tid AND  `psct_order_id` =$sid";
    $res = $win7pk_db->dbSelectPrepare($sql, array());


    $arr_input['psct_order_id'] = $id;
    $sql = "UPDATE play_station_cycle_table";
    $sql_where_condition = 'psct_id = ? ';
    $sql_where_value = array($res[0]['psct_id']);
    $result = $win7pk_db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);
    //return $result;
}

function mod_ps_cyle($db, $arr_input, $tid, $id, $psct_suit_type, $ttid, $jvs_web) {

    // ini_set("display_errors", 1);
    //$jvs_root = "http://60.250.122.219:12345";
    $test = [
        "A" => "ChangeTableData",
        //機台ID
        "ps_id" => $tid,
        //目標門檻
        "station_win" => $arr_input['psct_station_win'],
        //牌型code
        "suit_code" => $psct_suit_type,
        //排序
        "order" => $ttid,
//        "order" => $id,
    ];

    $q = http_build_query($test);

    $params2 = "?" . $q;
    //var_dump($params2);
    $res_json = send_http_get($jvs_web, $params2);


    if ($res_json[0]['code'] == 0) {
        return true;
    } else {
        return FALSE;
    }

    //var_dump($res_json);
//    $sql = "UPDATE play_station_cycle_table";
//    $sql_where_condition = 'psct_id = ? ';
//    $sql_where_value = array($id);
//    $result = $db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);
//    return $result;
}

function mod_ps_cycle_date($db, $arr_input, $id, $jvs_web) {
//    $sql = "UPDATE play_station_cycle_setting";
//    $sql_where_condition = 'pscs_ps_id = ? ';
//    $sql_where_value = array($id);
//    $result = $db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);
    //ini_set("display_errors", 1);
    //$jvs_root = "http://60.250.122.219:12345";
    $arr_input['pscs_is_cycle'] = ($arr_input['pscs_is_cycle'] == "") ? "0" : $arr_input['pscs_is_cycle'];
    $arr_input['pscs_is_random'] = ($arr_input['pscs_is_random'] == "") ? "0" : $arr_input['pscs_is_random'];
    $test = [
        "A" => "ChangeSetting",
        //機台ID
        "ps_id" => $id,
        //是否打亂
        "random" => $arr_input['pscs_is_random'],
        //是否循環
        "is_cycle" => $arr_input['pscs_is_cycle'],
        //循環次數
        "cycle_time" => $arr_input['pscs_cycle_time'],
        //目標金額
        "target_win" => $arr_input['pscs_target_win'],
        //目前排序
        "order" => $arr_input['pscs_now_order'],
    ];
    $q = http_build_query($test);
    $params2 = "?" . $q;

    //var_dump($params2);
    // die;
    $res_json = send_http_get($jvs_web, $params2);

    if ($res_json[0]['code'] == 0) {
        return true;
    } else {
        return FALSE;
    }

    //   return true;
}

function mod_ps_zone_date($db, $arr_input, $id) {
    //$db->debug();
    $sql = "UPDATE play_station_prob";
    $sql_where_condition = 'ps_id = ? ';
    $sql_where_value = array($id);
    $result = $db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);
    return $result;
}

function mod_ps_gift_date($db, $arr_input, $id) {
    //$db->debug();
    $sql = "UPDATE play_gift_setting";
    $sql_where_condition = 'ps_id = ? ';
    $sql_where_value = array($id);
    $result = $db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);
    return $result;
}

function mod_ps_gift_date1($db, $arr_input, $id) {
    //$db->debug();
    $sql = "UPDATE play_station_prob";
    $sql_where_condition = 'ps_id = ? ';
    $sql_where_value = array($id);
    $result = $db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);
    return $result;
}

//取得資料內容
function get_play_station($db, $page) {
    //$db->debug();
    if (count($page) > 0) {
        $sql = ' SELECT ps.*, psb.* 
				 FROM play_station AS ps LEFT JOIN play_station_prob AS psb ON ps.ps_id = psb.ps_id WHERE ps.ps_del=0 ';
        $sql .= $page->getSqlLimit();
    } else {
        $sql = ' SELECT COUNT(ps_id) as cnt
				 FROM play_station  WHERE ps_del=0 ';
    }
    $res = $db->dbSelectPrepare($sql, array());
    return $res;
}

function get_ps_name($win7pk_db, $id) {
    $sql = ' SELECT * FROM  `play_station` WHERE  `ps_id` = ' . $id;
    return $win7pk_db->dbSelectPrepare($sql, array());
}

function get_poker_suit_list($win7pk_db, $id) {
    $sql = ' SELECT * FROM  `poker_set` ';
    return $win7pk_db->dbSelectPrepare($sql, array());
}

function get_cyle_date($win7pk_db, $id) {

    //$win7pk_db->debug();
    $sql = "SELECT * FROM  `play_station_cycle_table` WHERE  `psct_ps_id` =" . $id . " order by psct_order_id asc ";
    return $win7pk_db->dbSelectPrepare($sql, array());
}

function get_cyle_date_one($win7pk_db, $id) {
    $sql = "SELECT * FROM  `play_station_cycle_table` WHERE  `psct_id` =" . $id;
    return $win7pk_db->dbSelectPrepare($sql, array());
}

function get_psc_next($win7pk_db, $order, $id) {
    $order = ($order + 1);
    $sql = "SELECT * FROM  `play_station_cycle_table` WHERE  `psct_ps_id` =$id  AND  `psct_id` = $order ";
    $res = $win7pk_db->dbSelectPrepare($sql, array());

    if ($res == "") {
        $sql = "SELECT * FROM  `play_station_cycle_table` WHERE  `psct_ps_id` =$id  AND  `psct_order_id` = 1 ";
        $res = $win7pk_db->dbSelectPrepare($sql, array());
    }
    return $res;
}

function get_list($win7pk_db, $id) {
    //$win7pk_db->debug();
    $sql = "SELECT * FROM  `play_station_cycle_table` WHERE  `psct_ps_id` =$id  order by psct_order_id asc limit 18";
    //$sql = "SELECT * FROM  `play_station_cycle_table` WHERE  `psct_ps_id` =$id limit 16 ";
    return $win7pk_db->dbSelectPrepare($sql, array());
}

function get_list1($win7pk_db, $id) {
    //$win7pk_db->debug();
    $sql = "SELECT * FROM  `play_station_cycle_table` WHERE  `psct_ps_id` =$id  order by psct_order_id asc limit 18,18";
    //$sql = "SELECT * FROM  `play_station_cycle_table` WHERE  `psct_ps_id` =$id limit 16 ";
    return $win7pk_db->dbSelectPrepare($sql, array());
}

function get_list_o($win7pk_db, $order, $id) {
    // $win7pk_db->debug();
//    $sql = "SELECT * FROM  `play_station_cycle_table` WHERE  `psct_ps_id` =$id order by psct_order_id asc limit $next,36";
    $sql = "SELECT * FROM  `play_station_cycle_table` WHERE  `psct_ps_id` =$id AND `psct_order_id` =$order ";
    return $win7pk_db->dbSelectPrepare($sql, array());
    //$aid = ($win7pk_db[0]['psct_id']+1);
    // var_dump($aid);
    //$sql = "SELECT * FROM  `play_station_cycle_table` WHERE  `psct_id` =$aid";
    //var_dump($sql);
    //$sql = "SELECT * FROM  `play_station_cycle_table` WHERE  `psct_ps_id` =$id limit 16 ";
    //return $aid;
    //return $win7pk_db->dbSelectPrepare($sql, array());
}

function get_pscs_now_order($win7pk_db, $order, $id) {
    // $db->debug();
    $sql = "SELECT * FROM  `play_station_cycle_table` WHERE  `psct_ps_id` =$id  AND  `psct_order_id` = $order";
    return $win7pk_db->dbSelectPrepare($sql, array());
}

function get_play_station_cycle_setting($db) {

    $sql = ' SELECT * FROM play_station_cycle_setting ';
    return $db->dbSelectPrepare($sql, array());
}

function get_play_order($win7pk_db, $id) {
    $sql = "SELECT * FROM  `play_station_cycle_setting` WHERE  `pscs_id` =$id";
    return $win7pk_db->dbSelectPrepare($sql, array());
}

//選取單筆資料
function get_play_station_by_id($win7pk_db, $id) {
    // $db->debug();
    // var_dump($win7pk_db);
    //$win7pk_db->debug();
//    $def = ' WHERE ps.ps_id = ?  ';
//    $sql = ' SELECT ps.*, psb.*
//			 FROM play_station AS ps LEFT JOIN play_station_prob AS psb ON ps.ps_id = psb.ps_id ' . $def;
//    $res = $win7pk_db->dbSelectPrepare($sql, array($id));
//    return $res[0];
    $def = ' WHERE ps.ps_id = ?  ';
    $sql = ' SELECT ps.*, psb.*
			 FROM play_station AS ps LEFT JOIN play_gift_setting AS psb ON ps.ps_id = psb.ps_id ' . $def;
    $res = $win7pk_db->dbSelectPrepare($sql, array($id));
    return $res[0];
}

function get_play_station_by_id1($win7pk_db, $id) {
    // $db->debug();
    // var_dump($win7pk_db);
    //$win7pk_db->debug();
    $def = ' WHERE ps.ps_id = ?  ';
    $sql = ' SELECT ps.*, psb.*
			 FROM play_station AS ps LEFT JOIN play_station_prob AS psb ON ps.ps_id = psb.ps_id ' . $def;
    $res = $win7pk_db->dbSelectPrepare($sql, array($id));
    return $res[0];
//    $def = ' WHERE ps.ps_id = ?  ';
//    $sql = ' SELECT ps.*, psb.*
//			 FROM play_station AS ps LEFT JOIN play_gift_setting AS psb ON ps.ps_id = psb.ps_id ' . $def;
//    $res = $win7pk_db->dbSelectPrepare($sql, array($id));
//    return $res[0];
}

//修改or更新
function mod_play_station($db, $arr_input, $id) {


    //$db->debug();
    $sql = "UPDATE play_station ";
    $sql_where_condition = 'ps_id = ? ';
    $sql_where_value = array($id);
    $result = $db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);
    return $result;
}

//新增
function add_play_station($db, $arr_input) {
    //$db->debug();
    $sql = "INSERT INTO play_station ";
    $result = $db->dbInsertPrepare($sql, $arr_input);
    return $result;
}

//修改or更新
function mod_play_station_prob($db, $arr_input, $id) {
    $sql = "UPDATE play_station_prob ";
    $sql_where_condition = 'ps_id = ? ';
    $sql_where_value = array($id);
    $result = $db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);
    return $result;
}

//新增
function add_play_station_prob($db, $arr_input) {
    //$db->debug();
    $sql = "INSERT INTO play_station_prob ";
    $result = $db->dbInsertPrepare($sql, $arr_input);
    return $result;
}

function add_play_gift_setting($db, $arr_input) {
    //$db->debug();
    $sql = "INSERT INTO play_gift_setting ";
    $result = $db->dbInsertPrepare($sql, $arr_input);
    return $result;
}

function get_play_station_zone_setting($db) {
    $sql = ' SELECT * FROM play_station_zone_setting ';
    return $db->dbSelectPrepare($sql, array());
}

function get_play_station_zone_setting_by_id($db, $id) {
    //$db->debug();
    $def = ' WHERE psz_id = ?  ';
    $sql = ' SELECT *
			 FROM play_station_zone_setting ' . $def;
    $res = $db->dbSelectPrepare($sql, array($id));
    return $res[0];
}

function fill_ps_zone_data($db, $zoneId, $arr_input) {
    $zone_data = get_play_station_zone_setting_by_id($db, $zoneId);
    $arr_input['one_bet'] = $zone_data['one_bet'];
    $arr_input['start_score_max'] = $zone_data['start_score_max'];
    $arr_input['start_score_one_score'] = $zone_data['start_score_one_score'];
    $arr_input['min_up_score_value'] = $zone_data['min_up_score_value'];
    $arr_input['max_down_score_value'] = $zone_data['max_down_score_value'];
    $arr_input['down_score_one_score'] = $zone_data['down_score_one_score'];
    $arr_input['down_score_add_score'] = $zone_data['down_score_add_score'];
    $arr_input['two_pairs_multiple'] = $zone_data['two_pairs_multiple'];
    $arr_input['three_kind_multiple'] = $zone_data['three_kind_multiple'];
    $arr_input['straight_multiple'] = $zone_data['straight_multiple'];
    $arr_input['flush_multiple'] = $zone_data['flush_multiple'];
    $arr_input['full_hourse_multiple'] = $zone_data['full_hourse_multiple'];
    $arr_input['four_kind_multiple'] = $zone_data['four_kind_multiple'];
    $arr_input['str_flush_multiple'] = $zone_data['str_flush_multiple'];
    $arr_input['five_kind_multiple'] = $zone_data['five_kind_multiple'];
    $arr_input['royal_flush_multiple'] = $zone_data['royal_flush_multiple'];
    return $arr_input;
}

function get_play_station_zone_prob_by_id($db, $id) {
    $def = ' WHERE psz_id = ?  ';
    $sql = ' SELECT *
			 FROM play_station_zone_prob ' . $def;
    $res = $db->dbSelectPrepare($sql, array($id));
    return $res[0];
}

function fill_ps_prob_data($db, $zoneId, $arr_input) {
    $prob_data = get_play_station_zone_prob_by_id($db, $zoneId);
    $arr_input['two_pairs_prob'] = $prob_data['two_pairs_prob'];
    $arr_input['three_kind_prob'] = $prob_data['three_kind_prob'];
    $arr_input['straight_prob'] = $prob_data['straight_prob'];
    $arr_input['flush_prob'] = $prob_data['flush_prob'];
    $arr_input['full_hourse_prob'] = $prob_data['full_hourse_prob'];
    $arr_input['four_kind_prob'] = $prob_data['four_kind_prob'];
    $arr_input['str_flush_prob'] = $prob_data['str_flush_prob'];
    $arr_input['five_kind_prob'] = $prob_data['five_kind_prob'];
    $arr_input['royal_flush_prob'] = $prob_data['royal_flush_prob'];
    $arr_input['bonus_game_prob'] = $prob_data['bonus_game_prob'];
    $arr_input['joker_prob'] = $prob_data['joker_prob'];
    $arr_input['true_four_kind_prob'] = $prob_data['true_four_kind_prob'];
    $arr_input['true_str_flush_prob'] = $prob_data['true_str_flush_prob'];
    $arr_input['true_five_kind_prob'] = $prob_data['true_five_kind_prob'];
    $arr_input['true_royal_flush_prob'] = $prob_data['true_royal_flush_prob'];
    $arr_input['tortoise_prob'] = $prob_data['tortoise_prob'];
    $arr_input['twinstar_prob'] = $prob_data['twinstar_prob'];
    $arr_input['balance'] = $prob_data['balance'];
    return $arr_input;
}

//取得資料內容
function get_play_station_data($db, $page) {


    //$db->debug();
    if (count($page) > 0) {
        $sql = ' SELECT psd.*, ps.ps_name, ps.psz_id 
				 FROM play_station AS ps LEFT JOIN play_station_data AS psd ON ps.ps_id = psd.ps_id WHERE ps.ps_del = 0 ';
        $sql .= $page->getSqlLimit();
    } else {
        $sql = ' SELECT COUNT(ps_id) as cnt
				 FROM play_station AS ps WHERE ps_del = 0 ';
    }
    $res = $db->dbSelectPrepare($sql, array());
    //  var_dump($res);
    return $res;
}

//選取單筆資料
function get_play_station_data_by_id($db, $id) {
    $def = ' WHERE ps_id = ?  ';
    $sql = ' SELECT *
			 FROM play_station_data ' . $def;
    $res = $db->dbSelectPrepare($sql, array($id));
    return $res[0];
}

//修改or更新
function mod_play_station_data($db, $arr_input, $id) {
    $sql = "UPDATE play_station_data ";
    $sql_where_condition = 'ps_id = ? ';
    $sql_where_value = array($id);
    $result = $db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);

    //$db->debug();
    $sql = "UPDATE play_station_log ";
    $sql_where_condition = 'ps_id = ? ';
    $arrs_input['suit_win_factor'] = 0;
    $arrs_input['twin_star'] = 0;
    $arrs_input['double_count'] = 0;
    $arrs_input['double_win_factor'] = 0;
    $arrs_input['jp_win'] = 0;
    $arrs_input['total_win'] = 0;
    $arrs_input['total_bet'] = 0;
    $arrs_input['suit_type'] = NULL;
    $sql_where_value = array($id);
    $result = $db->dbUpdatePrepare($sql, $arrs_input, $sql_where_condition, $sql_where_value);
   // die;
    return $result;
}

//新增
function add_play_station_data($db, $arr_input) {
    // $db->debug();
    $sql = "INSERT INTO play_station_data ";
    $result = $db->dbInsertPrepare($sql, $arr_input);
    return $result;
}

//修改or更新
function mod_play_station_zone_prob_data($db, $arr_input, $id) {
    $sql = "UPDATE play_station_zone_prob ";
    $sql_where_condition = 'psz_id = ? ';
    $sql_where_value = array($id);
    $result = $db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);
    return $result;
}

//選取等級機率資料
function get_play_station_level_prob($db) {
    $sql = ' SELECT * FROM poker_suit_prob ';
    $res = $db->dbSelectPrepare($sql, array());
    return $res;
}

//修改or更新等級機率資料
function mod_play_station_level_prob_data($db, $lv, $value) {
    $sql = "UPDATE poker_suit_prob ";
    $sql_where_condition = 'prob_lv = ? ';
    $sql_where_value = array($lv);
    $arr_input['prob_value'] = $value;
    $result = $db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);
    return $result;
}

//取得交班紀錄資料內容
function get_shift_member($db) {
    //$db->debug();
    $sql = ' SELECT * FROM change_shift WHERE cs_type = 1 ORDER BY cs_stime DESC ';
    $res = $db->dbSelectPrepare($sql, array());
    return $res;
}

//新增
function add_daily_report_list($db, $ml_id, $shift_id, $in_money, $out_money) {
    //$db->debug();
    unset($arr_input);
    $arr_input['rl_ctime'] = date("Y-m-d H:i:s");
    $arr_input['rl_type'] = 2;
    $arr_input['rl_mlid'] = $ml_id;
    $arr_input['rl_shift'] = $shift_id;
    $arr_input['rl_in_money'] = $in_money;
    $arr_input['rl_out_money'] = $out_money;

//$db->debug();
    // var_dump($db->debug());
    $sql = "INSERT INTO report_list ";
    $result = $db->dbInsertPrepare($sql, $arr_input);

    //  echo '<pre>';
    //var_dump($db);
    //var_dump($result);
    // die;

    return $result;
}

//新增
function add_member_op_log($db, $arr_input) {
    //$db->debug();
    $sql = "INSERT INTO member_op_log ";
    $result = $db->dbInsertPrepare($sql, $arr_input);
    return $result;
}

//傳送HTTP REQUEST GET
function send_http_get($url, $params) {
    $ch = curl_init();
    try {
        if (FALSE === $ch) {
            throw new Exception('failed to initialize');
        }
        curl_setopt($ch, CURLOPT_URL, $url . $params);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        //將curl_exec()獲取的訊息以文件流的形式返回，而不是直接輸出。
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $result = curl_exec($ch);

        if (FALSE === $result) {
            throw new Exception(curl_error($ch), curl_errno($ch));
        }
    } catch (Exception $e) {
        trigger_error(sprintf('Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
        curl_close($ch);
    }
    // 轉換為Array形式
    $res_json = json_decode($result, true);
    return $res_json;
}

?>