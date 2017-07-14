<?php
//取得資料內容
function get_deposits($admin_db, $page, $arr_input = '')
{
//    $arr_input['name'] = 'brian';
//    $arr_input['start_day'] = '2016-12-19 00:00:00';
//    $arr_input['end_day'] = '2016-12-20 00:00:00';
//    $admin_db->debug();
    $def = '';
    $daytrigger = 0;
    if ($arr_input['start_day'] && $arr_input['end_day']) {

        $def = ' WHERE a.create_date BETWEEN ? AND ? ';
        $sql_input[] = $arr_input['start_day'];
        $sql_input[] = $arr_input['end_day'];
        $daytrigger = 1;
    }
    if ($arr_input['name']) {
        if ($daytrigger == 1)
            $def .= 'AND b.name = ? ';
        else
            $def .= 'WHERE b.name = ? ';
        $sql_input[] = $arr_input['name'];
    }

    $sql = 'SELECT a . * , b.name , c.name as card_type
FROM card_deposit AS a
LEFT JOIN member AS b ON a.member_id = b.id
LEFT JOIN card_deposit_type AS c ON a.type = c.id '
        . $def .
        'ORDER BY a.create_date DESC ';
    if (is_object($page))
        $sql .= $page->getSqlLimit();

    $res = $admin_db->dbSelectPrepare($sql, $sql_input);
    return $res;
}

function get_deposits_count($admin_db, $arr_input)
{

//    $admin_db->debug();
    $def = '';
    $daytrigger = 0;
    if ($arr_input['start_day'] && $arr_input['end_day']) {

        $def = ' WHERE a.create_date BETWEEN ? AND ? ';
        $sql_input[] = $arr_input['start_day'];
        $sql_input[] = $arr_input['end_day'];
        $daytrigger = 1;
    }
    if ($arr_input['name']) {
        if ($daytrigger == 1)
            $def .= 'AND b.name = ? ';
        else
            $def .= 'WHERE b.name = ? ';
        $sql_input[] = $arr_input['name'];
    }

    $sql = 'SELECT COUNT(*) as cnt
FROM card_deposit AS a
LEFT JOIN member AS b ON a.member_id = b.id
LEFT JOIN card_deposit_type AS c ON a.type = c.id '
        . $def.
        'ORDER BY a.create_date DESC ';

    $res = $admin_db->dbSelectPrepare($sql, $arr_input);
    return $res['0']['cnt'];


}


//手動儲值專用
function add_deposit($db, $arr_input)
{
//    $db = new DB;
    $arr_input['type'] = 2;

    $arr_input['create_date'] = date("Y-m-d H:i:s");
//    $arr_input['status'] = 1;

//    $arr_input['admin_name'] = $_SESSION['admin_name'];
    $sql = "INSERT INTO card_deposit ";
//    $db->debug();
    $result = $db->dbInsertPrepare($sql, $arr_input);

    return $result;


}

function log_deposit($db, $member_id, $deposit)
{
//    $db = new DB;
//    $db->debug();
    $mapData = [];
    //找出之前紀錄
    $sql = 'select * from card_deposit_sum where member_id = ? ';
    $res = $db->dbSelectPrepare($sql, array('member_id' => $member_id));
//    var_dump($record);
    $record = $db->getOneRow($res);
    if ($record) {
        $sql = 'update card_deposit_sum';
        $sql_where_condition = 'member_id = ? ';
        $sql_where_value = [$member_id];
        $original = $record['deposit_sum'];
        $mapData['deposit_sum'] = $original + $deposit;
        $mapData['update_date'] = date("Y-m-d H:i:s");
        $db->dbUpdatePrepare($sql, $mapData, $sql_where_condition, $sql_where_value);
    } else {
        $sql = 'insert into card_deposit_sum ';
        $mapData['member_id'] = $member_id;
        $mapData['deposit_sum'] = $deposit;
        $mapData['create_date'] = date("Y-m-d H:i:s");
        $mapData['update_date'] = date("Y-m-d H:i:s");
        $db->dbInsertPrepare($sql, $mapData);
    }
    return true;


}

//篩選個別帳號期間PLAYLOG資料內容
function get_deposit_excel($admin_db, $arr_input, $member_id)
{
    //var_dump($arr_input);
    //$db->debug();

    if ($arr_input['start_day'] && $arr_input['end_day']) {

        $def = ' WHERE a.create_date BETWEEN ? AND ? ';
        $def .= 'ORDER BY a.create_date ASC';
        $sql_input[] = $arr_input['start_day'];
        $sql_input[] = $arr_input['end_day'];

    } else {
        $def = ' WHERE a.member_id = ? ';
        $def .= 'ORDER BY a.create_date ASC';
        $sql_input['gml_id'] = $member_id;
    }

    $sql = 'SELECT a . * , b.name , c.name as card_type
FROM card_deposit AS a
LEFT JOIN member AS b ON a.member_id = b.id
LEFT JOIN card_deposit_type AS c ON a.type = c.id
' . $def;
    //ORDER BY a.create_date ASC

    $res = $admin_db->dbSelectPrepare($sql, $sql_input);
    return $res;
}

?>