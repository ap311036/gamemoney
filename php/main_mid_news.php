<main id="md" class="big_white_block" style="min-height: 570px;">
    <h3>最新消息</h3>
    <div id="md_news">
        <ul class="white_bottom_line tab_level_1">
            <li><a href="#md_news_1">消息公告</a></li>
            <li><a href="#md_news_2">最新排行榜</a></li>
        </ul>
        <div id="md_news_1">
            <button type="button" id="md_btn_all">所有消息</button>
            <button type="button" id="md_btn_game">遊戲公告</button>
            <button type="button" id="md_btn_acti">活動公告</button>
            <ul class="mt_20">
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
                        echo '<li><span class="'. $class.'">'.$typeName .'</span><span>'. date("Y-m-d", strtotime($item['sDate']))  .'</span><span data-toggle="modal" data-target="#myModal'. $item['id'] .'">'. $item['title'] .'</span></li>';
                            //最新消息
                        echo ' <div class="modal fade" id="myModal'. $item['id'] .'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h4 class="modal-title" id="myModalLabel">'.$item['title'].'</h4><p><span class="'. $class.'">'.$typeName.'</span><span style="margin-left:10px;color:#CCC;">'.$item['sDate'].'</span></p></div><div class="modal-body"><p style="letter-spacing:1px;line-height:2em;">'.$item['content'].'</p></div><div class="modal-footer"><button type="button" class="btn-close" data-dismiss="modal">關　閉</button></div></div></div></div>';
                            //最新消息內容跳窗
                    }  
                ?>
            </ul>
        </div>
        <div id="md_news_2">
            <div id="md_rank">
                <ul>
                    <li><a href="#md_rank_tab1">百大富豪</a></li>
                    <li><a href="#md_rank_tab2">彩金贏分</a></li>
                    <li><a href="#md_rank_tab3">百大勝分榜</a></li>
<!--                    <li><a href="#md_rank_tab4">單局贏分榜</a></li>
                    <li><a href="#md_rank_tab5">單局倍率榜</a></li>
                    <li><a href="#md_rank_tab6">斯洛連開榜</a></li>
                    <li><a href="#md_rank_tab7">ART榜</a></li>-->
                </ul>
                <div id="md_rank_tab1">
                    <table class="md_rank_table">
                        <?php include 'php/rank_table_1.php'; ?>
                    </table>
                </div>
                <div id="md_rank_tab2">
                    <table class="md_rank_table">
                        <?php include 'php/rank_table_2.php'; ?>
                    </table>
                </div>
                <div id="md_rank_tab3">
                    <table class="md_rank_table">
                        <?php include 'php/rank_table_3.php'; ?>
                    </table>
                </div>
<!--                <div id="md_rank_tab4">
                    <table class="md_rank_table">
                        <?php include 'php/rank_table_4.php'; ?>
                    </table>
                </div>
                <div id="md_rank_tab5">
                    <table class="md_rank_table">
                        <?php include 'php/rank_table_5.php'; ?>
                    </table>
                </div>
                <div id="md_rank_tab6">
                    <table class="md_rank_table">
                        <?php include 'php/rank_table_6.php'; ?>
                    </table>
                </div>
                <div id="md_rank_tab7">
                    <table class="md_rank_table">
                        <?php include 'php/rank_table_7.php'; ?>
                    </table>
                </div>-->
            </div>
        </div>
    </div>
</main>