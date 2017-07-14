<?php
header('Content-type:application/vnd.ms-excel');  //宣告網頁格式
header('Content-Disposition: attachment; filename=member_slotlog_excel.xls');  //設定檔案名稱
//ini_set("display_errors",1);
require "inc/inc.php";
require "func/func_member_slotlog_excel.php";
//require "head.php";
//$db->debug();

//取直

$start_day = ft($_GET['start_day'],1);
$end_day = ft($_GET['end_day'],1);
$mbid = ft($_GET['mbid'],0);;

$arr_input['mbid'] = ft($_GET['mbid'],0);
if(!isset($_GET['start_day'])){
    $arr_input['start_day'] = ft($_GET['start_day'],1);
    $start_day = $arr_input['start_day'];      
}else{
    $arr_input['start_day'] = ft($_GET['start_day'].' 00:00:00',1);
    $start_day = $arr_input['start_day'];
}
if(!isset($_GET['end_day'])){
    $arr_input['end_day'] = ft($_GET['end_day'],1);
    $end_day = $arr_input['end_date'];
}else{
    $arr_input['end_day'] = ft($_GET['end_day'].' 23:59:59',1);
    $end_day = $arr_input['end_date'];
}



//$db->debug;

//撈資料到表格中 and 分頁

//$arr_page['page_id'] = ft($_GET['pageID'],0);
//$res_sum = get_playlog_excel($db, $arr_input, $page, $mbid);
//$arr_page['num'] = $res_sum['0']['cnt'];
//$page = new pager($arr_page);

$res = get_slotlog_excel($db, $arr_input, $page, $mbid, $start_day, $end_day);

?>


                    <table>
                        <thead>
                            <tr>
                                <th width="50">編號</th>
                                <th width="100">會員名稱</th>
                                <th width="100">會員編號</th>                                
                                <th width="100">機台編號</th>
                                <th width="200">押注金額</th>
                                <th width="200">拉霸中獎金額</th>
                                <th width="200">獎勵遊戲遊玩次數</th>
                                <th width="200">獎勵遊戲中獎金額</th>
                                <th width="200">總中獎金額</th>
                                <th width="200">詳細資訊</th>
                                <th width="200">時間</th>                              
                            </tr>
                        </thead>
                        <tbody>
                    <?php
                    if (count($res) > 0) {
                        foreach ($res as $key => $row) {     
                     ?>

                            <tr>                 
                                <td><?php echo $row['sl_id'];?></td>
                                <td><?php echo $row['gml_name'];?></td>
                                <td><?php echo $row['gml_id'];?></td>                                
                                <td><?php echo $row['sm_id'];?></td>
                                <td><?php echo $row['bet'];?></td>
                                <td><?php echo $row['spin_win'];?></td>
                                <td><?php echo $row['bonus_count'];?></td>
                                <td><?php echo $row['bonus_win'];?></td>
                                <td><?php echo $row['total_win'];?></td>
                                <td><?php echo $row['sl_log'];?></td>
                                <td><?php echo $row['sl_time'];?></td>                             
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
