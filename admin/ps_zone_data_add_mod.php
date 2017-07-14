<?php
require("inc/inc.php");
require("func/func_play_station.php");
//$bk_bar_select = 2;
//$db->debug();
//顧客ID
$id = ft($_GET['id'], 0);
//判斷是否有選擇，沒有id代表新增，有id代表選擇進行修改
if ($id != '') {
    $play_station_data = get_play_station_by_id($win7pk_db, $id);
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
        <form class="form-horizontal" action="ps_list_add_mod_act.php" method="post" >
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
                        <input type="text" readonly="readonly" value="<?php echo $play_station_zone_setting['psz_name']; ?>" name="ps_name" id="ps_name" class="input-xlarge">
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

                <div class="control-group">
                    <label class="control-label" for="input01">7朵花外贈：</label>
                    <div class="controls">                        
                        <input type="text" onkeyup="return ValidateNumber($(this), value)" placeholder="請輸入7朵花" value="<?php echo $play_station_data['flush7']; ?>" name="flush7" id="seven_flowers" class="input-xlarge">
                    </div>	
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">葫蘆外贈：</label>
                    <div class="controls">                        
                        <input type="text" onkeyup="return ValidateNumber($(this), value)" placeholder="請輸入葫蘆" value="<?php echo $play_station_data['full_house']; ?>" name="full_house" id="full_hourse_prob" class="input-xlarge">
                    </div>	
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">鐵支外贈：</label>
                    <div class="controls">                        
                        <input type="text" onkeyup="return ValidateNumber($(this), value)" placeholder="請輸入鐵支" value="<?php echo $play_station_data['four_kind']; ?>" name="four_kind" id="iron_branch" class="input-xlarge">
                    </div>	
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">小柳外贈：</label>
                    <div class="controls">                        
                        <input type="text" onkeyup="return ValidateNumber($(this), value)" placeholder="請輸入小柳" value="<?php echo $play_station_data['royal_straight_flush']; ?>" name="royal_straight_flush" id="koyanagi" class="input-xlarge">
                    </div>	
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">五枚外贈：</label>
                    <div class="controls">                        
                        <input type="text" onkeyup="return ValidateNumber($(this), value)" placeholder="請輸入五枚" value="<?php echo $play_station_data['five_kind']; ?>" name="five_kind" id="five_kind_prob" class="input-xlarge">
                    </div>	
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">大柳外贈：</label>
                    <div class="controls">                        
                        <input type="text" onkeyup="return ValidateNumber($(this), value)" placeholder="請輸入大柳" value="<?php echo $play_station_data['straight_flush']; ?>" name="straight_flush" id="oyanagi" class="input-xlarge">
                    </div>	
                </div>


                <!--押注金額設定-->				
                <!--        <div class="control-group">
                                <label class="control-label" for="input01">兩對機率：</label>
                                <div class="controls">                        
                                <input type="text" placeholder="請輸入兩對機率" value="<?php echo $play_station_data['two_pairs_prob']; ?>" name="two_pairs_prob" id="two_pairs_prob" class="input-xlarge">
                                </div>	
                        </div>
                        <div class="control-group">
                                <label class="control-label" for="input01">三條機率：</label>
                                <div class="controls">                        
                                <input type="text" placeholder="請輸入三條機率" value="<?php echo $play_station_data['three_kind_prob']; ?>" name="three_kind_prob" id="three_kind_prob" class="input-xlarge">
                                </div>	
                        </div>
                        <div class="control-group">
                                <label class="control-label" for="input01">順子機率：</label>
                                <div class="controls">                        
                                <input type="text" placeholder="請輸入順子機率" value="<?php echo $play_station_data['straight_prob']; ?>" name="straight_prob" id="straight_prob" class="input-xlarge">
                                </div>	
                        </div>
                        <div class="control-group">
                                <label class="control-label" for="input01">同花機率：</label>
                                <div class="controls">                        
                                <input type="text" placeholder="請輸入同花機率" value="<?php echo $play_station_data['flush_prob']; ?>" name="flush_prob" id="flush_prob" class="input-xlarge">
                                </div>	
                        </div>
                        <div class="control-group">
                                <label class="control-label" for="input01">葫蘆機率：</label>
                                <div class="controls">                        
                                <input type="text" placeholder="請輸入葫蘆機率" value="<?php echo $play_station_data['full_hourse_prob']; ?>" name="full_hourse_prob" id="full_hourse_prob" class="input-xlarge">
                                </div>	
                        </div>
                        <div class="control-group">
                                <label class="control-label" for="input01">四枚機率：</label>
                                <div class="controls">                        
                                <input type="text" placeholder="請輸入四枚機率" value="<?php echo $play_station_data['four_kind_prob']; ?>" name="four_kind_prob" id="four_kind_prob" class="input-xlarge">
                                </div>	
                        </div>
                        <div class="control-group">
                                <label class="control-label" for="input01">同花順機率：</label>
                                <div class="controls">                        
                                <input type="text" placeholder="請輸入同花順機率" value="<?php echo $play_station_data['str_flush_prob']; ?>" name="str_flush_prob" id="str_flush_prob" class="input-xlarge">
                                </div>	
                        </div>
                        <div class="control-group">
                                <label class="control-label" for="input01">五枚機率：</label>
                                <div class="controls">                        
                                <input type="text" placeholder="請輸入五枚機率" value="<?php echo $play_station_data['five_kind_prob']; ?>" name="five_kind_prob" id="five_kind_prob" class="input-xlarge">
                                </div>	
                        </div>
                        <div class="control-group">
                                <label class="control-label" for="input01">同花大順機率：</label>
                                <div class="controls">                        
                                <input type="text" placeholder="請輸入同花大順機率" value="<?php echo $play_station_data['royal_flush_prob']; ?>" name="royal_flush_prob" id="royal_flush_prob" class="input-xlarge">
                                </div>	
                        </div>
                        <div class="control-group">
                                <label class="control-label" for="input01">比倍難易度(%)：</label>
                                <div class="controls">                        
                                <input type="text" placeholder="請輸入比倍難易度(%)" value="<?php echo $play_station_data['bonus_game_prob']; ?>" name="bonus_game_prob" id="bonus_game_prob" class="input-xlarge">
                                </div>	
                        </div>
                        <div class="control-group">
                                <label class="control-label" for="input01">鬼牌出現率(%)：</label>
                                <div class="controls">                        
                                <input type="text" placeholder="請輸入鬼牌出現率(%)" value="<?php echo $play_station_data['joker_prob']; ?>" name="joker_prob" id="joker_prob" class="input-xlarge">
                                </div>	
                        </div>
                        <div class="control-group">
                                <label class="control-label" for="input01">正四枚機率：</label>
                                <div class="controls">                        
                                <input type="text" placeholder="請輸入正四枚機率" value="<?php echo $play_station_data['true_four_kind_prob']; ?>" name="true_four_kind_prob" id="true_four_kind_prob" class="input-xlarge">
                                </div>	
                        </div>
                        <div class="control-group">
                                <label class="control-label" for="input01">正同花順機率：</label>
                                <div class="controls">                        
                                <input type="text" placeholder="請輸入正同花順機率" value="<?php echo $play_station_data['true_str_flush_prob']; ?>" name="true_str_flush_prob" id="true_str_flush_prob" class="input-xlarge">
                                </div>	
                        </div>
                        <div class="control-group">
                                <label class="control-label" for="input01">正五枚機率：</label>
                                <div class="controls">                        
                                <input type="text" placeholder="請輸入正五枚機率" value="<?php echo $play_station_data['true_five_kind_prob']; ?>" name="true_five_kind_prob" id="true_five_kind_prob" class="input-xlarge">
                                </div>	
                        </div>
                        <div class="control-group">
                                <label class="control-label" for="input01">正同花大順機率：</label>
                                <div class="controls">                        
                                <input type="text" placeholder="請輸入正同花大順機率" value="<?php echo $play_station_data['true_royal_flush_prob']; ?>" name="true_royal_flush_prob" id="true_royal_flush_prob" class="input-xlarge">
                                </div>	
                        </div>
                        <div class="control-group">
                                <label class="control-label" for="input01">小烏龜出現機率：</label>
                                <div class="controls">                        
                                <input type="text" placeholder="請輸入小烏龜出現機率" value="<?php echo $play_station_data['tortoise_prob']; ?>" name="tortoise_prob" id="tortoise_prob" class="input-xlarge">
                                </div>	
                        </div>
                        <div class="control-group">
                                <label class="control-label" for="input01">雙星出現機率：</label>
                                <div class="controls">                        
                                <input type="text" placeholder="請輸入雙星出現機率" value="<?php echo $play_station_data['twinstar_prob']; ?>" name="twinstar_prob" id="twinstar_prob" class="input-xlarge">
                                </div>	
                        </div>
                        <div class="control-group">
                                <label class="control-label" for="input01">水位數值：</label>
                                <div class="controls">                        
                                <input type="text" placeholder="請輸入水位數值" value="<?php echo $play_station_data['balance']; ?>" name="balance" id="balance" class="input-xlarge">
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


            function ValidateNumber(e, pnumber)
            {
                if (!/^[0-9]*[1-9][0-9]*$/.test(pnumber))
                {
                    $(e).val(/^\d+/.exec($(e).val()));
                }
                return false;
            }


            function checkForm()
            {
                var seven_flowers = document.getElementById("seven_flowers").value;
                if (seven_flowers < 500)
                {
                    alert("外贈7朵花小於500");
                    return false;
                }
                if (seven_flowers > 10000)
                {
                    alert("外贈7朵花大於1000");
                    return false;
                }

                var full_hourse_prob = document.getElementById("full_hourse_prob").value;
                if (full_hourse_prob < 500)
                {
                    alert("外贈葫蘆小於500");
                    return false;
                }
                if (full_hourse_prob > 10000)
                {
                    alert("外贈葫蘆大於1000");
                    return false;
                }

                var iron_branch = document.getElementById("iron_branch").value;
                if (iron_branch < 500)
                {
                    alert("外贈鐵支小於500");
                    return false;
                }
                if (iron_branch > 10000)
                {
                    alert("外贈鐵支大於1000");
                    return false;
                }

                var koyanagi = document.getElementById("koyanagi").value;
                if (koyanagi < 500)
                {
                    alert("外贈小柳小於500");
                    return false;
                }
                if (koyanagi > 10000)
                {
                    alert("外贈小柳大於1000");
                    return false;
                }

                var five_kind_prob = document.getElementById("five_kind_prob").value;
                if (five_kind_prob < 500)
                {
                    alert("外贈五梅小於500");
                    return false;
                }
                if (five_kind_prob > 10000)
                {
                    alert("外贈五梅大於1000");
                    return false;
                }

                var oyanagi = document.getElementById("oyanagi").value;
                if (oyanagi < 500)
                {
                    alert("外贈大柳小於500");
                    return false;
                }
                if (oyanagi > 10000)
                {
                    alert("外贈大柳大於1000");
                    return false;
                }
            }

        </script>

    </body>
</html>
