<?php

//個別帳號篩選期間拉霸資料內容
function get_slotlog_select($db, $arr_input, $page, $id, $gml_id, $start_date, $end_date )
{

    $page_count = count($page);         
	//var_dump($arr_input);
    //$db->debug();
    
    if( $id >= 0 ){
            $def =  ' WHERE a.gml_id = ? ' ;
        	$sql_input['gml_id'] = $id;	    
	}
	if( $arr_input['start_date'] && $arr_input['end_date'])
	{
        $def = ' WHERE a.gml_id = ? ' ;
		$def .= ' AND a.sl_time BETWEEN ? AND ? ';
        $sql_input['gml_id'] = $id;	       
		$sql_input[] = $arr_input['start_date'];
		$sql_input[] = $arr_input['end_date'];

	}
	if(count($page) > 0){

		$sql  = ' SELECT a.*, b.ml_account FROM spin_log AS a LEFT JOIN game_member_list AS b ON a.gml_id = b.gml_id '.$def;
		$sql .= $page->getSqlLimit();
	}
	else 
	{
		$sql = ' SELECT COUNT(a.gml_id) as cnt  FROM spin_log AS a LEFT JOIN game_member_list AS b ON a.gml_id = b.gml_id '.$def;
	}


	$res = $db->dbSelectPrepare( $sql,$sql_input );
	return $res;
}


//個別機台篩選期間拉霸資料內容
function get_slotlog_machine($db, $arr_input, $page, $id, $sm_id, $start_date, $end_date )
{

    $page_count = count($page);         
	//var_dump($arr_input);
    //$db->debug();
    
    if( $id >= 0 ){
            $def =  ' WHERE a.sm_id = ? ' ;
        	$sql_input['sm_id'] = $id;	    
	}
	if( $arr_input['start_date'] && $arr_input['end_date'])
	{
        $def = ' WHERE a.sm_id = ? ' ;
		$def .= ' AND a.sl_time BETWEEN ? AND ? ';
        $sql_input['sm_id'] = $id;	       
		$sql_input[] = $arr_input['start_date'];
		$sql_input[] = $arr_input['end_date'];

	}
	if(count($page) > 0){

		$sql  = ' SELECT a.*, b.sm_id FROM spin_log AS a LEFT JOIN slot_machine_data AS b ON a.sm_id = b.sm_id '.$def;
		$sql .= $page->getSqlLimit();
	}
	else 
	{
		$sql = ' SELECT COUNT(a.sm_id) as cnt  FROM spin_log AS a LEFT JOIN slot_machine_data AS b ON a.sm_id = b.sm_id '.$def;
	}


	$res = $db->dbSelectPrepare( $sql,$sql_input );
	return $res;
}

?>