<?php
require("inc/inc.php");
require("func/func_member.php");
require("head.php");
//$db->debug();
//取直
$arr_input['account'] = ft($_GET['account'], 1);
$account = $arr_input['account'];
//$db->debug;
//ini_set("display_errors",1);
//撈資料到表格中 and 分頁
$arr_page['page_id'] = ft($_GET['pageID'], 0);
$res_sum = get_member($admin_db, $arr_input);
$arr_page['num'] = $res_sum['0']['cnt'];
$page = new pager($arr_page);
$res = get_member($admin_db, $arr_input, $page);
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
                <h3>會員帳號管理</h3>
            </div>
            <!--新增按鈕-->
            <div class="row-fluid">
                <!--                    <div class="pull-left span3 text-left">
                                                                <button class="btn btn-primary" onclick="dialog_set('member_add_mod.php?act=add','新增',600,450);">新增</button>
                                    </div>-->
                <div class="pull-right text-right">
                    <form class="form-search" method="get">
                        <span>帳號 : <input name="account" id="account" class="input-medium search-query" placeholder="請輸入帳號" type="text" value="<?php echo $account; ?>"/></span>
                        <button type="submit"class="btn"><i class="icon-search"></i>搜尋</button>
                    </form>
                </div>
            </div>
            <!--資料內容-->
            <?php //echo $page->getPageHead(); ?> 

            <div class="row-fluid">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="55">功能</th>
                            <th width="100">帳號</th>
                            <th width="100">帳號類別</th>
                            <th width="100">儲值金額</th>
                            <th width="100">姓名</th>
                            <th width="200">生日</th>
                            <th width="200">行動電話</th>
                            <th width="200">住宅電話</th>
                            <th width="200">住宅地址</th>
                            <th width="200">電子郵件</th>
                            <th width="100">是否啟動</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($res) > 0) {
                            foreach ($res as $key => $row) {
                                //var_dump($res) ;     
                                ?>

                                <tr>
                                    <td>
                                        <!--功能:編輯/刪除觸發按鈕-->
                                        <a class="alphm_obj" title="編輯" onmouseover="$(this).tooltip('show');" href="javascript:void(0);" onclick="dialog_set('member_add_mod.php?id=<?php echo $row['id']; ?>', '修改', 600, 450);"><i class="icon-edit"></i></a>
                                    </td>
                                    <!--將資料表內容引入-->
                                    <td>
                                        <?php echo $row['account']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row['type'] == 0) {

                                            echo "一般帳號";
                                        }
                                        if ($row['type'] == 1) {

                                            echo "FB帳號";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $row['point']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['birthday']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['phone']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['tel']; ?>
                                    </td>                               
                                    <td>
                                        <?php echo $row['address']; ?>
                                    </td>                               
                                    <td>
                                        <?php echo $row['email']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row['is_del'] == 0) {
                                            echo '<a onclick="member_start(' . $row['id'] . ',' . $row['is_del'] . ');" href="javascript:void(0);" style="color:#080">啟動</a>';
                                        } else {
                                            echo '<a onclick="member_start(' . $row['id'] . ',' . $row['is_del'] . ');" href="javascript:void(0);" style="color:#D00">關閉</a>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="14">
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
            window.location.href = 'member_add_mod_act.php?act=start&id=' + id + '&start=' + start;
        }
    }
</script>	

<?php
require("foot.php");
?>