<?php
require("inc/inc.php");
require("func/func_admin.php");
require("class/OdlsPassword.php");
require("head.php");
//ini_set("display_errors",1);
//$db->debug();
//取直
//var_dump($mod);
//$res_sum = get_Problem_Management($admin_db, $arr_input);
//$arr_page['num'] = $res_sum['0']['cnt'];
$sn = $_POST['sn'];
if ($sn) {
    $pwManager = new OdlsPassword();
    $pw = $pwManager->showStringToPassword($sn);

}

//var_dump($res);
?>
    <!--畫面呈現-->
    <div class="container-fluid">
        <div class="row-fluid">
            <!--列表-->
            <?php
            require_once furl . "left_menu.php";
            ?>

            <div class="span10">
                <!--標題列-->
                <div class="span12">
                    <h3>機台密碼</h3>
                </div>

                <!--列表-->

                <div class="row-fluid">
                    <div class="pull-left span10 text-left">


                        <form action="" method="POST">
                            <input name="sn" type="text">
                            <input type="submit" value="送出">
                        </form>
                        <div>密碼：<?= $pw ?></div>
                    </div>

                </div>


                <div class="row-fluid">

                </div>
            </div>
        </div>
    </div>


<?php
require("foot.php");
?>