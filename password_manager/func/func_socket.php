<?php

//傳送HTTP REQUEST GET
function send_http_get($url, $params)
{
    $ch = curl_init();
    try {
        if (FALSE === $ch) {
            throw new Exception('failed to initialize');
        }
        curl_setopt($ch, CURLOPT_URL, $url.$params);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        
        //將curl_exec()獲取的訊息以文件流的形式返回，而不是直接輸出。
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        
        $result = curl_exec($ch);
        
        if (FALSE === $result) {
            throw new Exception(curl_error($ch), curl_errno($ch));
        }
    } catch (Exception $e) {
        trigger_error(sprintf('Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
        curl_close($ch);
    }
    // 轉換為Array形式
    $res_json = json_decode($result, true);
    return $res_json;
}

