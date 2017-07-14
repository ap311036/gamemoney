<?php
header('Content-type:application/vnd.ms-excel');  //宣告網頁格式
header('Content-Disposition: attachment; filename=deposit_excel'.date('Y-m-d H:i:s').'.xls');  //設定檔案名稱
//ini_set("display_errors",1);
require "inc/inc.php";
require "func/func_deposit.php";
//require "head.php";
//$db->debug();

//取直
//
$start_day = ft($_GET['start_day'], 1);
$end_day = ft($_GET['end_day'], 1);
$name = ft($_GET['name'], 1);;

$arr_input['name'] = ft($_GET['name'], 0);
if (!isset($_GET['start_day'])) {
    $arr_input['start_day'] = ft($_GET['start_day'], 1);
    $start_day = $arr_input['start_day'];
} else {
    $arr_input['start_day'] = ft($_GET['start_day'] . ' 00:00:00', 1);
    $start_day = $arr_input['start_day'];
}
if (!isset($_GET['end_day'])) {
    $arr_input['end_day'] = ft($_GET['end_day'], 1);
    $end_day = $arr_input['end_date'];
} else {
    $arr_input['end_day'] = ft($_GET['end_day'] . ' 23:59:59', 1);
    $end_day = $arr_input['end_date'];
}


//$db->debug;

//撈資料到表格中 and 分頁

//$arr_page['page_id'] = ft($_GET['pageID'],0);
//$res_sum = get_playlog_excel($db, $arr_input, $page, $mbid);
//$arr_page['num'] = $res_sum['0']['cnt'];
//$page = new pager($arr_page);

$res = get_deposits($admin_db, [], $arr_input);

?>


<table>
    <thead>
    <tr>
        <th width="55">編號</th>
        <th width="100">儲值類別</th>
        <th width="100">儲值者名稱</th>
        <th width="100">儲值人員名稱</th>
        <th width="200">卡片序號</th>
        <th width="200">儲值金額</th>
        <th width="200">廠商交易單號</th>
        <th width="200">回傳訊息</th>
        <th width="200">交易狀態</th>
        <th width="200">建立時間</th>
    </tr>
    </thead>
    <tbody>


    <?php
    if (count($res) > 0) {
        foreach ($res as $key => $row) {
            ?>

            <tr>
                <!--將資料表內容引入-->

                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['card_type']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['admin_name']; ?></td>
                <td><?php echo $row['serial_number']; ?></td>
                <td><?php echo $row['points']; ?></td>
                <td><?php echo $row['transactionid']; ?></td>
                <td><?php echo $row['msg']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['create_date']; ?></td>
                <td><?php echo $row['update_date']; ?></td>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td colspan="11">
                <div class="row-fluid text-center">此會員無拉霸記錄</div>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
