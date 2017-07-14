<?php include('lib/config.php');?>
<?php include('func/func_forgetpassword.php');?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>註冊 | Game Money</title>
    <style type="text/css">
        body {
            opacity: 0;
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
            <form id="form1" action="forgetpassword.php?m=send" style="text-align:center;" method="post">
                <h3 class="block_title" style="text-align:left;">忘記密碼</h3>
                <div class="text_left"  style="margin-left:35%;">
                    <label for=""><span class="star">*</span>帳　　號：<input type="text" placeholder="請輸入當初申請帳號" id="signupId" maxlength="12" required name="account" />
                        <span id="signupId_msg"></span>
                    </label><br>
                   
                   <!-- <label for="" id="signupEmail_label">電子信箱：<input type="email" id="signupEmail" placeholder="例：XXX@email.com" name="email" />
                        <span id="signupEmail_msg"></span>
                    </label><br>-->
                    <label>寄送密碼方式: &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="sendType" value="sms" checked="checked" /> 簡訊
                        <input type="radio" name="sendType" value="email" /> E-mail <br>
                    </label>
                   
                    <!--<button type="button" id="send_verify_code_btn">發送密碼</button><br>-->
                   <!-- <label for="" id="signupVerifyCode"><span class="star">*</span><span id="signupVerifyCode_text">驗證</span>碼：<input type="text" required name="code" value=""></label><br>
                    -->
                    <div class="g-recaptcha" data-sitekey="<?php echo $reCapcha?>"></div> <!--6LfrCwgUAAAAACm_JM8j5i99_ZH-r0lKi_iEpEkj-->
                </div>
                <input type="reset" value="重設" id="signup_reset" class="blue_btn">
                <input type="button" value="送出" id="signup_submit" class="blue_btn">
                <input type="button" value="回首頁" onclick="window.location='index.php';" class="blue_btn">
            </form>
            <!--<div class="vertical_line"></div>
            <div id="fb_login_div">
                <h3 class="block_title">FB 快速登入</h3>
                <div id="status"></div>
                <div class="fb-login-button" data-max-rows="1" data-size="xlarge" data-show-faces="false" data-auto-logout-link="true" scope="public_profile,email" onlogin="checkLoginState();"></div>
            </div>
            -->
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







    </script>
    
    <script type="text/javascript">
    $(document).ready(function($) {
       
        // 自訂表單submit動作
        $("#signup_submit").click(function() {
            // console.log(  );
         if ( grecaptcha.getResponse().length == 0 ) { // 6. reCAPTCHA 機器人驗證
                alert("請做 我不是機器人 驗證");
                return false;
            }

            var account = $('#signupId').val();
            if(account =='')
            {
                alert('請輸入帳號');
                return false;
            }

            $('#form1').submit();
        });

    });
    </script>
    <script type="text/javascript">
        window.onload = function() {
            $("body").css("opacity", "1");
        };
    </script>
</body>

</html>
