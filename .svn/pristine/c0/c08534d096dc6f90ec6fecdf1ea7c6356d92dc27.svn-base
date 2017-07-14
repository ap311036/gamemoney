<main id="md" class="big_white_block" style="min-height: 766px;">
    <h3>熱門活動</h3>
    <div id="md_activity" class="mt_20">
        <ul class="white_bottom_line tab_level_1">
            <li><a href="#md_activity_tab1">活動賽事</a></li>
            <li><a href="#md_activity_tab2">獲獎名單</a></li>
        </ul>
        <div id="md_activity_tab1" class="fontSize_0">

            <?php
            $activity = $viewData['activity'];
            $act_num = count($activity);
            //            var_dump($activity);
            if (is_array($activity) || is_object($activity)) {
                foreach ($activity as $row) {
                    echo ' <div class="md_activityDiv">';
                    echo ' <a href="' . $row['link_url'] . '">';
                    echo '<div class="activity_img" style="background-image: url(\'img/' . $row['img_url'] . '\');"></div>';
                    echo '</a>';
                    echo '<p>' . $row['description'] . '</p>';
                    echo '</div>';
                }
            }


            //            var_dump($viewData['actPrize']);
            //            var_dump($viewData['prizeList']);
            //            var_dump($viewData['activity']);
            ?>

            <!---->
            <!--            <div class="md_activityDiv">-->
            <!--                <a href="">-->
            <!--                    <div class="activity_img" style="background-image: url('img/activity3.jpg');"></div>-->
            <!--                </a>-->
            <!--                <p>XXX XXXX</p>-->
            <!--            </div>-->
        </div>
        <div id="md_activity_tab2">
            <div id="md_activityList">
                <ul>
                    <!--<li><a href="#md_activityList_tab1">活動比賽</a></li>
                    <!--<li><a href="#md_activityList_tab2">尊榮卡別活動</a></li>-->
                </ul>
                <div id="md_activityList_tab1" class="tab_level_2">
                    <div class="mb_20">
                        <div class="activity_tabbox">

                            <?php
                            $actPrize = $viewData['actPrize'];
                            $i = 0;
                            foreach ($actPrize as $act) {
                                $i++;

                                if ($i == 1) {
                                    echo '<input checked="" id="activity_tab' . $i . '" name="activity_tabs" type="radio" /><label class="activity_tp md_btn_activityGame" for="activity_tab' . $i . '">' . $act['title'] . '</label>';
                                } else {
                                    echo '<input id="activity_tab' . $i . '" name="activity_tabs" type="radio" /><label class="activity_tp md_btn_activityGame" for="activity_tab' . $i . '">' . $act['title'] . '</label>';
                                }
                            }
                            unset($i);
                            ?>

                            <div class="activity_content">
                                <?php
                                $prizeList = $viewData['prizeList'];
                                $i = 0;
                                //                                var_dump($actPrize);

                                if (count($prizeList) > 0) {

                                    $act_num = 0;
                                    foreach ($prizeList as $key => $prize) {
                                        $act_num++;
                                        echo '<div id="activity_content' . $act_num . '">';
                                        $i++;
                                        echo '<table><tr class="color_row"><th colspan="5"> ' . $prize['title'] . '</th></tr>';

                                        foreach ($prize['prize_detail'] as $p) {
                                            echo '<tr class="color_row"><th colspan="5">' . $p['prize_item'] . '</th></tr>';

                                            foreach ($p['player'] as $k => $q) {
                                                echo '<td>' . $q . '</td>';
                                            }
                                            if ($k % 1 != 1)
                                                echo '<td></td>';
                                        }
                                        echo '</table></div>';
//                                    die;
                                    }
                                } else {
                                    
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!--
                    <button type="button" class="md_btn_activityGame" id="md_btn_activityGame1">亞瑟王全盤榜</button>
                    <button type="button" class="md_btn_activityGame" id="md_btn_activityGame2">海神VS雷神連爆榜III</button>
                    <button type="button" class="md_btn_activityGame" id="md_btn_activityGame3">馬戲團連開榜</button>
                    <button type="button" class="md_btn_activityGame" id="md_btn_activityGame4">海神VS雷神連爆榜II</button>
                    <button type="button" class="md_btn_activityGame" id="md_btn_activityGame5">秦皇單局倍率榜</button>
                    -->
                </div>
            </div>
            <!--<div id="md_activityList_tab2" class="tab_level_2">
                <div>
                    <button type="button" class="yellow_btn" id="md_btn_activityDate1">105/08</button>
                    <button type="button" class="yellow_btn" id="md_btn_activityDate2">105/07</button>
                    <button type="button" class="yellow_btn" id="md_btn_activityDate3">105/06</button>
                    <button type="button" class="yellow_btn" id="md_btn_activityDate4">105/05</button>
                    <button type="button" class="yellow_btn" id="md_btn_activityDate5">105/04</button>
                    <button type="button" class="yellow_btn" id="md_btn_activityDate6">105/03</button>
                    <button type="button" class="yellow_btn" id="md_btn_activityDate7">105/02</button>
                    <button type="button" class="yellow_btn" id="md_btn_activityDate8">105/01</button>
                </div>
                <table>
            <?php //include 'php/table_activityDate_1.php';  ?>
            </table>-->
        </div>

    </div>
</div>
</div>
</main>