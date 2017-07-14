<?php
include('lib/config.php');
include('lib/pay2go_inc.php');
include('lib/Carbon.php');
$ExpireDate = Carbon\Carbon::now()->addDays($pay2go_setting['ExpireDateBaseDay'])->format("Ymd");
$ExpireTime = Carbon\Carbon::now()->addMinutes($pay2go_setting['ExpireTimeMinutes'])->format("His");

include('func/func_pay2go.php');

$pay2go_item = $viewData['pay2goinit'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf8">
        <link rel="stylesheet" href="css/reset.css">
        <style type="text/css">
            @font-face {
                font-family: 'Noto Sans TC';
                src: url(font/NotoSansTC-Regular.otf);
            }

            html, body {
                width: 100%;
                height: 100%;
            }

            body {
                background-image: url("img/star_background4.jpg");
                background-size: cover;
                background-position: 50% 50%;
            }

            form {
                padding-top: 50px;
                margin: auto;
                width: 315px;
                text-align: center;
            }

            td {
                padding: 5px;
                color: #fff;
                font-family: 'Noto Sans TC', sans-serif;
                font-size: 15px;
            }

            input[type="text"] {
                padding: 5px;
                width: 200px;
                font-family: 'Noto Sans TC', sans-serif;
                letter-spacing: 1px;
                font-size: 15px;
            }
            .button1 {
    background-color: #FFFFFF; /* Green */
    border: none;
    color: white;
    padding: 1px 1px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 1px;
}
            

            input[type="button"],
            input[type="reset"] {
                -moz-box-shadow: inset 0px 1px 0px 0px #97c4fe;
                -webkit-box-shadow: inset 0px 1px 0px 0px #97c4fe;
                box-shadow: inset 0px 1px 0px 0px #97c4fe;
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #3d94f6), color-stop(1, #1e62d0));
                background: -moz-linear-gradient(top, #3d94f6 5%, #1e62d0 100%);
                background: -webkit-linear-gradient(top, #3d94f6 5%, #1e62d0 100%);
                background: -o-linear-gradient(top, #3d94f6 5%, #1e62d0 100%);
                background: -ms-linear-gradient(top, #3d94f6 5%, #1e62d0 100%);
                background: linear-gradient(to bottom, #3d94f6 5%, #1e62d0 100%);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#3d94f6', endColorstr='#1e62d0', GradientType=0);
                background-color: #3d94f6;
                -moz-border-radius: 6px;
                -webkit-border-radius: 6px;
                border-radius: 6px;
                border: 1px solid #337fed;
                display: inline-block;
                cursor: pointer;
                color: #ffffff;
                font-family: 'Noto Sans TC', sans-serif;
                font-size: 15px;
                font-weight: bold;
                padding: 6px 24px;
                text-decoration: none;
                text-shadow: 0px 1px 0px #1570cd;
                margin: 0px 10px;
                letter-spacing: 2px;
            }

            input[type="button"]:hover,
            input[type="reset"]:hover {
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #1e62d0), color-stop(1, #3d94f6));
                background: -moz-linear-gradient(top, #1e62d0 5%, #3d94f6 100%);
                background: -webkit-linear-gradient(top, #1e62d0 5%, #3d94f6 100%);
                background: -o-linear-gradient(top, #1e62d0 5%, #3d94f6 100%);
                background: -ms-linear-gradient(top, #1e62d0 5%, #3d94f6 100%);
                background: linear-gradient(to bottom, #1e62d0 5%, #3d94f6 100%);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#1e62d0', endColorstr='#3d94f6', GradientType=0);
                background-color: #1e62d0;
            }

            input[type="button"]:active,
            input[type="reset"]:active {
                position: relative;
                top: 1px;
            }

            #butSubmit {
                margin-top: 20px;
            }
        </style>
        <script src="js/jquery-3.1.0.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script>
            $(document).ready(function () {
                //$(".colorbox").colorbox({iframe:true,width:"80%",height:"80%",href:"card_deposit.php"});
                $('#butSubmit').click(function () {
                    var carno = $('#carno').val();
                    var cardpass = $('#cardpass').val();
                    $('#form1').attr('action', 'card_deposit.php?m=deposit');
                    $('#form1').submit();
                });
                
                document.rrr.submit();
            });
        </script>
    </head>
    <body> 
        <div>
            <form method="post" name="rrr" action="https://api.pay2go.com/MPG/mpg_gateway">             <!-- 測試環境用的網址 正式的不一樣請注意 -->
                <input type="hidden" name="MerchantID" value="<?php
                echo $pay2go_item['MerchantID'];
//<!-- 店家代號 -->
                ?>">
                <input type="hidden" name="RespondType" value="<?php
                echo $pay2go_setting['RespondType'];
//    <!-- 回傳資料的格式 -->
                ?>"/>

                <input type="hidden" name="CheckValue" value="<?php
                echo $pay2go_item['CheckValue'];
// <!-- 驗證資料是否一致 -->
                ?>">
                <input type="hidden" name="TimeStamp" value="<?php
                echo $pay2go_item['TimeStamp'];
                // <!-- 訂單產生時間 -->
                ?>">
                <input type="hidden" name="Version" value="<?php
                echo $pay2go_item['Version'];
                //<!-- api 版本 請看最新版說明文件 -->
                ?>">

                <input type="hidden" name="LangType" value="<?php echo $pay2go_setting['LangType']; ?>">
                <input type="hidden" name="MerchantOrderNo" value="<?php
                echo $pay2go_item['MerchantOrderNo'];
                //        <!-- 店家產生的訂單編號 不可重覆 -->
                ?>">
                <input type="hidden" name="Amt" value="<?php
                echo $pay2go_item['Amt'];
                //<!-- 商品價格 --> 
                ?>">
                <input type="hidden" name="ItemDesc" value="<?php echo $pay2go_item['ItemDesc']; ?>">
                <!-- 商品名稱 -->
                <input type="hidden" name="TradeLimit" value="<?php echo $pay2go_setting['TradeLimit']; ?>">
                <!-- 限制交易的秒數，當秒數倒數至 0 時，交易當做失敗 -->
                <input type="hidden" name="ExpireDate" value=<?php
                echo $ExpireDate;
                //        <!-- (適用於非即時交易)格式為 date('Ymd') ，例：20140620 2.此參數若為空值，系統預設為 7 天 -->
                ?>>
                <input type="hidden" name="ExpireTime" value=<?php
                echo $ExpireTime;
                //        <!-- 1.僅適用於超商代碼繳費 2.格式為 date('His') ，例：235959 -->
                ?>>
        <!--        <input type="hidden" name="ReturnURL" value="--><?php
                //echo $pay2go_setting['ReturnURL'];
//        //<!--交易完成後，以 Form Post 方式導回商店頁面
//        
                ?><!--">-->
                <input type="hidden" name="NotifyURL" value="<?php
                echo $pay2go_setting['NotifyURL'];
                //<!--以幕後方式回傳給商店相關支付結果資料
                ?>">
                <?php
//<!--        <input type="hidden" name="CustomerURL" value="">-->
//                <!--.系統取號後以 form post 方式將結果導回商店指定的網址，請參考 七、取號完成系統回傳參數說明。 -->
//                <!--        <input type="hidden" name="ClientBackURL" value="">-->
//                <!--交易取消時，平台會出現返回鈕，使消費者依以此參數網址返回商店指定的頁面 -->
                ?>
                <input type="hidden" name="Email" value="<?php echo $pay2go_item['member_email'] ?>">
                <?php
// <!-- 付款成功會寄通知信到這個email -->
                ?>               
                <?php
// <!-- 可以在致富保頁面修改email -->
                ?>                   
                <input type="hidden" name="EmailModify" value="1">
                <?php
// <!-- 是否需要登入智付寶會員才能付款 0 不用 1 要，廢話這一定要填0的丫 -->
                ?>   
                <input type="hidden" name="LoginType" value="0">
                <input type="hidden" name="OrderComment" value="<?php echo $pay2go_item['OrderComment'] ?>">
                 <?php
// <!-- 將會於 MPG 頁面呈現商店備註內容。 -->
                ?>                  
                <button class="button1" type="submit" ></button>
            </form>
        </div>
    </body>
</html>