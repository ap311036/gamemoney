<?php
//ini_set("display_errors",1);
//載入程式設定檔
$id_id = "login";
require_once("inc/inc.php");
require_once("head.php");



//已登入狀態
if(isset($login_str) && $act != 'logout')
{
//	$admin_db->debug();
	$member = login_check($admin_db,$login_str);
	
	if($member != false)
	{
		$login_ok = true;
		$my_page_name = explode('/', $_SERVER['PHP_SELF']);
		$my_page_name = $my_page_name[count($my_page_name)-1];
		if($my_page_name == 'login.php')
		{
			redirect_js_href("index.php");
			exit();
		}
	}
}
?>

<form class="form-horizontal" action="login_act.php" method="POST" onsubmit="return checkForm();">
	<fieldset>
    <div style=" top: auto; left: auto; margin: 0 auto; z-index: 1; max-width: 100%; width:450px;" >
</div><br />

    <div style="position: relative; top: auto; left: auto; margin: 0 auto; z-index: 1; max-width: 100%; width:450px;" class="modal">
        <div class="modal-header">
            <h3>Slot管理系統 登入</h3>
        </div>
        
        <div class="modal-body">
           
            <div class="control-group">
                帳號 ： <input type="text" id="member_id" name="member_id" placeholder="請輸入帳號" class="span3">
			</div>
            <div class="control-group">
            	密碼 ： <input type="password" autocomplete="off" id="member_pw" name="member_pw" placeholder="請輸入密碼" class="span3"> 
            </div>
            
        </div>
        
        <div class="modal-footer">
	        <input type="hidden" name="log_sub" value="login"/>
            <button class="btn btn-primary" id="fat-btn" name="submit" type="submit"> 登 入 </button>
        </div>
    </div>
	</fieldset>
</form>
<script type="text/javascript">
document.getElementById('member_id').focus();
function checkForm()
{
	if(!checkempty('member_id','帳號')) return false;
	if(!checkempty('member_pw','密碼')) return false;
}
</script>

<?php 
require_once("foot.php");
?>