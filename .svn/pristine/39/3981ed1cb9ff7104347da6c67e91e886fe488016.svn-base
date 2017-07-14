<?php
/**
 * Created by PhpStorm.
 * User: Magus
 * Date: 2017/7/6
 * Time: 下午2:26
 */


function getResponse($cvurl, $type = "GET", $r_json = "")
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $cvurl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    if ($type == "POST") {
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $r_json);
    }
    $json_response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($status != 200) {
//        log_file(("Error: $cvurl failed status $status , json:" . $json_response));
        return -1;
    }

    return $json_response;
}

$win7pk_push = 'http://60.250.122.219:8080/7pk/';

//$res = file_get_contents($win7pk_push . "1" . "/setting");
$res = getResponse($win7pk_push . "1" . "/setting");
var_dump($res);
var_dump(json_decode($res));
