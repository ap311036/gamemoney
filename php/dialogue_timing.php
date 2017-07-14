<?php

include_once("../lib/config.php");
include_once '../lib/WebDB.php';
include_once '../lib/basePage.php';
//include_once '../lib/resize-class.php';
ini_set('display_errors', 0);

class game_log extends basePage {

    function gam_log() {
        var_dump($GLOBALS);
        //session_start();
        //$aa = json_decode($_POST);
       // echo $_POST;
       //var_dump($_POST);
        //var_dump(11111);
        //var_dump($GLOBALS);
        //$myid = $GLOBALS['myid'];
        //$room_id = $GLOBALS['room_id'];
        //$friend_id = $GLOBALS['friend_id'];
        //$arrData['ru_dialogue'] = 0;

        /// var_dump($myid);
        //var_dump($room_id);
        //var_dump($friend_id);
        //$result = $this->_db->Update('member', array('ru_uid' => $myid,'ru_friend' => $friend_id,'room_id' => $room_id), $arrData);
        //var_dump($result);
        die;

        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }

}

$aa = new game_log();
$aa->gam_log();
?>


