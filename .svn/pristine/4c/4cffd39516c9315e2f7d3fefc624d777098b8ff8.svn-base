<?php
$ctime=date("Y-m-d H:i:s");
 
$res="srcaddr=".$_REQUEST["srcaddr"]."\tdstaddr=".$_REQUEST["dstaddr"]."\tsmbody=".$_REQUEST["smbody"]."\tencoding=".$_REQUEST["encoding"]."\tctime=".$ctime;

$FileName=date("Y-m-d").'.txt';

$fh=fopen($FileName,"a");

fwrite($fh,$res);

fclose($fh);


?>