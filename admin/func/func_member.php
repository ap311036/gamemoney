<?php
function mod_member_admin($admin_db, $arr_input, $id)
{
    $sql = "UPDATE member ";
    $sql_where_condition = 'id=? ';
    $sql_where_value = array($id);
//    $admin_db->debug();
    $result = $admin_db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);
    return $result;
}


//取得資料內容
function get_member($db, $arr_input, $page)
{
    //$db->debug();
    $def = ' WHERE is_del=0 ';

    if ($arr_input['account']) {
        $def .= ' AND account = ? ';
        $sql_input[] = $arr_input['account'];
    }

    if (count($page) > 0) {
        $sql = ' SELECT * 
				 FROM member 
				 ' . $def;
        $sql .= $page->getSqlLimit();
    } else {
        $sql = ' SELECT COUNT(id) as cnt
				 FROM member 
				 ' . $def;
    }

    $res = $db->dbSelectPrepare($sql, $sql_input);
    return $res;
}

//取得資料內容
function get_member_once_strict($admin_db, $phone,$account)
{

//    $db = new DB;

    $sql = 'Select * from member WHERE phone = ? AND account = ? ';
//$admin_db->debug();
    $res = $admin_db->dbSelectPrepare($sql, [$phone, $account]);
//    var_dump($res);
    return $admin_db->getOneRow($res);
}

//取得詳細資料內容
function get_member_detail($db, $arr_input, $page)
{
    //$db->debug();
    $def = ' WHERE gml_del=0 ';

    if ($arr_input['gml_name']) {
        $def .= ' AND gml_name = ? ';
        $sql_input[] = $arr_input['gml_name'];
    }

    if (count($page) > 0) {
        $sql = ' SELECT a.*, b.*
				 FROM member AS a LEFT JOIN game_member_spin_data AS b ON a.gml_id = b.gml_id
				 ' . $def;
        $sql .= $page->getSqlLimit();
    } else {
        $sql = ' SELECT COUNT(gml_id) as cnt
				 FROM game_member_list 
				 ' . $def;
    }

    $res = $db->dbSelectPrepare($sql, $sql_input);
    return $res;
}

//選取單筆資料
function get_member_id($db, $id)
{
    $def = ' WHERE id = ?  ';
    $sql = ' SELECT *
			 FROM member ' . $def;

    $sql_input['id'] = $id;

    $res = $db->dbSelectPrepare($sql, $sql_input);
    return $res[0];
}

//選取單筆資料
function get_member_id_by_name($db, $name)
{
    $def = ' WHERE member = ?  ';
    $sql = ' SELECT *
			 FROM member ' . $def;

    $sql_input['name'] = $name;

    $res = $db->dbSelectPrepare($sql, $sql_input);
    return $res[0]['id'];
}

//檢驗資料
function check_input_value($db, $arr_input, $type, $id)
{
    //新增
    if ($type == 'add') {
        $def .= ' WHERE is_del = 0 AND name = ? ';

        $sql_input['name'] = $arr_input["name"];

        $sql = ' SELECT * FROM member ' . $def;

        $res = $db->dbSelectPrepare($sql, $sql_input);

        if (count($res) > 0) {
            post_back('姓名重複');

        } else {
            //沒有重複資料，將原值丟回
            return $arr_input;
        }
    } else {
        $def .= ' WHERE is_del = 0 AND name = ? AND id != ?';

        $sql = ' SELECT * FROM member' . $def;

        $sql_input["name"] = $arr_input["name"];

        $sql_input["id"] = $id;

        $res = $db->dbSelectPrepare($sql, $sql_input);
        //print_r(count($res));

        if (count($res) > 0) {
            //exit();
            post_back('客戶姓名 重複');
        } else {
            //exit();
            //沒有重複資料，將原值丟回
            return $arr_input;
        }
    }
}

//修改or更新
function mod_member($db, $arr_input, $id)
{
    $sql = "UPDATE member ";
    $sql_where_condition = 'id = ? ';
    $sql_where_value = array($id);
    $result = $db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);
    return $result;
}

//新增
function add_member($db, $arr_input)
{
    //$db->debug();
    $sql = "INSERT INTO member ";
    $result = $db->dbInsertPrepare($sql, $arr_input);
    return $result;
}

//選取單筆資料
function get_member_by_account($db, $account)
{
    $sql = ' SELECT * FROM member WHERE account = ? ';
    $sql_input['account'] = $account;
    $result = $db->dbSelectPrepare($sql, $sql_input);
    return $result;
}

//取得資料內容
function get_member_login($db, $arr_input, $page)
{
    //$db->debug();
    $def = '';
    $order = ' order by l.createDate desc ';
    if ($arr_input['account']) {
        $def .= ' AND m.account = ? ';
        $sql_input[] = $arr_input['account'];
    }

    if (count($page) > 0) {
        $sql = ' SELECT l.*, m.name, m.account FROM member_login_log AS l INNER JOIN member AS m ON l.member_id = m.id ' . $def.$order;
        $sql .= $page->getSqlLimit();
    } else {
        $sql = ' SELECT COUNT(l.id) as cnt FROM member_login_log AS l INNER JOIN member AS m ON l.member_id = m.id ' . $def.$order;
    }
    $res = $db->dbSelectPrepare($sql, $sql_input);
    return $res;
}

//取得資料內容
function get_member_transform_log($db, $arr_input, $page)
{
    //$db->debug();
    $def = '';
    $order = ' order by tl.create_at desc ';
    if ($arr_input['account']) {
        $def .= ' AND mo.account = ? ';
        $sql_input[] = $arr_input['account'];
    }

    if (count($page) > 0) {
        $sql = ' SELECT tl.*, mo.name AS out_name, mo.account AS out_account, mi.name AS in_name, mi.account AS in_account FROM member_transfer_log AS tl INNER JOIN member AS mo ON tl.transfer_id = mo.id INNER JOIN member AS mi ON tl.reciever_id = mi.id ' . $def.$order;
        $sql .= $page->getSqlLimit();
    } else {
        $sql = ' SELECT COUNT(tl.id) as cnt FROM member_transfer_log AS tl INNER JOIN member AS mo ON tl.transfer_id = mo.id ' . $def.$order;
    }
    $res = $db->dbSelectPrepare($sql, $sql_input);
    return $res;
}

?>