<?php
//載入程式設定檔
$id_id = "login";
require("inc/inc.php");
require("func/func_slot_machine.php");
//ini_set("display_errors",1);

//========= 參數接收 op ==========

$id									= ft($_GET['id'],0); 
$arr_input['total_win']				= ft($_POST['total_win']=0,0);
$arr_input['all_same_win']			= ft($_POST['all_same_win']=0,0);
$arr_input['total_bet']				= ft($_POST['total_bet']=0,0);
$arr_input['all_same_count']		= ft($_POST['all_same_count']=0,0);
$arr_input['spin_count']			= ft($_POST['spin_count']=0,0);
$arr_input['spin_win']			    = ft($_POST['spin_win']=0,0);
$arr_input['bonus_count']			= ft($_POST['bonus_count']=0,0);
$arr_input['bonus_win']			    = ft($_POST['bonus_win']=0,0);

$arrh_input['non_bonus_count']			    = ft($_POST['non_bonus_count']='0,0,0,0',1);
$arrh_input['non_all_same_count']			= ft($_POST['non_all_same_count']='0,0,0,0',1);
$arrh_input['non_true_all_same_count']		= ft($_POST['non_true_all_same_count']='0,0,0,0',1);

//========= 參數接收 ed ==========
			//機台記錄
			$del_id = del_slot_machine($db,$arr_input,$id);
			if($del_id)
			{
				reload_js_top_href('清除成功!','slot_machine.php');
			}
			else 
			{
				reload_js_top_href('清除失敗!','slot_machine.php');
			}

			//機台歷史記錄
			$del_id = del_slotmachine_history($db,$arrh_input,$id);
			if($del_id)
			{
				reload_js_top_href('清除成功!','slot_machine.php');
			}
			else 
			{
				reload_js_top_href('清除失敗!','slot_machine.php');
			}			

		
?>