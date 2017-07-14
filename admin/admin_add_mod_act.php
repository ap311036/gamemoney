<?php
//載入程式設定檔
$id_id = "login";
require("inc/inc.php");
require("func/func_admin.php");
//ini_set("display_errors",1);

//========= 參數接收 op ==========

$act 				= ft($_POST['act'],1);
$id				= ft($_POST['id'],0); 
$arr_input['ad_name']		= ft($_POST['ad_name'],1);
$arr_input['ad_account']	= ft($_POST['ad_account'],1);
$arr_input['ad_mtid']   	= ft($_POST['type'],1);
$m_pass				= ft($_POST['ad_pass'],1);
$arr_input['ad_del']		= ft($_POST['ad_del'],1);

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
                    $arr_input = check_input_value($db,$arr_input,$act);
                    //密碼檢查判斷無誤後加密
                    if($m_pass != '******')
                    {
                        $arr_input['ad_pass'] = encrypt_password($ad_pass);
                    }
                    $add_id = add_admin($admin_db, $arr_input);
                    if($add_id)
                    {
                            reload_js_top_href('新增成功!','admin.php');
                    }
                    else 
                    {
                            reload_js_top_href('新增失敗或沒有新增!','admin.php');
                    }
		break;
		
		//更新
		case 'mod':
			//檢驗
			$arr_input = check_input_value($db,$arr_input,$act,$id);
			
			//加密密碼判斷
			if($m_pass != '******')
			{
					$arr_input['ad_pass'] = encrypt_password($m_pass);
			}
			
			//更新基本資料
			$mod_id = mod_admin($db,$arr_input,$id);
			if($arr_input['ad_pass'])
			{
				reload_js_top_href('變更密碼，請重新登入!','login.php');
			}
			if($mod_id)
			{
				reload_js_top_href('更新成功!','admin.php');
			}
			else 
			{
				reload_js_top_href('更新失敗或沒有更新!','admin.php');
			}
		break;
		
		//是否啟用
		case 'start':
			$arr_start['ad_del'] = !($start);
			if(mod_admin($db,$arr_start,$del_id))
			{
				reload_js_top_href('更新成功!','admin.php');
			}
			else
			{
				reload_js_top_href('更新失敗或沒有更新!','admin.php');
			}
		break;
		default:
			reload_js_top_href('異常','admin.php');
			exit('異常');
	}


?>