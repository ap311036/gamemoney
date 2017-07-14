<?php
require("inc/inc.php");
require("func/func_center.php");
//$bk_bar_select = 2;
//$db->debug();
//顧客ID
$id = ft($_GET['id'], 0);
//判斷是否有選擇，沒有id代表新增，有id代表選擇進行修改

$game_once = get_game_intro_once($admin_db, $id);
if (count($game_once) < 0 ||!$game_once) {
    post_back('異常!');
}

$center = get_game_center_list($admin_db);
//var_dump($game_once);
//var_dump($center_once);
//var_dump($get_member_type);
//var_dump($category_once);
//取得所有帳號類別
//$get_member_type = get_member_type($db);
//echo $article_once['at_content'];
//echo $article_once;
//var_dump($get_member_type);
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>遊戲規則設定</title>

    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <!--<link href="css/style.css" rel="stylesheet" media="screen">-->
    <link href="css/jquery-ui-1.8.19.custom.css" rel="stylesheet"/>
    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/jquery-ui-1.8.16.custom.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/comm.js"></script>
    <script src="js/twzipcode-1.4.1-min.js"></script>
    <!--所見即所得編輯器-->
    <script src="ckeditor/ckeditor.js"></script>

<!--    <script src="//cdn.ckeditor.com/4.6.1/basic/ckeditor.js"></script>-->

</head>
<body>
<!--標題列-->
<h3>
    <?php echo (count($id) > 0) ? '修改' : '新增'; ?>遊戲規則設定
</h3>
<form class="form-horizontal" action="game_intro_manager_add_mod_act.php" method="post" onsubmit="return checkForm()"
      enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label" for="xlInput"></label>
        <code>Note :</code> 標記
        <code>*</code> 為必填。
    </div>
    <!--文章標題-->


    <div class="control-group">
        <label class="control-label" for="input01">遊戲名稱 <span class="red">*</span>：</label>
        <div class="controls">

            <input type="hidden" placeholder="遊戲名稱" value="<?php echo $game_once['game_title']; ?>" name="tmp"
                   id="tmp" class="input-xlarge"><?php echo $game_once['game_title']; ?>
        </div>
    </div>

    <!--類別名稱-->

    <!--文章內容-->

    <div class="control-group">
        <label class="control-label" for="input01">遊戲規則<span class="red">*</span>：</label>
        <div class="controls">

           <textarea name="game_rules" id="game_rules" rows="10" cols="80">
                    <?php echo $game_once['game_rules']; ?>
           </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                var editor = CKEDITOR.replace('game_rules');
                editor.on('change', function (evt) {
                    // getData() returns CKEditor's HTML content.
                    console.log('Total bytes: ' + evt.editor.getData().length);
                });
            </script>
            <!--            <input type="text" placeholder="請輸入文章內容" value="<?php /*echo $article_once['at_content']; */ ?>"
                   name="at_content"
                   id="at_content" class="input-xlarge">-->
        </div>
    </div>


    <!--圖片-->
<!--    <div class="control-group">-->
<!--        <label class="control-label" for="input01">icon上傳<span class="red">*</span>：<p>請上傳90*90的png檔</p></label>-->
<!--        <div class="controls">-->
<!--            <input type="file" placeholder="上載icon" value=""-->
<!--                   name="img_upload" id="img_upload">-->
<!--        </div>-->
<!--    </div>-->

    <div id="action_single" style="padding-left:20px;" class="form-actions text-center">
        <input type="submit" value="送出" class="btn-primary btn" onclick="checkForm()">&nbsp;
        <button id="cancel" class="btn" type="reset" onclick="javascript:history.back();">取消</button>
        <!--是否選擇修改-->
        <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
        <input type="hidden" id="act" name="act" value="<?php echo (count($id)) ? 'mod' : 'add'; ?>">
    </div>
</form>
</div>
<!--/span-->
</div>
<!--/row-->

</div>

<script type="text/javascript">


    function checkForm() {
        var text = $('#game_rules').text();
        var post = htmlEncode(text);
        var y;
        y = editor.getData();
        y = htmlEncode(y);
//        alert(y);
//        alert(htmlDecode(y));
//        alert(post);
        $('#game_rules').text(y);



//        return false;
    }
    function htmlEncode(value) {
        //create a in-memory div, set it's inner text(which jQuery automatically encodes)
        //then grab the encoded contents back out.  The div never exists on the page.
        return $('<div/>').text(value).html();
    }

    function htmlDecode(value) {
        return $('<div/>').html(value).text();
    }
</script>

</body>
</html>
