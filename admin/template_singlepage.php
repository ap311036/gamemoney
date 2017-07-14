<?php
require("inc/inc.php");

require("head.php");
require 'func/func_service.php';

$user_rule = get_userrules($admin_db);

?>
    <script src="ckeditor/ckeditor.js"></script>

    <!--畫面呈現-->
    <div class="container-fluid">
        <div class="row-fluid">
            <!--列表-->
            <?php require_once furl . "left_menu.php"; ?>
            <div class="span10">
                <div class="control-group">
                    <h3>Work with us 管理</h3>
                </div>
                <form id="post_form" class="form-group .pull-left span3 text-left" action="template_singlepage_act.php" method="post">
                <div class="control-group">
                    <label class="control-label" for="xlInput"></label>
                    <code>Note :</code> 標記
                    <code>*</code> 為必填。
                </div>
                <!--文章標題-->
                <div class="control-group">
                    <label class="control-label" for="post_form">Partner with 文章內容<span class="red">*</span>：</label>
                    <div class="controls">
                        <textarea class="ckeditor" name="content" id="content">
                            <?php echo ($user_rule[0]['content']); ?>
                        </textarea>
                        <script></script>
                    </div>
                </div>
                <div id="action_single" style="padding-left:20px;" class="form-actions text-center">
                    <input type="submit" value="確認" class="btn-primary btn">&nbsp;
                    <button id="cancel" class="btn" type="reset" onclick="javascript:history.back();">取消</button>
                </div>
                </form>
            </div>
        </div>
        <!--/span-->
    </div>
    <!--/row-->
    </div>
    </div>
    </div>
<li>

</li>
<?php
require(cmsroot . "layout/foot.php");
?>