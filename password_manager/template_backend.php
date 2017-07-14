<?php
require("../inc/inc.php");
require(furl . "common/func_articles.php");
require(furl . "common/func_member.php");
require(cmsroot . "/layout/head.php");


//$db->debug();
//取直
$mod = ft($_GET['mod'], 0);
$arr_input['at_title'] = ft($_GET['name'], 1);
$name = $arr_input['at_title'];
//$db->debug;
//ini_set("display_errors",1);
//撈資料到表格中 and 分頁
$arr_page['page_id'] = ft($_GET['pageID'], 0);
$res_sum = get_articles_count($db,$name);
//var_dump($res_sum);
//var_dump($category);

$arr_page['num'] = $res_sum;
$page = new pager($arr_page);
$articles = get_cms_articles($db, $arr_input, $page);

//var_dump($articles);


?>
    <!--畫面呈現-->
    <div class="container-fluid">
        <div class="row-fluid">
            <!--列表-->
            <?php
            require_once furl . "cms/layout/left_menu.php";
            ?>

            <div class="span10">
                <!--標題列-->
                <div class="span12">
                    <h3>文章管理</h3>
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
                                onclick="dialog_set('articles_manager_add_mod.php?act=add','新增',600,600);">新增
                        </button>
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
                            <th width="200">文章標題</th>
                            <th width="150">文章類別</th>
                            <th width="300">文章內容</th>
                            <th width="200">文章圖片</th>
                            <th width="150">建立時間</th>
                            <th width="100">是否刪除</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (count($articles) > 0) {
                            foreach ($articles as $key => $row) {

//                                $get_mtid_name = db_select_anyid($db, "member_type", "mt_id", $row['ml_mtid']);
                                ?>
                                <tr>
                                    <td>
                                        <!--功能:編輯/刪除觸發按鈕-->
                                        <a class="alphm_obj" title="編輯" onmouseover="$(this).tooltip('show');"
                                           href="javascript:void(0);"
                                           onclick="dialog_set('articles_manager_add_mod.php?id=<?php echo $row['at_id']; ?>','修改',960,600);"><i
                                                    class="icon-edit"></i></a>
                                    </td>
                                    <!--將資料表內容引入-->
                                    <td>
                                        <?php echo $row['at_title']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['cg_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['at_content']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $img_name = "../storage/image/articles/" . $row['at_pic'];
                                        echo '<img width="300" src="' . $img_name . '" alt="' . $row['at_pic'], '" />';
                                        ?>

                                    </td>
                                    <td>
                                        <?php echo $row['created_at']; ?>
                                    </td>

                                    <td>
                                        <?php
                                        $deleted = is_null($row['deleted_at']) ? 1 : 0;
                                        if (is_null($row['deleted_at'])) {
                                            echo '<a onclick="article_del(' . $row['at_id'] . ',' . $deleted . ');" href="javascript:void(0);" style="color:#080">點擊刪除</a>';
                                        } else {
                                            echo '<a onclick="article_del(' . $row['at_id'] . ',' . $deleted . ');" href="javascript:void(0);" style="color:#D00">點擊開啟</a>';
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
                <?php echo $page->getPageFoot(); ?>
            </div>
        </div>
    </div>

    <script Language="JavaScript">
        //是否啟動
        function article_del(id, deleted) {

            if (deleted == 0) {
                var str = '開啟';
            }
            else {
                var str = '刪除';
            }
            if (confirm('您確定要' + str)) {
                window.location.href = 'articles_manager_add_mod_act.php?act=switch&id=' + id + '&deleted=' + deleted;
            }
        }
    </script>

<?php
require(furl . "cms/layout/foot.php");
?>