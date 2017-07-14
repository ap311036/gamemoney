<?php
//var_dump($_SESSION['member_point']);
//var_dump($_COOKIE['member_point']);
//var_dump($_COOKIE['member_account']);
$frame_value = $_GET['key'];
include_once '../lib/config.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
//$(function(){
//    $('#iframe1').ready(function(){
//        var $iframe = $(this),
//            $contents = $iframe.contents();
//
//            console.log($contents.find("#btn3").val());
//        });
//
//
//});
  // $(function(){
  //   setIframeSize();
  //   function setIframeSize() {
  //     var height = window.innerHeight - 130 + "px";
  //     $("#iframe1").css({ "height" : height});
  //   }
  //   window.addEventListener("resize", setIframeSize);
  // })
</script>
<div class="closeGame">關閉遊戲</div>
<iframe id="iframe1" name="iframe1" style="width:100%;height:100%" src="<?php echo $win7pkwebgl; ?>index.html?user=<?php echo $_COOKIE['member_account']; ?>&key=<?php echo $frame_value ?>" scrolling="NO"></iframe>

