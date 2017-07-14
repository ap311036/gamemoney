<div class="span2">
    <div class="well sidebar-nav">
        <ul class="nav nav-list">
            <li class="nav-header">櫃控系統</li>
            <?php
            if ($admin['ad_mtid'] == 1) {
                ?>
                <li><a href="admin.php">管理員帳號管理</a></li>
                <?php
            }
            ?>
            <li><a href="member.php">會員帳號管理</a></li>
            <li><a href="game_member.php">會員遊玩紀錄管理</a></li>
            <li><a href="slot_machine.php">機台管理</a></li>
            <li><a href="deposit_history.php">儲值紀錄</a></li>
            <li><a href="member_login_list.php">會員登入紀錄</a></li>
            <li><a href="member_transform_log.php">會員轉帳紀錄</a></li>

        </ul>

        <ul class="nav nav-list">
            <li class="nav-header">客服中心</li>
            <li><a href="look_message.php">聯絡留言</a></li>
            <li><a href="comments_message.php">意見留言</a></li>
            <li><a href="latest_news.php">最新消息</a></li>
            <li><a href="common_problem.php">常見問題</a></li>
        </ul>
        <ul class="nav nav-list">
            <li class="nav-header">遊戲管理</li>
            <li><a href="game_center_list.php">館別管理</a></li>
            <li><a href="game_intro_manager.php">遊戲說明管理</a></li>
            <li><a href="game_newbie_guide.php">新手導引管理</a></li>
            <li><a href="get_machine_password.php">遊戲機台密碼</a></li>

        </ul>
        <ul class="nav nav-list">
            <li class="nav-header">JPOT管理</li>
            <li><a href="jpot_setting.php">JPOT管理</a></li>
            <li><a href="jpot_win_record.php">JPOT得獎紀錄</a></li>
        </ul>
        <ul class="nav nav-list">
            <li class="nav-header">商品管理</li>
            <li><a href="product_information.php">pay2go管理</a></li>
        </ul>
        </ul>
        <ul class="nav nav-list">
            <li class="nav-header">跑馬燈管理</li>
            <li><a href="marquee.php">跑馬燈管理</a></li>
        </ul>

    </div>
</div>