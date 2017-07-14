<?php
require("inc/inc.php");
require("func/func_admin.php");
require("head.php");
//$db->debug();
//取直
$arr_input['ad_mtid'] = ft($_GET['mod'], 0);
$arr_input['ad_name'] = ft($_GET['name'], 1);
$name = $arr_input['ad_name'];
$mod = $arr_input['ad_mtid'];
//$db->debug;
//ini_set("display_errors",1);
//撈資料到表格中 and 分頁
$arr_page['page_id'] = ft($_GET['pageID'], 0); //


$mod = $_GET['mod'];

//var_dump($mod);
//$res_sum = get_Problem_Management($admin_db, $arr_input);
//$arr_page['num'] = $res_sum['0']['cnt'];
$page = new pager($arr_page);
$res = get_message($admin_db,$res);
//var_dump($res);
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
                <h3>觀看留言</h3>
            </div>
            <div class="row-fluid">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="200">留言者</th>
                            <th width="200">聯絡電話</th>
                            <th width="200">電子信箱</th>
                            <th width="200">留言內容</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($res) > 0) {
                            foreach ($res as $key => $row) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $row['name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['phone']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['email']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['content']; ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="6">
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

//是否啟動
    function member_start(id, start)
    {
        if (start == 0)
        {
            var str = '啟動';
        } else
        {
            var str = '關閉';
        }
        if (confirm('您確定要' + str))
        {
            window.location.href = 'common_problem_add_mod_act.php?act=start&id=' + id + '&start=' + start;
        }
    }
</script>	

<?php
require("foot.php");
?>