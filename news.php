<?php include('lib/config.php');?>
<?php include('func/func_news.php');?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>最新消息 | Game Money</title>
    <style type="text/css">
        body {
            opacity: 0;
            transition: opacity 0.5s;
        }
    </style>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <link rel="stylesheet" href="css/bootstrap.css" >
    <!-- CSS -->
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/main_mid_news.css">
</head>

<body>
    <?php include 'php/header.php'; ?>
    <div id="main">
        <?php include 'php/main_mid_news.php'; ?>
    </div>

    <footer>
        <?php include 'php/footer-1.php'; ?>
        <?php include 'php/footer-2.php'; ?>
    </footer>
    <script src="js/jquery-3.1.0.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- JS -->
    <?php
        if ( $_GET["tab"] == 1 ) {
            echo ' <script type="text/javascript"> $("#md_news").tabs({ active: 1 }); </script> ';
        } else {
            echo ' <script type="text/javascript"> $("#md_news").tabs(); </script> ';
        }
    ?>
    <script src="js/main_mid_news.js"></script>
    <script src="js/header.js"></script>
    <script type="text/javascript">
        window.onload = function() {
            $("body").css("opacity", "1");
        };
    </script>
</body>

</html>
