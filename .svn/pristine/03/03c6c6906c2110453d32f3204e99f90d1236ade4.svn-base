<?php
require("inc/inc.php");
//require("func/func_center.php");
require(furl . "func/func_marquee.php");
//$bk_bar_select = 2;
//$db->debug();
//顧客ID
$id = ft($_GET['id'], 0);
//判斷是否有選擇，沒有id代表新增，有id代表選擇進行修改
if ($id != '') {
    $center_once = get_marquee_one($admin_db, $id);
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
        <title>跑馬燈管理設定</title>

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
            <?php echo (count($id) > 0) ? '修改' : '新增'; ?>跑馬燈管理
        </h3>
        <form class="form-horizontal" action="marquee_add_mod_act.php" method="post" onSubmit="return checkForm();">
            <!--管別名稱-->
            <div class="control-group">
                <label class="control-label" for="input01">跑馬燈抬頭<span class="red">*</span>：</label>
                <div class="controls">
                    <input type="text" placeholder="請輸入跑馬燈抬頭" value="<?php echo $center_once['title']; ?>" name="title" id="ItemDesc"
                           class="input-xlarge">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="input01">跑馬燈內容<span class="red">*</span>：</label>
                <div class="controls">
                    <input type="text" placeholder="請輸入跑馬燈內容" value="<?php echo $center_once['msg']; ?>" name="msg" id="OrderComment"
                           class="input-xlarge">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="input01">跑馬燈開始時間<span class="red">*</span>：</label>
                <div class="controls">
                    <?php
                    if ($center_once['m_start_date'] != "") {
                        $m_start_date = $center_once['m_start_date'];
                        $m_start_date = str_replace(" ", "T", $m_start_date);
                        $m_start_date = str_replace("/", "-", $m_start_date);
                    } else {
                        date_default_timezone_set('Asia/Taipei');
                        $datetime = date("Y/m/d H:i:s");
                        $m_start_date = $datetime;
                        $m_start_date = str_replace(" ", "T", $m_start_date);
                        $m_start_date = str_replace("/", "-", $m_start_date);
                    }

                    if ($center_once['m_end_date'] != "") {
                        $m_end_date = $center_once['m_end_date'];

                        $m_end_date = str_replace(" ", "T", $m_end_date);
                        $m_end_date = str_replace("/", "-", $m_end_date);
                    } else {
                        date_default_timezone_set('Asia/Taipei');
                        $datetime = date('Y-m-d H:i:s', strtotime('+3 day'));
                        $m_end_date = $datetime;
                        //2017-06-01T08:30
                        $m_end_date = str_replace(" ", "T", $m_end_date);
                        $m_end_date = str_replace("/", "-", $m_end_date);
                    }
                    ?>
                    <input id="tel_desc" type="datetime-local" name="start_date" value="<?php echo $m_start_date ?>" style="width:220px">
                    <label for="no_tel" style="display:inline;">立即開始</label>
                    <input type="checkbox" name="immediately" value="2" class="no_tel" id="no_tel">

                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="input01">跑馬燈結束時間<span class="red">*</span>：</label>
                <div class="controls">
                    <input id="party" type="datetime-local" name="end_date" value="<?php echo $m_end_date ?>" style="width:220px">
                </div>
            </div>



            <div id="action_single" style="padding-left:20px;" class="form-actions text-center">
                <input type="submit" value="送出" class="btn-primary btn">&nbsp;
                <button id="cancel" class="btn" type="reset" onclick="window.close();">取消</button>
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
<script Language="JavaScript">
    //是否啟動
    var tel_desc = document.getElementById('tel_desc');
    var no_tel = document.getElementById('no_tel');
//    var tel_desc = $('#item').find('tr').find('td').find('input[id="tel_desc"]');
//    var no_tel = $('#item').find('tr').find('td').find('input[id="no_tel"]');
    $(no_tel).click(function () {
        if ($(this).prop("checked")) {
            $(tel_desc).prop("disabled", "disabled");
            $(tel_desc).css("background-color", "#999");
            console.log('checked');
        } else {
            $(tel_desc).prop("disabled", "");
            $(tel_desc).css("background-color", "");
            console.log('unchecked');
        }
    })
</script>
</body>
</html>


