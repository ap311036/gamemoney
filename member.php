<?php include('lib/config.php'); ?>
<?php include('func/func_member.php'); ?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>會員專區 | Game Money</title>
        <style type="text/css">
            body {
                opacity: 0;
                transition: opacity 0.5s;
            }
        </style>
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/jquery-ui.min.css">
        <!-- CSS -->
        <link rel="stylesheet" href="css/all.css">
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/footer.css">

        <link rel="stylesheet" href="css/member.css">
    </head>

    <body>
        <?php include 'php/header.php'; ?>
        <div id="main">
            <?php include 'php/main_member.php'; ?>
        </div>
        <footer>
            <?php include 'php/footer-1.php'; ?>
            <?php include 'php/footer-2.php'; ?>
        </footer>
        <script src="js/jquery-3.1.0.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/jquery.twzipcode.min.js"></script>
        <!-- JS -->
        <?php
        $tabNum = 0;
        if (isset($_GET['tab'])) {
            $tabNum = $_GET["tab"];
        }
        switch ($tabNum) {
            case "1":
                echo ' <script type="text/javascript"> $("#md_member").tabs({ active: 1 }); </script> ';
                break;
            case "2":
                echo ' <script type="text/javascript"> $("#md_member").tabs({ active: 2 }); </script> ';
                break;
            case "3":
                echo ' <script type="text/javascript"> $("#md_member").tabs({ active: 3 }); </script> ';
                break;
            default:
                echo ' <script type="text/javascript"> $("#md_member").tabs(); </script> ';
                break;
        }
        ?>
        <script src="js/member.js"></script>
        <script src="js/header.js"></script>
        <script type="text/javascript">
            window.onload = function () {
                $("body").css("opacity", "1");
            };

            function saveReport() {
                // jquery 表单提交  
                $("#showDataForm").ajaxSubmit(function (message) {
                    // 对于表单提交成功后处理，message为提交页面saveReport.htm的返回内容  
                });

                return false; // 必须返回false，否则表单会自己再做一次提交操作，并且页面跳转  
            }
        </script>
    </body>

</html>
