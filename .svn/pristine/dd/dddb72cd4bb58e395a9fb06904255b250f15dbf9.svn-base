<?php

$value =  iconv("utf-8", "big5", $_POST['msg']); //轉換編碼

//$value = mb_convert_encoding($_POST['msg'], "utf-8", "auto"); 

$value = urlencode($value);

//echo mb_detect_encoding($value)."\n";
//var_dump($vale);

$phone = $_POST['phone'];


$url = 'https://api.kotsms.com.tw/kotsmsapi-1.php';
$pass = 'grace623';
$acc = 'graceanna';

//iconv("來源編碼","欲轉換編碼",變數名稱);



if($value !='')
{
    echo '<script>window.location="'.$url.'?username='.$acc.'&password='.$pass.'&dstaddr='.$phone.'&%20smbody='.$value.'&response=http://gamemoney.sammicorner.com/receiveMsg.php";</script>';
}

//https://api.kotsms.com.tw/kotsmsapi-1.php?username=graceanna&password=grace623&dstaddr=0933371571&%20smbody=%E7%B0%A1%E8%A8%8A%E7%8E%8Bapi%E7%B0%A1%E8%A8%8A%E6%B8%AC%E8%A9%A6%20&response=http://gamemoney.sammicorner.com/

?>

<html>
<head>

    <script>

    
    </script>

</head>
<body>

<form method="post">
    <div>訊息 <input name="msg" type="text" value="" /></div>

    <div>電話 <input name="phone" type="text" value="" /></div>



    <div>
        <input type="submit" value="送出" />
    </div>
</form>


</body>


</html>