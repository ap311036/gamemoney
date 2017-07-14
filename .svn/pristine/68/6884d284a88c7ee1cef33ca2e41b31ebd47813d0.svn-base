<?php
//篩選個別帳號期間PLAYLOG資料內容
function get_slotlog_excel($db, $arr_input, $page, $gmlId, $start_day, $end_day )
{         
	//var_dump($arr_input);
    //$db->debug();
    
    if( $arr_input['start_day'] && $arr_input['end_day'] ){

        $def = ' WHERE a.gml_id = ? ' ;
		$def .= ' AND a.sl_time BETWEEN ? AND ? ';
        $sql_input['gml_id'] = $gmlId;		       
		$sql_input[] = $arr_input['start_day'];
		$sql_input[] = $arr_input['end_day'];
		   
	}else
	{
		$def =  ' WHERE a.gml_id = ? ' ;
        $sql_input['gml_id'] = $gmlId;
	}

		$sql  = ' SELECT a.*, b.gml_name FROM spin_log AS a LEFT JOIN game_member_list AS b ON a.gml_id = b.gml_id '.$def;

	$res = $db->dbSelectPrepare( $sql,$sql_input );
	return $res;
}

?>