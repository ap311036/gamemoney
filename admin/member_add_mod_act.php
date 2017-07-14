<?php
//載入程式設定檔
$id_id = "login";
require("inc/inc.php");
require("func/func_member.php");
//ini_set("display_errors",1);

//========= 參數接收 op ==========

$act 				= ft($_POST['act'],1);
$id				= ft($_POST['id'],0); 
$arr_input['name']		= ft($_POST['name'],1);
$arr_input['account']          = ft($_POST['account'],1);
$arr_input['birthday']		= ft($_POST['birthday'],1);
$arr_input['phone']		= ft($_POST['phone'],1);
$arr_input['tel']		= ft($_POST['tel'],1);
$arr_input['address']		= ft($_POST['address'],1);
$arr_input['email']		= ft($_POST['email'],1);
$arr_input['is_del']		= ft($_POST['is_del'],1);

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
                    $arr_input = check_input_value($admin_db,$arr_input,$act);
                    $add_id = add_member($admin_db, $arr_input);
                    if($add_id)
                    {
                            reload_js_top_href('新增成功!','member.php');
                    }
                    else 
                    {
                            reload_js_top_href('新增失敗或沒有新增!','member.php');
                    }
		break;
		
		//更新
		case 'mod':
			//檢驗
			$arr_input = check_input_value($admin_db,$arr_input,$act,$id);
			//更新基本資料
			$mod_id = mod_member($admin_db,$arr_input,$id);
			if($mod_id)
			{
				reload_js_top_href('更新成功!','member.php');
			}
			else 
			{
				reload_js_top_href('更新失敗或沒有更新!','member.php');
			}
		break;
		
		//是否啟用
		case 'start':
			$arr_start['is_del'] = !($start);
			if(mod_member($admin_db,$arr_start,$del_id))
			{
				reload_js_top_href('更新成功!','member.php');
			}
			else
			{
				reload_js_top_href('更新失敗或沒有更新!','member.php');
			}
		break;
		default:
			reload_js_top_href('異常','member.php');
			exit('異常');
	}


?>