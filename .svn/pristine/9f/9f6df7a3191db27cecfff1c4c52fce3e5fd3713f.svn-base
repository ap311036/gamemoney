<main id="md">
    <div>
        <h3 class="md_h3">我最常玩</h3>
        <button type="button" class="md_btn_more">more</button>
        <div class="md_clear"></div>
    </div>
    <hr>
    <div class="md_div_lt">
        <h3 class="md_h3">熱門推薦</h3>
        <div class="md_clear">
            <div class="md_game">
                <a href=""><img src="img/BaseSymbol8.png" alt="" width="92"></a>
                <p>最新上架</p>
            </div>
            <div class="md_game">
                <a href=""><img src="img/main_mid_game_icon.png" alt=""></a>
                <p>新手入門</p>
            </div>
            <div class="md_game">
                <a href=""><img src="img/main_mid_game_icon.png" alt=""></a>
                <p>新手入門</p>
            </div>
            <div class="md_game">
                <a href=""><img src="img/main_mid_game_icon.png" alt=""></a>
                <p>最夯遊戲</p>
            </div>
            <div class="md_game">
                <a href=""><img src="img/main_mid_game_icon.png" alt=""></a>
                <p>最夯遊戲</p>
            </div>
            <div class="md_game">
                <a href=""><img src="img/main_mid_game_icon.png" alt=""></a>
                <p>最夯遊戲</p>
            </div>
        </div>
    </div>
    <div class="md_div_rt">
        <h3 class="md_h3">我的好友</h3>
        <button type="button" class="md_btn_more">more</button>
        <div class="md_clear"></div>
    </div>
    <hr>
    <div class="md_div_lt">
        <h3 class="md_h3">最新消息</h3>
        <button type="button" class="md_btn_more">more</button>
        <div class="md_clear" id="md_news">
            <ul id="md_news_ul">
                <?php 

                
                    foreach($viewData['newsList'] as $item)
                    {
                        $typeName = '';
                        foreach($viewData['newsType'] as $type)
                        {
                            if($item['news_type'] == $type['id'])
                            {
                                $typeName = $type['name'];
                            }
                        }

                        $class = 'md_news_type_acti';
                        if($item['news_type']=='1')
                        {
                            $class = 'md_news_type_game';
                        }
                        echo '<li><span class="'. $class.'">'.$typeName .'</span><span>'. date("Y-m-d", strtotime($item['sDate']))  .'</span><a href="">'. $item['title'] .'</a></li>';
                    }
                
                ?>
                <!--
                <li><span class="md_news_type_game">遊戲</span><span>2016/08/04</span><a href="">8/4(四) 開放公告</a></li>
                <li><span class="md_news_type_game">遊戲</span><span>2016/08/04</span><a href="">8/4(四) 例行維護時間延長公告</a></li>
                <li><span class="md_news_type_game">遊戲</span><span>2016/08/04</span><a href="">8/4(四) 例行維護時間調整公告</a></li>
                <li><span class="md_news_type_acti">活動</span><span>2016/08/04</span><a href="">7/21 轉輪館「亞瑟王」臨時維護公告</a></li>
                <li><span class="md_news_type_game">遊戲</span><span>2016/08/04</span><a href="">7/21 例行維護延長公告</a></li>
                <li><span class="md_news_type_game">遊戲</span><span>2016/08/04</span><a href="">8/4(四) 開放公告</a></li>
                <li><span class="md_news_type_acti">活動</span><span>2016/08/04</span><a href="">7/21(四) 例行維護時間調整公告</a></li>

                -->
            </ul>
        </div>
    </div>
    <div class="md_div_rt">
        <h3 class="md_h3">彩金連線</h3>
        <div class="md_clear" id="md_money">
            <ul id="md_money_ul">
                <li><span class="md_money_jp">JP1</span><a href="" class="md_money_num">1234567.89</a></li>
                <li><span class="md_money_jp">JP2</span><a href="" class="md_money_num">234567.89</a></li>
                <li><span class="md_money_jp">JP3</span><a href="" class="md_money_num">34567.89</a></li>
                <li><span class="md_money_jp">JP4</span><a href="" class="md_money_num">4567.89</a></li>
            </ul>
        </div>
    </div>
    <hr>
    <div>
        <h3 class="md_h3">排行榜</h3>
        <button type="button" class="md_btn_more">more</button>
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
                    <li><a href="#md_rank_rt_tab3" class="md_rank_tabs">斯洛連開榜</a></li>
                    <li><a href="#md_rank_rt_tab4" class="md_rank_tabs">ART榜</a></li>
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
                <div id="md_rank_rt_tab3" class="md_rank_div">
                    <table>
                        <?php include 'php/rank_table_6.php'; ?>
                    </table>
                </div>
                <div id="md_rank_rt_tab4" class="md_rank_div">
                    <table>
                        <?php include 'php/rank_table_7.php'; ?>
                    </table>
                </div>
            </div>
            <p id="md_rank_note">*單局贏分榜、單局倍率榜只含轉輪、電子遊戲。</p>
        </div>
    </div>
</main> 