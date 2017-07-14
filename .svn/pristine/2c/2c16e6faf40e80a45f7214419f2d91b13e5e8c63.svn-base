<?php
//篩選個別帳號期間machine_slotlog資料內容
function get_machine_slotlog_excel($db, $arr_input, $sm_id, $start_day, $end_day )
{         
	//var_dump($arr_input);
    //$db->debug();
    
    if( $arr_input['start_day'] && $arr_input['end_day'] ){

        $def = ' WHERE a.sm_id = ? ' ;
		$def .= ' AND a.sl_time BETWEEN ? AND ? ';
        $sql_input['sm_id'] = $sm_id;		       
		$sql_input[] = $arr_input['start_day'];
		$sql_input[] = $arr_input['end_day'];
		   
	}else
	{
		$def =  ' WHERE a.sm_id = ? ' ;
        $sql_input['sm_id'] = $sm_id;
	}

		$sql  = ' SELECT a.*, b.* FROM spin_log AS a LEFT JOIN slot_machine_data AS b ON a.sm_id = b.sm_id '.$def;

	$res = $db->dbSelectPrepare( $sql,$sql_input );
	return $res;
}

?>