<?php
require("inc/inc.php");
require("func/func_slot_machine.php");
//$bk_bar_select = 2;
//$db->debug();
//顧客ID
$id = ft($_GET['id'],0);
//判斷是否有選擇，沒有id代表新增，有id代表選擇進行修改
if($id != '')
{
	$slot_machine_data = get_slot_machine_by_id($db, $id);
	if(count($slot_machine_data) < 0)
	{
		post_back('異常!');
	}
}
$edit_data = (count($id) > 0) ? true : false;

//var_dump($get_member_type);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>機台管理設定</title>

<link href="css/bootstrap.css" rel="stylesheet" media="screen">
<!--<link href="css/style.css" rel="stylesheet" media="screen">-->
<link href="css/jquery-ui-1.8.19.custom.css" rel="stylesheet"/>
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/comm.js"></script>
<script src="js/twzipcode-1.4.1-min.js"></script>
</head>
<body>	
			<!--標題列-->
			<h3>
				<?php echo ($edit_data == true) ?'修改':'新增'; ?>機台管理
			</h3>
			<form class="form-horizontal" action="slot_machine_add_mod_act.php" method="post" onSubmit="return checkForm();">
                            <?php
                                if ($edit_data == true)
                                {
                            ?>
                                    <!--編號-->
                                    <div class="control-group">
                                        <label class="control-label" for="input01">機台編號：<?php echo $slot_machine_data['sm_id'];?></label>
                                    </div>
                            <?php
                                }
                            ?>

                            <!--機台機率-->				
                            <div class="control-group">
                                    <label class="control-label" for="input01">機台機率：</label>
                                    <div class="controls">                        
                                        <select name="prob" id="type">
                                        <option value=""> 請選擇機率 </option>
                                        <?php
                                        for ($i=90;$i<100;$i++)
                                        { 
                                        ?>
                                            <option value="<?php echo $i;?>" <?php echo ($slot_machine_data['sm_prob'] == $i)?'selected="selected"':''?>> <?php echo $i;?> 
                                            </option>
                                        <?php 
                                        }
                                        ?>
                                        </select>    
                                    </div>	
                            </div>
				<!--押注金額設定-->				
				<div class="control-group">
					<label class="control-label" for="input01">最低單線押注金額：</label>
					<div class="controls">
                                        <input type="text" placeholder="請輸入最低單線押注金額" value="<?php echo ($edit_data == true) ? $slot_machine_data['min_bet_per_line'] : 10;?>" name="min_bet_per_line" id="min_bet_per_line" class="input-xlarge">
					</div>	
                            </div>
				<div class="control-group">
					<label class="control-label" for="input01">最高單線押注金額：</label>
					<div class="controls">
                                        <input type="text" placeholder="請輸入最高單線押注金額" value="<?php echo ($edit_data == true) ? $slot_machine_data['max_bet_per_line'] : 50;?>" name="max_bet_per_line" id="max_bet_per_line" class="input-xlarge">
					</div>	
                            </div>
				<div class="control-group">
					<label class="control-label" for="input01">最大持有金額：</label>
					<div class="controls">                        
                                        <input type="text" placeholder="請輸入最大持有金額" value="<?php echo ($edit_data == true) ? $slot_machine_data['max_money'] : 1000000;?>" name="max_money" id="max_money" class="input-xlarge">
					</div>	
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">最小攜帶點數：</label>
					<div class="controls">                        
                                        <input type="text" placeholder="請輸入最小攜帶點數" value="<?php echo ($edit_data == true) ? $slot_machine_data['min_trans_money'] : 180;?>" name="min_trans_money" id="min_trans_money" class="input-xlarge">
					</div>	
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">最大攜帶點數：</label>
					<div class="controls">                        
                                        <input type="text" placeholder="請輸入最大攜帶點數" value="<?php echo ($edit_data == true) ? $slot_machine_data['max_trans_money'] : 100000;?>" name="max_trans_money" id="max_trans_money" class="input-xlarge">
					</div>	
				</div>
				<div id="action_single" style="padding-left:20px;" class="form-actions text-center"> 
					<input type="submit" value="送出" class="btn-primary btn">&nbsp;    
					<button id="cancel" class="btn" type="reset" onclick="javascript:history.back();">取消</button>
					<!--是否選擇修改-->
					<input type="hidden" id="id" name="id" value="<?php echo $id;?>">
					<input type="hidden" id="act" name="act" value="<?php echo (count($id))?'mod':'add';?>">
				</div>
			</form>
		  </div>
            <!--/span-->
        </div>
        <!--/row-->

    </div>
	
<script type="text/javascript">
/*function checkForm()
{
	if(!checkempty('m_name','姓名')) return false;
	if(!checkempty('m_acc','帳號')) return false;
	if(!checkempty('m_pass','密碼')) return false;
	if(!checkempty('m_pro','職位')) return false;
}*/
</script>

</body>
</html>
