<?php
require("inc/inc.php");
require("func/func_deposit.php");
//var_dump($_SESSION['admin_name'],
//    $_SESSION['admin_type']);
if($_SESSION['admin_type'] !=1)
    post_back('你沒有權限使用此區域');
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>手動儲值</title>

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
    手動儲值
</h3>
<form class="form-horizontal" action="deposit_add_act.php" method="post" onSubmit="return checkForm();">
    <!--帳號-->
    <div class="control-group">
        <label class="control-label" for="input01">帳號<span class="red">*</span>：</label>
        <div class="controls">

            <input type="text" placeholder="請輸入帳號" value="" name="account" id="account"
                   class="input-xlarge">

        </div>
    </div>

    <!--姓名-->
    <div class="control-group">
        <label class="control-label" for="input01">手機號碼<span class="red">*</span>：</label>
        <div class="controls">
            <input type="text" placeholder="請輸入手機號碼" value="" name="phone"
                   id="phone" class="input-xlarge">
        </div>
    </div>
    <!--儲值金額-->
    <div class="control-group">
        <label class="control-label" for="input01">儲值金額<span class="red">*</span>：</label>
        <div class="controls">
            <input type="text" placeholder="請輸入儲值金額" value="" name="deposit"
                   id="deposit" class="input-xlarge">
        </div>
    </div>

    <div id="action_single" style="padding-left:20px;" class="form-actions text-center">
        <input name="admin_name" id="admin_name" class="input-medium search-query" type="hidden" value="<?php echo $admin['ad_name']; ?>"/>
        <input type="submit" value="送出" class="btn-primary btn">&nbsp;
        <button id="cancel" class="btn" type="reset" onclick="javascript:history.back();">取消</button>
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
 	 //if(!checkid('account','帳號')) return false;
        if(!checkmobile('phone')) return false;
        if(!checknum('deposit','儲值金額')) return false;
     }
</script>

</body>
</html>
