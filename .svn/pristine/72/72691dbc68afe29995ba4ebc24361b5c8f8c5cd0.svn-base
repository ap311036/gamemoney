<?php
//取得資料內容
function get_play_log_count_by_suittype($db, $ps_id, $suittype, $full_bet)
{ 
    //$db->debug();
	$def = ' WHERE ps_id = ? AND suit_type = ?  ';
       if ($full_bet)
       {
           $def .= ' AND total_bet = psz_id * 40 ';
       }
	$sql = ' SELECT count(1) AS count
			 FROM play_station_log '.$def;
        
       // var_dump($sql);
	$res = $db->dbSelectPrepare($sql, array($ps_id, $suittype));
	return $res[0];
}

//篩選個別機台一段時間內LOG資料內容
function get_ps_log($db, $arr_input, $page, $id, $start_date, $end_date )
{
    $page_count = count($page);         
	//var_dump($arr_input);
   //$db->debug();
    
    if( $id >= 0 )
    {
        $def =  ' WHERE a.ps_id = ? ' ;
        $sql_input['ps_id'] = $id;	    
    }
    
    if( $arr_input['start_date'] && $arr_input['end_date'])
    {
        $def = ' WHERE a.ps_id = ? ' ;
                $def .= ' AND a.ps_time BETWEEN ? AND ? ';
        $sql_input['ps_id'] = $id;		       
        $sql_input[] = $arr_input['start_date'];
        $sql_input[] = $arr_input['end_date'];
    }
    
    if(count($page) > 0)
    {
        $sql  = ' SELECT a.* FROM play_station_log AS a '.$def;
        $sql .= $page->getSqlLimit();
    }
    else 
    {
        $sql = ' SELECT COUNT(1) as cnt FROM play_station_log AS a '.$def;
    }
    $res = $db->dbSelectPrepare( $sql,$sql_input );
    return $res;
}

//取得機台一段時間內操作LOG資料內容
function get_operator_log($db, $start_date)
{ 
    //$db->debug();
    if( $start_date)
    {
        $def = ' WHERE a.pso_time >= ? ';
        $sql_input = array($start_date);		       
    }
    else
    {
        $def = '';
        $sql_input = array();
    }

    $def .= ' ORDER BY id DESC ';

    $sql = ' SELECT * FROM play_station_operator_log AS a '.$def;
    $res = $db->dbSelectPrepare($sql, $sql_input);
    return $res;
}

//取得交班紀錄資料內容
function get_change_shift($db)
{
    //$db->debug();
    $sql = ' SELECT * FROM change_shift WHERE cs_type = 1 ORDER BY cs_id DESC limit 0,1 ';
    $res = $db->dbSelectPrepare($sql,array());
    return $res;
}

?>