<?php
function get_jpot_win_record(DB $jpot_db, Pager $page, $arr_input = '')
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
    if ($arr_input['member_name']) {
        if ($daytrigger == 1)
            $def .= 'AND member_name = ? ';
        else
            $def .= 'WHERE member_name = ? ';
        $sql_input[] = $arr_input['member_name'];
    }

    $sql = 'SELECT a . * , c.jpot_name
FROM jpot_win_record AS a
LEFT JOIN jpot_setting AS c ON a.jpot_id = c.jpot_id '
        . $def .
        'ORDER BY a.created_at DESC ';
    if (is_object($page))
        $sql .= $page->getSqlLimit();

    $res = $jpot_db->dbSelectPrepare($sql, $sql_input);
    return $res;
}

function get_jpot_win_record_count(DB $jpot_db, $arr_input)
{

//    $admin_db->debug();
    $def = '';
    $daytrigger = 0;
    if ($arr_input['start_day'] && $arr_input['end_day']) {

        $def = ' WHERE a.created_at BETWEEN ? AND ? ';
        $sql_input[] = $arr_input['start_day'];
        $sql_input[] = $arr_input['end_day'];
        $daytrigger = 1;
    }
    if ($arr_input['member_name']) {
        if ($daytrigger == 1)
            $def .= 'AND member_name = ? ';
        else
            $def .= 'WHERE member_name = ? ';
        $sql_input[] = $arr_input['member_name'];
    }

    $sql = 'SELECT COUNT(*) as cnt
FROM jpot_win_record AS a
LEFT JOIN jpot_setting AS c ON a.jpot_id = c.jpot_id '
        . $def .
        'ORDER BY a.created_at DESC ';
//    $jpot_db->debug();
    $res = $jpot_db->dbSelectPrepare($sql, $arr_input);
    return $res['0']['cnt'];


}
function get_jpot_setting(DB $jpot_db)
{
    $sql = 'select a.accumulation , b.* from jpot as a LEFT outer join jpot_setting as b on a.id = b.jpot_id  ';
    $res = $jpot_db->dbSelectPrepare($sql, []);
    return $res;

}

function get_jpot_setting_once(DB $jpot_db, $id)
{
    $sql = 'select * from  jpot_setting where id = ?';
    $sql_input = [];
    $sql_input['id'] = $id;
   $res = $jpot_db->dbSelectPrepare($sql, $sql_input);
    return $res[0];

}

//
//修改or更新
function mod_jpot_setting(DB $jpot_db, $arr_input, $id)
{
    $sql = "UPDATE jpot_setting ";
    $sql_where_condition = 'id = ? ';
    $sql_where_value = array($id);
    $result = $jpot_db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);
    return $result;
}

?>