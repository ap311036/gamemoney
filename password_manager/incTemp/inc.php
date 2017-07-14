<?php
//Error Message 1=>open 0=>close

header('Content-Type: text/html; charset=UTF-8');

define('webroot','http://127.0.0.1:8888/gamemoney/password_manager/');

define('furl','/Applications/MAMP/htdocs/gamemoney/password_manager/');

//DB & SYS CONFIG 
require_once(furl.'inc/db_info.php');

//EMAIL CLASS
require_once(furl.'class/email_class.php');

//DB CLASS
require_once(furl.'class/db_class.php');
$db = new DB($dbconfig['default']);
$admin_db = new DB($dbconfig['admin']);
$jpot_db = new DB($dbconfig['jpot']);



//FUNCTION SYSTEMM COMMON
require_once(furl.'func/func_sys_comm.php');

//FUNCTION DB COMMON
require_once(furl.'func/func_db_comm.php');



if($id_id != "login")
{
//login
require_once('login_act.php');
}
require_once(furl.'class/pageClass.php');

//系統表單資料
require(furl.'inc/web_info.php');
?>
