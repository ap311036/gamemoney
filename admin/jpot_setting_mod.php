<?php
require("inc/inc.php");
require("func/func_jpot.php");
//$bk_bar_select = 2;
//$db->debug();
//顧客ID
$id = ft($_GET['id'], 0);
if ($admin['ad_mtid'] != 1)
    post_back('沒有權限!');
if (!$id)
    post_back('異常!');
//判斷是否有選擇，沒有id代表新增，有id代表選擇進行修改
if ($id != '') {
    $jpot_setting = get_jpot_setting_once($jpot_db, $id);
//    if (count($jpot_setting) != 1) {
//        post_back('異常!');
//    }
}
//var_dump($jpot_setting);

?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>JPOT管理設定</title>

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
    <?php echo (count($id) > 0) ? '修改' : '新增'; ?>JPOT設定
</h3>
<form class="form-horizontal" action="jpot_setting_mod_act.php" method="post" onSubmit="return checkForm();">
    <div class="control-group">
        <label class="control-label" for="input01">館別名稱<span class="red">*</span>：</label>
        <div class="controls">

            <input type="text" placeholder="請輸入JPOT名稱" value="<?php echo $jpot_setting['jpot_name']; ?>"
                   name="jpot_name"
                   id="jpot_name" class="input-xlarge">


        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="input01">底分<span class="red">*</span>：</label>
        <div class="controls">
            <input type="text" placeholder="請輸入底分" value="<?php echo $jpot_setting['button_points'] / 100; ?>"
                   name="button_points"
                   id="button_points" class="input-xlarge">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="input01">押分<span class="red">*</span>：</label>
        <div class="controls">
            <input type="text" placeholder="請輸入押分" value="<?php echo $jpot_setting['charge_points'] / 100; ?>"
                   name="charge_points"
                   id="charge_points" class="input-xlarge">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="input01">累積(最小為0.01)<span class="red">*</span>：</label>
        <div class="controls">
            <input type="text" placeholder="請輸入累積" value="<?php echo $jpot_setting['acc_ratio'] / 100; ?>" name="acc_ratio"
                   id="acc_ratio" class="input-xlarge">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="input01">累積上限<span class="red">*</span>：</label>
        <div class="controls">
            <input type="text" placeholder="請輸入累積上限" value="<?php echo $jpot_setting['acc_limit'] / 100; ?>" name="acc_limit"
                   id="acc_limit" class="input-xlarge">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="input01">抽獎機率(百分比,最小為0.001)<span class="red">*</span>：</label>
        <div class="controls">
            <input type="text" placeholder="請輸入抽獎機率" value="<?php echo $jpot_setting['lottery_ratio'] / (1000); ?>"
                   name="lottery_ratio"
                   id="lottery_ratio" class="input-xlarge">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="input01">壓分比例<span class="red">*</span>：</label>
        <div class="controls">
            <input type="text" placeholder="請輸入壓分比例" value="<?php echo $jpot_setting['charge_ratio'] / 100; ?>"
                   name="charge_ratio"
                   id="charge_ratio" class="input-xlarge">
        </div>
    </div>


    <div id="action_single" style="padding-left:20px;" class="form-actions text-center">
        <input type="submit" value="送出" class="btn-primary btn">&nbsp;
        <button id="cancel" class="btn" type="reset" onclick="javascript:history.back();">取消</button>
        <!--是否選擇修改-->
        <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
        <input type="hidden" id="act" name="act" value="<?php echo (count($id)) ? 'mod' : 'add'; ?>">
    </div>
</form>
</div>
<!--/span-->
</div>
<!--/row-->

</div>

<script type="text/javascript">
    function checkForm() {
        if (!checkname('jpot_name', 'JPOT名稱')) return false;
        if (!checknum('button_points', '底分')) return false;
        if (!checknum('charge_points', '押分')) return false;
        if (!checknumpoint('acc_ratio', '累積')) return false;
        if (!checknum('acc_limit', '累積上限')) return false;
        if (!checknumpoint('lottery_ratio', '抽獎機率')) return false;
        if (!checknum('charge_ratio', '押分比率')) return false;
        if (!checklen('jpot_name', '館別名稱', 2, 8)) return false;


        transValue('button_points',100);
        transValue('charge_points',100);
        transValue('acc_ratio',100);
        transValue('acc_limit',100);
        transValue('lottery_ratio',1000);
        transValue('charge_ratio',100);

//        $('#game_intro').val(y) = $('#button_points').val();
//        var post = htmlEncode(text);
//        var y;
//        y = editor.getData();
//        y = htmlEncode(y);
////        alert(y);
////        alert(htmlDecode(y));
////        alert(post);
//        $('#game_intro').text(y);

    }
    function transValue(fmobj, x) {
        document.getElementById(fmobj).value =document.getElementById(fmobj).value * x;
    }

</script>

</body>
</html>
