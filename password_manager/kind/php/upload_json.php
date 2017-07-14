<?php
//ini_set('display_errors',1);
/**
 * 圖片上傳功能-抓資料庫版本
 * 
 */
require_once 'JSON.php';
require_once('../../../inc/web_info.php');
include_once('../../../polo2u_ad_admin/config/config.php');
include_once('../../../polo2u_ad_admin/libraries/ftp.php');

$http_host = getenv('HTTP_HOST'); #目前的網址
$php_path = dirname(__FILE__) . '/';

$save_path = $php_path . '../../../images_CK/'; #圖片存檔的目錄路径
$save_url  = FRONT_WEB_URL.'images_CK/';          #圖片存檔的目錄URL
$ext_arr   = array('gif', 'jpg', 'png'); #定義允許上傳的文件副檔名
$max_size  = 2097152;                            #最大文件大小(2MB)
$save_path = realpath($save_path) . '/';

#有圖片可以上傳時
if (empty($_FILES) === false) 
{
	$file_name  = $_FILES['imgFile']['name'];     #原文件名
	$tmp_name   = $_FILES['imgFile']['tmp_name']; #臨時文件名稱
	$file_size  = $_FILES['imgFile']['size'];     #文件大小
	$file_notes = $_POST['imgTitle'];             #圖片說明
	
	#检查圖片名稱
	if (!$file_name) 
	{
		alert("請選擇圖片。");
	}
	
	#检查目錄
	if (@is_dir($save_path) === false) 
	{
		alert("上傳目錄不存在。");
	}
	
	#檢查目錄寫入權限
	if (@is_writable($save_path) === false) 
	{
		alert("上傳目錄沒有寫入權限。");
	}
	
	#檢查是否已經上傳
	if (@is_uploaded_file($tmp_name) === false) 
	{
		alert("臨時文件可能不是上傳文件。");
	}
	
	#檢查文件檔案大小
	if ($file_size > $max_size) 
	{
		alert("上傳圖片大小請勿超過 ".($max_size / 1024 / 1024)." MB 。");
	}
	
	#取得文件副檔名
	$temp_arr = explode(".", $file_name);
	$file_ext = array_pop($temp_arr);
	$file_ext = trim($file_ext);
	$file_ext = strtolower($file_ext);
	
	#檢查副檔名
	if (in_array($file_ext, $ext_arr) === false) 
	{
		alert("圖片不是允許的上傳格式。");
	}
	
	#新文件名
	$new_file_name = time('Ymdgis').rand(0,999).'.'.$file_ext;
	
	#移動檔案
	$file_path = $save_path . $new_file_name;
	if (move_uploaded_file($tmp_name, $file_path) === false) 
	{
		alert("上傳圖片失敗。");
	}
	
	if($http_host == 'www.polo2u.com.tw' || $http_host == 'w1.polo2u.com.tw' || $http_host == 'w2.polo2u.com.tw'  || $http_host == 'w4.polo2u.com.tw')
	{
			$ftp = new Ftp(FTP_HOST_1, FTP_ACCOUNT, FTP_PASSWORD);
			$ftp ->remote_file = '../../../images_CK/'.$new_file_name;
			$ftp ->local_file  = '../../../images_CK/'.$new_file_name;
			$ftp ->upload();
			
			$ftp = new Ftp(FTP_HOST_2, FTP_ACCOUNT, FTP_PASSWORD);
			$ftp ->remote_file = '../../../images_CK/'.$new_file_name;
			$ftp ->local_file  = '../../../images_CK/'.$new_file_name;
			$ftp ->upload();
			
			$ftp = new Ftp(FTP_HOST_3, FTP_ACCOUNT, FTP_PASSWORD);
			$ftp ->remote_file = '../../../images_CK/'.$new_file_name;
			$ftp ->local_file  = '../../../images_CK/'.$new_file_name;
			$ftp ->upload();				
	}			
	
	/*$pic = new Kind();
	$pic ->name = $file_notes;
	$pic ->pic  = $new_file_name;
	$pic ->sort = Kind::getSort();
	$pic ->add();*/
	
	@chmod($file_path, 0644);
	$file_url = $save_url . $new_file_name;
	
	header('Content-type: text/html; charset=UTF-8');
	$json = new Services_JSON();
	echo $json->encode(array('error' => 0, 'url' => $file_url));
	exit;
}


function alert($msg) 
{
	header('Content-type: text/html; charset=UTF-8');
	$json = new Services_JSON();
	echo $json->encode(array('error' => 1, 'message' => $msg));
	exit;
}
?>