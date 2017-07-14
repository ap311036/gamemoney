<?php
//載入程式設定檔
$id_id = "login";
require("inc/inc.php");
require(furl . "func/func_service.php");

//ini_set("display_errors",1);

//========= 參數接收 op ==========
//var_dump($_POST);
$sql = 'update user_rule';
$sql_where_condition = 'id = ?';
$sql_where_value = ['id'=>1];
$sql_input_data=[];
$sql_input_data['content'] = ft($_POST['content'],7);
$admin_db->debug();
$admin_db->dbUpdatePrepare($sql, $sql_input_data, $sql_where_condition, $sql_where_value);




?>