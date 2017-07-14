<?php
require("inc/inc.php");
require("func/func_slot_machine.php");
require("func/func_play_station.php");
require("func/func_play_log.php");
require("func/http_client.php");
require("head.php");
//$db->debug();
//ini_set("display_errors",1);
//撈資料到表格中 and 分頁
$id = ft($_GET['sm_id'], 0);
$game = $_GET['game'];
$arr_page['page_id'] = ft($_GET['pageID'], 0);
if ($game == "slot" || $game == "all" || $game == "") {
    $res_sum = get_slot_machine($db, array());
    $arr_page['num'] = $res_sum['0']['cnt'];
    $page = new pager($arr_page);
    $res = get_slot_machine($db, $page);
}
if ($game == "win7pk" || $game == "ps_zone_data") {
    //var_dump(1111111111);
    $res_sum = get_play_station_data($win7pk_db, array());
    //var_dump($res_sum);
    //die;
    $arr_page['num'] = $res_sum['0']['cnt'];
    $page = new pager($arr_page);
    $res = get_play_station_data($win7pk_db, $page);
}
if ($game == "ps_list") {
    $res_sum = get_play_station($win7pk_db, array());
    $arr_page['num'] = $res_sum['0']['cnt'];
    $page = new pager($arr_page);
    $res = get_play_station($win7pk_db, $page);

    // echo '<pre>';
    //var_dump($res);
}
if ($game == "ps_zone_list") {
    $res_sum = get_play_station($win7pk_db, array());
    $arr_page['num'] = $res_sum['0']['cnt'];
    $page = new pager($arr_page);
    $res = get_play_station($win7pk_db, $page);
}

if (strstr($game, 'cycle')) {
    $res_sum = get_play_station_cycle_setting($win7pk_db, array());
    $arr_page['num'] = $res_sum['0']['cnt'];
    $page = new pager($arr_page);
    $res = get_play_station_cycle_setting($win7pk_db, $page);
}
?>
    <!--畫面呈現-->
    <div class="container-fluid">
        <div class="row-fluid">
            <!--列表-->
            <?php
            require_once "left_menu.php";
            ?>

            <div class="span10">
                <!--標題列-->
                <div class="span12">
                    <?php
                    if ($game == "" || $game == "slot") {
                        ?>
                        <h3>slot機台管理</h3>
                        <?php
                    }
                    ?>
                    <?php
                    if ($game == "win7pk" || $game == "ps_zone_data") {
                        ?>
                        <h3>win7pk 機台管理</h3>
                        <?php
                    }
                    ?>
                    <?php
                    if ($game == "ps_list") {
                        ?>
                        <h3>win7pk 機台機率管理</h3>
                        <?php
                    }
                    ?>
                    <?php
                    if ($game == "ps_zone_list") {
                        ?>
                        <h3>win7pk 機台分區管理</h3>
                        <?php
                    }
                    ?>
                    <?php
                    if ($game == "cycle") {
                        ?>
                        <h3>win7pk 機台循環管理</h3>
                        <?php
                    }
                    ?>
                </div>
                <div class="row-fluid">
                    <div class="pull-left span10 text-left">
                        <div class="btn-group">
                            <!--                        <a href="slot_machine.php?game=all"  class="btn"  title="全部"><b>全部</b></a>-->
                            <a href="slot_machine.php?game=slot" class="btn" title="Slot"><b>Slot</b></a>
                            <a href="slot_machine.php?game=win7pk" class="btn" title="Slot"><b>win7pk</b></a>
                        </div>
                    </div>
                </div>
                <!--新增按鈕-->
                <?php
                if ($admin['ad_mtid'] == 1) {
                    ?>
                    <div class="row-fluid" style="padding-top: 3px;">
                        <?php
                        if ($game == "slot" || $game == "") {
                            ?>
                            <div class="pull-left span3 text-left">
                                <button class="btn btn-primary"
                                        onclick="dialog_set('slot_machine_add_mod.php?act=add', '新增', 600, 450);">新增
                                </button>
                            </div>
                            <?php
                        }

                        if ($game == "ps_zone_list111111111111") {
                            ?>
                            <div class="pull-left span3 text-left">
                                <button class="btn btn-primary"
                                        onclick="dialog_set('ps_zone_data_add_mod.php?act=add', '新增', 600, 450);">新增
                                </button>
                            </div>
                            <?php
                        }
                        ?>
                        <?php
                        if ($game == "ps_zone_data" || $game == "ps_list" || $game == "ps_zone_list" || $game == "win7pk" || $game == "cycle") {
                            ?>
                            <div style="float:right;">
                                <a href="slot_machine.php?game=ps_zone_data" class="btn" title="全部"><b>機台管理</b></a>
                                <a href="slot_machine.php?game=ps_list" class="btn" title="全部"><b>機台機率管理</b></a>
                                <a href="slot_machine.php?game=ps_zone_list" class="btn" title="全部"><b>機台分區管理</b></a>
                                <a href="slot_machine.php?game=cycle" class="btn" title="全部"><b>機台循環管理</b></a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
                </br>
                <!--資料內容-->
                <div class="row-fluid">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr>
                            <?php
                            if ($game == "slot" || $game == "") {
                                ?>
                                <th width="55">功能</th>
                                <th width="55">編號</th>
                                <th width="100">機率</th>
                                <th width="200">最低單線押注金額</th>
                                <th width="200">最高單線押注金額</th>
                                <th width="200">最大持有金額</th>
                                <th width="200">最小攜帶點數</th>
                                <th width="200">最大攜帶點數</th>
                                <th width="200">總拉霸次數</th>
                                <th width="200">總拉霸金額</th>
                                <th width="200">全盤中獎次數</th>
                                <th width="200">全盤中獎金額</th>
                                <th width="200">獎勵遊戲遊玩次數</th>
                                <th width="200">獎勵遊戲中獎次數</th>
                                <th width="200">總中獎金額</th>
                                <th width="200">總押注金額</th>
                                <th width="200">機台賠率</th>
                                <th width="200">總差額</th>
                                <th width="200">清空機台記錄</th>
                                <th width="200">查詢中獎記錄</th>
                                <th width="200">查詢拉霸記錄</th>
                                <?php
                            }
                            ?>
                            <?php
                            if ($game == "ps_zone_data" || $game == "win7pk") {
                                ?>
                                <th width="120">外贈</th>
                                <th width="100">機台名稱</th>
                                <th width="50">分區編號</th>
                                <th width="50">遊戲次數</th>
                                <th width="50">雙星次數</th>
                                <th width="50">None</th>
                                <th width="50">OnePair</th>
                                <th width="50">TwoPair</th>
                                <th width="50">三條</th>
                                <th width="50">順子</th>
                                <th width="50">同花</th>
                                <th width="50">葫蘆</th>
                                <th width="50">小四枚次數</th>
                                <th width="50">正四枚次數</th>
                                <th width="50">同花順次數</th>
                                <th width="50">正同花順次數</th>
                                <th width="50">五枚次數</th>
                                <th width="50">同花大順次數</th>
                                <th width="50">正同花大順次數</th>
                                <th width="50">七朵花外贈</th>
                                <th width="50">葫蘆外贈</th>
                                <th width="50">鐵支外贈</th>
                                <th width="50">五枚外贈</th>
                                <th width="50">小柳外贈</th>
                                <th width="50">大柳外贈</th>
                                <th width="50">押注金額</th>
                                <th width="50">得分金額</th>
                                <th width="50">水位率</th>
                                <th width="50">鍵入金額</th>
                                <th width="50">鍵出金額</th>
                                <th width="50">吞吐率</th>
                                <th width="50">清空機台記錄</th>
                                <th width="50">記錄查詢</th>
                                <?php
                            }
                            ?>
                            <?php
                            if ($game == "ps_list") {
                                ?>
                                <th width="55">功能</th>
                                <th width="55">編號</th>
                                <th width="100">機台名稱</th>
                                <th width="100">分區編號</th>
                                <!--                                <th width="200">兩對機率</th>
                                                            <th width="200">三條機率</th>
                                                            <th width="200">順子機率</th>
                                                            <th width="200">同花機率</th>-->
                                <th width="200">大柳機率</th>
                                <th width="200">五梅機率</th>
                                <th width="200">小柳機率</th>
                                <th width="200">鐵支機率</th>
                                <th width="200">葫蘆機率</th>
                                <th width="200">同花機率</th>
                                <th width="200">兩對中獎機率</th>
                                <!--                                <th width="200">同花大順機率</th>-->
                                <!--                                <th width="200">比倍難易度(%)</th>
                                <th width="200">鬼牌出現率(%)</th>-->
                                <!--                                <th width="200">正四枚機率</th>
                                <th width="200">正同花順機率</th>
                                <th width="200">正五枚機率</th>
                                <th width="200">正同花大順機率</th>-->
                                <!--                                <th width="200">小烏龜出現機率</th>
                                <th width="200">雙星出現機率</th>
                                <th width="200">通關率</th>
                                <th width="200">水位數值</th> -->
                                <?php
                            }
                            ?>
                            <?php
                            if ($game == "ps_zone_list") {
                                ?>
                                <th width="55">功能</th>
                                <th width="55">編號</th>
                                <th width="100">機台名稱</th>
                                <th width="100">分區編號</th>
                                <th width="200">一注金額</th>
                                <th width="200">開分最大金額</th>
                                <th width="200">開分一次加多少金額</th>
                                <th width="200">最少可以上分的金額</th>
                                <th width="200">最大可以下分的金額</th>
                                <th width="200">下分金額</th>
                                <th width="200">下分額外的贈分</th>
                                <!--                                <th width="200">兩對賠率</th>
                                                            <th width="200">三條賠率</th>
                                                            <th width="200">順子賠率</th>
                                                            <th width="200">同花賠率</th>
                                                            <th width="200">葫蘆賠率</th>
                                                            <th width="200">四枚賠率</th>
                                                            <th width="200">同花順率</th>
                                                            <th width="200">五枚賠率</th>
                                                            <th width="200">同花大順賠率</th>-->
                                <?php
                            }
                            ?>
                            <?php
                            if ($game == "cycle") {
                                ?>
                                <th width="55">編號</th>
                                <th width="400">機台循環狀況</th>
                                <th width="400">機台循環狀況</th>
                                <th width="200">循環次數</th>
                                <th width="200">當前循環次數</th>
                                <th width="200">當前牌型</th>
                                <th width="200">下一次目標金額</th>
                                <th width="200">下一次牌型</th>
                                <th width="200">是否打亂</th>
                                <th width="200">是否循環</th>
                                <th width="300">編輯機台循環</th>
                                <?php
                            }
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (count($res) > 0) {
                            foreach ($res as $key => $row) {
                                //dump($row);
                                ?>
                                <tr>
                                <!--                                    <td>-->
                                <!--                                    </td>-->
                                <!--將資料表內容引入-->
                                <?php
                                if ($game == "slot" || $game == "") {
                                    if ($admin['ad_mtid'] == 1) {
                                        $bet = $row['total_bet'];
                                        $win = $row['total_win'];
                                        ?>
                                        <td>
                                            <a class="alphm_obj" title="編輯" onmouseover="$(this).tooltip('show');"
                                               href="javascript:void(0);"
                                               onclick="dialog_set('slot_machine_add_mod.php?id=<?php echo $row['sm_id']; ?>', '修改', 600, 450);"><i
                                                        class="icon-edit"></i></a>

                                        </td>
                                        <?php
                                    }
                                    ?>
                                    <td>
                                        <?php echo $row['sm_id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['sm_prob']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['min_bet_per_line']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['max_bet_per_line']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['max_money']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['min_trans_money']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['max_trans_money']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['spin_count']; ?><!--中獎次數-->
                                    </td>
                                    <td>
                                        <?php echo $row['spin_win']; ?><!--中獎金額-->
                                    </td>
                                    <td>
                                        <?php echo $row['all_same_count']; ?><!--全盤中獎次數-->
                                    </td>
                                    <td>
                                        <?php echo $row['all_same_win']; ?><!--全盤中獎金額-->
                                    </td>
                                    <td>
                                        <?php echo $row['bonus_count']; ?><!--獎勵遊戲遊玩次數-->
                                    </td>
                                    <td>
                                        <?php echo $row['bonus_win']; ?><!--獎勵遊戲中獎次數-->
                                    </td>

                                    <td>
                                        <?php echo $win; ?><!--總中獎金額-->
                                    </td>
                                    <td>
                                        <?php echo $bet; ?>
                                    </td>
                                    <td>

                                        <?php
                                        $prob = $win * 100.0 / $bet;
                                        if ($row['sm_prob'] < $prob) {
                                            echo '<span style="color:#ff0000">' . sprintf("%1\$.2f", $prob) . '%</span>';
                                        } else {
                                            echo '<span style="color:#000000">' . sprintf("%1\$.2f", $prob) . '%</span>';
                                        }
                                        ?>

                                    </td>
                                    <td>
                                        <?php
                                        $offset = $bet - $win;
                                        if ($offset < 0) {
                                            echo '<span style="color:#ff0000">' . $offset . '</span>';
                                        } else {
                                            echo '<span style="color:#000000">' . $offset . '</span>';
                                        }
                                        ?>
                                    </td>
                                    <?php
                                    $total_win = $row['total_win'];
                                    $all_same_win = $row['$all_same_win'];
                                    $total_bet = $row['total_bet'];
                                    $all_same_count = $row['all_same_count'];
                                    $spin_count = $row['spin_count'];
                                    $spin_win = $row['spin_win'];
                                    $bonus_count = $row['bonus_count'];
                                    $bonus_win = $row['bonus_win'];

                                    if ($total_win || $all_same_win || $total_bet || $all_same_count || $spin_count || $spin_win || $bonus_count || $bonus_win) {
                                        ?>
                                        <td>
                                            <input type="button" value="清空" onclick="if (confirm('確定要清空機台記錄嗎？')) {
                                                    location.href = 'slotmachine_del_act.php?id=<?php echo $row['sm_id']; ?>'
                                                    }" class="btn"/>
                                        </td>
                                        <td><a class="alphm_obj" title="查詢"
                                               href="slot_machine_symbol.php?id=<?php echo $row['sm_id']; ?>"> <i
                                                        class="icon-search"></i></a></td>
                                        <td><a class="alphm_obj" title="查詢"
                                               href="slot_machine_select.php?id=<?php echo $row['sm_id']; ?>"> <i
                                                        class="icon-search"></i></a></td>
                                        <?php
                                    } else {
                                        ?>
                                        <td>
                                            <input type="button" value="清空" class="btn" disabled/>
                                        </td>
                                        <td><i class="icon-search"></i></td>
                                        <td><i class="icon-search"></i></td>
                                        <?php
                                    }
                                    ?>
                                    </tr>
                                    <?php
                                }
                                ?>

                                <?php
                                if ($game == "ps_zone_data" || $game == "win7pk") {
                                    if ($admin['ad_mtid'] == 1) {
                                        ?>
                                        <td>
                                            <!--                                       <a class="alphm_obj" title="外贈"  onmouseover="$(this).tooltip('show');" href="javascript:void(0);" onclick="dialog_set('ps_zone_data_add_mod.php?id=<?php echo $row['ps_id']; ?>', '修改', 600, 450);"><i class="btn">外贈</i></a>-->
                                            <!--                                        <a href="ps_zone_data_add_mod.php?id=<?php echo $row['ps_id']; ?>" class="btn" title="全部"><b>外贈</b></a>-->
                                            <input type="button"
                                                   onclick="dialog_set('ps_zone_data_add_mod.php?id=<?php echo $row['ps_id']; ?>', '修改', 600, 450);"
                                                   value="外贈" name="外贈" style="width:80px;height:40px;">
                                            <?php ?>
                                        </td>
                                        <?php
                                    }
                                    ?>
                                    <td>
                                        <?php echo $row['ps_name']; ?>

                                    </td>
                                    <td>
                                        <?php echo $row['psz_id']; ?>

                                    </td>
                                    <td>
                                        <?php echo $row['play_count']; ?>

                                    </td>
                                    <td>
                                        <?php echo $row['twinstar_count']; ?>

                                    </td>
                                    <td>
                                        <?php
                                        $four_None_data = get_play_log_count_by_suittype($win7pk_db, $row['ps_id'], 'None', 0);
                                        echo $four_None_data['count'];

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $four_OnePair_data = get_play_log_count_by_suittype($win7pk_db, $row['ps_id'], 'OnePair', 0);
                                        echo $four_OnePair_data['count'];

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $four_TwoPair_data = get_play_log_count_by_suittype($win7pk_db, $row['ps_id'], 'TwoPair', 0);
                                        echo $four_TwoPair_data['count'];

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $four_ThreeKind_data = get_play_log_count_by_suittype($win7pk_db, $row['ps_id'], 'ThreeKind', 0);
                                        echo $four_ThreeKind_data['count'];

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $four_Straight_data = get_play_log_count_by_suittype($win7pk_db, $row['ps_id'], 'Straight', 0);
                                        echo $four_Straight_data['count'];

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $four_Flush_data = get_play_log_count_by_suittype($win7pk_db, $row['ps_id'], 'Flush', 0);
                                        echo $four_Flush_data['count'];

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $four_FullHouse_data = get_play_log_count_by_suittype($win7pk_db, $row['ps_id'], 'FullHouse', 0);
                                        echo $four_FullHouse_data['count'];
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        $four_kind_data = get_play_log_count_by_suittype($win7pk_db, $row['ps_id'], 'FourKind', 0);
                                        echo $four_kind_data['count'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $true_four_kind_data = get_play_log_count_by_suittype($win7pk_db, $row['ps_id'], 'TrueFourKind', 0);
                                        echo $true_four_kind_data['count'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $str_flush_data = get_play_log_count_by_suittype($win7pk_db, $row['ps_id'], 'StraightFlush', 0);
                                        echo $str_flush_data['count'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $true_str_flush_data = get_play_log_count_by_suittype($win7pk_db, $row['ps_id'], 'TrueStraightFlush', 0);
                                        echo $true_str_flush_data['count'];
                                        ?>
                                    </td>
                                    <td>
                                        <!-- 五梅-->
                                        <?php
                                        $five_kind_data = get_play_log_count_by_suittype($win7pk_db, $row['ps_id'], 'FiveKind', 0);
                                        $true_five_kind_data = get_play_log_count_by_suittype($win7pk_db, $row['ps_id'], 'TrueFiveKind', 0);
                                        echo($true_five_kind_data['count'] + $five_kind_data['count']);
                                        ?>
                                    </td>
                                    <!--                                <td>
                                     正五梅
                                <?php
                                    $true_five_kind_data = get_play_log_count_by_suittype($win7pk_db, $row['ps_id'], 'TrueFiveKind', 0);
                                    echo $true_five_kind_data['count'];
                                    ?>
                                </td>-->
                                    <td>
                                        <!-- 桐花大順-->
                                        <?php
                                        $royal_flush_data = get_play_log_count_by_suittype($win7pk_db, $row['ps_id'], 'RoyalFlush', 0);
                                        echo $royal_flush_data['count'];
                                        ?>
                                    </td>
                                    <td>
                                        <!-- 鄭桐花大順-->
                                        <?php
                                        $true_royal_flush_data = get_play_log_count_by_suittype($win7pk_db, $row['ps_id'], 'TrueRoyalFlush', 0);
                                        echo $true_royal_flush_data['count'];
                                        ?>
                                    </td>
                                    <td>
                                        <!-- 七朵花外贈-->
                                        <?php
                                        $res_date = get_play_station_by_id($win7pk_db, $row['ps_id']);
                                        echo $res_date['flush7'];
                                        ?>
                                    </td>
                                    <td>
                                        <!-- 葫蘆外贈-->
                                        <?php
                                        $res_date = get_play_station_by_id($win7pk_db, $row['ps_id']);
                                        echo $res_date['full_house'];
                                        ?>
                                    </td>
                                    <td>
                                        <!-- 鐵支外贈-->
                                        <?php
                                        $res_date = get_play_station_by_id($win7pk_db, $row['ps_id']);
                                        echo $res_date['four_kind'];
                                        ?>
                                    </td>
                                    <td>
                                        <!-- 小柳外贈-->
                                        <?php
                                        $res_date = get_play_station_by_id($win7pk_db, $row['ps_id']);
                                        echo $res_date['straight_flush'];
                                        ?>
                                    </td>
                                    <td>
                                        <!-- 五枚外贈-->
                                        <?php
                                        $res_date = get_play_station_by_id($win7pk_db, $row['ps_id']);
                                        echo $res_date['five_kind'];
                                        ?>
                                    </td>
                                    <td>
                                        <!-- 大柳外贈-->
                                        <?php
                                        $res_date = get_play_station_by_id($win7pk_db, $row['ps_id']);
                                        echo $res_date['royal_straight_flush'];
                                        ?>
                                    </td>
                                    <td>
                                        <!-- 壓住金額-->
                                        <?php echo $row['total_bet']; ?>
                                    </td>
                                    <td>
                                        <!-- 得分金額-->
                                        <?php echo $row['total_win']; ?>
                                    </td>
                                    <td>
                                        <!-- 水位綠-->
                                        <?php echo floor($row['total_win'] / $row['total_bet'] * 100); ?>％
                                    </td>
                                    <td>
                                        <!-- 見入金額-->
                                        <?php echo $row['total_open']; ?>
                                    </td>
                                    <td>
                                        <!-- 見出金額-->
                                        <?php echo $row['total_close']; ?>
                                    </td>
                                    <td>
                                        <!-- 吞吐綠-->
                                        <?php echo floor($row['total_close'] / $row['total_open'] * 100); ?>％
                                    </td>
                                    <td>
                                        <?php
                                        if ($row['play_count'] > 0) {
                                            ?>
                                            <input type="button" value="清空" onclick="if (confirm('確定要清空機台記錄嗎？')) {
                                                    location.href = 'ps_zone_data_del_act.php?act=clear&id=<?php echo $row['ps_id']; ?>'
                                                    }" class="btn"/>
                                            <?php
                                        } else {
                                            ?>
                                            <input type="button" value="清空" class="btn" disabled/>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td><a class="alphm_obj" title="查詢"
                                           href="ps_zone_data_log.php?id=<?php echo $row['ps_id']; ?>"> <i
                                                    class="icon-search"></i></a></td>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($game == "ps_list") {
                                    $sn = $key + 1;
                                    $rate = getResponse($win7pk_push . $sn . "/setting");
                                    $rate = json_decode($rate,true);
//                                    var_dump($rate);
                                    if ($admin['ad_mtid'] == 1) {
                                        ?>
                                        <td>
                                            <!--功能:編輯/刪除觸發按鈕-->
                                            <a class="alphm_obj" title="編輯" onmouseover="$(this).tooltip('show');"
                                               href="javascript:void(0);"
                                               onclick="dialog_set('ps_list_add_mod.php?id=<?php echo $row['ps_id']; ?>', '修改', 600, 450);"><i
                                                        class="icon-edit"></i></a>
                                            <a class="alphm_obj" title="刪除" onmouseover="$(this).tooltip('show');"
                                               onclick="ps_del(<?php echo $row['ps_id'] ?>);"><i
                                                        class="icon-remove"></i></a>
                                        </td>
                                        <?php
                                    }
                                    ?>
                                    <td>
                                        <?php echo $sn; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['ps_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['psz_id']; ?>
                                    </td>

                                    <td>
                                        <?php echo $rate['rf']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rate['5k']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rate['sf']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rate['4k']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rate['fh']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rate['flush']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rate['min2p']; ?>
                                    </td>


                                    <!--                                <td>
                                <?php echo $row['two_pairs_prob']; ?>
                                                                                                                                                                                                            </td>-->
                                    <!--                                <td>
                                <?php echo $row['three_kind_prob']; ?>
                                                                                                                                                                                                            </td>-->
                                    <!--                                <td>
                                <?php echo $row['straight_prob']; ?>
                                                                                                                                                                                                            </td>-->
                                    <!--                                <td>
                                <?php echo $row['flush_prob']; ?>
                                                                                                                                                                                                            </td>-->
                                    <!--                                <td>
                                <?php echo $row['full_hourse_prob']; ?>
                                                                                                                                                                                                            </td>
                                                                                                                                                                                                            <td>
                                <?php echo $row['four_kind_prob']; ?>
                                                                                                                                                                                                            </td>
                                                                                                                                                                                                            <td>
                                <?php echo $row['str_flush_prob']; ?>
                                                                                                                                                                                                            </td>
                                                                                                                                                                                                            <td>
                                <?php echo $row['five_kind_prob']; ?>
                                                                                                                                                                                                            </td>
                                                                                                                                                                                                            <td>
                                <?php echo $row['royal_flush_prob']; ?>
                                                                                                                                                                                                            </td>-->
                                    <!--                                <td>
                                <?php echo $row['bonus_game_prob']; ?>
                                                                                                                                                                                                            </td>-->
                                    <!--                                <td>
                                <?php echo $row['joker_prob']; ?>
                                                                                                                                                                                                            </td>-->
                                    <!--                                <td>
                                <?php echo $row['true_four_kind_prob']; ?>
                                                                                                                                                                                                            </td>
                                                                                                                                                                                                            <td>
                                <?php echo $row['true_str_flush_prob']; ?>
                                                                                                                                                                                                            </td>
                                                                                                                                                                                                            <td>
                                <?php echo $row['true_five_kind_prob']; ?>
                                                                                                                                                                                                            </td>
                                                                                                                                                                                                            <td>
                                <?php echo $row['true_royal_flush_prob']; ?>
                                                                                                                                                                                                            </td>-->
                                    <!--                                <td>
                                <?php //echo $row['tortoise_prob'];  ?>
                                                                                                                                                                                                            </td>
                                                                                                                                                                                                            <td>
                                <?php //echo $row['twinstar_prob'];  ?>
                                                                                                                                                                                                            </td>
                                                                                                                                                                                                            <td>
                                <?php //echo $row['clearance'];  ?>
                                                                                                                                                                                                            </td>
                                                                                                                                                                                                            <td>
                                <?php //echo $row['balance'];  ?>
                                                                                                                                                                                                            </td>-->


                                    <?php
                                }
                                ?>
                                <?php
                                if ($game == "ps_zone_list") {
                                    if ($admin['ad_mtid'] == 1) {
                                        ?>
                                        <td>
                                            <!--功能:編輯/刪除觸發按鈕-->
                                            <a class="alphm_obj" title="編輯" onmouseover="$(this).tooltip('show');"
                                               href="javascript:void(0);"
                                               onclick="dialog_set('ps_zone_list_add_mod.php?id=<?php echo $row['ps_id']; ?>', '修改', 600, 450);"><i
                                                        class="icon-edit"></i></a>
                                            <a class="alphm_obj" title="刪除" onmouseover="$(this).tooltip('show');"
                                               onclick="ps_del(<?php echo $row['ps_id'] ?>);"><i
                                                        class="icon-remove"></i></a>
                                        </td>
                                        <?php
                                    }
                                    ?>
                                    <!--將資料表內容引入-->
                                    <td>
                                        <?php echo($key + 1); ?>
                                    </td>
                                    <td>
                                        <?php echo $row['ps_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['psz_id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['one_bet']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['start_score_max']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['start_score_one_score']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['min_up_score_value']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['max_down_score_value']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['down_score_one_score']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['down_score_add_score']; ?>
                                    </td>
                                    <!--                                <td>
                                <?php echo $row['two_pairs_multiple']; ?>
                                </td>
                                <td>
                                <?php echo $row['three_kind_multiple']; ?>
                                </td>
                                <td>
                                <?php echo $row['straight_multiple']; ?>
                                </td>
                                <td>
                                <?php echo $row['flush_multiple']; ?>
                                </td>
                                <td>
                                <?php echo $row['full_hourse_multiple']; ?>
                                </td>
                                <td>
                                <?php echo $row['four_kind_multiple']; ?>
                                </td>
                                <td>
                                <?php echo $row['str_flush_multiple']; ?>
                                </td>
                                <td>
                                <?php echo $row['five_kind_multiple']; ?>
                                </td>
                                <td>
                                <?php echo $row['royal_flush_multiple']; ?>
                                </td>-->
                                    <?php
                                }

                                if ($game == "cycle") {
                                    ?>

                                    <td>
                                        <?php echo($key + 1); ?>
                                        <!--                                    <a class="alphm_obj" title="查詢" href="win7pk_cycle.php?id=<?php echo $row['pscs_ps_id']; ?>"> <?php echo($key + 1); ?></a>-->
                                    </td>
                                    <td>
                                        <?php
                                        $get_ps_name = get_list($win7pk_db, $row['pscs_ps_id']);
                                        foreach ($get_ps_name as $key => $value) {

                                            echo '排序：' . $value['psct_order_id'] . ' 牌型：' . $value['psct_suit_type'] . '<br>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $get_ps_name1 = get_list1($win7pk_db, $row['pscs_ps_id']);
                                        foreach ($get_ps_name1 as $key => $value) {

                                            echo '排序：' . $value['psct_order_id'] . ' 牌型：' . $value['psct_suit_type'] . '<br>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $row['pscs_cycle_time']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['pscs_now_cycle']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $get_pscs_now_order = get_pscs_now_order($win7pk_db, $row['pscs_now_order'], $row['pscs_ps_id']);
                                        echo $get_pscs_now_order[0]['psct_suit_type']
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $row['pscs_target_win']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $get_psc_next = get_psc_next($win7pk_db, $get_pscs_now_order[0]['psct_id'], $row['pscs_ps_id']);
                                        echo $get_psc_next[0]['psct_suit_type'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row['pscs_is_random'] == 1) {
                                            echo "目前已關閉打亂";
                                        } elseif ($row['pscs_is_random'] == 0) {
                                            echo "目前已開啟打亂";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row['pscs_is_cycle'] == 1) {
                                            echo "目前已開啟循環";
                                        } elseif ($row['pscs_is_cycle'] == 0) {
                                            echo "目前已關閉循環";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <!--                                    <a class="alphm_obj" title="編輯" onmouseover="$(this).tooltip('show');" href="javascript:void(0);" onclick="dialog_set('ps_cycle_add_mod.php?id=<?php echo $row['pscs_ps_id']; ?>', '修改', 600, 450);"><i class="icon-edit"></i></a>-->
                                        <a class="btn" title="單一機台編輯" onmouseover="$(this).tooltip('show');"
                                           href="javascript:void(0);"
                                           onclick="dialog_set('ps_cycle_add_mod.php?id=<?php echo $row['pscs_ps_id']; ?>', '修改', 600, 450);"><b>單一機台編輯</b></a>
                                        <br>
                                        <a href="win7pk_cycle.php?id=<?php echo $row['pscs_ps_id']; ?>" class="btn"
                                           title="全部"><b>單一機台循環編輯</b></a>
                                    </td>
                                    <?php
                                }
                                ?>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="18">
                                    <div class="row-fluid text-center">查無資料</div>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <?php echo $page->getPageFoot(); ?>
            </div>
        </div>
    </div>

    <script Language="JavaScript">
    </script>

<?php
require("foot.php");
?>