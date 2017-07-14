<?php
//ini_set("display_errors",1);
require "inc/inc.php";
require "func/func_member_game.php";
require "head.php";
//$db->debug();
$bk_bar_select == 2;
//取直
$id = ft($_GET['id'], 0);
$start_day = ft($_GET['start_date'], 1);
$end_day = ft($_GET['end_date'], 1);
$mbid = $id;

$arr_input['id'] = ft($_GET['id'], 0);

if (!isset($_GET['start_date'])) {
    $arr_input['start_date'] = ft($_GET['start_date'], 1);
    $start_date = $arr_input['start_date'];
} else {
    $arr_input['start_date'] = ft($_GET['start_date'] . ' 00:00:00', 1);
    $start_date = $arr_input['start_date'];
}
if (!isset($_GET['end_date'])) {
    $arr_input['end_date'] = ft($_GET['end_date'], 1);
    $end_date = $arr_input['end_date'];
} else {
    $arr_input['end_date'] = ft($_GET['end_date'] . ' 23:59:59', 1);
    $end_date = $arr_input['end_date'];
}

//$db->debug;
//撈資料到表格中 and 分頁

$arr_page['page_id'] = ft($_GET['pageID'], 0);
$res_sum = get_playlog($win7pk_db, $arr_input, $page, $id);
$arr_page['num'] = $res_sum['0']['cnt'];
$page = new pager($arr_page);

$res = get_playlog($win7pk_db, $arr_input, $page, $id, $ml_id, $start_date, $end_date);

//var_dump($res);
//die;
?>
<!--畫面呈現-->
<div class="container-fluid">
    <div class="row-fluid">
        <!--列表-->
        <?php require_once "left_menu.php"; ?>

        <div class="span10">
            <!--標題列-->
            <div class="span10">
                <h3>會員遊玩記錄</h3>
            </div>

            <!--列表-->

            <div class="row-fluid">
                <div class="pull-left span10 text-left">				

                </div>
            </div>
            <!--新增按鈕-->

            <div class="row-fluid">
                </br>

                <div class="pull-right text-right">
                    <form class="form-playlog" method="get">
                        <span>從&nbsp;<input type="date" name="start_date" id="start_date" value="<?php echo $start_date; ?>" class="input-xlarge">&nbsp;至&nbsp;
                            <input type="date" name="end_date" id="end_date" value="<?php echo $end_date; ?>" class="input-xlarge">&nbsp;止<span>                  
                                <input name="id" id="id" class="input-medium search-query"  type="hidden" value="<?php echo $id; ?>"/>
                                <button type="submit" id="btn" class="btn"><i class="icon-search"></i>搜尋</button>
                                </form>

                                <form class="form-playlogexcel" method="post" >
                                    <input name="mbid" id="mbid" class="input-medium search-query" type="hidden" value="<?php echo $id; ?>"/>                        
                                    <input name="start_day" id="start_day" class="input-medium search-query"  type="hidden" value="<?php echo $start_date; ?>"/>
                                    <input name="end_day" id="end_day" class="input-medium search-query"  type="hidden" value="<?php echo $end_date; ?>"/> 
                                    <?php
                                    if ($start_day == "" || $end_day == "" || count($res) == 0) {
                                        ?>
                                        <button type="button" class="btn" disabled >轉出EXCEL</button>  
                                        <?php
                                    } else {
                                        ?>
                                        <button type="button" id="excelbtn" class="btn" >轉出EXCEL</button>
                                    <?php } ?>
                                </form>                        
                                </div>
                                </div>
                                <!--資料內容-->
                                <?php echo $page->getPageHead(); ?>

                                <div class="row-fluid">
                                    <table class="table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="50">編號</th>
                                                <th width="100">會員名稱</th>                               
                                                <th width="100">機台編號</th>
                                                <th width="100">分區編號</th>
                                                <th width="100">押注金額</th>
                                                <th width="100">牌型名稱</th>
                                                <th width="100">牌型贏得倍率</th>
                                                <th width="100">比倍次數</th>
                                                <th width="100">比倍贏得倍率</th>
                                                <th width="100">JP贏錢金額</th>
                                                <th width="100">總贏錢金額</th>
                                                <th width="100">建立時間</th>                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (count($res) > 0) {
                                                foreach ($res as $key => $row) {
                                                    ?>
                                                    <tr>

                                                        <!--將資料表內容引入-->
                                                        <td>
                                                            <?php echo $row['id']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['gml_name'] . "(" . $row['ml_id'] . ")"; ?>
                                                        </td>
                                                        <td><?php echo $row['ps_id']; ?></td>
                                                        <td><?php echo $row['psz_id']; ?></td>
                                                        <td><?php echo $row['total_bet']; ?></td>
                                                        <td><?php echo $row['suit_type']; ?></td>
                                                        <td><?php echo $row['suit_win_factor']; ?></td>
                                                        <td><?php echo $row['double_count']; ?></td>
                                                        <td><?php echo $row['double_win_factor']; ?></td>
                                                        <td><?php echo $row['jp_win']; ?></td> 
                                                        <td><?php echo $row['total_win']; ?></td>
                                                        <td><?php echo $row['ps_time']; ?></td>                              
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="12">
                                                        <div class="row-fluid text-center">此會員無遊玩記錄</div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php echo $page->getPageFoot(); ?>
                                </div>
                                </div>
                                </div>
                                <script Language="JavaScript">

                                    $(document).ready(function () {

                                        $('#btn').click(function () {

                                            var start_date = $('#start_date').val();
                                            var end_date = $('#end_date').val();

                                            if (start_date == "") {

                                                alert("起始日沒填寫");
                                                return false;
                                            }
                                            if (end_date == "") {

                                                alert("結束日沒填寫");
                                                return false;
                                            }
                                            if (start_date > end_date) {

                                                alert("結束日必須大於起始日");
                                                return false;
                                            }

                                        });
                                        $('#excelbtn').click(function () {

                                            var start_day = $('#start_day').val().substring(0, 10);
                                            var end_day = $('#end_day').val().substring(0, 10);
                                            var mbid = $('#mbid').val();

                                            window.location.href = 'member_playlog_excel.php?mbid=' + mbid + '&start_day=' + start_day + '&end_day=' + end_day;

                                            //alert(mbid+'-'+start_day+'-'+end_day);
                                        });

                                    });
                                </script>   
                                <?php
                                require "foot.php";
                                ?>