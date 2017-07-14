<?php
// 開啟 session
if (!isset($_SESSION)) { session_start(); }
 
// 設定亂數種子
mt_srand((double)microtime()*1000000);
 
// 驗證碼變數
$CaptchaString = '';
 
// 定義顯示在圖片上的文字，可以再加上大寫字母
$str = 'abcdefghijkmnpqrstuvwxyz1234567890';
 
$l = strlen($str); //取得字串長度
 
//隨機取出 6 個字
for($i=0; $i<5; $i++){
   $num=rand(0,$l-1);
   $CaptchaString.= $str[$num];
}
$_SESSION['CAPTCHA'] = $CaptchaString;


Header("Content-type: image/PNG");	//宣告輸出為PNG影像
$CaptchaWidth = 50;					//驗證碼影像寬度
$CaptchaHeight = 15;				//驗證碼影像高度
 
//建立影像
$Captcha = ImageCreate($CaptchaWidth, $CaptchaHeight);
//設定背景顏色，範例是紅色
$BackgroundColor = ImageColorAllocate($Captcha, 255, 200, 200);
//設定文字顏色，範例是黑色
$FontColor = ImageColorAllocate($Captcha, 0, 0, 0);
//影像填滿背景顏色
ImageFill($Captcha, 0, 0, $BackgroundColor);
//影像畫上驗證碼
ImageString($Captcha, 20, 0, 0, $_SESSION['CAPTCHA'] , $FontColor);
//隨機畫上200個點，做為雜訊用
for($i = 0; $i < 1; $i++) {
	Imagesetpixel($Captcha, rand() % $CaptchaWidth , rand() % $CaptchaHeight , $FontColor);
}
//輸出驗證碼影像
ImagePNG($Captcha);
ImageDestroy($Captcha);
 
?>