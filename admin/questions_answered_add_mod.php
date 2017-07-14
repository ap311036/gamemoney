<?php
require("inc/inc.php");
require("func/func_admin.php");

$id = ft($_GET['id'], 0);
//var_dump($db);
//var_dump($id);
//if ($id != NULL) {
//    $category = get_news_id($admin_db, $id);
//}
//判斷是否有選擇，沒有id代表新增，有id代表選擇進行修改
if ($id != '') {
    $category = get_common_id($admin_db, $id);
     //var_dump($category);
    $category_one = get_one_question_id($admin_db, $id);
    //var_dump($category_one);
    //var_dump($category_one);
    if (count($article_once) < 0) {
        post_back('異常!');
    }
}
//var_dump($category_one);
//var_dump($id);
$aa = get_common_one_id($admin_db, $id);
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>文章管理設定</title>

        <link href="css/bootstrap.css" rel="stylesheet" media="screen">
        <!--<link href="css/style.css" rel="stylesheet" media="screen">-->
        <link href="css/jquery-ui-1.8.19.custom.css" rel="stylesheet"/>
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/jquery-ui-1.8.16.custom.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/comm.js"></script>
        <script src="js/twzipcode-1.4.1-min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
        <!--所見即所得編輯器-->
         <!-- <script src="//cdn.ckeditor.com/4.6.1/basic/ckeditor.js"></script>-->
        <script src="ckeditor/ckeditor.js"></script>
    </head>
    <body>
        <!--標題列-->
        <h3>
            <?php echo (count($id) > 0) ? '修改' : '新增'; ?>文章
        </h3>
        <form class="form-horizontal" action="questions_answered_add_mod_act.php" method="post" enctype="multipart/form-data">
            <div class="control-group">
                <label class="control-label" for="xlInput"></label>
                <code>Note :</code> 標記
                <code>*</code> 為必填。
            </div>
            <div class="control-group">

                <label class="control-label" for="input01">問題標題<span class="red">*</span>：</label>
                <div class="controls">

                    <input type="text" placeholder="請輸入問題標題" value="<?php echo $category_one['question']; ?>" name="at_title"
                           id="at_title" class="input-xlarge">
                </div>
            </div>

            <div class="control-group">

                <label class="control-label" for="input01">問題內容<span class="red">*</span>：</label>
                <div class="controls">

                    <input type="text" placeholder="請輸入問題內容" value="<?php echo $category_one['answer']; ?>" name="at_content"
                           id="at_title" class="input-xlarge">
                    <input type="hidden" name="is_del" value="<?php echo $category_one['is_del']; ?>">
                </div>
            </div>

            <div id="action_single" style="padding-left:20px;" class="form-actions text-center">
                <input type="submit" value="送出" class="btn-primary btn">&nbsp;
                <button id="cancel" class="btn" type="reset" onclick="javascript:history.back();">取消</button>
                <!--是否選擇修改-->
                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
<!--                <input type="hidden" id="at_pic" name="at_pic" value="<?php echo $category_one['at_pic']; ?>">-->
                <input type="hidden" id="act" name="act" value="<?php echo (count($id)) ? 'mod' : 'add'; ?>">
<!--                <input type="hidden" id="Column_position" name="Column_position" value="<?php echo Column_position; ?>">-->
            </div>
        </form>
    </div>
    <!--/span-->
</div>
<!--/row-->
</div>

<script type="text/javascript">
</script>

</body>
</html>
