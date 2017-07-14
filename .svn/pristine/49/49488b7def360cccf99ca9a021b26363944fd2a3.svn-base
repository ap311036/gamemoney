<?php include('lib/config.php');?>
<?php include('func/func_service.php');?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>客服中心 | Game Money</title>
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
    <link rel="stylesheet" href="css/service.css">
    <link rel="stylesheet" href="admin/ckeditor/contents.css">
    <link rel="stylesheet" href="css/unreset.css">
</head>

<body>
   
    <?php include 'php/header.php'; ?>
    <div id="main">
        <?php include 'php/main_service.php'; ?>
    </div>
    <footer>
        <?php include 'php/footer-1.php'; ?>
        <?php include 'php/footer-2.php'; ?>
    </footer>
    <script src="js/jquery-3.1.0.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <!-- JS -->
    <script src="js/common.js"></script>
    <script src="js/service.js"></script>
    <script src="js/header.js"></script>
    <script type="text/javascript">
        window.onload = function() {
            $("body").css("opacity", "1");
        };

        switch ( QueryString("tab") ) {
                case "1":
                    $("#md_service").tabs({active:1}); 
                    break;
                case "2":
                    $("#md_service").tabs({active:2}); 
                    break;
                case "3":
                    $("#md_service").tabs({active:3}); 
                    break;
                case "4":
                    $("#md_service").tabs({active:4}); 
                    break;
                default:
                    $("#md_service").tabs(); 
                    break;
        }

        
    </script>
</body>

</html>
