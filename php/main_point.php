<script>

</script>
<main id="md" class="big_white_block">
    <h3>儲值轉帳</h3>
    <?php
    @$production_package = $viewData['production_package'];
    $couaa = count($production_package);
    ?>
    <div id="md_point" class="mt_20">
        <ul class="white_bottom_line tab_level_1">
            <li><a href="#md_point_tab1" onclick="get_close(<?php echo $couaa; ?>)">儲值購點</a></li>
            <li><a href="#md_point_tab2">平台幣轉帳</a></li>
        </ul>
        <div id="md_point_tab1">
            <div id="md_point_buy">
                <ul>
                    <li><a href="#md_point_buy1" onclick="get_close(<?php echo $couaa; ?>)">線上購點</a></li>
                    <li><a href="#md_point_buy2">序號儲值</a></li>
                    <li><a href="#md_point_buy4">線上轉點</a></li>
                    <li><a href="#md_point_buy5">儲值紀錄</a></li>
                </ul>
                <div id="md_point_buy1" class="tab_level_2">

                    <div id="md_mb_profile" class="tab_level_2">
                        <!--                        <div id='product_info'>
                                                    <table id="order_tablea" style='display:none'>
                                                       <tbody><tr>
                                                               <td class="otb_left">商品名稱：</td>
                                                               <td class="otb_right" id='prod_name'></td>
                                                           </tr>
                                                           <tr>
                                                               <td class="otb_left">商店名稱：</td>
                                                               <td class="otb_right">大聯盟娛樂城</td>
                                                           </tr>
                                                           <tr>
                                                               <td class="otb_left">訂單金額：</td>
                                                               <td class="otb_right" id='prod_price'></td>
                                                           </tr>
                                                           <tr>
                                                               <td class="otb_left">應付金額：</td>
                                                               <td class="otb_right  total_amount" id=''></td>
                                                           </tr>
                                                           <tr>
                                                               <td class="otb_left">獲得點數：</td>
                                                               <td class="otb_right  total_amount"></td>
                                                           </tr>
                                                           <tr>
                                                               <td colspan='2'>
                                                                   <button>pay</button>
                                                                   <button>close</button>
                                                               </td>
                                                           </tr>
                                                       </tbody></table> 
                                                   
                                                </div>-->
                        <div class="mb_10" id='order_options'>
                            <!--                                <h4 label for="mbGameType">尚未開放：</label>-->
                            <?php
                            if (@$production_package != NULL) {
                                foreach (@$production_package as $key => $value) {
                                    ?>
                                    <div class="yellow_btn" id="pack<?php echo $key + 1 ?>" onclick="get_card(<?php echo $key + 1 ?>, <?php echo $couaa; ?>);"><?php echo $value['Amt']; ?> 元  獲得點數：<?php echo $value['points']; ?>

                                    </div>
                                    <div id="pag2go<?php echo $key + 1 ?>"  style="display:none; padding-left: 25px; margin-bottom: 5px ;width:500px" >
                                        <div class="billing_style_div">
                                            <div id="order_info">
                                                <table id="order_table">
                                                    <tbody><tr>
                                                            <td class="otb_left">商品名稱：</td>
                                                            <td class="otb_right"><?php echo $value['ItemDesc']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="otb_left">商店名稱：</td>
                                                            <td class="otb_right">大聯盟娛樂城</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="otb_left">訂單金額：</td>
                                                            <td class="otb_right"><?php echo $value['Amt']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="otb_left">應付金額：</td>
                                                            <td class="otb_right  total_amount"><?php echo $value['Amt']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="otb_left">獲得點數：</td>
                                                            <td class="otb_right  total_amount"><?php echo $value['points']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan='2'>
                                                                <button  onclick="get_pay(<?php echo $value['id']; ?>)"  value="<?php echo $value['id']; ?>" style="background-color:#0000AA">付款</button>
                                                                <button  onclick="get_close(<?php echo $couaa; ?>)" value="close" style="background-color:#AA0000">取消</button>
                                                            </td>
                                                        </tr>
                                                    </tbody></table> 
                                                <hr style="margin: 10px 0px">
                                                <div style="margin-top: 10px;margin-bottom:5px;">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                }
                            }
                            ?>

                        </div>

                    </div>










                </div>
                <div id="md_point_buy2" class="tab_level_2">
                    <h4 class="ml_20">請選擇您的序號來源</h4>
                    <div class="pink_btn colorbox">
                        <span>JCard 序號儲值</span><span>何處買?</span><span>教學</span>
                    </div>
                    <h4 class="ml_20">以下尚未開放：</h4>
                    <div class="blue_btn">
                        <span>平台卡序號儲值</span><span>何處買?</span><span>教學</span>
                    </div>
                    <div class="blue_btn">
                        <span>平台有錢活動/產包</span><span>何處買?</span><span>教學</span>
                    </div>
                    <div class="green_btn">
                        <span>Fun Pay 全家立即儲</span><span>何處買?</span><span>教學</span>
                    </div>
                    <div class="light_blue_btn">
                        <span>my Card 序號儲值</span><span>何處買?</span><span>教學</span>
                    </div>
                    <div class="red_btn">
                        <span>GASH 序號儲值</span><span>何處買?</span><span>教學</span>
                    </div>
                    <div class="pink_btn">
                        <span>辣椒卡 序號儲值</span><span>何處買?</span><span>教學</span>
                    </div>
                    <!--                <div class="pink_btn colorbox">
                                        <span>JCard 序號儲值</span><span>何處買?</span><span>教學</span>
                                    </div>-->
                </div>
                <!--                <div id="md_point_buy3" class="tab_level_2">
                                    <h4 class="ml_20">以下尚未開放：</h4>
                                                        <h4 class="ml_20">請選擇您的包月方案</h4>
                
                
                                </div>-->
                <div id="md_point_buy4" class="tab_level_2">
                    <h4 class="ml_20">以下尚未開放：</h4>
                    <!--                    <h4 class="ml_20">請選擇您要使用的轉點平台</h4>-->
                    <div class="light_blue_btn">
                        <span>my Card 線上轉點</span><span>何處買?</span><span>教學</span>
                    </div>
                </div>
                <div id="md_point_buy5" class="tab_level_2">
                    <div id="md_point_transfer2" class="tab_level_2">
                        <h4 class="ml_20">轉帳紀錄</h4>
                        <table>
                            <tr>
                                <th>序號</th>
                                <th>儲值名稱</th>
                                <th>儲值卡別</th>
                                <th>儲值時間</th>
                                <th>儲值點數</th>
                                <th>儲值序號</th>
                                <th>狀態</th>
                            </tr>
                            <?php
                            @$record1 = $viewData['jcord_data'];
                            if (@$record1 != FALSE) {
                                foreach (@$record1 as $key => $row) {
                                    ?>
                                    <tr>
                                        <td><?= @$key + 1 ?></td>
                                        <td><?= @$row['name'] ?></td>
                                        <td><?= $row['card_type'] ?></td>
                                        <td><?= @$row['create_date'] ?></td>
                                        <td><?= @$row['points'] ?></td>
                                        <td><?= @$row['serial_number'] ?></td>

                                        <?php
                                        if ($row['status'] == '-1') {
                                            echo '<td>交易失敗</td>';
                                        }
                                        if ($row['status'] == 2) {
                                            echo '<td>成功</td>';
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>

                                <tr>
                                    查無資料
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <!--                <div id="md_point_buy5" class="tab_level_2">
                                    <div id="md_mb_profile" class="tab_level_2">
                                        <form action="" method="POST" class="ml_20 mb_20">
                                            <div class="mb_10">
                                                <label for="mbGameType">尚未開放：</label>
                                        </form>
                                    </div>
                                </div>
                                <h4 class="ml_20">實體產包</h4>
                                <table>
                                    <tr>
                                        <th>馬戲團小丑包</th>
                                        <th>實體產包</th>
                                    </tr>
                                    <tr>
                                        <td>XXX</td>
                                        <td>XXX</td>
                                    </tr>
                                    <tr>
                                        <th>XX包</th>
                                        <th>實體產包</th>
                                    </tr>
                                    <tr>
                                        <td>XXX</td>
                                        <td>XXX</td>
                                    </tr>
                                    <tr>
                                        <th>XX包</th>
                                        <th>實體產包</th>
                                    </tr>
                                    <tr>
                                        <td>XXX</td>
                                        <td>XXX</td>
                                    </tr>
                                </table>
                                <h4 class="ml_20 mt_20">虛擬產包</h4>
                                <table>
                                    <tr>
                                        <th>馬戲團小丑包</th>
                                        <th>實體產包</th>
                                    </tr>
                                    <tr>
                                        <td>XXX</td>
                                        <td>XXX</td>
                                    </tr>
                                    <tr>
                                        <th>XX包</th>
                                        <th>實體產包</th>
                                    </tr>
                                    <tr>
                                        <td>XXX</td>
                                        <td>XXX</td>
                                    </tr>
                                    <tr>
                                        <th>XX包</th>
                                        <th>實體產包</th>
                                    </tr>
                                    <tr>
                                        <td>XXX</td>
                                        <td>XXX</td>
                                    </tr>
                                </table>
                            </div>-->
            </div>
        </div>
        <!--        <div class="yellow_btn">500元</div>-->
        <div id="md_point_tab2">
            <div id="md_point_transfer">
                <ul>
                    <li><a href="#md_point_transfer1">轉帳中心</a></li>
                    <li><a href="#md_point_transfer2" >轉帳紀錄</a></li>
                </ul>
                <div id="md_point_transfer1" class="tab_level_2">
                    <h4 class="ml_20">平台幣轉帳</h4>
                    <div class="ml_20" style="line-height: 2em;">
                        <p>轉出平台幣：<?= $viewData['transferData']['transfer_total'] ?></p>
                        <p>目前可建立轉帳筆數：<?php echo $viewData['transferData']['daycount'] - $viewData['transferData']['transfer_count']
                            ?></p>
                        <p>目前可轉帳額度：<?php
                            echo $viewData['transferData']['daylimit'] - $viewData['transferData']['transfer_total']
                            ?></p>
                        <p>凍結轉帳點數：0</p>
                    </div>
                    <h4 class="ml_20 mt_20">轉帳入口</h4>
                    <div class="yellow_btn" id="transferData" style="width: 120px">前往轉帳</div>
                    <div class="yellow_btn" id="point_receive" style="width: 120px">確認轉帳</div>
                </div>
                <div id="md_point_transfer2" class="tab_level_2">
                    <h4 class="ml_20">轉帳紀錄</h4>
                    <table>
                        <tr>
                            <th>序號</th>
                            <th>轉出暱稱</th>
                            <th>轉出帳號</th>
                            <th>轉入暱稱</th>
                            <th>轉入帳號</th>
                            <th>轉出點數</th>
                            <th>減少點數</th>
                            <th>手續費</th>
                            <th>建立時間</th>
                            <th>狀態</th>
                        </tr>

                        <?php
                        $record = $viewData['transferRecord'];
                        if ($record != FALSE) {
                            if (count($record) >= 1) {
                                foreach ($record as $key => $row) {
                                    ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $row['transfer_name'] ?></td>
                                        <td><?= $row['transfer_acc'] ?></td>
                                        <td><?= $row['receiver_name'] ?></td>
                                        <td><?= $row['receiver_acc'] ?></td>
                                        <td><?= $row['reduce_point'] ?></td>
                                        <td><?= $row['receive_point'] ?></td>
                                        <td><?= $row['fee'] ?></td>
                                        <td><?= $row['create_at'] ?></td>
                                        <?php
                                        if ($row['tm_status'] == 1) {
                                            echo '<td>等待驗證</td>';
                                        }
                                        if ($row['tm_status'] == 2 && $viewData['member']['id'] == $row['transfer_id']) {
                                            echo '<td>等待對方接受</td>';
                                        }
                                        if ($row['tm_status'] == 2 && $viewData['member']['id'] != $row['transfer_id']) {

                                            echo '<input id="id_1" type="hidden" name="en" value="' . $row['id'] . '">';
                                            echo '<td><input id="button1" type="button" value="接受">';
                                            echo '<input id="button2" type="button" value="拒絕"></td>';
                                        }
                                        if ($row['tm_status'] == 3 && $viewData['member']['id'] == $row['transfer_id']) {
                                            echo '<td>等待二次驗證</td>';
                                        }
                                        if ($row['tm_status'] == 3 && $viewData['member']['id'] != $row['transfer_id']) {
                                            echo '<td>等待對方接受</td>';
                                        }
                                        if ($row['tm_status'] == 4) {
                                            echo '<td>轉帳成功</td>';
                                        }
                                        if ($row['tm_status'] == 0) {
                                            echo '<td>已取消交易</td>';
                                        }
                                        ?>
                                    </tr>
                                    <script type="text/JavaScript">
                                        document.onclick=function()
                                        { var obj = event.srcElement;
                                        var x = $('#button1').attr("value");
                                        var y = $('#button2').attr("value");
                                        var z = $('#id_1').attr("value");
                                        if(obj.type == "button"){
                                        if(obj.value == "接受")
                                        {
                                        $.ajax({
                                        url: "check_button.php",
                                        data: "button="+x+"&id="+z,
                                        type: "POST",
                                        dataType: 'text',
                                        success: function (msg) {
                                        alert("等待對方驗證");    
                                        window.location.replace('point.php?=0');          
                                        },
                                        })
                                        }

                                        if(obj.value == "拒絕")
                                        {
                                        $.ajax({
                                        url: "check_button.php",
                                        data: "button="+y+"&id="+z,
                                        type: "POST",
                                        dataType: 'text',
                                        beforeSend: function (msg) {
                                        },
                                        success: function (msg) {
                                        alert("已取消交易");
                                        window.location.replace('point.php?=0');
                                        },
                                        })
                                        }
                                        }
                                        } 
                                    </script>
                                    <?php
                                }
                            } else {
                                ?>

                                <tr>
                                    查無資料
                                </tr>
                                <?php
                            }
                        }
                        ?>

                    </table>

                </div>
            </div>
        </div>
    </div>
</main>