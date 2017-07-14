<?php
//========= javascript 系列 op =========
	//==================
	// alert控制
	//==================
	function js_alert($msg)
	{
		echo '<script>alert("'.$msg.'");</script>';
	}
	
	//==================
	// 錯誤控制
	//==================
	function post_back($postmsg)
	{
		echo '<script>alert("'.$postmsg.'");history.back();</script>';
		exit();
	}

	//==================
	//js 轉址
	//==================
	function redirect_js_href($msg,$url)
	{
		if($url == NULL)
		{
			$url = 'index.php';	
		}
		
		echo '<script>';
		if($msg)
		{
			echo "alert('".$msg."');";
		}
		echo 'window.location.href="'.$url.'";';
		echo '</script>';
	}
	
	//==================
	//js 回上X頁
	//==================
	function redirect_js_back($msg,$num)
	{
		if($num== NULL)
		{
			$url = '1';	
		}
		
		echo '<script>';
		if($msg)
		{
			echo "alert('".$msg."');";
		}
		echo 'window.history.go("-'.$num.'");';
		echo '</script>';
	}
	
	//==================
	//js 重新整理最上層頁面
	//==================
	function reload_js_top($msg,$content=true)
	{
		if($content)
		{
			echo '轉換頁面中...';
		}
		echo '<script>';
		if($msg)
		{
			echo "alert('".$msg."');";
		}
		
		echo 'top.window.location.reload();';
		echo '</script>';	
	}
	
	//==================
	//js 轉址最上層頁面
	//==================
	function reload_js_top_href($msg,$href)
	{
		echo '<script>';
		if($msg)
		{
			echo "alert('".$msg."');";
		}
		echo 'top.window.location="'.$href.'";';
		echo '</script>';	
	}
	
	//==================
	//js 重新整理上一層頁面
	//==================
	function reload_js_parent($msg)
	{
		echo '<script>';
		if($msg)
		{
			echo "alert('".$msg."');";
		}
		echo 'parent.window.location.reload();';
		echo '</script>';
	}
	
	//==================
	//js 轉址上一層頁面
	//==================
	function reload_js_parent_href($msg,$href)
	{
		echo '<script>';
		if($msg)
		{
			echo "alert('".$msg."');";
		}
		echo 'parent.window.location="'.$href.'";';
		echo '</script>';	
	}
	
	//==================
	//js confirm 確認視窗
	//==================
	function confirm_page($msg,$url)
	{
		echo '<script>';
		echo 'if (confirm("'.$msg.'") )';
		echo '{';
			echo 'window.top.location.href="'.$url.'";';
		echo '}';
		echo '</script>';
	}

//========= javascript 系列 ed =========


//==================
//html 以字串轉出
//==================
function html_out($str)
{
	$search  = array ('<','>',' ',"\r\n");
	$replace = array ('&lt;','&gt;',' &nbsp;',"<br>\r\n");
	return str_replace($search,$replace,$str);
}

//==================
//php 字串過濾 
//==================
function ft($input, $class = 1)
{
	/*
  	if(isset($input) && !empty($input))
	{
	
				
		switch($class)
		{
			//數字
			case 0:			
				if(!filter_var($input, FILTER_VALIDATE_INT)) {				
					echo "數字格式有問題!";
					exit();
				}
				if(!intval($input)) exit();  
				break;
			
			//字串
			case 1:
				
				return filter_var($input,FILTER_SANITIZE_STRING);
				break;
			
			//文章(去除html標記)
			case 2:
				return filter_var($input,FILTER_SANITIZE_STRING);
				break;
			
			//email
			case 3:
				if(!filter_var($input, FILTER_VALIDATE_EMAIL)) 
				{				
					echo "mail格式有問題!";
					exit();
				}
				break;
			
			//地址
			case 4:
				return filter_var($input,FILTER_SANITIZE_STRING);
				break;
			
			//中文
			case 5:
				return filter_var($input,FILTER_SANITIZE_STRING);
				break;
			
			//網址
			case 6:
				if(!filter_var($input, FILTER_VALIDATE_URL)) 
				{				
					echo "網址格式有問題!";
					
					exit();
				}
				break;

		}
	}*/
	
	switch($class)
	{
		#數字過濾
		case 0:
			if(is_numeric($input) == false && $input != '')
			{
				exit('數字格式錯誤');
			}
		break;
		
		#字串過濾
		case 1:
			if(isset($input))
			{
		    	$input = strip_tags(trim($input));
			}
		break;
		
		#html過濾
		case 7:
			if(isset($input))
			{
				$input = stripslashes(trim($input));
			}
		break;
		
		default:
		    if(isset($input))
			{
		    	$input = strip_tags(trim($input));
			}
		break;
	}
		
   	return $input; 
}

//==================
//php 陣列字串過濾
//==================
function ft_arr($arr_input, $class = 1)
{
	foreach($arr_input as $key =>$input)
	{
		$arr_val[$key] = ft($input, $class);
	}
	return $arr_val;
}


//==================
// 密碼加密(前)
//==================
function eliteEncrypt($string,$i_salt) 
{ 
    // Create salt 
    $salt = md5($string.SYS_COOKEY4.$i_salt); 
    $sand = crypt(SYS_COOKEY2.$string,$salt);
    
    // Hash
    $string = md5($sand.$string.$salt); 
    return $string; 
}

//==================
// 密碼加密(後)
//==================
function encrypt_password($password)
{
	return sha1(md5(SYS_COOKEY5).$password.md5(SYS_COOKEY3));
}

//==================
//頁面GET參數取得處理
//str 為陣列
//$type(0=>問號及後方參數 , 1=>網址後半段 , 2=>完整網址, 3=>完整網址去除參數)
//PS.若無陣列參數使用方式   get_Url(NULL,2);
//==================
function get_Url($str = NULL,$type = 0)
{
	$i=0;
	if($type < 3)
	{
		if(count($_GET) > 0)
		{
			foreach ($_GET as $varname => $varvalue)
		   	{
			
				
		    	$varvalue = ft($varvalue,1);
				$varname = ft($varname,1);
		  		if ((!empty($varvalue)))
				{
		
					
					if(count($str)>0)
					{
						
						$vn_flag=0;
						foreach($str as $s => $v)
						{
							if($varname == $s)
							{
								$vn_flag=1;
								
								if($i>0)
								{
									$uri .= '&';
								}
								$uri .= $s.'='.$v;
								unset($str[$s]);
							}
						}
			
						if($vn_flag==0)
						{
							if($i>0)
							{
								$uri .= '&';	
							}
							$uri .= $varname.'='.$varvalue;	
						}
					}
					else
					{
						if($i>0)
						{
							$uri .= '&';	
						}
						$uri .= $varname.'='.$varvalue;	
					}
				}
		      	$i++;
		    }
		}
	
	    if(count($str)>0)
	    {
		    foreach($str as $s => $v)
		    {
				if($i>0)
				{
					$uri .= '&';
				}
				$uri .= $s.'='.$v;
				unset($str[$s]);
				$i++;
		     }
	    }
	}
     
     if($type == 1)
     {
     	return $_SERVER['PHP_SELF'].'?'.$uri;
     }
     elseif($type == 2)
     {
     	$all_url .= 'http://'.$_SERVER['SERVER_NAME'];
     	
     	if($_SERVER['SERVER_PORT'] != 80)
     	{
     		$all_url .= ':'.$_SERVER['SERVER_PORT'];
     	}
     	
     	$all_url .= $_SERVER['PHP_SELF'];
     	
     	if($uri != '')
     	{
     		$all_url .= '?'.$uri;
     	}
     	
     	return $all_url;
     }
     elseif($type == 3)
     {
     	$all_url .= 'http://'.$_SERVER['SERVER_NAME'];
     
     	if($_SERVER['SERVER_PORT'] != 80)
     	{
     		$all_url .= ':'.$_SERVER['SERVER_PORT'];
     	}
     
     	$all_url .= $_SERVER['PHP_SELF'];
     
     	return $all_url;
     }
     else 
     {
     	return '?'.$uri;
     }
}

//==================
//頁面GET參數取得處理 for login
//==================
function get_url_login()
{
	 
// 	foreach ($_GET as $varname => $varvalue)
//    	{
//     	$varvalue = ft($varvalue,1);
// 		$varname = ft($varname,1);
//   		if ((!empty($varvalue)) && (strtolower($varname) != 'act'))
// 		{	
// 			if($uri)
// 			{
// 				$uri .= '&';		
// 			}
// 			$uri .= $varname.'='.$varvalue;
// 		}	
      
//      }
// 	 return '?'.$uri;
	return '?'.$_SERVER['QUERY_STRING'];
}

//==================
//取得現在頁面
//==================
function get_current_page()
{
	$url = 'http://'.getenv("SERVER_NAME").getenv("REQUEST_URI");
	return ft($url,1);	
}

//====================================
//取得縮圖檔名
// @img_name = 圖片名稱
//====================================
function get_thumb_img_name($img_name)
{
	if($img_name != NULL)
	{
		$pic_tmp = explode('.jpg',$img_name);
		$r_pic = $pic_tmp[0].'_s'.'.jpg';
		if(file_exists($r_pic))
		{
			return $r_pic;
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;	
	}
	
}

//====================================
//取得縮圖尺寸
// @img_name = 圖片名稱
//$img['tmp_w'] = 80; 小圖寬度
//$img['tmp_h'] = 90; 小圖高度
//$img['tmp_w_lag'] = 230; 大圖寬度
//$img['tmp_h_lag'] = 270; 大圖高度
//====================================
function get_thumb_size($img_name)
{
	if($img_name == NULL)
	{
		return false;
	}
	
	list($src_w, $src_h, $type, $attr) = getimagesize($img_name);
	
	if($src_w == NULL)
	{
		return false;
	}
	if($src_w < $src_h)
	{
		$img['tmp_w'] = 80;
		$img['tmp_h'] = 90;
		$img['tmp_w_lag'] = 230;
		$img['tmp_h_lag'] = 270;
	}
	else
	{
		$img['tmp_w'] = 120;
		$img['tmp_h'] = 90;
		$img['tmp_w_lag'] = 360;
		$img['tmp_h_lag'] = 270;
	}
	return $img;
}

//==================
//中文切割字串
// @str   = 需要切割的字串
// @len   = 達到多少字元以後才需要切割，預設是127個字元
// @style = 如果有切割字串以後，後面的樣式 如: 字串...， ...就是樣式 
//==================
function utf_substr($str, $len = 127, $style = NULL)
{
	$strlen = mb_strlen($str, 'UTF-8');
	
	if($strlen > $len)
	{
		$str = mb_substr($str, 0, $len, 'UTF-8').$style;
	}
	
	return $str;
}

//==================
//取得限制頁面數量 
//==================
function get_page_limit($page)
{
	//var_dump($page);
	if(count($page) > 0)
	{
		if($page['page_id'] == NULL || $page['page_id'] == 1)
		{
			$sql = " limit 0,".$page['page_limit'];
		}
		else
		{
			$sql = " limit ".(($page['page_id']-1)*$page['page_limit']).','.$page['page_limit'];
		}
		return $sql;
	}
	else
	{
		return false;
	}
	
}

//==================
//印出html選取狀態
//==================
function echo_html_seleted($value,$current)
{
	if($value == $current)
	{
		echo 'selected="selected"';
	}
}


function echo_html_checked($value,$current)
{
	if($value == $current)
	{
		echo 'checked="checked"';
	}
}

function echo_html_active($value,$current)
{
	if($value == $current)
	{
		echo 'class="active"';
	}
}

//隨機產生密碼
function rand_password()
{
    $password_len = 8;
    $password     = '';

    
    $word = 'abcdefghijkmnpqrstuvwxyz123456789';
    
	$len = strlen($word);
	
    srand(make_seed());
    
	for($i = 0; $i < $password_len; $i++) 
    {
        $password .= $word[rand() % $len];
    }

    return $password;
}


//產生亂數種子
function make_seed()
{
	  list($usec, $sec) = explode(' ', microtime());
	  
	  return ((float) $sec + ((float) $usec * 100000));
}

//debug 專用
//檢視陣列輸出
function debug_arr($arr)
{
	echo '<pre>';
	var_dump($arr);
	echo '</pre>';
}



//取得使用者IP
function get_ip()
{
	if (getenv('HTTP_CLIENT_IP')) 
	{
		$ip = getenv('HTTP_CLIENT_IP');
	} 
	
	else if (getenv('HTTP_X_FORWARDED_FOR')) 
	{
		$ip = getenv('HTTP_X_FORWARDED_FOR');
	}
	
	else if (getenv('REMOTE_ADDR')) 
	{
		$ip = getenv('REMOTE_ADDR');
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	
	return $ip;	
}

function check_input($value,$type,$r_type = NULL)
{
	$check['ck'] = false;
	switch ($type)
	{
		//一般字串
		case 'str':
			if(strlen($value) < 1)
			{
				$check['msg'] = '不得為空';
				$check['ck']  = false;
			}
			else 
			{
				$check['ck']  = true;
			}
		break;
		//帳號 (只能由英文數字及底線)
		case 'acc':
			$re = '/^\w{1,30}$/';
			if(strlen($value) < 6)
			{
				$check['msg'] = '需超過6個字';
				$check['ck']  = false;
			}
			elseif(strlen($value) > 30)
			{
				$check['msg'] = '不能超過30個字';
				$check['ck']  = false;
			}
			elseif(!preg_match($re,$value))
			{
				$check['msg'] = '格式有問題,只能由英文數字及底線';
				$check['ck']  = false;
			}
			else 
			{
				$check['ck']  = true;
			}
		break;
		//密碼
		case 'pw':
			$i_end = strlen($value);
			$ns = 0;
			$ni = 0;
			$res = true;
			for($i = 0 ; $i < $i_end ; $i++)
			{
				$str = mb_substr($value,$i,1,"UTF-8");;
				$subStr = ord($str);
				if($subStr > 122 && $subStr < 33)
				{
					$check['msg'] = '格式不符合,只能使用符號與英數字';
					$check['ck']  = false;
					$res = false;
				}
				
				if($subStr>=48 && $subStr<=57)
					$ni = 1;
				else 
					$ns = 1;
			}
			
			if($ni == 0 || $ns == 0)
			{
				$check['msg'] = '要有 數字 及 英文或符號 之組合';
				$check['ck']  = false;
				$res = false;
			}
			
			if(strlen($value) < 8)
			{
				$check['msg'] = '需超過8個字';
				$check['ck']  = false;
				$res = false;
			}
			elseif(strlen($value) > 30)
			{
				$check['msg'] = '不能超過30個字';
				$check['ck']  = false;
				$res = false;
			}
			if($res)
			{
				$check['ck']  = true;
			}
		break;
		//日期 範例:2013-09-23
		case 'day':
			$re = '/^(\d{4})([\/]|[-])(\d{1,2})\2(\d{1,2})$/';
			$res1 = checkdate(substr($value, 5,2),substr($value, 8,2),substr($value, 0,4));
			$res2 = preg_match($re,$value);
			$check['ck'] = ($res1 && $res2)?true:false;
			$check['msg'] = '日期格式有問題，範例:2013-09-23';
			break;
		//電話 範例:02-23456789
		case 'tel':
			$re = '/^[0-9]{2,3}\-[0-9]{8}(\#[0-9]+)?$/';
			$check['ck'] = preg_match($re,$value);
			$check['msg'] = '電話號碼格式有問題，範例:02-23456789#1234';
		break;
		//手機 範例:0987654321
		case 'phone':
			$re = '/^09\d{8}$/';
			$check['ck'] = preg_match($re,$value);
			$check['msg'] = '手機格式有問題，範例:0987654321';
		break;
		//E-Mail
		case 'email':
			$re = '/^[^\s]+@[^\s]+\.[^\s]{2,3}$/';
			$check['ck'] = preg_match($re,$value);
			$check['msg'] = 'E-Mail格式有問題，範例:'.SERVICE_EMAIL;
		break;
		default:
			$check['ck'] = false;
		break;
	}
	
	if($r_type == '')
		return $check['ck'];
	elseif($r_type == 'all')
		return $check;
	elseif($r_type == 'msg')
		return $check['msg'];
	else 
		return $check['ck'];
}
 

?>