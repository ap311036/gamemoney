<?php
require("inc/inc.php");
//require("func/func_center.php");
require(furl . "func/func_play_station.php");
//$bk_bar_select = 2;
//$db->debug();
//顧客ID
$id = ft($_GET['id'], 0);
$tid = ft($_GET['tid'], 0);
//判斷是否有選擇，沒有id代表新增，有id代表選擇進行修改
if ($id != '') {
    $center_once = get_cyle_date_one($win7pk_db, $id);
    $get_suit = get_poker_suit_list($win7pk_db);
    if (count($center_once) < 0) {
        post_back('異常!');
    }
}
//var_dump($_GET);
//var_dump($center_once);
//var_dump($get_member_type);
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>機台循環管理設定</title>

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
            <?php echo (count($id) > 0) ? '修改' : '新增'; ?>循環管理
        </h3>
        <form class="form-horizontal" action="win7pk_cycle_add_mod.php" method="post" onSubmit="return checkForm();">
            <!--管別名稱-->
<!--            <div class="control-group">
                <label class="control-label" for="input01">循環ID<span class="red">*</span>：</label>
                <div class="controls">
                    <input type="text" placeholder="請輸入循環ID" value="<?php echo $id ?>" name="psct_id" id="ItemDesc"
                           class="input-xlarge">
                </div>
            </div>-->
            <div class="control-group">
                <label class="control-label" for="input01">機台門檻<span class="red">*</span>：</label>
                <div class="controls">
                    <input type="text" placeholder="請輸入機台門檻" value="<?php echo $center_once[0]['psct_station_win']; ?>" name="psct_station_win" id="OrderComment"
                           class="input-xlarge">
                </div>
            </div>
<!--            <div class="control-group">
                <label class="control-label" for="input01">請輸入排序<span class="red">*</span>：</label>
                <div class="controls">
                    <select name="psct_order_id">
                        <option value="<?php echo $center_once[0]['psct_order_id']; ?>"><?php echo $center_once[0]['psct_order_id']; ?></option>
                        <?php
                        for ($i = 1; $i <= 36; $i++) {
                            ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>-->

            <div class="control-group">
                <label class="control-label" for="input01">請輸入牌型<span class="red">*</span>：</label>
                <div class="controls">
                    <select name="psct_suit_type">
                        <?php
                        foreach ($get_suit as $key => $value) {
                            if ($value['brand_name'] == $center_once[0]['psct_suit_type']) {
                                ?>
                                <option value="<?php echo $value['brand_value']; ?>"><?php echo $value['brand_name']; ?></option>
                                <?php
                            }
                        }
                        foreach ($get_suit as $key => $value) {
                            if ($value['brand_name'] != $center_once[0]['psct_suit_type']) {
                                ?>
                                <option value="<?php echo $value['brand_value']; ?>"><?php echo $value['brand_name']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div id="action_single" style="padding-left:20px;" class="form-actions text-center">
                <input type="submit" value="送出" class="btn-primary btn">&nbsp;
                <button id="cancel" class="btn" type="reset" onclick="window.close();">取消</button>
                <!--是否選擇修改-->
                <input type="hidden" id="tid" name="ttid" value="<?php echo $center_once[0]['psct_order_id']; ?>">
                <input type="hidden" id="tid" name="tid" value="<?php echo $tid; ?>">
                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                <input type="hidden" id="act" name="act" value="<?php echo (count($id)) ? 'mod' : 'add'; ?>">
            </div>
        </form>
    </div>
    <!--/span-->
</div>
<!--/row-->

</div>
<script Language="JavaScript">
    //是否啟動
//    var tel_desc = document.getElementById('tel_desc');
//    var no_tel = document.getElementById('no_tel');
////    var tel_desc = $('#item').find('tr').find('td').find('input[id="tel_desc"]');
////    var no_tel = $('#item').find('tr').find('td').find('input[id="no_tel"]');
//    $(no_tel).click(function () {
//        if ($(this).prop("checked")) {
//            $(tel_desc).prop("disabled", "disabled");
//            $(tel_desc).css("background-color", "#999");
//            console.log('checked');
//        } else {
//            $(tel_desc).prop("disabled", "");
//            $(tel_desc).css("background-color", "");
//            console.log('unchecked');
//        }
//    })
</script>
</body>
</html>


