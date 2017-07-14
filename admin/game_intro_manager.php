<?php
require("inc/inc.php");
require(furl . "func/func_center.php");
require(furl . "func/func_member.php");
require(furl . "head.php");


//$db->debug();
//取直
$mod = ft($_GET['mod'], 0);

//$db->debug;
//ini_set("display_errors",1);
//撈資料到表格中 and 分頁


$arr_input['center'] = ft($_GET['center'], 1);
$account = $arr_input['ml_account'];

$game = ft($_GET['game'], 1);

//$db->debug;
//ini_set("display_errors",1);
//撈資料到表格中 and 分頁
$center = get_game_center_list($admin_db);
$arr_page['page_id'] = ft($_GET['pageID'], 0);
$res_sum = get_game_intro_detail($admin_db, $arr_input);
$arr_page['num'] = $res_sum['0']['cnt'];
$page = new pager($arr_page);
$res = get_game_intro_detail($admin_db, $arr_input, $page);

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
                    <h3>遊戲說明管理</h3>
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
                                onclick="dialog_set('game_intro_manager_add_mod.php?act=add','新增',600,600);">新增
                        </button>

                    </div>
                    <div class="pull-left span6 text-left">

                        <?php
                        foreach ($center as $v) {
                            $center_name = $v['title'];
                            echo '<a class="btn btn-primary" href="game_intro_manager.php?center=' . $center_name . '">' . $center_name . '</a>';


                        }
                        ?>
                    </div>
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
                            <th width="200">館別</th>
                            <th width="200">圖片icon</th>
                            <th width="200">遊戲說明</th>
                            <th width="200">遊戲規則</th>
                            <th width="150">排序</th>
                            <th width="150">建立時間</th>
                            <th width="150">是否關閉</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (count($res) > 0) {
                            foreach ($res as $key => $row) {
                                var_dump($row['id']);
//                                $get_mtid_name = db_select_anyid($db, "member_type", "mt_id", $row['ml_mtid']);
                                ?>
                                <tr>
                                    <td>
                                        <!--功能:編輯/刪除觸發按鈕-->
                                        <a class="alphm_obj" title="編輯編輯遊戲說明及設定" onmouseover="$(this).tooltip('show');"
                                           href="javascript:void(0);"
                                           onclick="dialog_set('game_intro_manager_add_mod.php?id=<?php echo $row['id']; ?>','修改',600,600);"><i
                                                    class="icon-edit"></i></a>
                                        <a class="alphm_obj" title="編輯遊戲規則" onmouseover="$(this).tooltip('show');"
                                           href="javascript:void(0);"
                                           onclick="dialog_set('game_intro_rules_add_mod.php?id=<?php echo $row['id']; ?>','修改',960,600);"><i
                                                    class="icon-edit"></i></a>
                                    </td>
                                    <!--將資料表內容引入-->
                                    <td>
                                        <?php echo $row['center']; ?>
                                    </td>
                                    <td>
                                        <img width="90" src="../img/<?php echo $row['game_icon']; ?>"
                                             alt="<?php echo $row['game_icon']; ?>">
                                    </td>
                                    <td>
                                        <?php echo $row['game_intro']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['game_rules']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['order_id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['created_at']; ?>
                                    </td>

                                    <td>
                                        <?php
                                        $del = $row['is_delete'] == 1 ? 0 : 1;
                                        if ($row['is_delete'] == 0) {


                                            echo '<a onclick="game_start(' . $row['id'] . ',' . $del . ');" href="javascript:void(0);" style="color:#080">啟動中</a>';
                                        } else {
                                            echo '<a onclick="game_start(' . $row['id'] . ',' . $del . ');" href="javascript:void(0);" style="color:#D00">關閉中</a>';
                                        }
                                        ?>
                                        <!--                                        --><?php //echo $row['is_delete']; ?>
                                    </td>
                                    <!--                                    <td>-->
                                    <!--                                        --><?php
                                    //                                        $img_name = "../storage/image/articles/" . $row['at_pic'];
                                    //                                        echo '<img width="300" src="' . $img_name . '" alt="' . $row['at_pic'], '" />';
                                    //                                        ?>
                                    <!---->
                                    <!--                                    </td>-->


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
        function game_start(id, del) {
            if (del == 0) {
                var str = '啟動';
            }
            else {
                var str = '關閉';
            }
            if (confirm('您確定要' + str)) {
                window.location.href = 'game_intro_manager_add_mod_act.php?act=switch&id=' + id + '&del=' + del;
            }
        }
    </script>

<?php
require(furl . "foot.php");
?>