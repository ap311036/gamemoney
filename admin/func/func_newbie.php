<?php
function get_dup_newbie($admin_db, $order_id ,$not_id)
{
    $sql = "select * from newbie_guide where order_id = ? and id != ?";
    $arr_input = [];
    $arr_input['order_id'] = $order_id;
    $arr_input['id'] = $not_id;
//    $admin_db->debug();
    $result = $admin_db->dbSelectPrepare($sql, $arr_input);
    return $result[0];
}


function get_newbie_pkmax($admin_db)
{

    $sql = ' SELECT max(id) as max
				 from newbie_guide ';

    $res = $admin_db->dbSelectPrepare($sql, []);
    return $res['max'];
}

//取得資料內容
function get_newbie_guide($admin_db)
{

    $sql = "select * from newbie_guide 
order by order_id asc";
    $res = $admin_db->dbSelectPrepare($sql, []);
    return $res;
}

//


function get_newbie_guide_once($admin_db, $id)
{
    $sql = "select * from newbie_guide where id = ?
				 ";

    $sql_input['id'] = $id;
//    $admin_db->debug();
    $res = $admin_db->dbSelectPrepare($sql, $sql_input);
    return $res[0];
}

//修改or更新
function mod_newbie_guide($admin_db, $arr_input, $id)
{
    $sql = "UPDATE newbie_guide ";
    $sql_where_condition = 'id = ? ';
    $sql_where_value = array($id);
//    $admin_db->debug();
    $result = $admin_db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);
//    die;
    return $result;
}


//新增
function add_newbie_guide($admin_db, $arr_input)
{
    //$db->debug();
    $sql = "INSERT INTO newbie_guide ";
    $arr_input['created_at'] = date('Y-m-d H:i:s');
    $result = $admin_db->dbInsertPrepare($sql, $arr_input);
    return $result;
}


?>