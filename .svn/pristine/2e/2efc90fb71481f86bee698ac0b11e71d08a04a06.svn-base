<?php
require("inc/inc.php");
require("func/func_member.php");
//$bk_bar_select = 2;
//$db->debug();
//顧客ID
$id = ft($_GET['id'],0);
//判斷是否有選擇，沒有id代表新增，有id代表選擇進行修改
if($id != '')
{
	$member_once = get_member_id($admin_db, $id);
	if(count($member_once) < 0)
	{
		post_back('異常!');
	}
}

//var_dump($get_member_type);
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
			<form class="form-horizontal" action="member_add_mod_act.php" method="post" onSubmit="return checkForm();">	
				<!--帳號-->
                            <div class="control-group">
					<label class="control-label" for="input01">帳號<span class="red">*</span>：</label>
					<div class="controls">    
						<?php 
						if(count($id)>0)
						{
						?>
							<input type="hidden" placeholder="請輸入帳號" value="<?php echo $member_once['account'];?>" name="account" id="account" class="input-xlarge"><?php echo $member_once['account'];?>
						<?php
						}
						else
						{
						?>
							<input type="text" placeholder="請輸入帳號" value="<?php echo $member_once['account'];?>" name="account" id="account" class="input-xlarge">
						<?php
						}
						?>
							
					</div>
				</div>
				<!--姓名-->				
				<div class="control-group">
					<label class="control-label" for="input01">姓名<span class="red">*</span>：</label>
					<div class="controls">                        
						<input type="text" placeholder="請輸入姓名" value="<?php echo $member_once['name'];?>" name="name" id="name" class="input-xlarge">   
					</div>	
				</div>
                            <!--生日-->
                            <div class="control-group">
                                <label class="control-label" for="input01">生日<span class="red">*</span>：</label>
                                <div class="controls">
                                    <input type="text" placeholder="請輸入生日" value="<?php echo $member_once['birthday']; ?>" name="birthday"
                                           id="birthday" class="input-xlarge">
                                </div>
                            </div>
                            <!--行動電話-->
                            <div class="control-group">
                                <label class="control-label" for="input01">行動電話<span class="red">*</span>：</label>
                                <div class="controls">
                                    <input type="text" placeholder="請輸入行動電話" value="<?php echo $member_once['phone']; ?>" name="phone"
                                           id="phone" class="input-xlarge">
                                </div>
                            </div>
                            <!--住宅電話-->
                            <div class="control-group">
                                <label class="control-label" for="input01">住宅電話：</label>
                                <div class="controls">
                                    <input type="text" placeholder="請輸入住宅電話" value="<?php echo $member_once['tel']; ?>" name="tel"
                                           id="tel" class="input-xlarge">
                                </div>
                            </div>
                            <!--住宅地址-->
                            <div class="control-group">
                                <label class="control-label" for="input01">住宅地址：</label>
                                <div class="controls">
                                    <input type="text" placeholder="請輸入住宅地址" value="<?php echo $member_once['address']; ?>" name="address"
                                           id="address" class="input-xlarge">
                                </div>
                            </div>
                            <!--電子郵件-->
                            <div class="control-group">
                                <label class="control-label" for="input01">電子郵件：</label>
                                <div class="controls">
                                    <input type="text" placeholder="請輸入電子郵件" value="<?php echo $member_once['email']; ?>" name="email"
                                           id="email" class="input-xlarge">
                                </div>
                            </div>
				
				<!--是否啟動此帳號-->
				<div class="control-group">
					<label class="control-label" for="input01">是否啟動：</label>
					<div class="controls">
						<input type="radio" name="is_del" id="is_del" class="input-xlarge" value="0" <?php echo ($member_once["is_del"] == 0)?('checked="checked"'):('');?> />啟動
						<input type="radio" name="is_del" id="is_del" class="input-xlarge" value="1" <?php echo ($member_once["is_del"] == 1)?('checked="checked"'):('');?> />關閉
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
    function checkForm()
     {
 	 if(!checkid('account','帳號')) return false;
        if(!checkname('name','姓名')) return false;
        if(!checkdate('birthday')) return false;
        if(!checkmobile('phone')) return false;
     }
</script>

</body>
</html>
