<?php
/*
 * cookie的加密
 * @user
 * @pw
 * 回傳加密字串
 */
function cookie_encode($user,$pw)
{
	return base64_encode(SYS_COOKEY5.base64_encode($pw.'###'.$user).SYS_COOKEY4);
}

/*
 * cookie的解密
 * @str
 * 回傳陣列
 * $arr['0'] = pw
 * $arr['1'] = user
 */
function cookie_decode($str)
{
	$str = base64_decode($str);
	$str = substr($str, strlen(SYS_COOKEY5),-strlen(SYS_COOKEY4));
	$str = base64_decode($str);
	$arr = explode('###', $str);
	return $arr;
}

//確認是否登入
function login_check($db,$str)
{
	//cookie解開
	$arr = cookie_decode($str);
	
	if($arr[0] && $arr[1])
	{
		$member = get_admin_one($db,$arr[1],$arr[0]);
	    session_start();
	    $_SESSION['admin_name'] = $member['ad_name'];
	    $_SESSION['admin_type'] = $member['ad_mtid'];
//	    var_dump($member);
	    session_commit();
		if(count($member) > 0)
		{
			return $member;
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

//取得該登入帳號
function get_admin_one($db, $id, $pw)
{
	$sql = 'SELECT * 
			FROM admin_data 
			WHERE ad_account = ?
			AND ad_del = 0
			AND ad_mtid in (1,2)';
	$sql_input[] = $id;
	
	if($pw != '')
	{
		$sql .= ' AND ad_pass = ? ';
		$sql_input[] = $pw;
	}
	$res = $db->dbSelectPrepare($sql,$sql_input);
	
	return $res[0];
}

// ==================================================== //
//							//
//	下面是for api用					//
//							//
// ==================================================== //

//取得帳號的ad_id
function get_ad_id ( $db, $acc, $platform )
{
	$sql = "SELECT ad_id FROM admin_data WHERE ad_account = ? AND ad_mtid = ?";
	$sql_input = array($acc, $platform);
	$res = $db->dbSelectPrepare($sql, $sql_input);
	
	if ( isset($res[0]) && isset($res[0]["ad_id"]) ) return $res[0]["ad_id"];

	return false;
}

//產生password
function create_pw ()
{
	$str = "abcd0efghi1jklmn2opqrs3tuvwx4yzABC5DEFGH6IJKL7MNOPQ8RSTU9VWXYZ0";
	$pw  = "";

	for ( $i=0; $i<8; $i++ )
	{
		$idx = rand(0,62);
		$pw .= $str[$idx];
	}
	
	return crypt($pw, "\$1\$jowjavjo");
}

//建立新帳號
function add_user ( $db, $acc, $nick, $platform, $t )
{
	$pw   = create_pw();
	$sql  = "INSERT INTO admin_data ";
	$sql_input = array("ad_name"=>$nick, "ad_account"=>$acc, "ad_mtid"=>$platform,"ad_pass"=>$pw,"ad_del"=>0);
		
	$res  = $db->dbInsertPrepare($sql, $sql_input);
	
	return $res;
}
