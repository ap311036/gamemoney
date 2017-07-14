<?php
require("inc/inc.php");
require("func/func_play_station.php");
//$bk_bar_select = 2;
//$db->debug();
//顧客ID
$id = ft($_GET['id'], 0);
//判斷是否有選擇，沒有id代表新增，有id代表選擇進行修改
if ($id != '') {
    $play_station_data = get_play_station_by_id1($win7pk_db, $id);
    if (count($play_station_data) < 0) {
        post_back('異常!');
    }
} else {
    $play_station_data = null;
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
            <?php echo ($edit_data == true) ? '修改' : '新增'; ?>機台管理
        </h3>
        <form class="form-horizontal" action="ps_zone_data_add_mod_act_1.php" method="post" onSubmit="return checkForm();">
            <?php
            if ($edit_data == true) {
                ?>
                <!--編號-->
                <div class="control-group">
                    <label class="control-label" for="input01">機台編號：</label>
                    <div class="controls">                        
                        <input type="text" readonly="readonly" value="<?php echo $play_station_data['ps_id']; ?>" name="ps_id" id="ps_id" class="input-xlarge">
                    </div>	
                </div>
                <?php
            }
            ?>

            <!--機台機率-->				
            <div class="control-group">
                <label class="control-label" for="input01">機台分區：</label>
                <div class="controls">                        
                    <?php
                    if ($edit_data == true) {
                        $psz_id = $play_station_data['psz_id'];

                        $play_station_zone_setting = get_play_station_zone_setting_by_id($win7pk_db, $psz_id);
                        ?>
                        <input type="hidden" name="psz_name" value="<?php echo $psz_id; ?>">
                        <input type="text" readonly="readonly" value="<?php echo $play_station_zone_setting['psz_name']; ?>"class="input-xlarge">
                        <?php
                    } else {
                        ?>
                        <select name="zone" id="type">
                            <option value=""> 請選擇分區 </option>
                            <?php
                            $play_station_zone_setting = get_play_station_zone_setting($win7pk_db);
                            foreach ($play_station_zone_setting as $key => $row) {
                                ?>
                                <option value="<?php echo $row['psz_id']; ?>" <?php echo ($play_station_data['psz_id'] == $row['psz_id']) ? 'selected="selected"' : '' ?>> <?php echo $row['psz_name']; ?> 
                                </option>
                                <?php
                            }
                            ?>
                        </select>    
                        <?php
                    }
                    ?>
                </div>	
            </div>

            <div class="control-group">
                <label class="control-label" for="input01">機台名稱：</label>
                <div class="controls">
                    <?php
                    if ($edit_data == true) {
                        ?>
                        <input type="text" readonly="readonly" value="<?php echo $play_station_data['ps_name']; ?>" name="ps_name" id="ps_name" class="input-xlarge">
                        <?php
                    } else {
                        ?>
                        <input type="text" placeholder="請輸入機台名稱" value="" name="ps_name" id="ps_name" class="input-xlarge">
                        <?php
                    }
                    ?>
                </div>	
            </div>
            <?php
            if ($edit_data == true) {
                ?>

                <!--押注金額設定-->				
                <div class="control-group">
                    <label class="control-label" for="input01">一注金額：</label>
                    <div class="controls">                        
                        <input type="text" placeholder="請輸入一注金額" value="<?php echo $play_station_data['one_bet']; ?>" name="one_bet" id="one_bet" class="input-xlarge">
                    </div>	
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">開分最大金額：</label>
                    <div class="controls">                        
                        <input type="text" placeholder="請輸入開分最大金額" value="<?php echo $play_station_data['start_score_max']; ?>" name="start_score_max" id="start_score_max" class="input-xlarge">
                    </div>	
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">開分一次加多少金額：</label>
                    <div class="controls">                        
                        <input type="text" placeholder="請輸入開分一次加多少金額" value="<?php echo $play_station_data['start_score_one_score']; ?>" name="start_score_one_score" id="start_score_one_score" class="input-xlarge">
                    </div>	
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">最少可以上分的金額：</label>
                    <div class="controls">                        
                        <input type="text" placeholder="請輸入最少可以上分的金額" value="<?php echo $play_station_data['min_up_score_value']; ?>" name="min_up_score_value" id="min_up_score_value" class="input-xlarge">
                    </div>	
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">最大可以下分的金額：</label>
                    <div class="controls">                        
                        <input type="text" placeholder="請輸入最大可以下分的金額" value="<?php echo $play_station_data['max_down_score_value']; ?>" name="max_down_score_value" id="max_down_score_value" class="input-xlarge">
                    </div>	
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">下分金額：</label>
                    <div class="controls">                        
                        <input type="text" placeholder="請輸入下分金額" value="<?php echo $play_station_data['down_score_one_score']; ?>" name="down_score_one_score" id="down_score_one_score" class="input-xlarge">
                    </div>	
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">下分額外的贈分：</label>
                    <div class="controls">                        
                        <input type="text" placeholder="請輸入下分額外的贈分" value="<?php echo $play_station_data['down_score_add_score']; ?>" name="down_score_add_score" id="down_score_add_score" class="input-xlarge">
                    </div>	
                </div>
                <!--<div class="control-group">
                    <label class="control-label" for="input01">兩對賠率：</label>
                    <div class="controls">                        
                        <input type="text" placeholder="請輸入兩對賠率" value="<?php echo $play_station_data['two_pairs_multiple']; ?>" name="two_pairs_multiple" id="two_pairs_multiple" class="input-xlarge">
                    </div>	
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">三條賠率：</label>
                    <div class="controls">                        
                        <input type="text" placeholder="請輸入三條賠率" value="<?php echo $play_station_data['three_kind_multiple']; ?>" name="three_kind_multiple" id="three_kind_multiple" class="input-xlarge">
                    </div>	
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">順子賠率：</label>
                    <div class="controls">                        
                        <input type="text" placeholder="請輸入順子賠率" value="<?php echo $play_station_data['straight_multiple']; ?>" name="straight_multiple" id="straight_multiple" class="input-xlarge">
                    </div>	
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">同花賠率：</label>
                    <div class="controls">                        
                        <input type="text" placeholder="請輸入同花賠率" value="<?php echo $play_station_data['flush_multiple']; ?>" name="flush_multiple" id="flush_multiple" class="input-xlarge">
                    </div>	
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">葫蘆賠率：</label>
                    <div class="controls">                        
                        <input type="text" placeholder="請輸入葫蘆賠率" value="<?php echo $play_station_data['full_hourse_multiple']; ?>" name="full_hourse_multiple" id="full_hourse_multiple" class="input-xlarge">
                    </div>	
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">四枚賠率：</label>
                    <div class="controls">                        
                        <input type="text" placeholder="請輸入四枚賠率" value="<?php echo $play_station_data['four_kind_multiple']; ?>" name="four_kind_multiple" id="four_kind_multiple" class="input-xlarge">
                    </div>	
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">同花順賠率：</label>
                    <div class="controls">                        
                        <input type="text" placeholder="請輸入同花順賠率" value="<?php echo $play_station_data['str_flush_multiple']; ?>" name="str_flush_multiple" id="str_flush_multiple" class="input-xlarge">
                    </div>	
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">五枚賠率：</label>
                    <div class="controls">                        
                        <input type="text" placeholder="請輸入五枚賠率" value="<?php echo $play_station_data['five_kind_multiple']; ?>" name="five_kind_multiple" id="five_kind_multiple" class="input-xlarge">
                    </div>	
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">同花大順賠率：</label>
                    <div class="controls">                        
                        <input type="text" placeholder="請輸入同花大順賠率" value="<?php echo $play_station_data['royal_flush_multiple']; ?>" name="royal_flush_multiple" id="royal_flush_multiple" class="input-xlarge">
                    </div>	
                </div>-->
                <?php
            }
            ?>

            <div id="action_single" style="padding-left:20px;" class="form-actions text-center"> 
                <input type="submit" value="送出" class="btn-primary btn">&nbsp;    
                <button id="cancel" class="btn" type="reset" onclick="close_dialog();">取消</button>
                <!--是否選擇修改-->
                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                <input type="hidden" id="act" name="act" value="<?php echo (count($id)) ? 'mod' : 'add'; ?>">
            </div>
        </form>

        <script type="text/javascript">
        </script>

    </body>
</html>
