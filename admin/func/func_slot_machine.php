<?php
//取得資料內容
function get_slot_machine($db,$page)
{
	//$db->debug();
	if(count($page) > 0)
	{
		$sql = ' SELECT * 
				 FROM slot_machine_data ';
		$sql .= $page->getSqlLimit();
	}
	else 
	{
		$sql = ' SELECT COUNT(sm_id) as cnt
				 FROM slot_machine_data';
	}
	$res = $db->dbSelectPrepare($sql, array());
	return $res;
}
//選取單筆資料
function get_slot_machine_by_id($db, $id)
{ 
	$def = ' WHERE sm_id = ?  ';
	$sql = ' SELECT *
			 FROM slot_machine_data '.$def;
			 
	$sql_input['sm_id'] = $id;
	
	$res = $db->dbSelectPrepare($sql,$sql_input);
	return $res[0];
}

//修改or更新
function mod_slot_machine($db,$arr_input,$id)
{
//       $db->debug();
	$sql = "UPDATE slot_machine_data ";
	$sql_where_condition 	= 'sm_id = ? ';
	$sql_where_value = array($id);
	$result = $db -> dbUpdatePrepare($sql,$arr_input,$sql_where_condition,$sql_where_value);
	return $result;
}

//新增
function add_slot_machine($db,$arr_input)
{
	//$db->debug();
	$sql = "INSERT INTO slot_machine_data ";
	$result = $db -> dbInsertPrepare($sql,$arr_input);
	return $result;
}

//清空機台記錄
function del_slot_machine($db,$arr_input,$id)
{
    //db->debug();
	$sql = "UPDATE slot_machine_data ";
	$sql_where_condition = 'sm_id = ? ';
	$sql_where_value = array($id);
	$result = $db -> dbUpdatePrepare($sql,$arr_input,$sql_where_condition,$sql_where_value);
	return $result;
}
//清空機台歷史錄
function del_slotmachine_history($db,$arrh_input,$id)
{
    //db->debug();
	$sql = "UPDATE slot_machine_history ";
	$sql_where_condition = 'sm_id = ? ';
	$sql_where_value = array($id);
	$result = $db -> dbUpdatePrepare($sql,$arrh_input,$sql_where_condition,$sql_where_value);
	return $result;
}

?>