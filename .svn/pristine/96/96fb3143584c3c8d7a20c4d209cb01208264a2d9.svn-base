<?php

require("inc/inc.php");
require("func/func_slot_machine.php");
require("head.php");

//$db->debug;
$id = ft($_GET['id'],0);
$res = get_slot_machine_by_id($db, $id);
$sm_hit_symbol = $res['sm_hit_symbol'];
$td_style = "text-align: center; vertical-align: middle; font-size:20px;";
$symbol_data_array = array();
if ($sm_hit_symbol != null && empty($sm_hit_symbol) == false)
{
    $symbol_data_array = explode("[", $sm_hit_symbol);
}
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
                    <h3>機台<?php echo $id; ?>號中獎詳細紀錄</h3>
                </div>
                <div class="row-fluid">
                    <div class="pull-left span10 text-left">
                        <div class="btn-group">
                            <a href="slot_machine.php"  class="btn btn-primary"  title="回上頁"><b>回上頁</b></a>
                        </div>	
                    </div>
                </div>
                <div class="row-fluid" id="logdata">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="<?php echo $td_style;?>" width="150">15輪圖標</th>
                                <th style="<?php echo $td_style;?>" width="100">15X</th>
                                <th style="<?php echo $td_style;?>" width="100">3X</th>
                                <th style="<?php echo $td_style;?>" width="100">4X</th>
                                <th style="<?php echo $td_style;?>" width="100">5X</th>
                                <th style="<?php echo $td_style;?>" width="150">副遊戲圖標</th>
                                <th style="<?php echo $td_style;?>" width="100">All</th>
                                <th style="<?php echo $td_style;?>" width="100">1X</th>
                                <th style="<?php echo $td_style;?>" width="100">2X</th>
                                <th style="<?php echo $td_style;?>" width="100">3X</th>
                                <th style="<?php echo $td_style;?>" width="100">4X</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (empty($symbol_data_array) == false)
                            {
                                for ($i=1;$i<count($symbol_data_array);++$i)
                                {
                                    $symbol_name = "Symbol".$i.".png";
                                    $symbol_data = $symbol_data_array[$i];
                                    $symbol_data = str_replace("]", ",", $symbol_data);
                                    $sub_symbol_data_array = explode(",", $symbol_data);
                            ?>
                            <tr>
                                <td style="<?php echo $td_style;?>">
                                        <img src="images/symbol/<?php echo $symbol_name;?>" width="50"/>
                                </td>
                                <td style="<?php echo $td_style;?>">
                                        <?php echo $sub_symbol_data_array[0];?>
                                </td>
                                <td style="<?php echo $td_style;?>">
                                        <?php echo $sub_symbol_data_array[1];?>
                                </td>
                                <td style="<?php echo $td_style;?>">
                                        <?php echo $sub_symbol_data_array[2];?>
                                </td>
                                <td style="<?php echo $td_style;?>">
                                        <?php echo $sub_symbol_data_array[3];?>
                                </td>
                                <td style="<?php echo $td_style;?>">
                                        <img src="images/symbol/<?php echo $symbol_name;?>" width="50"/>
                                </td>
                                <td style="<?php echo $td_style;?>">
                                        <?php echo $sub_symbol_data_array[4];?>
                                </td>
                                <td style="<?php echo $td_style;?>">
                                        <?php echo $sub_symbol_data_array[5];?>
                                </td>
                                <td style="<?php echo $td_style;?>">
                                        <?php echo $sub_symbol_data_array[6];?>
                                </td>
                                <td style="<?php echo $td_style;?>">
                                        <?php echo $sub_symbol_data_array[7];?>
                                </td>
                                <td style="<?php echo $td_style;?>">
                                        <?php echo $sub_symbol_data_array[8];?>
                                </td>
                            </tr>   
                            <?php 
                                }
                            }
                            else 
                            {
                            ?>
                            <tr>
                                <td colspan="11">
                                    <div class="row-fluid text-center">查無機台中獎記錄</div>
                                </td>
                            </tr>
                            <?php 
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
	<script Language="JavaScript">
	</script>	
<?php 
require("foot.php");
?>