<?php
require("inc/inc.php");
require("func/func_admin.php");
require("head.php");
//$db->debug();
//取直
$arr_input['ad_mtid'] = ft($_GET['mod'],0);
$arr_input['ad_name'] = ft($_GET['name'],1);
$name = $arr_input['ad_name'];
$mod  = $arr_input['ad_mtid'];
//$db->debug;
//ini_set("display_errors",1);
//撈資料到表格中 and 分頁
$arr_page['page_id'] = ft($_GET['pageID'],0);//
$res_sum = get_admin($admin_db, $arr_input);
$arr_page['num'] = $res_sum['0']['cnt'];
$page = new pager($arr_page);
$res = get_admin($admin_db, $arr_input, $page);


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
                    <h3>管理員帳號管理</h3>
                </div>
				
				<!--列表-->
				
				<div class="row-fluid">
					<div class="pull-left span10 text-left">
						<div class="btn-group">
                       		<a href="admin.php?mod=0"  class="btn"  title="全部"><b>全部</b></a>
							<a href="admin.php?mod=1&name=<?php echo $name;?>"  class="btn"  title="超級管理員"><b>超級管理員</b></a>
							<a href="admin.php?mod=2&name=<?php echo $name;?>"  class="btn"  title="管理員"><b>管理員</b></a>			
														
						</div>	
					</div>
					
					</br>
					
	    		</div>
				<!--新增按鈕-->
                <div class="row-fluid">
                    <div class="pull-left span3 text-left">
						<button class="btn btn-primary" onclick="dialog_set('admin_add_mod.php?act=add','新增',600,450);">新增</button>
                    </div>
                    <div class="pull-right text-right">
                        <form class="form-search" method="get">
							<span>姓名 : <input name="name" id="name" class="input-medium search-query" placeholder="請輸入姓名" type="text" value="<?php echo $name;?>"/></span>
                            <input name="mod" id="mod" class="input-medium search-query"  type="hidden" value="<?php echo $mod;?>"/>
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
                                <th width="55">功能</th>
                                <th width="200">帳號</th>
                                <th width="200">姓名</th>
                                <th width="200">職務</th>
                                <th width="100">是否啟動</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(count($res) > 0)
                            {
                                foreach($res as $key => $row)
                                { 
								
								$get_adtid_name =  db_select_anyid($admin_db,"admin_type","adt_id",$row['ad_mtid']);
                            ?>
                            <tr>
                                <td>
									<!--功能:編輯/刪除觸發按鈕-->
									<a class="alphm_obj" title="編輯" onmouseover="$(this).tooltip('show');" href="javascript:void(0);" onclick="dialog_set('admin_add_mod.php?id=<?php echo $row['ad_id'];?>','修改',600,450);"><i class="icon-edit"></i></a>
                                </td>
								<!--將資料表內容引入-->
                                <td>
									<?php echo $row['ad_account'];?>
								</td>
								<td>
									<?php echo $row['ad_name'];?>
								</td>
                                <td>
									<?php echo $get_adtid_name[0]['adt_name'];?>
								</td>
                                <td>
									<?php 
										if($row['ad_del'] == 0)
										{
											echo '<a onclick="member_start('.$row['ad_id'].','.$row['ad_del'].');" href="javascript:void(0);" style="color:#080">啟動</a>';
										}
										else
										{
											echo '<a onclick="member_start('.$row['ad_id'].','.$row['ad_del'].');" href="javascript:void(0);" style="color:#D00">關閉</a>';
										}
									?>
								</td>
                            </tr>
                            <?php 
                                }
                            }
                            else 
                            {
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
                <?php echo $page->getPageFoot();?>
            </div>
        </div>
    </div>
    
	<script Language="JavaScript">
	
	//是否啟動
	function member_start(id,start)
	{
		if(start == 0)
		{
			var str = '啟動';
		}
		else
		{
			var str = '關閉';
		}
		if(confirm('您確定要'+str))
		{
			window.location.href='admin_add_mod_act.php?act=start&id='+id+'&start='+start;
		}
	}
	</script>	

<?php 
require("foot.php");
?>