<?php

//取得資料內容
function get_admin($db, $arr_input, $page) {

    //$db->debug();
    $def = ' WHERE ad_del=0 ';
    // var_dump($def);
    if ($arr_input['ad_name']) {
        $def .= ' AND ad_name = ? ';
        $sql_input[] = $arr_input['ad_name'];
    }

    if ($arr_input['ad_mtid']) {
        if ($arr_input['ad_mtid'] == 0) {
            
        } else {
            $def .= ' AND ad_mtid = ? ';
            $sql_input[] = $arr_input['ad_mtid'];
        }
    }


    if (count($page) > 0) {
        //$def .=' ORDER BY m_start DESC , m_ctime DESC ';

        $sql = ' SELECT * 
				 FROM admin_data 
				 ' . $def;
        $sql .= $page->getSqlLimit();
    } else {
        $sql = ' SELECT COUNT(ad_id) as cnt
				 FROM admin_data 
				 ' . $def;
    }

    //var_dump($sql_input);
    $res = $db->dbSelectPrepare($sql, $sql_input);
    //var_dump($res);
    return $res;
}

function get_message($db, $arr_input, $page, $mod, $res) {

    $sql = "SELECT * FROM `contact_us` WHERE `is_del` = 0 AND `type` LIKE 'contact_us' ORDER BY `contact_us`.`create_date` DESC";
    //var_dump($sql);
    $res = $db->dbSelectPrepare($sql);
    //var_dump($res);
    return $res;
}

function get_message_1($db, $arr_input, $page, $mod, $res) {

    $sql = "SELECT * FROM `contact_us` WHERE `is_del` = 0 AND `type` LIKE 'recommand' ORDER BY `contact_us`.`create_date` DESC";
    //var_dump($sql);
    $res = $db->dbSelectPrepare($sql);
    //var_dump($res);
    return $res;
}

function get_Problem_Management($db, $arr_input, $page, $mod, $res) {
    if ($mod == 0) {
        $sql = ' SELECT * 
				 FROM question 
				 ' . $def;

        $sql = "SELECT * FROM `question` WHERE `is_del` = 0 ORDER BY `create_date` DESC";
        $res = $db->dbSelectPrepare($sql);
        //var_dump($res);
        return $res;
    }
    if ($mod == 1) {
        $sql = ' SELECT * 
				 FROM question 
				 ' . $def;

        $sql = "SELECT * FROM `question` WHERE `question_type_id` = " . $mod. " AND `is_del` = 0";
        $res = $db->dbSelectPrepare($sql);
        //var_dump($res);
        return $res;
    }
    if ($mod == 2) {
        $sql = ' SELECT * 
				 FROM question 
				 ' . $def;
        $sql = "SELECT * FROM `question` WHERE `question_type_id` = " . $mod. " AND `is_del` = 0";
        $res = $db->dbSelectPrepare($sql);
        return $res;
    }
    if ($mod == 3) {
        $sql = ' SELECT * 
				 FROM question 
				 ' . $def;
        $sql = "SELECT * FROM `question` WHERE `question_type_id` = " . $mod. " AND `is_del` = 0";
        $res = $db->dbSelectPrepare($sql);
        return $res;
    }
    //}
}

function get_questions_answered($db, $arr_input, $page, $mod, $res) {
  
        $sql = "SELECT * FROM `question2` WHERE `is_del` = 0 ORDER BY `create_date` DESC";
        $res = $db->dbSelectPrepare($sql);
        //var_dump($res);
        return $res;
   
}


function get_news($db, $arr_input, $page, $mod, $res) {
    if ($mod == 0) {
        $sql = ' SELECT * 
				 FROM news 
				 ' . $def;

        $sql = "SELECT * FROM `news` WHERE `is_del` = 0 ORDER BY `news`.`createDate` DESC";
        $res = $db->dbSelectPrepare($sql);
        return $res;
    }
    if ($mod == 1) {
        $sql = ' SELECT * 
				 FROM news 
				 ' . $def;

        $sql = "SELECT * FROM `news` WHERE `news_type` = " . $mod . " AND `is_del` = 0";
        $res = $db->dbSelectPrepare($sql);
        return $res;
    }
    if ($mod == 2) {
        $sql = ' SELECT * 
				 FROM news 
				 ' . $def;
        $sql = "SELECT * FROM `news` WHERE `news_type` = " . $mod . " AND `is_del` = 0";
        $res = $db->dbSelectPrepare($sql);
        return $res;
    }
}

function get_common_id($db, $id) {

    //var_dump($id);
    $sql = "SELECT * FROM `question` WHERE `id` = " . $id;
    //var_dump($sql);
    $res = $db->dbSelectPrepare($sql);
    return $res;
}

function get_common_one_id($db, $at_id) {

   // var_dump($db);
    $sql = 'SELECT * 
			FROM question_type 
			';
    //$db->debug();
    $res = $db->dbSelectPrepare($sql);
    // var_dump($res);
    return $res;
    //return $res;
}


function get_one_common_id($db, $at_id) {
    // var_dump(123123123);
    $sql = 'SELECT * 
			FROM question 
			WHERE id = ?
			';
    //$db->debug();
    $res = $db->dbSelectPrepare($sql, [$at_id]);
    return $db->getOneRow($res);
    //return $res;
}


function get_one_question_id($db, $at_id) {
    // var_dump(123123123);
    $sql = 'SELECT * 
			FROM question2 
			WHERE id = ?
			';
    //$db->debug();
    $res = $db->dbSelectPrepare($sql, [$at_id]);
    return $db->getOneRow($res);
    //return $res;
}


function get_news_id($db, $id) {

    //var_dump($id);
    $sql = "SELECT * FROM `news` WHERE `id` = " . $id;
    //var_dump($sql);
    $res = $db->dbSelectPrepare($sql);
    return $res;
}


function get_one_news_id($db, $at_id) {
    // var_dump(123123123);
    $sql = 'SELECT * 
			FROM news 
			WHERE id = ?
			';
    //$db->debug();
    $res = $db->dbSelectPrepare($sql, [$at_id]);
    return $db->getOneRow($res);
    //return $res;
}

function get_one_id($db, $at_id) {

   // var_dump($db);
    $sql = 'SELECT * 
			FROM news_type 
			';
    //$db->debug();
    $res = $db->dbSelectPrepare($sql);
    // var_dump($res);
    return $res;
    //return $res;
}

//新增功能

function add_common($db, $arr_input) {
    $sql = "INSERT INTO question ";
    
    $arr_input['create_date'] = date('Y-m-d H:i:s',time());
    //$aa = dateTimeNow();
    //var_dump($arr_input['create_date']);
    //$db->debug();
    //var_dump($sql);
    $result = $db->dbInsertPrepare($sql, $arr_input);
    //die();
    return $result;
}

function add_question($db, $arr_input) {
    $sql = "INSERT INTO question2 ";
    
    $arr_input['create_date'] = date('Y-m-d H:i:s',time());
    //$aa = dateTimeNow();
    //var_dump($arr_input['create_date']);
    //$db->debug();
    //var_dump($sql);
    $result = $db->dbInsertPrepare($sql, $arr_input);
    //die();
    return $result;
}



function mod_common($db, $arr_input, $id, $is_del) {
    $sql = "UPDATE question ";
    $sql_where_condition = 'id = ? ';
    $sql_where_value = array($id);
    //$db->debug();
    $result = $db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);

    return $result;
}


function mod_question($db, $arr_input, $id, $is_del) {
    $sql = "UPDATE question2 ";
    $sql_where_condition = 'id = ? ';
    $sql_where_value = array($id);
    //$db->debug();
    $result = $db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);

    return $result;
}


function add_news($db, $arr_input) {
    $sql = "INSERT INTO news ";
    //$db->debug();
    $arr_input['create_date'] = date('Y-m-d H:i:s',time());
    $result = $db->dbInsertPrepare($sql, $arr_input);
    return $result;
}

function mod_news($db, $arr_input, $id, $is_del) {
    $sql = "UPDATE news ";
    $sql_where_condition = 'id = ? ';
    $sql_where_value = array($id);
    //$db->debug();
    $result = $db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);

    return $result;
}


function mod_latest_new($db, $arr_input, $id)
{
    //var_dump($id);
    $sql = "UPDATE news ";
    $sql_where_condition = 'id = ? ';
    $sql_where_value = array($id);
    //$db->debug();
    
    $result = $db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);

    return $result;
}


function mod_latest_question($db, $arr_input, $id)
{
    //var_dump($id);
    $sql = "UPDATE question ";
    $sql_where_condition = 'id = ? ';
    $sql_where_value = array($id);
    //$db->debug();
    
    $result = $db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);

    return $result;
}


function mod_question2($db, $arr_input, $id)
{
    //var_dump($id);
    $sql = "UPDATE question2 ";
    $sql_where_condition = 'id = ? ';
    $sql_where_value = array($id);
    //$db->debug();
    
    $result = $db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);

    return $result;
}


//使用者規章
function get_User_regulations($db, $id) {

    $def = 'WHERE id =?';
    $sql = ' SELECT *
			 FROM user_regulations ' . $def;
    $sql_input['ad_id'] = $id;

    $res = $db->dbSelectPrepare($sql, $sql_input);

    // var_dump($res);
    return $res;
}




//選取單筆資料
function get_admin_id($db, $id) {
    $def = ' WHERE ad_id = ?  ';
    $sql = ' SELECT *
			 FROM admin_data ' . $def;

    $sql_input['ad_id'] = $id;

    $res = $db->dbSelectPrepare($sql, $sql_input);
    return $res[0];
}

//檢驗資料
function check_input_value($db, $arr_input, $type, $id) {
    //新增
    if ($type == 'add') {
        $def .= ' WHERE ad_del = 0 AND ad_name = ? ';

        $sql_input['ad_name'] = $arr_input["ad_name"];

        $sql = ' SELECT * FROM admin_data ' . $def;

        $res = $db->dbSelectPrepare($sql, $sql_input);

        if (count($res) > 0) {
            post_back('姓名重複');
        } else {
            //沒有重複資料，將原值丟回
            return $arr_input;
        }
    } else {
        $def .= ' WHERE ad_del = 0 AND ad_name = ? AND ad_id != ?';

        $sql = ' SELECT * FROM admin_data' . $def;

        $sql_input["ad_name"] = $arr_input["ad_name"];

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
function mod_admin($db, $arr_input, $id) {
    $sql = "UPDATE admin_data ";
    $sql_where_condition = 'ad_id = ? ';
    $sql_where_value = array($id);
    $result = $db->dbUpdatePrepare($sql, $arr_input, $sql_where_condition, $sql_where_value);
    return $result;
}

//新增
function add_admin($db, $arr_input) {
    //$db->debug();
    $sql = "INSERT INTO admin_data ";
    $result = $db->dbInsertPrepare($sql, $arr_input);

    return $result;
}

//選取帳號所有種類
function get_admin_type($db) {
    $def = ' WHERE 1  ';
    $sql = ' SELECT *
			 FROM admin_type ' . $def;

    $res = $db->dbSelectPrepare($sql, $sql_input);
    return $res;
}

?>