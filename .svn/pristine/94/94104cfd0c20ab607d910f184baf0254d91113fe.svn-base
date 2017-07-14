<?php
//取得資料內容
function get_game_member($db, $arr_input, $page)
{
    //$db->debug();
    $def = ' WHERE gml_del=0 ';

    if ($arr_input['ml_account']) {
        $def .= ' AND ml_account = ? ';
        $sql_input[] = $arr_input['ml_account'];
    }

    if (count($page) > 0) {
        $sql = ' SELECT * 
				 FROM game_member_list 
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

//取得詳細資料內容
function get_game_member_detail($db, $arr_input, $page)
{
    //$db->debug();
    $def = ' WHERE gml_del=0 ';

    if ($arr_input['ml_account']) {
        $def .= ' AND ml_account = ? ';
        $sql_input[] = $arr_input['ml_account'];
    }

    if (count($page) > 0) {
        $sql = ' SELECT a.*, b.*
				 FROM game_member_list AS a LEFT JOIN game_member_spin_data AS b ON a.gml_id = b.gml_id
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
function get_game_member_id($db, $id)
{
    $def = ' WHERE gml_id = ?  ';
    $sql = ' SELECT *
			 FROM game_member_list ' . $def;

    $sql_input['gml_id'] = $id;

    $res = $db->dbSelectPrepare($sql, $sql_input);
    return $res[0];
}

//選取單筆資料
function get_game_member_id_by_name($db, $name)
{
    $def = ' WHERE gml_name = ?  ';
    $sql = ' SELECT *
			 FROM game_member_list ' . $def;

    $sql_input['gml_name'] = $name;

    $res = $db->dbSelectPrepare($sql, $sql_input);
    return $res[0]['gml_id'];
}

//檢驗資料
function check_game_member_input_value($db, $arr_input, $type, $id)
{
    //新增
    if ($type == 'add') {
        $def .= ' WHERE gml_del = 0 AND gml_name = ? ';

        $sql_input['gml_name'] = $arr_input["gml_name"];

        $sql = ' SELECT * FROM game_member_list ' . $def;

        $res = $db->dbSelectPrepare($sql, $sql_input);

        if (count($res) > 0) {
            post_back('姓名重複');

        } else {
            //沒有重複資料，將原值丟回
            return $arr_input;
        }
    } else {
        $def .= ' WHERE gml_del = 0 AND gml_name = ? AND gml_id != ?';

        $sql = ' SELECT * FROM game_member_list' . $def;

        $sql_input["gml_name"] = $arr_input["gml_name"];

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
function mod_game_member($db, $arr_input, $id)
{
    $sql = "UPDATE game_member_list ";
    $sql_where_condition = 'gml_id = ? ';
    $sql_where_value = array($id);
    $result = $db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);
    return $result;
}

//新增
function add_game_member($db, $arr_input)
{
    //$db->debug();
    $sql = "INSERT INTO game_member_list ";
    $result = $db->dbInsertPrepare($sql, $arr_input);
    return $result;
}

?>