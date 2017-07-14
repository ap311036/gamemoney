<?php
require("inc/inc.php");
require(furl . "func/func_jpot.php");
require(furl . "func/func_member.php");
require(furl . "head.php");


//$db->debug();
//取直
$mod = ft($_GET['mod'], 0);

//$db->debug;
//ini_set("display_errors",1);
//撈資料到表格中 and 分頁
$jpot_set = get_jpot_setting($jpot_db);

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
                    <h3>JPOT管理</h3>
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
                    <!--                    <div class="pull-right text-right">
                        <form class="form-search" method="get">
							<span>姓名 : <input name="name" id="name" class="input-medium search-query" placeholder="請輸入姓名" type="text" value="<?php /*echo $name;*/ ?>"/></span>
                            <input name="mod" id="mod" class="input-medium search-query"  type="hidden" value="<?php /*echo $mod;*/ ?>"/>
							<button type="submit"class="btn"><i class="icon-search"></i>搜尋</button>
                        </form>
    				</div>-->
                </div>
                <!--資料內容-->
                <?php //echo $page->getPageHead();?>

                <div class="row-fluid">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr>
                            <th width="55">功能</th>
                            <th width="200">JPOT名稱</th>
                            <th width="150">底分</th>
                            <th width="150">押分</th>
                            <th width="150">累積</th>
                            <th width="150">累積上限</th>
                            <th width="150">抽獎機率</th>
                            <th width="150">押分比率</th>
                            <th width="150">目前JPOT累積<br>(不可修改)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (count($jpot_set) > 0) {
                            foreach ($jpot_set as $key => $row) {

//                                $get_mtid_name = db_select_anyid($db, "member_type", "mt_id", $row['ml_mtid']);
                                ?>
                                <tr>
                                    <td>
                                        <!--功能:編輯/刪除觸發按鈕-->
                                        <a class="alphm_obj" title="編輯" onmouseover="$(this).tooltip('show');"
                                           href="javascript:void(0);"
                                           onclick="dialog_set('jpot_setting_mod.php?id=<?php echo $row['id']; ?>','修改',600,600);"><i
                                                    class="icon-edit"></i></a>
                                    </td>
                                    <!--將資料表內容引入-->
                                    <td>
                                        <?php echo $row['jpot_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['button_points']/100; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['charge_points']/100; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['acc_ratio']/100; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['acc_limit']/100; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['lottery_ratio']/(1000).'%'; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['charge_ratio']/100; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['accumulation']/100; ?>
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

    </script>

<?php
require(furl . "foot.php");
?>