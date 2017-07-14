<main id="md" class="big_white_block" style="min-height: 500px;">
    <h3>客服中心</h3>
    <div id="md_service">
        <ul class="white_bottom_line tab_level_1">
            <li><a href="#md_service_tab1">聯絡我們</a></li>
            <li><a href="#md_service_tab2">意見回饋</a></li>
            <li><a href="#md_service_tab3">常見問題</a></li>
            <li><a href="#md_service_tab4">反詐騙Q&A</a></li>
            <li><a href="#md_service_tab5">使用者規章</a></li>
        </ul>
        <div id="md_service_tab1">

            <form action="service.php?m=contact_us" method="post">
                <input type="hidden"  name="page_token" value="<?php echo $_SESSION['page_token'] ?>"></input>
                <label for=""><span class="star">*</span><span style="letter-spacing: 6px;">留言</span>者：</label><input name="name" type="text" value="" style="margin-left: 11px;" required>
                <br>
                <label for="" class="no_star">聯絡電話：</label><input type="tel"  pattern="[0][9][0-9]{8}" placeholder="09xxxxxxxx" name="tel">
                <br>
                <label for=""><span class="star">*</span>電子信箱：</label><input type="email" required name="email">
                <br>
                <label for="" class="md_service_msg_label"><span class="star">*</span>留言內容：</label><textarea name="content" id="" cols="60" rows="10" required></textarea>
                <br>
                <input type="reset" value="重設" class="form_btn">
                <input type="submit" value="送出" class="form_btn">
            </form>
        </div>
        <div id="md_service_tab2">


            <form action="service.php?m=recommand" method="post">
                <input type="hidden"  name="page_token" value="<?php echo $_SESSION['page_token'] ?>"></input>
                <label for=""><span class="star">*</span><span style="letter-spacing: 6px;">留言</span>者：</label><input name="name" type="text" value="" style="margin-left: 11px;" required>
                <br>
                <label for="" class="no_star">聯絡電話：</label><input type="tel"  pattern="[0][9][0-9]{8}" placeholder="09xxxxxxxx" name="tel">
                <br>
                <label for=""><span class="star">*</span>電子信箱：</label><input type="email" required name="email">
                <br>
                <label for="" class="md_service_msg_label"><span class="star">*</span>留言內容：</label><textarea name="content" id="" cols="60" rows="10" required></textarea>
                <br>
                <input type="reset" value="重設" class="form_btn">
                <input type="submit" value="送出" class="form_btn">
            </form>
        </div>
        <div id="md_service_tab3">

            <div>
                <button type="button" id="md_btn_questionAll">所有問題</button>
                <button type="button" id="md_btn_questionGam">遊戲問題</button>
                <button type="button" id="md_btn_questionPnt">點數問題</button>
                <button type="button" id="md_btn_questionOth">其他問題</button>
            </div>
            <table>
                <?php
                if (isset($viewData['qlist'])) {
                    if ($viewData['qlist'] != FALSE) {
                        foreach ($viewData['qlist'] as $item) {
                            $css = '';
                            //var_dump($item);
                            switch ($item['type']) {
                                case '遊戲問題' :
                                    $css = 'md_questionForGame';
                                    break;
                                case '點數問題' :
                                    $css = 'md_questionForPont';
                                    break;
                                case '其它問題' :
                                    $css = 'md_questionForOthr';
                                    break;
                            }
                            echo '<tr class="' . $css . '">';
                            echo '<td>' . $item['type'] . '</td>';
                            echo '<td>' . $item['create_date'] . '</td>';
                            echo '<td>' . $item['title'] . '</td>';
                            echo '</tr>';
                        }
                    }
                }
                ?>
                <!--
                <tr class="md_questionForGame">
                    <td>遊戲問題</td>
                    <td>2016/08/16</td>
                    <td>XXXXXXXXXXXXXXXXXXXXXXXX</td>
                </tr>
                <tr class="md_questionForGame">
                    <td>遊戲問題</td>
                    <td>2016/08/16</td>
                    <td>XXXXXXXXXXXXXXXXXXXXXXXX</td>
                </tr>
                <tr class="md_questionForGame">
                    <td>遊戲問題</td>
                    <td>2016/08/16</td>
                    <td>XXXXXXXXXXXXXXXXXXXXXXXX</td>
                </tr>
                <tr class="md_questionForPont">
                    <td>點數問題</td>
                    <td>2016/08/16</td>
                    <td>XXXXXXXXXXXXXXXXXXXXXXXX</td>
                </tr>
                <tr class="md_questionForPont">
                    <td>點數問題</td>
                    <td>2016/08/16</td>
                    <td>XXXXXXXXXXXXXXXXXXXXXXXX</td>
                </tr>
                <tr class="md_questionForPont">
                    <td>點數問題</td>
                    <td>2016/08/16</td>
                    <td>XXXXXXXXXXXXXXXXXXXXXXXX</td>
                </tr>
                <tr class="md_questionForOthr">
                    <td>其他問題</td>
                    <td>2016/08/16</td>
                    <td>XXXXXXXXXXXXXXXXXXXXXXXX</td>
                </tr>
                <tr class="md_questionForOthr">
                    <td>其他問題</td>
                    <td>2016/08/16</td>
                    <td>XXXXXXXXXXXXXXXXXXXXXXXX</td>
                </tr>
                <tr class="md_questionForOthr">
                    <td>其他問題</td>
                    <td>2016/08/16</td>
                    <td>XXXXXXXXXXXXXXXXXXXXXXXX</td>
                </tr>
                -->
            </table>



        </div>
        <div id="md_service_tab4">
            <h4>直接以滑鼠點擊問題，即可看到答案</h4>
            <ol>
<?php
if (isset($viewData['qlist2'])) {
    foreach ($viewData['qlist2'] as $item) {

        echo ' <li class="md_questionQuestn">' . $item['question'] . '</li><li class="md_questionAnswer">' . $item['answer'] . '</li>';
    }
}
?>
                <!--
                    <li class="md_questionQuestn">1. XXXXXXXXXXXXXXX</li>
                    <li class="md_questionAnswer">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</li>
                    <li class="md_questionQuestn">2. XXXXXXXXXXXXXXXXXXXXXXX</li>
                    <li class="md_questionAnswer">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</li>
                    <li class="md_questionQuestn">3. XXXXXXXXXXXXXX</li>
                    <li class="md_questionAnswer">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</li>
                    <li class="md_questionQuestn">4. XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</li>
                    <li class="md_questionAnswer">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</li>
                    <li class="md_questionQuestn">5. XXXXXXXXXXXXXXXXXXXXXXXXXXXXX</li>
                    <li class="md_questionAnswer">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</li>
                    <li class="md_questionQuestn">6. XXXXXXXXXXXXXXXXXXXXXXX</li>
                    <li class="md_questionAnswer">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</li>
                    <li class="md_questionQuestn">7.XXXXXXXXXXXXXXXXXXXX</li>
                    <li class="md_questionAnswer">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</li>
                -->
            </ol>
        </div>
        <div id="md_service_tab5">
            <p><?php echo $viewData['user_rule'][0]['content']; ?></p>
        </div>
    </div>
</main>