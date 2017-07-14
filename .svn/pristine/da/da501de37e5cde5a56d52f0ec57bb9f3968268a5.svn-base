<?php
require("inc/inc.php");
require("func/func_center.php");
//$bk_bar_select = 2;
//$db->debug();
//顧客ID
$id = ft($_GET['id'], 0);
//判斷是否有選擇，沒有id代表新增，有id代表選擇進行修改
if ($id != '') {
    $center_once = get_producd_id($admin_db, $id);
    if (count($center_once) < 0) {
        post_back('異常!');
    }
}
//var_dump($center_once);
//var_dump($get_member_type);
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>館別管理設定</title>

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
            <?php echo (count($id) > 0) ? '修改' : '新增'; ?>商品管理
        </h3>
        <form class="form-horizontal" action="product_information_add_mod_act.php" method="post" onSubmit="return checkForm();">
            <!--管別名稱-->
            <div class="control-group">
                <label class="control-label" for="input01">商品名稱<span class="red">*</span>：</label>
                <div class="controls">
                    <input type="text" placeholder="請輸入商品名稱" value="<?php echo $center_once['ItemDesc']; ?>" name="ItemDesc" id="ItemDesc"
                           class="input-xlarge">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="input01">商品描述<span class="red">*</span>：</label>
                <div class="controls">
                    <input type="text" placeholder="請輸入商品描述" value="<?php echo $center_once['OrderComment']; ?>" name="OrderComment" id="OrderComment"
                           class="input-xlarge">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="input01">商品金額<span class="red">*</span>：</label>
                <div class="controls">
                    <input type="text" placeholder="請輸入商品金額" value="<?php echo $center_once['Amt']; ?>" name="Amt" id="Amt"
                           class="input-xlarge">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="input01">平台幣價值<span class="red">*</span>：</label>
                <div class="controls">
                    <input type="text" placeholder="請輸入平台幣" value="<?php echo $center_once['points']; ?>" name="points" id="points"
                           class="input-xlarge">
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

</body>
</html>
