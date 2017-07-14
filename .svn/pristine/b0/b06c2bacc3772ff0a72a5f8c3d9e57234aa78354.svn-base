<?php

//取得資料內容
function get_game_center_list($admin_db) {

    $sql = "select * from game_center_list order by order_id asc";
    $res = $admin_db->dbSelectPrepare($sql, []);
    return $res;
}

function get_product_information($admin_db) {

    $sql = "SELECT * FROM  `pay2go_items` WHERE  `pay_del` !=1";
    $res = $admin_db->dbSelectPrepare($sql, []);
    return $res;
}

function img_date($img_d) {
    $parten = '#src\s*=\s*["|\']*\s*(.[^>"\'\s]+)#i';
    preg_match_all($parten, $img_d, $pic);
    //$arr_input['img'] .= $img;W    
    return $pic[1];
}

//
////取得詳細資料內容
function get_game_intro_detail($admin_db, $arr_input, $page) {
//    $admin_db->debug();
    $def = ' ';
    if ($arr_input['center']) {
        $def .= ' WHERE a.title = ? ';
        $sql_input[] = $arr_input['center'];
    }

    if (count($page) > 0) {
        $def .= 'order by a.order_id, b.order_id asc ';
        $sql = 'select a.title as center, b.* from game_center_list as a 
left outer join game_intro_list as b on a.id = b.gc_id  
				 ' . $def;
        $sql .= $page->getSqlLimit();
    } else {
        $sql = ' SELECT COUNT(*) as cnt
				 from game_center_list as a 
left outer join game_intro_list as b on a.id = b.gc_id  
				 ' . $def;
    }
    $res = $admin_db->dbSelectPrepare($sql, $sql_input);
    return $res;
}

function get_game_intro_pkmax($admin_db) {

    $sql = ' SELECT max(id) as max
				 from game_intro_list ';

    $res = $admin_db->dbSelectPrepare($sql, []);
    return $res['max'];
}

function get_game_intro_once($admin_db, $id) {
    $def = 'where b.id = ? ';
    $sql = 'select a.title as center, b.* from game_center_list as a 
left outer join game_intro_list as b on a.id = b.gc_id  
				 ' . $def;

    $sql_input['id'] = $id;

    $res = $admin_db->dbSelectPrepare($sql, $sql_input);
    return $res[0];
}

//修改or更新
function mod_game_intro($admin_db, $arr_input, $id) {
    $sql = "UPDATE game_intro_list ";
    $sql_where_condition = 'id = ? ';
    $sql_where_value = array($id);
    $result = $admin_db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);
    return $result;
}

function get_dup_game_intro($admin_db, $order_id, $gc_id, $not_id) {
    $sql = "select * from game_intro_list where gc_id = ? and order_id = ? and id != ?";
    $arr_input = [];
    $arr_input['gc_id'] = $gc_id;
    $arr_input['order_id'] = $order_id;
    $arr_input['id'] = $not_id;
    $result = $admin_db->dbSelectPrepare($sql, $arr_input);
    return $result[0];
}

function get_max_game_intro_order($admin_db, $gc_id) {
    $sql = "select max(order_id) as max from game_intro_list where gc_id = ? ";
    $arr_input = [];
    $arr_input['gc_id'] = $gc_id;
    $result = $admin_db->dbSelectPrepare($sql, $arr_input);
    return $result['max'];
}

//新增
function add_game_intro($admin_db, $arr_input) {
    //var_dump($arr_input);
    // $db->debug();
    $sql = "INSERT INTO game_intro_list ";
    $arr_input['created_at'] = date('Y-m-d H:i:s');
    //$db->debug();
    $result = $admin_db->dbInsertPrepare($sql, $arr_input);
    //var_dump($result);
//die();
    return $result;
}

//
////選取單筆資料
//function get_game_member_id($db, $id)
//{
//    $def = ' WHERE gml_id = ?  ';
//    $sql = ' SELECT *
//			 FROM game_member_list ' . $def;
//
//    $sql_input['gml_id'] = $id;
//
//    $res = $db->dbSelectPrepare($sql, $sql_input);
//    return $res[0];
//}
//
////選取單筆資料
//function get_game_member_id_by_name($db, $name)
//{
//    $def = ' WHERE gml_name = ?  ';
//    $sql = ' SELECT *
//			 FROM game_member_list ' . $def;
//
//    $sql_input['gml_name'] = $name;
//
//    $res = $db->dbSelectPrepare($sql, $sql_input);
//    return $res[0]['gml_id'];
//}
//
////檢驗資料
//function check_game_member_input_value($db, $arr_input, $type, $id)
//{
//    //新增
//    if ($type == 'add') {
//        $def .= ' WHERE gml_del = 0 AND gml_name = ? ';
//
//        $sql_input['gml_name'] = $arr_input["gml_name"];
//
//        $sql = ' SELECT * FROM game_member_list ' . $def;
//
//        $res = $db->dbSelectPrepare($sql, $sql_input);
//
//        if (count($res) > 0) {
//            post_back('姓名重複');
//
//        } else {
//            //沒有重複資料，將原值丟回
//            return $arr_input;
//        }
//    } else {
//        $def .= ' WHERE gml_del = 0 AND gml_name = ? AND gml_id != ?';
//
//        $sql = ' SELECT * FROM game_member_list' . $def;
//
//        $sql_input["gml_name"] = $arr_input["gml_name"];
//
//        $sql_input["id"] = $id;
//
//        $res = $db->dbSelectPrepare($sql, $sql_input);
//        //print_r(count($res));
//
//        if (count($res) > 0) {
//            //exit();
//            post_back('客戶姓名 重複');
//        } else {
//            //exit();
//            //沒有重複資料，將原值丟回
//            return $arr_input;
//        }
//    }
//}
//
//修改or更新
function mod_game_center($admin_db, $arr_input, $id) {
    $sql = "UPDATE game_center_list ";
    $sql_where_condition = 'id = ? ';
    $sql_where_value = array($id);
    $result = $admin_db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);
    return $result;
}

function delete_package($admin_db, $arr_input, $id) {
    //$admin_db->debug();
    $sql = "UPDATE pay2go_items ";
    $sql_where_condition = 'id = ? ';
    $arr_input['pay_del'] = 1;
    $sql_where_value = array($id);
    var_dump($id);
        var_dump($admin_db);

    $result = $admin_db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);
    return $result;
}

function mod_package($admin_db, $arr_input, $id) {
    $sql = "UPDATE pay2go_items ";
    $sql_where_condition = 'id = ? ';
    $sql_where_value = array($id);
    $result = $admin_db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);
    return $result;
}

//新增
function add_game_center($admin_db, $arr_input) {
    //$db->debug();
    $sql = "INSERT INTO game_center_list ";
    $arr_input['created_at'] = date('Y-m-d H:i:s');
    $result = $admin_db->dbInsertPrepare($sql, $arr_input);
    return $result;
}

function add_package($admin_db, $arr_input) {
    //$db->debug();
    $sql = "INSERT INTO pay2go_items";
    $result = $admin_db->dbInsertPrepare($sql, $arr_input);
    return $result;
}

//選取單筆資料
function get_game_center_id($admin_db, $id) {
    $def = ' WHERE id = ?  ';
    $sql = ' SELECT *
			 FROM game_center_list ' . $def;

    $sql_input['id'] = $id;

    $res = $admin_db->dbSelectPrepare($sql, $sql_input);
    return $res[0];
}

function get_producd_id($admin_db, $id) {
    $def = ' WHERE id = ?  ';
    $sql = ' SELECT *
			 FROM pay2go_items ' . $def;

    $sql_input['id'] = $id;

    $res = $admin_db->dbSelectPrepare($sql, $sql_input);
    return $res[0];
}

function get_game_center_order_dup($admin_db, $order_id, $not_id) {
    $def = ' WHERE order_id = ? AND id != ? ';
    $sql = ' SELECT *
			 FROM game_center_list ' . $def;

    $sql_input['order_id'] = $order_id;
    $sql_input['id'] = $not_id;

    $res = $admin_db->dbSelectPrepare($sql, $sql_input);
    return $res[0];
}

?>