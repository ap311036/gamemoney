<main id="md">
    <!-- <marquee behavior="scroll" bgcolor="rgba(0, 0, 0, 0.6)" direction="left" height="25px" hspace="10px" loop="-1" scrollamount="1" scrolldelay="" truespeed="" vspace="0px" width="">
        <p>恭喜 XXX 在 XXX 贏得 XXX 分！　恭喜 OOO 在 OOO 贏得 OOO 分！　恭喜 XXX 在 XXX 贏得 XXX 分！　恭喜 OOO 在 OOO 贏得 OOO 分！</p>
    </marquee> -->
    <div class="fontSize_0">

        <?php if ($viewData['member']) { ?>

            <div class="div_style_1 inline_top width_32p mr_2p">
                <h3 class="md_h3">我最常玩</h3>
                <!--    <button type="button" class="md_btn_more">更多</button>-->
                <div class="md_clear fontSize_0">
                    <a href="game.php" class="game_icon"><img src="img/BaseSymbol8.png" alt=""></a>
                    <a href="game.php" class="game_icon"><img src="img/win7pk.png" alt=""></a>
                    <!--                    <a href="" class="game_icon"><img src="img/game_icon5.png" alt=""></a>
                                        <a href="" class="game_icon"><img src="img/game_icon4.png" alt=""></a>
                                        <a href="" class="game_icon"><img src="img/game_icon3.png" alt=""></a>
                                        <a href="" class="game_icon"><img src="img/game_icon2.png" alt=""></a>
                                        <a href="" class="game_icon"><img src="img/game_icon1.png" alt=""></a>-->

                </div>
            </div>

        <?php } else { ?>

            <div class="div_style_1 inline_top width_32p mr_2p">
                <h3 class="md_h3">免登入　快速體驗</h3>
                <!--<button type="button" class="md_btn_more">更多</button>-->
                <div class="md_clear fontSize_0">
                    <a href="" class="game_icon"><img src="img/BaseSymbol8.png" alt=""></a>
                    <a href="" class="game_icon"><img src="img/win7pk.png" alt=""></a>
                    <!--                    <a href="" class="game_icon"><img src="img/game_icon5.png" alt=""></a>
                                        <a href="" class="game_icon"><img src="img/game_icon4.png" alt=""></a>
                                        <a href="" class="game_icon"><img src="img/game_icon3.png" alt=""></a>
                                        <a href="" class="game_icon"><img src="img/game_icon2.png" alt=""></a>
                                        <a href="" class="game_icon"><img src="img/game_icon1.png" alt=""></a>-->
                </div>
            </div>

        <?php } ?>

        <div class="div_style_1 inline_top width_32p mr_2p">
            <h3 class="md_h3">最新消息</h3>
            <!--<button type="button" class="md_btn_more">更多</button>-->
            <div class="md_clear" id="md_news">
                <ul id="md_news_ul">
                    <?php


                    foreach ($viewData['newsList'] as $item) {
                        $typeName = '';
                        foreach ($viewData['newsType'] as $type) {
                            if ($item['news_type'] == $type['id']) {
                                $typeName = $type['name'];
                            }
                        }

                        $class = 'md_news_type_acti';
                        if ($item['news_type'] == '1') {
                            $class = 'md_news_type_game';
                        }

                        echo '<li><span class="' . $class . '">' . $typeName . '</span><span>' . date("Y-m-d", strtotime($item['sDate'])) . '</span><span data-toggle="modal" data-target="#myModal' . $item['id'] . '">' . $item['title'] . '</span></li>';
                        //最新消息
                        echo ' <div class="modal fade" id="myModal' . $item['id'] . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h4 class="modal-title" id="myModalLabel">' . $item['title'] . '</h4><p><span class="' . $class . '">' . $typeName . '</span><span style="margin-left:10px;color:#CCC;">' . $item['sDate'] . '</span></p></div><div class="modal-body"><p style="letter-spacing:1px;line-height:2em;White-space: initial;">' . $item['content'] . '</p></div><div class="modal-footer"><button type="button" class="btn-close" data-dismiss="modal">關　閉</button></div></div></div></div>';
                        //最新消息內容跳窗
                    }

                    ?>
                </ul>
            </div>
        </div>
        <div class="div_style_1 inline_top width_32p">
            <h3 class="md_h3">金礦彩金連線</h3>
            <div class="md_clear" id="md_money">
                <ul id="md_money_ul">
                    <?php
                    foreach ($viewData['jpotData'] as $row)
                        echo '<li><span class="md_money_jp">JP' . $row['id'] . '</span><a href="" class="md_money_num">' . number_format($row['accumulation']/100,1) . '</a></li>';

                    ?>

<!--                    <li><span class="md_money_jp">JP1</span><a href="" class="md_money_num">1234567.89</a></li>-->
<!--                    <li><span class="md_money_jp">JP2</span><a href="" class="md_money_num">234567.89</a></li>-->
<!--                    <li><span class="md_money_jp">JP3</span><a href="" class="md_money_num">34567.89</a></li>-->
<!--                    <li><span class="md_money_jp">JP4</span><a href="" class="md_money_num">4567.89</a></li>-->
                </ul>
            </div>
        </div>
    </div>
    <div class="div_style_3 mt_20 mb_20">
        <h3 class="md_h3">排行榜</h3>
        <!--        <button type="button" class="md_btn_more">更多</button>-->
        <div class="md_clear">
            <div class="md_rank" id="md_rank_lt">
                <ul>
                    <li><a href="#md_rank_lt_tab1" class="md_rank_tabs">百大富豪</a></li>
                    <li><a href="#md_rank_lt_tab2" class="md_rank_tabs">彩金贏分</a></li>
                    <li><a href="#md_rank_lt_tab3" class="md_rank_tabs">百大勝分榜</a></li>
                </ul>
                <div id="md_rank_lt_tab1" class="md_rank_div">
                    <table>
                        <?php include 'php/rank_table_1.php'; ?>
                    </table>
                </div>
                <div id="md_rank_lt_tab2" class="md_rank_div">
                    <table>
                        <?php include 'php/rank_table_2.php'; ?>
                    </table>
                </div>
                <div id="md_rank_lt_tab3" class="md_rank_div">
                    <table>
                        <?php include 'php/rank_table_3.php'; ?>
                    </table>
                </div>
            </div>
            <div class="md_rank" id="md_rank_rt">
                <ul>
                    <li><a href="#md_rank_rt_tab1" class="md_rank_tabs">單局贏分榜</a></li>
                    <li><a href="#md_rank_rt_tab2" class="md_rank_tabs">單局倍率榜</a></li>
                    <!--                    <li><a href="#md_rank_rt_tab3" class="md_rank_tabs">斯洛連開榜</a></li>
                                        <li><a href="#md_rank_rt_tab4" class="md_rank_tabs">ART榜</a></li>-->
                </ul>
                <div id="md_rank_rt_tab1" class="md_rank_div">
                    <table>
                        <?php include 'php/rank_table_4.php'; ?>
                    </table>
                </div>
                <div id="md_rank_rt_tab2" class="md_rank_div">
                    <table>
                        <?php include 'php/rank_table_5.php'; ?>
                    </table>
                </div>
                <!--                <div id="md_rank_rt_tab3" class="md_rank_div">
                    <table>
                        <?php include 'php/rank_table_6.php'; ?>
                    </table>
                </div>
                <div id="md_rank_rt_tab4" class="md_rank_div">
                    <table>
                        <?php include 'php/rank_table_7.php'; ?>
                    </table>
                </div>-->
            </div>
            <p id="md_rank_note">*單局贏分榜、單局倍率榜只含轉輪、電子遊戲。</p>
        </div>
    </div>
</main> 