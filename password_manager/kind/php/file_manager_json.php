<?php
/**
 * 圖片瀏覽功能-抓資料庫版本
 * 
 */
require_once 'JSON.php';
require_once('../../models/kind_models.php');

$image     = Kind::getAll();
$php_path  = dirname(__FILE__) . '/';
$php_url   = dirname($_SERVER['PHP_SELF']) . '/';
$root_path = $php_path . '../../user_file/pic/'; #根目錄路徑，可以指定絕對路径，比如 /var/www/attached/
$root_url  = $php_url . '../../user_file/pic/';  #根目錄URL，可以指定絕對路径，比如 http://www.yoursite.com/attached/
$ext_arr   = array('gif', 'jpg', 'png'); #圖片副檔名

#根據path參數，設置各路徑和URL
if (empty($_GET['path'])) 
{
	$current_path = realpath($root_path) . '/';
	$current_url = $root_url;
	$current_dir_path = '';
	$moveup_dir_path = '';
} else {
	$current_path = realpath($root_path) . '/' . $_GET['path'];
	$current_url = $root_url . $_GET['path'];
	$current_dir_path = $_GET['path'];
	$moveup_dir_path = preg_replace('/(.*?)[^\/]+\/$/', '$1', $current_dir_path);
}

$order = empty($_GET['order']) ? 'name' : strtolower($_GET['order']); #排序形式，name or size or type

#不允許使用..移動到上一層目錄
if (preg_match('/\.\./', $current_path)) 
{
	echo '不允許使用.';
	exit;
}

#最後一個文字不是/
if (!preg_match('/\/$/', $current_path)) 
{
	echo '無效的參數.';
	exit;
}

#目錄不存在或是不是目錄
if (!file_exists($current_path) || !is_dir($current_path)) 
{
	echo '目錄不存在.';
	exit;
}



#取得圖片或是資料夾
$file_list = array();
if ($handle = opendir($current_path) and $image > 0) 
{
	foreach($image as $image)
	{
		$file = $current_path . $image['pi_pic'];
		
		$file_list[$i]['is_dir']    = false; #是否是資料夾
		$file_list[$i]['has_file']  = false; #資料夾是否包括資料
		$file_list[$i]['filesize']  = filesize($file); #檔案大小
		$file_list[$i]['dir_path']  = '';
		$file_list[$i]['filename']  = $image['pi_pic']; #檔案名稱，包括副檔名(用來抓取正確圖片的)
		$file_ext = strtolower(array_pop(explode('.', trim($image['pi_pic']))));
		$file_list[$i]['is_photo']  = in_array($file_ext, $ext_arr); #判斷是不是圖片
		$file_list[$i]['filetype']  = $file_ext; #檔案類別，用副檔名判斷
		$file_list[$i]['datetime']  = date('Y-m-d H:i:s', filemtime($file)); #檔案最後修改時間
		$file_list[$i]['imagename'] = $image['pi_name'];  #圖片名稱（顯示用）
		$file_list[$i]['imagemsg']  = $image['pi_message']; #圖片備註
		$file_list[$i]['imagesort'] = $image['pi_sort'];  #圖片排序用
		$i++;
	}
} 
/*
else {
	if ($handle = opendir($current_path)) {
		$i = 0;
		while (false !== ($filename = readdir($handle))) {
			if ($filename{0} == '.') continue;
			$file = $current_path . $filename;
			if (is_dir($file)) {
				$file_list[$i]['is_dir']   = true;
				$file_list[$i]['is_photo'] = false;
				$file_list[$i]['has_file'] = (count(scandir($file)) > 2); 
				$file_list[$i]['filesize'] = 0; 
				$file_list[$i]['filetype'] = '';
			}
			$file_list[$i]['filename'] = $filename;
			$file_list[$i]['datetime'] = date('Y-m-d H:i:s', filemtime($file));
			$i++;
		}
		closedir($handle);
	}
}
*/

#排序
function cmp_func($a, $b) 
{
	global $order;
	
	if ($a['is_dir'] && !$b['is_dir']) 
	{
		return -1;
	} else if (!$a['is_dir'] && $b['is_dir']) {
		return 1;
	} else {
		
		if($order == 'size') 
		{
			if($a['filesize'] > $b['filesize']) {
				return 1;
			} else if ($a['filesize'] < $b['filesize']) {
				return -1;
			} else {
				return 0;
			}
		}
		
		if($order == 'type') {
			if ($a['filetype']<$b['filetype'])  
			    return -1;  
			else if ($a['filetype']>$b['filetype'])  
			    return 1;   
			return 0;
		}
		

		if($order == 'sort')
		{
			if ($a['imagesort']<$b['imagesort'])  
			    return -1;  
			else if ($a['imagesort']>$b['imagesort'])  
			    return 1;   
			return 0; 
		}
	}
}

usort($file_list, 'cmp_func');

$result = array();
$result['moveup_dir_path']  = $moveup_dir_path;  #相對於根目錄的上一級目錄
$result['current_dir_path'] = $current_dir_path; #相對於根目錄的當前目錄
$result['current_url']      = $current_url; #當前目錄的URL
$result['total_count']      = count($file_list); #檔案數量
$result['file_list']        = $file_list; #檔案列表陣列

header('Content-type: application/json; charset=UTF-8'); #輸出JSON字串陣列
$json = new Services_JSON();
echo $json->encode($result);
?>
