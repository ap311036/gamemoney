<?php include_once('func/func_main_left.php');?>
<script src="js/jquery-3.1.0.min.js"></script>
<script type="text/javascript">
    function jsFunction() {
        alert("此商品尚未開放");

    }




        // Facebook JS SDK
        // 1. Load the SDK asynchronously
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/zh_TW/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));


        // 2.
        window.fbAsyncInit = function () {
            FB.init({
                appId: <?php echo $FbAppid?>,
                cookie: true,  // enable cookies to allow the server to access the session
                xfbml: true,  // parse social plugins on this page
                version: 'v2.7' // use graph api version 2.5
            });

            // Now that we've initialized the JavaScript SDK, we call FB.getLoginStatus().
            // This function gets the state of the person visiting this page and can return
            // one of three states to the callback you provide. They can be:
            // 1. Logged into your app ('connected')
            // 2. Logged into Facebook, but not your app ('not_authorized')
            // 3. Not logged into Facebook and can't tell if they are logged into your app or not.


        };
    function fbloginuse() {
        FB.getLoginStatus(function (response) {
            statusChangeCallback(response);
        });
        // 3. This is called with the results from from FB.getLoginStatus()
        function statusChangeCallback(response) {
            // The response object is returned with a status field that lets the app know the current login status of the person.
            // Full docs on the response object can be found in the documentation for FB.getLoginStatus().
            if (response.status === 'connected') { // 有登入app和Facebook.
                FB_connected();
                //通知server fb已登入
                $.ajax({
                    type: 'post',
                    dataType: 'json', // to client
                    contentType: "application/x-www-form-urlencoded;", //to server
                    url: 'login.php?m=fbLogin',
                    cache: true,
                    data: null,
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log("server msg:" + JSON.stringify(xhr));
                        console.log("msg:" + thrownError);
                        //alert(JSON.stringify(xhr) + "," + thrownError);
                    },
                    success: function (response) {
                        //return JSON.parse(response);
                        if (response.msg == 'success') {
                            //alert("簡訊已發送，請在60秒內輸入認證碼。");
//                        alert('登入成功');
//                        window.location = 'index.php';
                        }
                        else {
                            alert(response.msg);
                        }
                    },
                    complete: function (data) {
                    }
                });
//            alert('有登入app和Facebook.');


            } else if (response.status === 'not_authorized') { // 有登入Facebook, 但沒登入這個app.

//                alert('有登入Facebook, 但沒登入這個app.');
//            document.getElementById('status').innerHTML = '<img src="img/logo-facebook.png" alt="Facebook" style="width:50px;height:50px;border-radius:50%;" /><br>用 FB 帳號<br>快速登入';
//============目前用不到的先關掉了
            } else { // 沒登入Facebook, 所以不知登入狀況

//                登入FB呼叫這隻
                FB.login(function(response){
                  if (response.status === 'connected') {
                     location.href=('login.php?m=fbLogin');
                  } else {
                 // The person is not logged into this app or we are unable to tell.

                  }
                });


//                alert('沒登入Facebook, 所以不知登入狀況');
//            document.getElementById('status').innerHTML = '<img src="img/logo-facebook.png" alt="Facebook" style="width:50px;height:50px;border-radius:50%;" /><br>用 FB 帳號<br>快速登入';
//============目前用不到的先關掉了
            }
        }

        // 4. Here we run a very simple test of the Graph API after * login is successful *
        function FB_connected() {
            FB.api('/me?fields=id,name,picture,birthday', function (response) {
//            document.getElementById('status').innerHTML = '<img src="' + response.picture.data.url + '" alt="" style="border-radius:50%;" /><br>' + response.name + '<br>登入中';
//============目前用不到的先關掉了
            });
        }

        // 5. This function is called when someone finishes with the Login Button. See the onlogin handler attached to it.
        function checkLoginState() {
            FB.getLoginStatus(function (response) {
                statusChangeCallback(response);
//            location.href=('login.php?m=fbloginTest');
            });
        }

        // 6. Person is now logged out
        function fb_logout() {
            FB.getLoginStatus(function (response) {
                if (response.authResponse) {
//                window.location = 'https://www.facebook.com/logout.php?access_token=' + response.authResponse.accessToken + '&next=index.php';
                }
            });
        }

    }

</script>
<header>
    <!--<a href="" id="fb_fan_page"></a>-->
<!-- --><?//= print_r($_SESSION["fuser_account"]) ;?>

    <div id="hd_logo"><a href="index.php"></a></div>
    <div id="hd_play"><a href="game.php"></a></div>
    <div id="userStatusDiv">

        <?php if (!empty($_SESSION['fuser_account'])) { ?>
            <!--        有登入顯示這裡-->
            <div id="userInfoDiv">
                <h3>我的資訊</h3>
                <a id="playFreeBtn" href="game.php">
                    <button type="button">免費玩</button>
                </a>
                <div>
                    <?php if(isset($viewData['member'])): ?>
                        <p><span class="userInfo_title">暱　稱：</span><?php echo $viewData['member']['name']; ?>
                        </p>
                    <?php else: ?>
                        <p><span class="userInfo_title">暱　稱：</span>吐不出來
                        </p>
                    <?php endif; ?>

                    <p><span class="userInfo_title">等　級：</span>LV.1<a href="">（一般會員）</a></p>
                    <p><span class="userInfo_title">金　幣：</span><?= $viewData['member']['point'] ?></p>
                    <div style="text-align: center;padding-top: 2px;">
                        <a href="member.php">
                            <button type="button" id="userSettingBtn">帳號設定</button>
                        </a>

                        <!--<button type="button" class="fb-login-button" id="userFbSignInBtn" data-auto-logout-link="true" scope="public_profile,email" onlogin="checkLoginState();">FB 登入</button>-->
                        <!--                    <div id="fb_login_div">-->
                        <!--                        <h3 class="block_title">FB 快速登入</h3>-->
                        <!--                        <div id="status"></div>-->
                        <a href="login.php?m=logout">
                            <button type="button" id="userSignOutBtn">登出</button>
                        </a>

                    </div>
                    <!-- <p><a href="game.php" style="color:red;font-size:22px;font-weight:bold;">免費玩</a></p> -->
                    <!-- <p><a href="game.php" style="color:blue;">進入遊戲免費玩</a></p> -->
                </div>
            </div>
        <?php } else { ?>
            <!--         沒有登入則顯示下面的-->
            <div id="userSignInMid">
                <h3 id="userSignIn" style="margin-top: 0px">會員登入</h3>
                <a id="userSignUp" href="signup.php">
                    <button type="button">註冊</button>
                </a>
                <form action="login.php?m=login" method="post">
                    <label for="">帳　號<input type="text" id="userId" name="account"
                                            value="<?php if (isset($viewData['last_acc'])) {
                                                echo $viewData['last_acc'];
                                            } ?>"></label><br>
                    <label for="">密　碼<input type="password" id="userPw" name="password"
                                            value="<?php if (isset($viewData['last_pass'])) {
                                                echo $viewData['last_pass'];
                                            } ?>"></label><br>
                    <label for="">驗證碼<input type="text" id="userVerify" name="code"/><img src="imgValidate.php?fhg"
                                                                                          alt="驗證碼圖" id="userVerifyImg"></label><br>
                    <label for=""><input type="checkbox" id="userRemember" name="rememeberMe">記住帳號資訊</label>
                    <a id="user_forgot_pw" href="forgetpassword.php">忘記密碼</a><br>
                    <input type="submit" value="登入" id="userSignInBtn"><span style="color:#fff">或用</span>

<!--                    <button type="button" class="fb-login-button" id="userFbSignInBtn" data-auto-logout-link="true" scope="public_profile,email" onlogin="checkLoginState();">FB 登入</button>-->
<!--                    有登入FB的狀態-->
<!--                    <div id="fb_login_div" onclick="javascript:fblogin();return false;">-->
                    <div id="fb_login_div">

                        <h3>FB 快速登入</h3>
<!--                        <div id="status"></div>-->
                    </div>
<!--                    <div class="fb-login-button" id="fb-login-button" style="width:80px !important;text-align: center;" data-max-rows="1" data-size="medium" data-show-faces="false" data-auto-logout-link="true" scope="public_profile,email" onlogin="checkLoginState();"></div>-->
                </form>
            </div>
        <?php } ?>
    </div>
</header>
<nav id="hd_nav">
    <ul>
        <li class="hd_nav_lv1">
            <a href="news.php?tab=0" class="hd_nav_lv1_a">最新消息</a>
            <ul class="hd_nav_lv2">
                <li><a href="news.php?tab=0" class="hd_nav_lv2_a">消息公告</a></li>
                <li><a href="news.php?tab=1" class="hd_nav_lv2_a">最新排行榜</a></li>
            </ul>
        </li>
        <li class="hd_nav_lv1">
            <a href="intro.php?tab=0" class="hd_nav_lv1_a">新手教學</a>
            <ul class="hd_nav_lv2">
                <li><a href="intro.php?tab=0" class="hd_nav_lv2_a">遊戲說明</a></li>
                <li><a href="intro.php?tab=1" class="hd_nav_lv2_a">新手引導</a></li>
            </ul>
        </li>
        <li class="hd_nav_lv1">
            <a href="member.php?tab=0" class="hd_nav_lv1_a">會員專區</a>
            <ul class="hd_nav_lv2">
                <li><a href="member.php?tab=0" class="hd_nav_lv2_a">帳號設定</a></li>
                <li><a href="member.php?tab=1" class="hd_nav_lv2_a">我的檔案</a></li>
                <li><a onclick="jsFunction();" class="unopen">我的卡別</a></li>
                <li><a onclick="jsFunction();" class="unopen">卡別優惠</a></li>
                <!--                <li><a href="member.php?tab=2" class="hd_nav_lv2_a">我的卡別</a></li>
                                <li><a href="member.php?tab=3" class="hd_nav_lv2_a">卡別優惠</a></li>-->
            </ul>
        </li>
        <li class="hd_nav_lv1">
            <a href="activity.php?tab=0" class="hd_nav_lv1_a">熱門活動</a>
            <ul class="hd_nav_lv2">
                <li><a href="activity.php?tab=0" class="hd_nav_lv2_a">活動賽事</a></li>
                <li><a href="activity.php?tab=1" class="hd_nav_lv2_a">獲獎名單</a></li>
            </ul>
        </li>
        <li class="hd_nav_lv1">
            <a href="point.php?tab=0" class="hd_nav_lv1_a">儲值轉帳</a>
            <ul class="hd_nav_lv2">
                <li><a href="point.php?tab=0" class="hd_nav_lv2_a">儲值購點</a></li>
                <li><a href="point.php?tab=1" class="hd_nav_lv2_a">平台幣轉帳</a></li>
            </ul>
        </li>
        <li class="hd_nav_lv1">
            <a href="service.php?tab=0" class="hd_nav_lv1_a">客服中心</a>
            <ul class="hd_nav_lv2">
                <li><a href="service.php?tab=0" class="hd_nav_lv2_a">聯絡我們</a></li>
                <li><a href="service.php?tab=1" class="hd_nav_lv2_a">意見回饋</a></li>
                <li><a href="service.php?tab=2" class="hd_nav_lv2_a">常見問題</a></li>
                <li><a href="service.php?tab=3" class="hd_nav_lv2_a">反詐騙Q&A</a></li>
                <li><a href="service.php?tab=4" class="hd_nav_lv2_a">使用者規章</a></li>
            </ul>
        </li>
        <li class="hd_nav_lv1"><a href="" class="hd_nav_lv1_a">網站地圖</a></li>
    </ul>
</nav>

