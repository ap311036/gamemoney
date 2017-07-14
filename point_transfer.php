<?php include('lib/config.php');?>
<?php include('func/func_card_deposit.php');?>
<?php include('func/func_point.php');?>
<?php
require_once 'lib/Carbon.php';
use Carbon\Carbon;

printf("Now: %s", Carbon::now()); ?>
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

        input[type="button"],
        input[type="reset"] {
            -moz-box-shadow:inset 0px 1px 0px 0px #97c4fe;
            -webkit-box-shadow:inset 0px 1px 0px 0px #97c4fe;
            box-shadow:inset 0px 1px 0px 0px #97c4fe;
            background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #3d94f6), color-stop(1, #1e62d0));
            background:-moz-linear-gradient(top, #3d94f6 5%, #1e62d0 100%);
            background:-webkit-linear-gradient(top, #3d94f6 5%, #1e62d0 100%);
            background:-o-linear-gradient(top, #3d94f6 5%, #1e62d0 100%);
            background:-ms-linear-gradient(top, #3d94f6 5%, #1e62d0 100%);
            background:linear-gradient(to bottom, #3d94f6 5%, #1e62d0 100%);
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#3d94f6', endColorstr='#1e62d0',GradientType=0);
            background-color:#3d94f6;
            -moz-border-radius:6px;
            -webkit-border-radius:6px;
            border-radius:6px;
            border:1px solid #337fed;
            display:inline-block;
            cursor:pointer;
            color:#ffffff;
            font-family:'Noto Sans TC', sans-serif;
            font-size:15px;
            font-weight:bold;
            padding:6px 24px;
            text-decoration:none;
            text-shadow:0px 1px 0px #1570cd;
            margin: 0px 10px;
            letter-spacing: 2px;
        }

        input[type="button"]:hover,
        input[type="reset"]:hover {
            background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #1e62d0), color-stop(1, #3d94f6));
            background:-moz-linear-gradient(top, #1e62d0 5%, #3d94f6 100%);
            background:-webkit-linear-gradient(top, #1e62d0 5%, #3d94f6 100%);
            background:-o-linear-gradient(top, #1e62d0 5%, #3d94f6 100%);
            background:-ms-linear-gradient(top, #1e62d0 5%, #3d94f6 100%);
            background:linear-gradient(to bottom, #1e62d0 5%, #3d94f6 100%);
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#1e62d0', endColorstr='#3d94f6',GradientType=0);
            background-color:#1e62d0;
        }

        input[type="button"]:active,
        input[type="reset"]:active {
            position:relative;
            top:1px;
        }

        #butSubmit {
            margin-top: 20px;
        }
    </style>
    <script src="js/jquery-3.1.0.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script>
        $( document ).ready(function() {
            //$(".colorbox").colorbox({iframe:true,width:"80%",height:"80%",href:"card_deposit.php"});
            $('#butSubmit').click(function(){

                var point = $('#point').val();
                var account = $('#account').val();

//                if(carno == '')
//                {
//                    alert('請輸入卡號');
//                    return false;
//                }
//
//                if(cardpass == '')
//                {
//                    alert('請輸入卡片密碼');
//                    return false;
//                }
//
//                if(carno.length != 15)
//                {
//                    alert('卡號長度需15碼');
//                    return false;
//                }
//
//                if(cardpass.length != 20)
//                {
//                    alert('卡片密碼長度需20碼');
//                    return false;
//                }

                $('#form1').attr('action','point_transfer.php?m=transferPoint');
                $('#form1').submit();
            });

        });
    </script>
</head>
<body>
<div>
    <form id="form1" method="post" action="">
        <table>
            <tr>
                <td>轉點帳號：</td>
                <td><input id="account" name="account" type="text" value="" /></td>
            </tr>
            <tr>
                <td>轉點點數：</td>
                <td><input id="point" name="point" type="text" value="" /></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input id="butSubmit" type="button" value="送出" />
                    <input id="butReset" type="reset" value="重置" />
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>