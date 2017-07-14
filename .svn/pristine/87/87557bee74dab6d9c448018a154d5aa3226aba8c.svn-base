<?php
//載入程式設定檔
$id_id = "login";
require("inc/inc.php");
require("func/func_play_station.php");
//ini_set("display_errors",1);

//========= 參數接收 op ==========

$act 				= ft($_POST['act'],1);
$id				= ft($_POST['id'],0); 
$zoneId                      = ft($_POST['zone'],0);
if ($act == null)
{
    $act = ft($_GET['act'],1);
    $id = ft($_GET['id'],0); 
}

//========= 參數接收 ed ==========
	switch ($act)
	{
		//新增
		case 'add':
                    $ps_input['psz_id'] = $zoneId;
                    $ps_input['ps_name'] = ft($_POST['ps_name'],1);
                    $add_id = add_play_station($db, $ps_input);
                    if ($add_id)
                    {
                            $arr_input['ps_id'] = $add_id;
                            $arr_input = fill_ps_prob_data($db, $zoneId, $arr_input);
                            $arr_input = fill_ps_zone_data($db, $zoneId, $arr_input);
                            add_play_station_prob($db, $arr_input);
                            
                            $data_input['ps_id'] = $add_id;
                            add_play_station_data($db, $data_input);
                            
                            $shift_member = get_shift_member($db);
                            $log_input['mo_ml_id'] = $shift_member[0]['cs_mlid'];
                            $log_input['mo_ps_id'] = $id;
                            $log_input['mo_op_type'] = 2;
                            $log_input['mo_time'] = date("Y-m-d H:i:s");
                            $log_input['mo_note'] = json_encode($arr_input);
                            add_member_op_log($db, $log_input);

                            reload_js_top_href('新增成功!','ps_zone_list.php');
                    }
                    else 
                    {
                            reload_js_top_href('新增失敗或沒有新增!','ps_zone_list.php');
                    }
		break;
		
		//更新
		case 'mod':
                     $ps_input['psz_id'] = $zoneId;
                     $ps_input['ps_name'] = ft($_POST['ps_name'],1);
		       $mod_id = mod_play_station($db,$ps_input,$id);
			if ($mod_id)
			{
                            $arr_input['one_bet']                  = ft($_POST['one_bet'],0);
                            $arr_input['start_score_max']           = ft($_POST['start_score_max'],0);
                            $arr_input['start_score_one_score']	= ft($_POST['start_score_one_score'],0);
                            $arr_input['min_up_score_value']		= ft($_POST['min_up_score_value'],0);
                            $arr_input['max_down_score_value']      = ft($_POST['max_down_score_value'],0);
                            $arr_input['down_score_one_score']      = ft($_POST['down_score_one_score'],0);
                            $arr_input['down_score_add_score']      = ft($_POST['down_score_add_score'],0);
                            $arr_input['two_pairs_multiple']		= ft($_POST['two_pairs_multiple'],0);
                            $arr_input['three_kind_multiple']		= ft($_POST['three_kind_multiple'],0);
                            $arr_input['straight_multiple']		= ft($_POST['straight_multiple'],0);
                            $arr_input['flush_multiple']           = ft($_POST['flush_multiple'],0);
                            $arr_input['full_hourse_multiple']      = ft($_POST['full_hourse_multiple'],0);
                            $arr_input['four_kind_multiple']		= ft($_POST['four_kind_multiple'],0);
                            $arr_input['str_flush_multiple']		= ft($_POST['str_flush_multiple'],0);
                            $arr_input['five_kind_multiple']		= ft($_POST['five_kind_multiple'],0);
                            $arr_input['royal_flush_multiple']      = ft($_POST['royal_flush_multiple'],0);
                            mod_play_station_prob($db,$arr_input,$id);

                            $shift_member = get_shift_member($db);
                            $log_input['mo_ml_id'] = $shift_member[0]['cs_mlid'];
                            $log_input['mo_ps_id'] = $id;
                            $log_input['mo_op_type'] = 1;
                            $log_input['mo_time'] = date("Y-m-d H:i:s");
                            $log_input['mo_note'] = json_encode($arr_input);
                            add_member_op_log($db, $log_input);
                            
				reload_js_top_href('更新成功!','ps_zone_list.php');
			}
			else 
			{
				reload_js_top_href('更新失敗或沒有更新!','ps_zone_list.php');
			}
		break;
		//刪除
		case 'del':
                    $play_station = get_play_station_by_id($db, $id);
                    if ($play_station['ps_statue'] != 0)
                    {
				reload_js_top_href('機台使用中，無法刪除!','ps_zone_list.php');
                            break;
                    }

                    $arr_input['ps_del'] = 1;
			if(mod_play_station($db,$arr_input,$id))
			{
				reload_js_top_href('刪除成功!','ps_zone_list.php');
			}
			else
			{
				reload_js_top_href('刪除失敗或沒有刪除!','ps_zone_list.php');
			}
		break;
		default:
			reload_js_top_href('異常','ps_zone_list.php');
			exit('異常');
	}
?>