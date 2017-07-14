<?php
//從資料庫取跑馬燈
$marqueeArray = array(
    "time" => "2017-01-30",
    "content" => "歡迎光臨，老子有錢！"
);

//JSON encode
$marqueeArray_encode = json_encode($marqueeArray);
$marqueeArray_encode = '{"code":0,"marquee":[{"id":"7","title":"JPOT4WIN","msg":"\u606d\u559c\u73a9\u5bb6 magussiro \u5728 \u767e\u5927\u5bcc\u8c6a \u904a\u6232\u4e2d\u4e2dJPOT4\u734e!\u7368\u5f97\u734e\u91d15004\u806f\u76df\u5e63!","start_date":"2017-01-18 18:38:06","end_date":"2017-01-18 18:41:06","created_at":"2017-01-18 18:38:06","priority":"1"},{"id":"8","title":"JPOT4WIN","msg":"\u606d\u559c\u73a9\u5bb6 magussiro \u5728 \u767e\u5927\u5bcc\u8c6a \u904a\u6232\u4e2d\u4e2dJPOT4\u734e!\u7368\u5f97\u734e\u91d15004\u806f\u76df\u5e63!","start_date":"2017-01-18 18:39:08","end_date":"2017-01-18 18:42:08","created_at":"2017-01-18 18:39:08","priority":"1"},{"id":"9","title":"JPOT4WIN","msg":"\u606d\u559c\u73a9\u5bb6 magussiro \u5728 \u767e\u5927\u5bcc\u8c6a \u904a\u6232\u4e2d\u4e2dJPOT4\u734e!\u7368\u5f97\u734e\u91d15004\u806f\u76df\u5e63!","start_date":"2017-01-18 18:39:46","end_date":"2017-01-18 18:42:46","created_at":"2017-01-18 18:39:46","priority":"1"},{"id":"10","title":"JPOT4WIN","msg":"\u606d\u559c\u73a9\u5bb6 magussiro \u5728 \u767e\u5927\u5bcc\u8c6a \u904a\u6232\u4e2d\u4e2dJPOT4\u734e!\u7368\u5f97\u734e\u91d15004\u806f\u76df\u5e63!","start_date":"2017-01-18 18:39:47","end_date":"2017-01-18 18:42:47","created_at":"2017-01-18 18:39:47","priority":"1"},{"id":"11","title":"JPOT4WIN","msg":"\u606d\u559c\u73a9\u5bb6 magussiro \u5728 \u767e\u5927\u5bcc\u8c6a \u904a\u6232\u4e2d\u4e2dJPOT4\u734e!\u7368\u5f97\u734e\u91d15004\u806f\u76df\u5e63!","start_date":"2017-01-18 18:39:47","end_date":"2017-01-18 18:42:47","created_at":"2017-01-18 18:39:47","priority":"1"},{"id":"12","title":"JPOT4WIN","msg":"\u606d\u559c\u73a9\u5bb6 magussiro \u5728 \u767e\u5927\u5bcc\u8c6a \u904a\u6232\u4e2d\u4e2dJPOT4\u734e!\u7368\u5f97\u734e\u91d15004\u806f\u76df\u5e63!","start_date":"2017-01-18 18:39:48","end_date":"2017-01-18 18:42:48","created_at":"2017-01-18 18:39:48","priority":"1"},{"id":"13","title":"JPOT4WIN","msg":"\u606d\u559c\u73a9\u5bb6 magussiro \u5728 \u767e\u5927\u5bcc\u8c6a \u904a\u6232\u4e2d\u4e2dJPOT4\u734e!\u7368\u5f97\u734e\u91d15004\u806f\u76df\u5e63!","start_date":"2017-01-18 18:39:49","end_date":"2017-01-18 18:42:49","created_at":"2017-01-18 18:39:49","priority":"1"},{"id":"14","title":"JPOT4WIN","msg":"\u606d\u559c\u73a9\u5bb6 magussiro \u5728 \u767e\u5927\u5bcc\u8c6a \u904a\u6232\u4e2d\u4e2dJPOT4\u734e!\u7368\u5f97\u734e\u91d15004\u806f\u76df\u5e63!","start_date":"2017-01-18 18:39:50","end_date":"2017-01-18 18:42:50","created_at":"2017-01-18 18:39:50","priority":"1"},{"id":"15","title":"JPOT4WIN","msg":"\u606d\u559c\u73a9\u5bb6 magussiro \u5728 \u767e\u5927\u5bcc\u8c6a \u904a\u6232\u4e2d\u4e2dJPOT4\u734e!\u7368\u5f97\u734e\u91d15004\u806f\u76df\u5e63!","start_date":"2017-01-18 18:39:50","end_date":"2017-01-18 18:42:50","created_at":"2017-01-18 18:39:50","priority":"1"},{"id":"16","title":"JPOT4WIN","msg":"\u606d\u559c\u73a9\u5bb6 magussiro \u5728 \u767e\u5927\u5bcc\u8c6a \u904a\u6232\u4e2d\u4e2dJPOT4\u734e!\u7368\u5f97\u734e\u91d15004\u806f\u76df\u5e63!","start_date":"2017-01-18 18:39:51","end_date":"2017-01-18 18:42:51","created_at":"2017-01-18 18:39:51","priority":"1"}]}';
echo $marqueeArray_encode;

//JSON decode
$marqueeArray2 = '' . $marqueeArray_encode . '';
$marqueeArray_decode = json_decode($marqueeArray2);
//game.php?m=getMarque
?>

