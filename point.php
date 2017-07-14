<?php include('lib/config.php'); ?>
<?php include('func/func_point.php'); ?>
<!DOCTYPE html>
<html>

    <head>
        <script src="js/jquery.js"></script>
        <script>
            $(document).ready(function () {
                $(".colorbox").colorbox({iframe: true, width: "80%", height: "80%", href: "card_deposit.php"});
                $("#transferData").colorbox({iframe: true, width: "80%", height: "80%", href: "point_transfer.php"});
                $("#point_receive").colorbox({iframe: true, width: "80%", height: "80%", href: "point_receive.php"});

            });
            var c = 1;

            function get_card(id, sum)
            {
                //    $("#pag2go").show();
                var i = 0;

                for (i = 0; i <= sum; i++)
                {
                    $("#pack" + i).hide();
                    $("#pag2go" + i).hide();
                    if (i == id)
                    {
                        $("#pack" + id).show();
                        $("#pag2go" + id).show();
                    }

                }
                if (c == "2")
                {
                    c = 0;
                    var i = 0;
                    for (i = 0; i <= sum; i++)
                    {
                        $("#pag2go" + i).hide();
                        $("#pack" + i).show();

                    }
                }
                c++;
                // $("#pag2go").show();
                ///$("#card_deposit").colorbox({background: "http://gamemoney.sammicorner.com/img/star_background4.jpg", iframe: false, width: "80%", height: "80%", href: "pay2go.php?m=pay2goinit&item_id=" + id + "&Amt=" + Amt + "&des=" + des + "&points=" + points});
            }


            function get_pay(id)
            {
                window.open('pay2go.php?m=pay2goinit&item_id=' + id, 'pa2go', config = 'height=1000,width=1000')
            }

            function get_close(close)
            {
                var i = 0;
                for (i = 0; i <= close; i++)
                {
                    $("#pag2go" + i).hide();
                    $("#pack" + i).show();

                }
            }


        </script>
        <meta charset="UTF-8">
        <title>儲值轉帳 | Game Money</title>
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

        <link rel="stylesheet" href="css/point.css">
    </head>

    <body>
        <?php include 'php/header.php'; ?>
        <div id="main">
            <?php include 'php/main_point.php'; ?>
        </div>
        <footer>
            <?php include 'php/footer-1.php'; ?>
            <?php include 'php/footer-2.php'; ?>
        </footer>
        <script src="js/jquery-3.1.0.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <!-- JS -->
        <?php
        if ($_GET["tab"] == 1) {
            echo ' <script type="text/javascript"> $("#md_point").tabs({ active: 1 }); </script> ';
        } else {
            echo ' <script type="text/javascript"> $("#md_point").tabs(); </script> ';
        }
        ?>
        <script src="js/point.js"></script>
        <script src="js/comm.js"></script>
        <script src="js/header.js"></script>
        <script type="text/javascript">
            window.onload = function () {
                $("body").css("opacity", "1");
            };
        </script>

        <link rel="stylesheet" href="css/colorbox.css">
        <script type="text/javascript" src="js/jquery.colorbox.js"></script>
    </body>

</html>
