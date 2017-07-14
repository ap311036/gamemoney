<?php

include_once("../lib/config.php");
include_once '../lib/WebDB.php';
include_once '../lib/basePage.php';
include_once '../lib/resize-class.php';
ini_set('display_errors', 0);

class game_log extends basePage {

    function gam_log() {
        session_start();
        //var_dump($_FILES);
        // var_dump($_FILES);
        // die;
        global $target_image_uploade;

        //  var_dump($target_image_uploade);
        //var_dump($_FILES);
        $file_tmp = $_FILES['upfile']['tmp_name'];

        //var_dump($_FILES);

        $target_path = $target_image_uploade;
        $name = 'cg_' . (string) time();
        $aa = move_uploaded_file($file_tmp, $target_path . $name);
        //var_dump($target_path . $name);
        //var_dump($file_tmp);
        //var_dump($aa);

        $target_file = $target_path . $name;
        // var_dump($target_file);

        $image = new ResizeImage();
        $image->load($target_file);
        $image->resizeToWidth(200);
        $aa = pathinfo($target_file, PATHINFO_EXTENSION);
        $target_files = explode("." . $aa, $target_file);
        $aaaa = $image->save($target_files[0] . "s.png" . $aa);
        //var_dump($aaaa);
        //$account = $_SESSION['fuser_account'];
        //var_dump($GLOBALS);
        //die;
        // $arrData['personal_avatar'] = $name."jpg";
        //$result = $this->_db->Update('member', array('account' => $account), $arrData);
//die;
        echo $name . "s.png";
        //$this->redirect('http://gamemoney.sammicorner.com/member.php?tab=0', '上傳成功');
    }

}

$aa = new game_log();
$aa->gam_log();
?>


