<?php
//ini_set("display_errors",1);
require("inc/inc.php");
require(furl . "func/func_marquee.php");
require(furl . "head.php");


//$db->debug();
//取直
$mod = ft($_GET['mod'], 0);

//$db->debug;
//ini_set("display_errors",1);
//撈資料到表格中 and 分頁
//$center_list = get_product_information($admin_db);
$center_list = get_marquee($admin_db);

//var_dump($center_list);
?>
<!--畫面呈現-->
<div class="container-fluid">
    <div class="row-fluid">
        <!--列表-->
        <?php
        require_once furl . "left_menu.php";
        ?>

        <div class="span10">
            <!--標題列-->
            <div class="span12">
                <h3>跑馬燈管理</h3>
            </div>

            <!--列表-->

            <div class="row-fluid">
                <div class="pull-left span10 text-left">
                    <div class="btn-group">

                    </div>
                </div>

                </br>

            </div>
            <!--新增按鈕-->
            <div class="row-fluid">
                <div class="pull-left span3 text-left">
                    <button class="btn btn-primary"
                            onclick="dialog_set('marquee_add_mod.php?act=add', '新增', 600, 600);">新增
                    </button>
                </div>
            </div>
            <!--資料內容-->
            <?php //echo $page->getPageHead();  ?>

            <div class="row-fluid">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="55">功能</th>
                            <th width="200">跑馬燈抬頭</th>
                            <th width="200">跑馬燈描述</th>
                            <th width="150">開始時間</th>
                            <th width="150">結束時間</th>
                            <th width="150">是否刪除</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($center_list) > 0) {
                            foreach ($center_list as $key => $row) {

//                                $get_mtid_name = db_select_anyid($db, "member_type", "mt_id", $row['ml_mtid']);
                                ?>
                                <tr>
                                    <td>
                                        <!--功能:編輯/刪除觸發按鈕-->
                                        <a class="alphm_obj" title="編輯" onmouseover="$(this).tooltip('show');"
                                           href="javascript:void(0);"
                                           onclick="dialog_set('marquee_add_mod.php?id=<?php echo $row['id']; ?>', '修改', 600, 600);"><i
                                                class="icon-edit"></i></a>
                                    </td>
                                    <!--將資料表內容引入-->
                                    <td>
                                        <?php echo $row['title']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['msg']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['m_start_date']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['m_end_date']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row['m_del'] == 0) {
                                            $deleted = 1;
                                        }
                                        if ($row['pay_del'] == 0) {
                                            // var_dump($row['id'], $deleted);
                                            echo '<a onclick="article_del(' . $row['id'] . ',' . $deleted . ');" href="javascript:void(0);" style="color:#080">點擊刪除</a>';
                                        } else {
                                            echo '<a onclick="article_del(' . $row['id'] . ',' . $deleted . ');" href="javascript:void(0);" style="color:#D00">點擊開啟</a>';
                                        }
                                        ?>
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
            <?php //echo $page->getPageFoot();  ?>
        </div>
    </div>
</div>

<script Language="JavaScript">
    //是否啟動
    function article_del(id, deleted) {

        if (deleted == 0) {
            var str = '開啟';
        } else {
            var str = '刪除';
        }
        if (confirm('您確定要' + str)) {
            window.location.href = 'marquee_add_mod_act.php?act=switch&id=' + id + '&deleted=' + deleted;
        }
    }
</script>

<?php
require(furl . "foot.php");
?>