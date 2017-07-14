<main id="md" class="big_white_block">
    <h3>新手教學</h3>
    <div id="md_intro">
        <ul class="white_bottom_line tab_level_1">
            <li><a href="#md_intro_1">遊戲說明</a></li>
            <li><a href="#md_intro_2">新手引導</a></li>
        </ul>
        <div id="md_intro_1">
            <div id="md_game">
                <ul>
                    <?php
                    $centers = $viewData['Centers'];

                    foreach ($centers as $key => $row) {

                        $order_id = $row['order_id'];
                        $title = $row['title'];
                        echo "
                    <li><a href=\"#md_game_tab$order_id\" class=\"md_game_tab_v1\">$title</a></li>
                        ";

                    }
                    ?>

                    <!-- <li><a href="#md_game_tab6" class="md_game_tab_v2">彩金介紹</a></li>
                    <li><a href="#md_game_tab7" class="md_game_tab_v2">白金外贈</a></li>
                    <li><a href="#md_game_tab8" class="md_game_tab_v3">虛寶系統</a></li>
                    <li><a href="#md_game_tab9" class="md_game_tab_v3">歷史轉數表</a></li> -->
                </ul>
                <?php

                $centers = $viewData['Centers'];
                $games = $viewData['GamesList'];


                foreach ($games as $t => $p) {
                    $tab = $t;
                    echo "<div id=\"md_game_tab$tab\" class=\"tab_level_2\">";
                    $game_num = count($p);
                    echo "<ul class=\"game_icon_tab\">";
                    for ($i = 0; $i < $game_num; $i++) {//5個館5個
                            if ($tab == $p[$i]['gc_id']) {
                                $icon = $p[$i]['game_icon'];
                                $tag = $i + 1;
                                echo '<li><a href="#game_icon_tab_' . $tab . '_' . $tag . '"><img src="img/' . $icon . '" alt=""></a></li>';
                            }
                    }
                    echo "</ul>";
                    echo "<div class='md_intro_2_table'>";
                    for ($i = 0; $i < $game_num; $i++) {//5個館5個
                            if ($tab == $p[$i]['gc_id'] ) {
                                $title = $p[$i]['game_title'];
                                $content = $p[$i]['game_intro'];
                                $rules = $p[$i]['game_rules'];
                                $tag = $i + 1;

                                echo '<div id="game_icon_tab_' . $tab . '_' . $tag . '" class="game_icon_tab_div">
                                    <div class="md_intro_2_table_title">'. $title .'</div>
                                    <div class="md_intro_2_tabs">';


                                echo  '<div class="md_intro_2_tab">
                                            <input type="radio" id="md_intro_2_content_' . $tab . '_' . $tag . '" name="md_intro_2_tab" checked="checked">
                                            <label for="md_intro_2_content_' . $tab . '_' . $tag . '">遊戲說明</label>
                                            <div class="md_intro_2_content" id="md_intro_2_content_' . $tab . '_' . $tag . '">'. $content .'</div>
                                        </div>
                                        <div class="md_intro_2_tab">
                                            <input type="radio" id="md_intro_2_rules_' . $tab . '_' . $tag . '" name="md_intro_2_tab">
                                            <label for="md_intro_2_rules_' . $tab . '_' . $tag . '">遊戲規則</label>
                                            <div class="md_intro_2_rules" id="md_intro_2_rules_' . $tab . '_' . $tag . '">'. $rules .'</div>
                                        </div>';

                                echo '</div>
                                    </div>';

                            }
                    }
                    echo "</div>";
                    echo "</div>";
                }


                ?>


                <!--                <div id="md_game_tab1" class="tab_level_2">-->
                <!--                    <ul class="game_icon_tab">-->
                <!--                        <li><a href="#game_icon_tab_1_1"><img src="img/game_icon1.png" alt=""></a></li>-->
                <!--                        <li><a href="#game_icon_tab_1_2"><img src="img/game_icon2.png" alt=""></a></li>-->
                <!--                        <li><a href="#game_icon_tab_1_3"><img src="img/game_icon3.png" alt=""></a></li>-->
                <!--                    </ul>-->
                <!--                    <div id="game_icon_tab_1_1" class="game_icon_tab_div">-->
                <!--                        <p>水果吧 說明的內容</p>-->
                <!--                    </div>-->
                <!--                    <div id="game_icon_tab_1_2" class="game_icon_tab_div">-->
                <!--                        <p>超八 說明的內容</p>-->
                <!--                    </div>-->
                <!--                    <div id="game_icon_tab_1_3" class="game_icon_tab_div">-->
                <!--                        <p>幸運鑽石 說明的內容</p>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--                <div id="md_game_tab2" class="tab_level_2">-->
                <!--                    <ul class="game_icon_tab">-->
                <!--                        <li><a href="#game_icon_tab_2_1"><img src="img/game_icon4.png" alt=""></a></li>-->
                <!--                        <li><a href="#game_icon_tab_2_2"><img src="img/game_icon5.png" alt=""></a></li>-->
                <!--                        <li><a href="#game_icon_tab_2_3"><img src="img/game_icon6.png" alt=""></a></li>-->
                <!--                    </ul>-->
                <!--                    <div id="game_icon_tab_2_1" class="game_icon_tab_div">-->
                <!--                        <p>餐廳賓果 說明的內容</p>-->
                <!--                    </div>-->
                <!--                    <div id="game_icon_tab_2_2" class="game_icon_tab_div">-->
                <!--                        <p>小瑪莉 說明的內容</p>-->
                <!--                    </div>-->
                <!--                    <div id="game_icon_tab_2_3" class="game_icon_tab_div">-->
                <!--                        <p>5PK 說明的內容</p>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--                <div id="md_game_tab3" class="tab_level_2">-->
                <!--                    <ul class="game_icon_tab">-->
                <!--                        <li><a href="#game_icon_tab_3_1"><img src="img/game_icon1.png" alt=""></a></li>-->
                <!--                        <li><a href="#game_icon_tab_3_2"><img src="img/game_icon3.png" alt=""></a></li>-->
                <!--                        <li><a href="#game_icon_tab_3_3"><img src="img/game_icon5.png" alt=""></a></li>-->
                <!--                    </ul>-->
                <!--                    <div id="game_icon_tab_3_1" class="game_icon_tab_div">-->
                <!--                        <p>花物語 說明的內容</p>-->
                <!--                    </div>-->
                <!--                    <div id="game_icon_tab_3_2" class="game_icon_tab_div">-->
                <!--                        <p>馬戲團 說明的內容</p>-->
                <!--                    </div>-->
                <!--                    <div id="game_icon_tab_3_3" class="game_icon_tab_div">-->
                <!--                        <p>島國風情 說明的內容</p>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--                <div id="md_game_tab4" class="tab_level_2">-->
                <!--                    <ul class="game_icon_tab">-->
                <!--                        <li><a href="#game_icon_tab_4_1"><img src="img/game_icon2.png" alt=""></a></li>-->
                <!--                        <li><a href="#game_icon_tab_4_2"><img src="img/game_icon4.png" alt=""></a></li>-->
                <!--                    </ul>-->
                <!--                    <div id="game_icon_tab_4_1" class="game_icon_tab_div">-->
                <!--                        <p>視訊百家 說明的內容</p>-->
                <!--                    </div>-->
                <!--                    <div id="game_icon_tab_4_2" class="game_icon_tab_div">-->
                <!--                        <p>視訊輪盤 說明的內容</p>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--                <div id="md_game_tab5" class="tab_level_2">-->
                <!--                    <ul class="game_icon_tab">-->
                <!--                        <li><a href="#game_icon_tab_5_1"><img src="img/game_icon6.png" alt=""></a></li>-->
                <!--                        <li><a href="#game_icon_tab_5_2"><img src="img/game_icon4.png" alt=""></a></li>-->
                <!--                        <li><a href="#game_icon_tab_5_3"><img src="img/game_icon2.png" alt=""></a></li>-->
                <!--                    </ul>-->
                <!--                    <div id="game_icon_tab_5_1" class="game_icon_tab_div">-->
                <!--                        <p>老子大老二 說明的內容</p>-->
                <!--                    </div>-->
                <!--                    <div id="game_icon_tab_5_2" class="game_icon_tab_div">-->
                <!--                        <p>老子來一將 說明的內容</p>-->
                <!--                    </div>-->
                <!--                    <div id="game_icon_tab_5_3" class="game_icon_tab_div">-->
                <!--                        <p>十點半 說明的內容</p>-->
                <!--                    </div>-->
                <!--                </div>-->
            </div>
        </div>
        <div id="md_intro_2">
            <div id="md_guide">
                <ul><?php $list_num = count($viewData);

                    foreach ($viewData['Guides'] as $key => $row) {
                        $l_num = $key + 1;
                        $list = $row['title'];

                        echo "<li><a href=\"#md_guide_tab$l_num\" class=\"md_game_tab_v3\">$list</a></li>";
                    }
                    ?>
                    <!--                    <li><a href="#md_guide_tab1"-->
                    <!--                           class="md_game_tab_v2">-->
                    <? // echo $viewData['Guides'][0]['ng_title'] ?><!--</a></li>-->
                    <!--                    <li><a href="#md_guide_tab2" class="md_game_tab_v2">點數說明</a></li>-->
                    <!--                    <li><a href="#md_guide_tab3" class="md_game_tab_v3">聊天功能</a></li>-->
                    <!--                    <li><a href="#md_guide_tab4" class="md_game_tab_v2">頭像功能</a></li>-->
                    <!--                    <li><a href="#md_guide_tab5" class="md_game_tab_v3">升等系統</a></li>-->
                    <!--                    <li><a href="#md_guide_tab6" class="md_game_tab_v3">會員活躍指數</a></li>-->
                </ul>
                <?php
                foreach ($viewData['Guides'] as $key => $row) {
                    $r_num = $key + 1;
                    $content = $row['content'];
                    echo "
                <div id=\"md_guide_tab$r_num\" class=\"tab_level_2\">
                    <div>
                        <div class=\"md_guide_content\">$content</div>
                    </div>
                </div>
                    
                    ";

                }

                ?>

                <!--                <div id="md_guide_tab1" class="tab_level_2">-->
                <!--                    <div>-->
                <!--                        <div class="md_guide_content">在這裡放 介面操作 的內容</div>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--                -->
            </div>
        </div>
    </div>
</main>