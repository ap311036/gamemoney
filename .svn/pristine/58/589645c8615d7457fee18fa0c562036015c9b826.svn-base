<?php
require("inc/inc.php");
require("func/func_center.php");
//$bk_bar_select = 2;
//$db->debug();
//顧客ID
$id = ft($_GET['id'], 0);
//判斷是否有選擇，沒有id代表新增，有id代表選擇進行修改
if ($id != '') {
    $center_once = get_game_center_id($admin_db, $id);
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
    <?php echo (count($id) > 0) ? '修改' : '新增'; ?>館別管理
</h3>
<form class="form-horizontal" action="game_center_list_add_mod_act.php" method="post" onSubmit="return checkForm();">
    <!--管別名稱-->
    <div class="control-group">
        <label class="control-label" for="input01">館別名稱<span class="red">*</span>：</label>
        <div class="controls">
            <?php
            if (count($id) > 0) {
                ?>
                <input type="text" placeholder="請輸入館別名稱" value="<?php echo $center_once['title']; ?>" name="title"
                       id="title" class="input-xlarge">
                <?php
            } else {
                ?>
                <input type="text" placeholder="請輸入館別名稱" value="<?php echo $center_once['title']; ?>" name="title"
                       id="title" class="input-xlarge">
                <?php
            }
            ?>

        </div>
    </div>
    <!--排序-->
    <div class="control-group">
        <label class="control-label" for="input01">排序編號<span class="red">*</span>：</label>
        <div class="controls">
            <input type="text" placeholder="請輸入排序編號,相同者會互換" value="<?php echo $center_once['order_id']; ?>" name="order_id" id="order_id"
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

<script type="text/javascript">
    function checkForm() {
        if (!checknum('order_id', '排序編號')) return false;
        if (!checkname('title', '館別名稱')) return false;
        if (!checklen('title', '館別名稱',2,5)) return false;


    }
</script>

</body>
</html>
