<?php
require("inc/inc.php");
require("func/func_admin.php");
//$bk_bar_select = 2;
//$db->debug();
//顧客ID
$id = ft($_GET['id'],0);
//判斷是否有選擇，沒有id代表新增，有id代表選擇進行修改
if($id != '')
{
	$admin_once = get_admin_id($admin_db, $id);
	if(count($admin_once) < 0)
	{
		post_back('異常!');
	}
}
//取得所有帳號類別
$get_admin_type = get_admin_type($admin_db);

//var_dump($get_admin_type);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>帳號管理設定</title>

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
				<?php echo (count($id) > 0)?'修改':'新增';?>帳號管理
			</h3>
			<form class="form-horizontal" action="admin_add_mod_act.php" method="post" onSubmit="return checkForm();">	
				<div class="control-group">
					<label class="control-label" for="xlInput"></label>
						<code>Note :</code> 標記 
						<code>*</code> 為必填。
                </div>				
				
				<!--帳號-->
                <div class="control-group">
					<label class="control-label" for="input01">帳號<span class="red">*</span>：</label>
					<div class="controls">    
						<?php 
						if(count($id)>0)
						{
						?>
							<input type="hidden" placeholder="請輸入帳號" value="<?php echo $admin_once['ad_account'];?>" name="ad_account" id="ad_account" class="input-xlarge"><?php echo $admin_once['ad_account'];?>
						<?php
						}
						else
						{
						?>
							<input type="text" placeholder="請輸入帳號" value="<?php echo $admin_once['ad_account'];?>" name="ad_account" id="ad_account" class="input-xlarge">
						<?php
						}
						?>
							
					</div>
				</div>
                
				<!--密碼-->
                <div class="control-group">
					<label class="control-label" for="input01">密碼<span class="red">*</span>：</label>
					<div class="controls">                        
						<input type="password" placeholder="請輸入密碼" value="<?php echo (count($id) > 0)?'******':'';?>" name="ad_pass" id="ad_pass" class="input-xlarge">  
						<br>說明：密碼需有英文和數字並達8個以上
					</div>
				</div>

				<!--姓名-->				
				<div class="control-group">
					<label class="control-label" for="input01">姓名<span class="red">*</span>：</label>
					<div class="controls">                        
						<input type="text" placeholder="請輸入姓名" value="<?php echo $admin_once['ad_name'];?>" name="ad_name" id="ad_name" class="input-xlarge">   
					</div>	
				</div>
                
                <!--帳號種類-->				
				<div class="control-group">
					<label class="control-label" for="input01">帳號類別<span class="red">*</span>：</label>
					<div class="controls">                        
                    <select name="type" id="type">
                        		<option value=""> 請選擇類別 </option>
                        		<?php
                        		foreach($get_admin_type as $gl_key => $gl_row)
                        		{ 
                        		?>
                        		<option value="<?php echo $gl_row['adt_id'];?>" <?php echo ($admin_once['ad_mtid'] == $gl_row['adt_id'])?'selected="selected"':''?>> <?php echo $gl_row['adt_name'];?> 
                                </option>
                        		<?php 
                        		}
                        		?>
                       </select>    
					</div>	
				</div>
                
                
				
				<!--是否啟動此帳號-->
				<div class="control-group">
					<label class="control-label" for="input01">是否啟動<span class="red">*</span>：</label>
					<div class="controls">
						<input type="radio" name="ad_del" id="ad_del" class="input-xlarge" value="0" <?php echo ($admin_once["ad_del"] == 0)?('checked="checked"'):('');?> />啟動
						<input type="radio" name="ad_del" id="ad_del" class="input-xlarge" value="1" <?php echo ($admin_once["ad_del"] == 1)?('checked="checked"'):('');?> />關閉
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
