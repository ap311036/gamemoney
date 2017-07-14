<?php
//載入程式設定檔
$id_id = "login";
require("inc/inc.php");
require("func/func_game_member.php");
//ini_set("display_errors",1);

//========= 參數接收 op ==========

$act 				= ft($_POST['act'],1);
$id				= ft($_POST['id'],0); 
$arr_input['gml_name']		= ft($_POST['gml_name'],1);
$arr_input['ml_account']	= ft($_POST['ml_account'],1);
$arr_input['gml_del']		= ft($_POST['gml_del'],1);

$number = ft($_POST["number"],0);

if($act == '')
{
	$act		= ft($_GET['act'],1);	
	$del_id		= ft($_GET['id'],0);
	$start		= ft($_GET['start'],0);
}	
//$act = "addsn";
//echo $act;

//========= 參數接收 ed ==========
	switch ($act)
	{
		//新增
		case 'add':
                    //檢驗
                    $arr_input = check_game_member_input_value($db,$arr_input,$act);
                    $add_id = add_game_member($db, $arr_input);
                    if($add_id)
                    {
                            reload_js_top_href('新增成功!','game_member.php');
                    }
                    else 
                    {
                            reload_js_top_href('新增失敗或沒有新增!','game_member.php');
                    }
		break;
		
		//更新
		case 'mod':
			//檢驗
			$arr_input = check_game_member_input_value($db,$arr_input,$act,$id);
			//更新基本資料
			$mod_id = mod_game_member($db,$arr_input,$id);
			if($mod_id)
			{
				reload_js_top_href('更新成功!','game_member.php');
			}
			else 
			{
				reload_js_top_href('更新失敗或沒有更新!','game_member.php');
			}
		break;
		
		//是否啟用
		case 'start':
			$arr_start['gml_del'] = !($start);
			if(mod_game_member($db,$arr_start,$del_id))
			{
				reload_js_top_href('更新成功!','game_member.php');
			}
			else
			{
				reload_js_top_href('更新失敗或沒有更新!','game_member.php');
			}
		break;
		default:
			reload_js_top_href('異常','game_member.php');
			exit('異常');
	}


?>