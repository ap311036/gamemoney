<?php
//載入程式設定檔
$id_id = "login";
require("inc/inc.php");
require("func/func_slot_machine.php");
//ini_set("display_errors",1);

//========= 參數接收 op ==========

$act 				= ft($_POST['act'],1);
$id				= ft($_POST['id'],0); 
$arr_input['sm_prob']		= ft($_POST['prob'],0);
$arr_input['min_bet_per_line']	= ft($_POST['min_bet_per_line'],0);
$arr_input['max_bet_per_line']	= ft($_POST['max_bet_per_line'],0);
$arr_input['max_money']		= ft($_POST['max_money'],0);
$arr_input['min_trans_money']	= ft($_POST['min_trans_money'],0);
$arr_input['max_trans_money']	= ft($_POST['max_trans_money'],0);

//========= 參數接收 ed ==========
	switch ($act)
	{
		//新增
		case 'add':
                    $add_id = add_slot_machine($db, $arr_input);
                    if($add_id)
                    {
                            reload_js_top_href('新增成功!','slot_machine.php');
                    }
                    else 
                    {
                            reload_js_top_href('新增失敗或沒有新增!','slot_machine.php');
                    }
		break;
		
		//更新
		case 'mod':
			//更新基本資料
			$mod_id = mod_slot_machine($db,$arr_input,$id);
			if($mod_id)
			{
				reload_js_top_href('更新成功!','slot_machine.php');
			}
			else 
			{
				reload_js_top_href('更新失敗或沒有更新!','slot_machine.php');
			}
		break;
		default:
			reload_js_top_href('異常','slot_machine.php');
			exit('異常');
	}
?>