<?php
//==================
// 讀id通用式
//==================
function db_select_anyid($db,$table,$id_name,$id)
{
	$sql = "SELECT * FROM ".$table;
	if($id_name && $id)
	{
		$sql .= " WHERE ".$id_name." = ?";
		$arr_input = array($id);
	}
	$result = $db->dbSelectPrepare($sql,$arr_input);
	
	return $result;
}

//==================
// 用id修改單欄位通用式
//==================
function db_update_anyid($db,$table,$update_name,$update_var,$id_name,$id)
{

	
	$sql = "UPDATE ".$table;
	
	$arr_input[$update_name]   = $update_var ;
	
	$sql_where_condi = $id_name." = ?";
	$sql_where_value = array($id);
	
	$result = $db->dbUpdatePrepare($sql,$arr_input,$sql_where_condi,$sql_where_value);
	return $result;
}

//==================
// 新增單一筆資料通用格式
//==================
function db_insert_anyid($db,$table,$arr_input)
{
	$sql = "INSERT INTO ".$table;
	
	$result = $db->dbInsertPrepare($sql,$arr_input);
	return $result;
}



?>
