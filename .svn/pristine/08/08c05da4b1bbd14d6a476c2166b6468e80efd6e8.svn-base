<?php
include_once("../lib/config.php");
include_once '../lib/WebDB.php';
include_once '../lib/basePage.php';
include_once '../lib/resize-class.php';

class game_log extends basePage {

    function gam_log() {
        session_start();
        //var_dump($_FILES);
        global $target_personal_avatar;
        // var_dump($target_personal_avatar);
        $file_tmp = $_FILES['img_upload']['tmp_name'];
        $target_path = $target_personal_avatar;
        $name = 'cg_' . (string) time().".png";
        $aa = move_uploaded_file($file_tmp, $target_path . $name);
        $target_file = $target_path . $name;
        $image = new ResizeImage();
        $image->load($target_file);
        $image->resizeToWidth(220);
        $aa = pathinfo($target_file, PATHINFO_EXTENSION);
        $target_files = explode("." . $aa, $target_file);
        $image->save($target_files[0] . "s.png" . $aa);

        $account = $_SESSION['fuser_account'];
        //var_dump($GLOBALS);
        //die;
        $arrData['personal_avatar'] = $name;

        $result = $this->_db->Update('member', array('account' => $account), $arrData);
        
        
        //die;
         $this->redirect('http://gamemoney.sammicorner.com/member.php?tab=0', '上傳成功');
    }

}

$aa = new game_log();
$aa->gam_log();
?>


