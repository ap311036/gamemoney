<?php
require("inc/inc.php");
require("func/func_member.php");
require("head.php");
//$db->debug();
//取直
$arr_input['account'] = ft($_GET['account'],1);
$account = $arr_input['account'];
//$db->debug;
//ini_set("display_errors",1);
//撈資料到表格中 and 分頁
$arr_page['page_id'] = ft($_GET['pageID'],0);
$res_sum = get_member_transform_log($admin_db, $arr_input);
$arr_page['num'] = $res_sum['0']['cnt'];
$page = new pager($arr_page);
$res = get_member_transform_log($admin_db, $arr_input, $page);

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
                    <h3>會員平台轉帳紀錄</h3>
                </div>
                <div class="row-fluid">
                    <div class="pull-right text-right">
                        <form class="form-search" method="get">
                            <span>帳號 : <input name="account" id="account" class="input-medium search-query" placeholder="請輸入帳號" type="text" value="<?php echo $account;?>"/></span>
                            <button type="submit"class="btn"><i class="icon-search"></i>搜尋</button>
                        </form>
    				</div>
                </div>
				<!--資料內容-->
                <?php //echo $page->getPageHead();?> 
				
                <div class="row-fluid">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="200">轉出會員帳號</th>
                                <th width="100">轉出會員姓名</th>
                                <th width="200">轉入會員帳號</th>
                                <th width="100">轉入會員姓名</th>
                                <th width="200">轉出金額</th>
                                <th width="100">手續費</th>
                                <th width="200">轉帳時間</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(count($res) > 0)
                            {
                                foreach($res as $key => $row)
                                { 
                              //var_dump($res) ;     
                            ?>

                            <tr>
                                <!--將資料表內容引入-->
                                <td>
                                        <?php echo $row['out_account'];?>
                                </td>
                                <td>
                                        <?php echo $row['out_name'];?>
                                </td>
                                <td>
                                        <?php echo $row['in_account'];?>
                                </td>
                                <td>
                                        <?php echo $row['in_name'];?>
                                </td>
                                <td>
                                        <?php echo $row['reduce_point'];?>
                                </td>
                                <td>
                                        <?php echo $row['fee'];?>
                                </td>
                                <td>
                                        <?php echo $row['create_at'];?>
                                </td>
                            </tr>
                            <?php 
                                }
                            }
                            else 
                            {
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
                <?php echo $page->getPageFoot();?>
            </div>
        </div>
    </div>
	<script Language="JavaScript">
	</script>	

<?php 
require("foot.php");
?>