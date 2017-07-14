<?php
//web config
define('FRONT_WEB_URL','');
define('UPPIC_URL','');
define('IMAGES_URL','');

//============== 導覽頁項目與上方tab設定 op ==============

//01 管理員帳號管理
$tab[] = array(
	"group" => "0",
	"title" => "01 管理員帳號管理",
	"admin.php" => "管理員帳號管理"
);

//02 帳號管理
$tab[] = array(
	"group" => "1",
	"title" => "02 帳號管理",
	"member.php" => "帳號管理"
);


//03 機台管理
$tab[] = array(
	"group" => "2",
	"title" => "03 機台管理",
	"slot_machine.php" => "機台管理"
);
	

//04 拉霸紀錄
$tab[] = array(
	"group" => "3",
	"title" => "04 拉霸紀錄",
	"slot_log.php" => "拉霸紀錄"
);

?>