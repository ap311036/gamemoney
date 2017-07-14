<?php
/**
 * Created by PhpStorm.
 * User: Magus
 * Date: 2017/1/6
 * Time: 下午3:17
 */
var_dump($_REQUEST);
echo $_POST['comment'];
require '../inc/testinc.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>A Simple Page with CKEditor</title>
    <!-- Make sure the path to CKEditor is correct. -->
    <script src="../ckeditor/ckeditor.js"></script>
</head>
<body>
<form name="form" id ="form" onsubmit="return checkForm()" method="post" enctype="multipart/form-data">
    <textarea name="comment" id="comment" form="form">Enter text here...</textarea>
    <input type="submit">
</form>

<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('comment');
    function checkForm() {
        var text = $('#comment').text();
        var post = htmlEncode(text);
        var y;
        y = editor.getData();
        y = htmlEncode(y);
        alert(y);
//        alert(htmlDecode(y));
//        alert(post);
        $('#comment').text(y);


//        return false;
    }
</script>
</body>
</html>
