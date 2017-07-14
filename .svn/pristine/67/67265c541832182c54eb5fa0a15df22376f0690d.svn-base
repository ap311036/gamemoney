<?php include('lib/config.php');?>
<?php include('func/func_activity.php');?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>熱門活動 | Game Money</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">

    <link rel="stylesheet" href="css/activity.css">
</head>

<body>
    <?php include 'php/header.php'; ?>
    <div id="main">
        <?php include 'php/main_activity.php'; ?>
    </div>
    <footer>
        <?php include 'php/footer-1.php'; ?>
        <?php include 'php/footer-2.php'; ?>
    </footer>
    <script src="js/jquery-3.1.0.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <!-- JS -->
    <?php
        if ( $_GET["tab"] == 1 ) {
            echo ' <script type="text/javascript"> $("#md_activity").tabs({ active: 1 }); </script> ';
        } else {
            echo ' <script type="text/javascript"> $("#md_activity").tabs(); </script> ';
        }
    ?>
    <script src="js/activity.js"></script>
    <?php //include 'php/activity_view.php'; ?>
    <script src="js/header.js"></script>
</body>

</html>
