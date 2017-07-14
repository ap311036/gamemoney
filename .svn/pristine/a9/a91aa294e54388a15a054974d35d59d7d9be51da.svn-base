<?php
require("inc/inc.php");
require("func/func_jpot.php");
require("head.php");

//$db->debug();
//ini_set("display_errors",1);
//撈資料到表格中 and 分頁
$arr_input['start_day'] = ft($_GET['start_date'], 1);
$arr_input['end_day'] = ft($_GET['end_date'], 1);
$arr_input['member_name'] = ft($_GET['member_name'], 1);
//var_dump($arr_input);
$arr_page['page_id'] = ft($_GET['pageID'], 0);
$res_sum = get_jpot_win_record_count($admin_db, $arr_input);
//$res_sum = get_member($db, $arr_input);
//var_dump($res_sum);
//var_dump($res_sum);
$arr_page['num'] = $res_sum;
$page = new pager($arr_page);
$res = get_jpot_win_record($admin_db, $page, $arr_input);
//var_dump($res);
//die;

?>
    <!--畫面呈現-->
    <div class="container-fluid">
        <div class="row-fluid">
            <!--列表-->
            <?php
            require_once "left_menu.php";
            ?>

            <div class="span10">
                <!--標題列-->
                <div class="span12">
                    <h3>JPOT得獎紀錄</h3>
                </div>

                <div class="row-fluid" id="form-search" style="">
                    <form class="form-logexcel" method="post">
                        <input name="name" id="name" class="input-medium search-query" type="hidden"
                               value="<?php echo $arr_input['name']; ?>"/>
                        <input name="start_day" id="start_day" class="input-medium search-query" type="hidden"
                               value="<?php echo $arr_input['start_day']; ?>"/>
                        <input name="end_day" id="end_day" class="input-medium search-query" type="hidden"
                               value="<?php echo $arr_input['end_day']; ?>"/>
                        <!--                        --><?php
                        //                        if ($arr_input['start_day'] == "" || $arr_input['end_day'] == "" || count($res) == 0) {
                        //                            ?>
                        <!--                            <button type="button" class="btn" disabled>轉出EXCEL</button>-->
                        <!--                            --><?php
                        //                        } else {
                        //                            ?>
                        <!--                            <button type="button" id="excelbtn" class="btn">轉出EXCEL</button>-->
                        <!--                        --><?php //} ?>
                    </form>
                </div>
                <div class="pull-right text-right">
                    <form class="form-search" method="get">
                        <span>從&nbsp;<input type="date" name="start_date" id="start_date"
                                            value="<?php echo $start_date; ?>" class="input-xlarge">&nbsp;至&nbsp;
 				        <input type="date" name="end_date" id="end_date" value="<?php echo $end_date; ?>"
                               class="input-xlarge">&nbsp;止<span>
                        <span>姓名 : <input name="member_name" id="member_name" class="input-medium search-query" placeholder="請輸入姓名"
                                          type="text"
                                          value="<?php echo $name; ?>"/></span>
                        <button type="submit" class="btn"><i class="icon-search"></i>搜尋</button>
                    </form>
                </div>

                <!--資料內容-->
                <div class="row-fluid">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr>
                            <th width="55">編號</th>
                            <th width="100">得獎名稱</th>
                            <th width="100">遊戲名稱</th>
                            <th width="200">得獎帳號</th>
                            <th width="100">得獎者</th>
                            <th width="200">得獎時間</th>
                            <!--<th width="200">更新時間</th>-->
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
                                    <?php echo $row['jpot_name'] ?>
                                </td>
                                <td>
                                    <?php echo $row['game_name'] ?>
                                </td>
                                <td>
                                    <?php echo $row['member_account']; ?>
                                </td>
                                <td>
                                    <?php echo $row['member_name']; ?>
                                </td>
                                <td>
                                    <?php echo $row['created_at']; ?>
                                </td>

                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="18">
                                    <div class="row-fluid text-center">查無資料</div>
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
                var name = $('#name').val();
                if (name == '')
                    window.location.href = 'deposit_history_excel.php?start_day=' + start_day + '&end_day=' + end_day;
                window.location.href = 'deposit_history_excel.php?start_day=' + start_day + '&end_day=' + end_dayn + '&name=' + name;

                //alert(sm_id+'-'+start_day+'-'+end_day);
            });

        });
    </script>

<?php
require("foot.php");
?>