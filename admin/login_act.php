<?php
//ini_set("display_errors",1);
//載入程式設定檔
require("inc/inc.php");
require("func/func_login_act.php");

//========= 參數接收 op ==========
$login_str			= ft($_COOKIE['ad_lg'],1);

$act 				= ft($_POST['log_sub'],1);
$arr_input['id'] 	= ft($_POST['member_id'],1);
$arr_input['pw']	= ft($_POST['member_pw'],1);


if($act == '')
{
	$act = ft($_GET['logout'],1);
	if($act != '' && $act != 'logout')
	{
		post_back('參數錯誤!');
	}
}

//exit();
//========= 參數接收 ed ==========

$login_ok = false;
//echo $login_str;

//已登入狀態
if(isset($login_str) && $act != 'logout')
{
	
	$admin = login_check($admin_db,$login_str);
	
	if($admin != false)
	{
		$login_ok = true;
		$my_page_name = explode('/', $_SERVER['PHP_SELF']);
		$my_page_name = $my_page_name[count($my_page_name)-1];
		if($my_page_name == 'login_act.php')
		{
			redirect_js_href("index.php");
			exit();
		}
	}
}

if($login_ok == false)
{
	if($act != '')
	{
		switch ($act)
		{

			case 'login':
				//取得會員資料
				
				$admin = get_admin_one($admin_db,$arr_input['id']);

				if(count($admin)>0)
				{	
					
					
					if($admin['ad_pass'] == encrypt_password($arr_input['pw']))
					{
						//cookie加密的字串
						$str = cookie_encode($admin['ad_account'],$admin['ad_pass']);
						//寫入cookie(8小時)
						setcookie('ad_lg', $str, time() + 28800 );
						//登入成功
						redirect_js_href('登入成功!','index.php');
					}
					else
					{
						
						redirect_js_href('帳號或密碼錯誤!','login.php');
					}
				}
				else
				{
					//帳號不存在
					redirect_js_href('帳號不存在!','login.php');
				}
		
			break;
			case 'logout':
				//cookie清除
				unset($_COOKIE['ad_lg']);
				setcookie('ad_lg', NULL, time()-36000);
				//登出訊息
				redirect_js_href('您已經成功登出!','login.php');
			break;
			default:
				
				exit('登入逾期，請重新登入');
		}
	}
	else
	{
		redirect_js_href('請重新登入，登入逾時，或者失效','login.php');
		exit();
	}
}
unset($arr_input);
?>