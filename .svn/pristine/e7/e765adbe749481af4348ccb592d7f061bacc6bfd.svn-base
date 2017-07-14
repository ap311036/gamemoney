<?php include('lib/config.php');?>
<?php include('func/func_facebookTest.php');?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>註冊 | Game Money</title>
    <style type="text/css">
        body {
            opacity: 0;
            transition: opacity 0.5s;
        }
    </style>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/strength.css">
    <!-- CSS -->
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/signup.css">
</head>

<body>
    <div id="signup">
        <div id="signup_top"></div>
        <div id="signup_mid" class="fontSize_0">
            <form action="signup.php?m=register" id="signup_form" method="post">
                <h3 class="block_title">會員註冊</h3>
                <div class="text_left">
                    <label for=""><span class="star">*</span>帳　　號：<input type="text" placeholder="請輸入3碼以上的小寫英文" id="signupId" maxlength="12" required name="account" />
                        <span id="signupId_msg"></span>
                    </label><br>
                    <label for=""><span class="star">*</span>密　　碼：<input type="password" placeholder="請輸入8碼以上的英文+數字組合" id="signupPw1" maxlength="12" required name="password" /> 
                    </label>
                    <ol id="signupPw_rules">
                        <li>1. 8碼以上的英文+數字組合</li>
                        <li>2. 包含大寫英文、小寫英文、及數字</li>
                        <li>3. 密碼不可包含帳號</li>
                    </ol>
                    <label for=""><span class="star">*</span>確認密碼：<input type="password" placeholder="請再次確認密碼" id="signupPw2" maxlength="12" required name="confirm_pass">
                        <span id="signupPw2_msg"></span>
                    </label><br>
                    <label for="" id="signupEmail_label">電子信箱：<input type="email" id="signupEmail" placeholder="例：XXX@email.com" name="email" />
                        <span id="signupEmail_msg"></span>
                    </label><br>
                    <label for="" id="signupTel_label"><span class="star">*</span>手機號碼：
                        <select name="" id="">
                            <option value="886">台灣(Taiwan) +886</option>
                        </select>
                        <input type="tel" id="signupTel" placeholder="例：0988123456" required name="phone" />
                        <span id="signupTel_msg"></span>
                    </label><br>
                    <button type="button" id="send_verify_code_btn">發送驗證碼</button><br>
                    <label for="" id="signupVerifyCode"><span class="star">*</span><span id="signupVerifyCode_text">驗證</span>碼：<input type="text" required name="code" value=""></label><br>
                    <label for="" id="signupAgree"><span class="star">*</span><input type="checkbox" required checked="checked">我同意<a href="">會員服務</a>、<a href="">隱私條款</a>內容</label><br>

                    <div class="g-recaptcha" data-sitekey="6LeCJgkUAAAAALdihUlYGIsdKJp_Ec7QdKJ4A1f9"></div> <!--6LfrCwgUAAAAACm_JM8j5i99_ZH-r0lKi_iEpEkj-->
                </div>
                <input type="reset" value="重設" id="signup_reset" class="blue_btn">
                <input type="submit" value="送出" id="signup_submit" class="blue_btn">
                <input type="button" value="回首頁" onclick="window.location='index.php';" class="blue_btn">
            </form>
            <div class="vertical_line"></div>
            <div id="fb_login_div">
                <h3 class="block_title">FB 快速登入</h3>
                <div id="status"></div>
                <div class="fb-login-button" data-max-rows="1" data-size="xlarge" data-show-faces="false" data-auto-logout-link="true" scope="public_profile,email" onlogin="checkLoginState();"></div>
            </div>
        </div>
    </div>
    <footer>
        <?php include 'php/footer-2.php'; ?>
    </footer>
    
    <script src="js/jquery-3.1.0.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src='js/common.js'></script>
    <script src="js/strength.js"></script>
    <!-- JS -->
    <script>
    $(document).ready(function() {
        $('#send_verify_code_btn').click(function(){
            var phone = $('#signupTel').val();
            if(phone =='')
            {
                alert('請輸入電話');
                return false;
            }

            var model = {'phone':phone}
            /*var obj = ajaxSave(model,'sendSMS.php');
             obj.success(function (res) {
                if(res.msg =='success')
                {
                    alert('簡訊送出');
                }
                else {
                    alert('失敗');
                }
                    
            });*/
            $.ajax({
                type: 'post',
                dataType: 'json', // to client
                contentType: "application/x-www-form-urlencoded;", //to server
                url: 'sendSMS.php',
                cache: false,
                data: model,
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log("server msg:" + JSON.stringify(xhr));
                    console.log("msg:" + thrownError);
                    //alert(JSON.stringify(xhr) + "," + thrownError);
                    //alert("error");
                },
                success: function(response) {
                    //return JSON.parse(response);
                    if(response.msg =='success')
                    {
                         alert("簡訊已發送，請在60秒內輸入認證碼。");
                    }
                    else
                    {
                        alert(response.msg);
                    }
                },
                complete: function(data) {}
            });
        });
    });

    // Facebook JS SDK
    // 1. Load the SDK asynchronously
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/zh_TW/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // 2.
    window.fbAsyncInit = function() {
        FB.init({
        appId      : '1181751815224247',
        cookie     : true,  // enable cookies to allow the server to access the session
        xfbml      : true,  // parse social plugins on this page
        version    : 'v2.7' // use graph api version 2.5
        });

        // Now that we've initialized the JavaScript SDK, we call FB.getLoginStatus().
        // This function gets the state of the person visiting this page and can return 
        // one of three states to the callback you provide. They can be:
        // 1. Logged into your app ('connected')
        // 2. Logged into Facebook, but not your app ('not_authorized')
        // 3. Not logged into Facebook and can't tell if they are logged into your app or not.
        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });

    };

    // 3. This is called with the results from from FB.getLoginStatus()
    function statusChangeCallback(response) {
        // The response object is returned with a status field that lets the app know the current login status of the person.
        // Full docs on the response object can be found in the documentation for FB.getLoginStatus().
        if (response.status === 'connected') { // 有登入app和Facebook.
            FB_connected();
        } else if (response.status === 'not_authorized') { // 有登入Facebook, 但沒登入這個app.
            document.getElementById('status').innerHTML = '<img src="img/logo-facebook.png" alt="Facebook" style="width:50px;height:50px;border-radius:50%;" /><br>用 FB 帳號<br>快速登入';
        } else { // 沒登入Facebook, 所以不知登入狀況
            document.getElementById('status').innerHTML = '<img src="img/logo-facebook.png" alt="Facebook" style="width:50px;height:50px;border-radius:50%;" /><br>用 FB 帳號<br>快速登入';
        }
    }

    // 4. Here we run a very simple test of the Graph API after * login is successful *
    function FB_connected() {
        FB.api('/me?fields=id,name,picture', function(response) {
            document.getElementById('status').innerHTML = '<img src="' + response.picture.data.url + '" alt="" style="border-radius:50%;" /><br>' + response.name + '<br>登入中';



        });
    }

    // 5. This function is called when someone finishes with the Login Button. See the onlogin handler attached to it.
    function checkLoginState() {
        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });
    }

    </script>
    
    <script type="text/javascript">
    $(document).ready(function($) {
        var signupId_valid = false;
        var signupId_value;
        var signupId = document.getElementById("signupId");
        var signupPw1_valid = false;
        var signupPw1 = document.getElementById("signupPw1");
        var signupPw2_valid = false;
        var signupPw2 = document.getElementById("signupPw2");
        var signupEmail_valid = false;
        var signupTel_valid = false;

        // 1. 帳號 RE驗證
        signupId.onchange = function() {
            signupId_value = document.getElementById("signupId").value;
            var signupId_msg = document.getElementById("signupId_msg");
            if ( !/.{3,}/.test(signupId_value) ) { // 有沒有3碼以上
                signupId_msg.innerHTML = "請輸入3碼以上的帳號";
                signupId_msg.style.color = "red";
                signupId_valid = false;
            } else if ( !/[a-z]+/.test(signupId_value) ) { // 有沒有包含小寫英文
                signupId_msg.innerHTML = "請輸入小寫英文的帳號";
                signupId_msg.style.color = "red";
                signupId_valid = false;
            } else if ( !/^(?=.*[a-z])[a-z]{3,}$/.test(signupId_value) ) { // 只包含小寫英文
                signupId_msg.innerHTML = "請輸入只包含小寫英文的帳號";
                signupId_msg.style.color = "red";
                signupId_valid = false;
            } else {
                signupId_msg.innerHTML = "";
                signupId_valid = true;
            }
        };

        // 2. 密碼強度
        $('#signupPw1').strength({
            strengthClass: 'strength',
            strengthMeterClass: 'strength_meter',
            strengthButtonClass: 'button_strength',
            strengthButtonText: '顯示密碼',
            strengthButtonTextToggle: '隱藏密碼'
        });   
        $(".button_strength").after("<span id='signupPw1_msg'></span>");

        // 2. 密碼 RE驗證
        $(".strength").change(function(){
            var signupPw1_value = document.getElementById("signupPw1").value;
            var signupPw1_msg = document.getElementById("signupPw1_msg");
            if ( !/.{8,}/.test(signupPw1_value) ) { // 有沒有8碼以上
                signupPw1_msg.innerHTML = "請輸入8碼以上的密碼";
                signupPw1_msg.style.color = "red";
                signupPw1_valid = false;
                signupPw2_valid = false;
            } else if ( !/\d+/.test(signupPw1_value) ) { // 有沒有包含數字
                signupPw1_msg.innerHTML = "請輸入包含數字的密碼";
                signupPw1_msg.style.color = "red";
                signupPw1_valid = false;
                signupPw2_valid = false;
            } else if ( !/[a-z]+/.test(signupPw1_value) ) { // 有沒有包含小寫英文
                signupPw1_msg.innerHTML = "請輸入包含小寫英文的密碼";
                signupPw1_msg.style.color = "red";
                signupPw1_valid = false;
                signupPw2_valid = false;
            } else if ( !/[A-Z]+/.test(signupPw1_value) ) {  // 有沒有包含大寫英文
                signupPw1_msg.innerHTML = "請輸入包含大寫英文的密碼";
                signupPw1_msg.style.color = "red";
                signupPw1_valid = false;
                signupPw2_valid = false;
            } else if ( !/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/.test(signupPw1_value) ) { // 只包含大寫英文、小寫英文、及數字
                signupPw1_msg.innerHTML = "請輸入英文+數字組合的密碼";
                signupPw1_msg.style.color = "red";
                signupPw1_valid = false;
                signupPw2_valid = false;
            } else if ( (signupPw1_value.toLowerCase()).includes(signupId_value.toLowerCase()) ) { // 密碼包含帳號
                signupPw1_msg.innerHTML = "密碼不可包含帳號";
                signupPw1_msg.style.color = "red";
                signupPw1_valid = false;
                signupPw2_valid = false;
            } else {
                signupPw1_msg.innerHTML = "";
                signupPw1_valid = true;
                signupPw2_valid = false;
            }

            if ( signupPw2.value != "" ) {
                if ( signupPw2.value != signupPw1.value ) {
                    $("#signupPw2_msg").html("密碼不同!");
                    $("#signupPw2_msg").css("color", "red");
                    signupPw2_valid = false;
                } else {
                    $("#signupPw2_msg").html("");
                    signupPw2_valid = true;
                }
            }
        });

        // 3. 確認密碼 驗證
        $("#signupPw2").change(function() {
            if ( signupPw2.value != signupPw1.value ) {
                $("#signupPw2_msg").html("密碼不同!");
                $("#signupPw2_msg").css("color", "red");
                signupPw2_valid = false;
            } else {
                $("#signupPw2_msg").html("");
                signupPw2_valid = true;
            }
        });

        // 4. 電子信箱 RE驗證
        $("#signupEmail").change(function() {
            if ( !/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i.test($("#signupEmail").val()) ) {
                $("#signupEmail_msg").html("電子信箱不符合格式");
                $("#signupEmail_msg").css("color", "red");
                signupEmail_valid = false;
            } else {
                $("#signupEmail_msg").html("");
                signupEmail_valid = true;
            }
        });

        // 5. 手機號碼 RE驗證
        $("#signupTel").change(function() {
            if ( !/^09\d{8}/.test($("#signupTel").val()) ) {
                $("#signupTel_msg").html("手機號碼不符合格式");
                $("#signupTel_msg").css("color", "red");
                signupTel_valid = false;
            } else {
                $("#signupTel_msg").html("");
                signupTel_valid = true;
            }
        });

        // 重設btn動作
        $("#signup_reset").click(function() {
            $("#signupId_msg").html("");
            $("#signupPw1_msg").html("");
            $("#signupPw2_msg").html("");
            $("#signupEmail_msg").html("");
            $("#signupTel_msg").html("");
        });

        // 取消預設的表單submit動作
        //$("#signup_form").submit(function() { 
        //    return false; 
        //});


        // 自訂表單submit動作
        $("#signup_submit").click(function() {
            // console.log(  );
            if ( !signupId_valid | !signupPw1_valid | !signupPw2_valid | !signupEmail_valid | !signupTel_valid ) {
                alert("請修正格式不符的欄位");
            } else if ( grecaptcha.getResponse().length == 0 ) { // 6. reCAPTCHA 機器人驗證
                alert("請做 我不是機器人 驗證");
            } else {
                //alert("可以送出表單");

                $('#signup_submit').submit();
            }
        });

    });
    </script>
    <script type="text/javascript">
        window.onload = function() {
            $("body").css("opacity", "1");
        };
    </script>


    <form method="post" action="http://ar.sammi.tw/file_get.php" enctype="multipart/form-data">
        <input name="k" value="950de64b6bc82fd85747a084b679bcdd" />
        <input name="fileUpload" type="file" />

        <input name="fileName" value="UserMedia/mp4ByChris.mp4" />
        <input type="submit" value="送出">
    
    </form>

</body>

</html>
