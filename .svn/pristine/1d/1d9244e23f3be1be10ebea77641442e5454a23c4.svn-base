<?php
function log_file($msg, $t = '', $file = false)
{
//    if(empty($t))
    $t = time();
    if (!$file) $file = "test.log";

    if (furl) {
        $file = 'test.log';
        $f_handle = fopen(furl . "cache/" . $file, "a");
    } else {
        $file = 'test.log';
        $f_handle = fopen(dirname(dirname(__FILE__)) . "/" . $file, "a");
    }
    if (!$f_handle) return false;

    $msg = date("Y-m-d H:i:s", $t) . " -- $msg\n";
    fwrite($f_handle, $msg);
    fclose($f_handle);

    return true;
}

function generate_qr_image($sn_urlen_num, $target_path)
{
    $range = "500x500";
    $pre_str = "goo.gl/SOFXUK?ISGT?";
    $url = "https://chart.googleapis.com/chart?chs=" . $range . "&cht=qr&chl=" . $pre_str . $sn_urlen_num . "&choe=UTF-8&chld=L|2";
    $input = "$url"; //路徑位置

    if (!file_exists($target_path) || !is_dir($target_path)) //目錄不存在就建立新目錄 
    {
        mkdir($target_path, 0775);
    }

    $output = $target_path . iconv("UTF-8", "big5", $sn_urlen_num) . '.png'; //儲存檔案名稱
    file_put_contents($output, file_get_contents($input));
}

function zip_folder($target_path, $folder_name)
{
    // Get real path for our folder
    $rootPath = realpath($target_path . $folder_name);
//    echo "rootPath ".$rootPath."</br>";

    // Initialize archive object
    $zip = new \ZipArchive();
    $zip->open($target_path . $folder_name . '.zip', \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
//    echo "Create zip file ".$target_path.$folder_name."</br>";

    // Create recursive directory iterator
    /** @var SplFileInfo[] $files */
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($rootPath),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $name => $file) {
//        echo "zipFile ".$name."</br>";
        // Skip directories (they would be added automatically)
        if (!$file->isDir()) {
            // Get real and relative path for current file
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($rootPath) + 1);

            // Add current file to archive
            $zip->addFile($filePath, $relativePath);
        }
    }

    // Zip archive will be created only after closing object
    $zip->close();
//    echo "zipFile done!"."</br>";
}

function download_zip_file($target_path, $zip_name)
{
    if (!file_exists($zip_name . ".zip")) {
        zip_folder($target_path, $zip_name);
    }

    $full_zip_name = $target_path . $zip_name . ".zip";
    //then send the headers to force download the zip file
    header("Content-type: application/zip");
    header("Content-Disposition: attachment; filename=$zip_name.zip");
    header("Pragma: no-cache");
    header("Expires: 0");
    readfile("$full_zip_name");
}

function convert_mov_to_mp4($file_name_incpath)
{
//    if ($_SERVER['SERVER_ADDR'] == '60.248.141.144')
//        /*
//         * [aac @ 0x1125640] The encoder 'aac' is experimental but experimental codecs are not enabled, add '-strict -2' if you want to use it.
//sammi@sammi-userver:~/iShareServer/um/UserMedia$ ffmpeg -f mp4 -strict -2 -i VjAwMDA1NzY\=1.mov test.mp4
//        */
//        /**/
//        /**/
//        $res = exec("ffmpeg -y -i $file_name.mov $file_name.mp4 2> /dev/null", $output, $status);
//    else
    $res = exec("/bin/ffmpeg -y -i $file_name_incpath.mov $file_name_incpath.mp4 2> /dev/null", $output, $status);
    if ($status != 0)
        return array("res" => $res, "output" => $output, "status" => $status);

    if (!unlink("$file_name_incpath.mov"))
        return array("res" => "Failed", "output" => "Failed to delete mov file", "status" => -1);

    return array("status" => $status);
}

function get_upload_filename($file_id)
{

    return basename($_FILES[$file_id]["name"]);

}

function get_file_ext($filestring)
{
    return pathinfo($filestring, PATHINFO_EXTENSION);
}

function get_file_name($filestring)
{
    return pathinfo($filestring, PATHINFO_FILENAME);
}

function check_file_upload($file_upload_key)
{

    return !empty($_FILES[$file_upload_key]['name']);
}


function upload_image($file_id, $target_dir = '', $target_name, $overwrite = 0)
{
    if ($target_dir == '')
        $target_dir = "uploads/";
    $file_type = '.' . explode('/', $_FILES[$file_id]["type"])[1];
//    log_file('basename' . json_encode($file_type));
//    log_file('file_type' . $file_type);
    $target_file = $target_dir . $target_name . $file_type;
    if ($overwrite == 1) {
        $target_file = $target_dir . get_file_name($target_name) . $file_type;
    }
//    log_file('ttgf' . json_encode($target_file));
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES[$file_id]["tmp_name"]);
        if ($check === false) {
            log_file("File is not an image.");
            return false;
        }
        log_file("File is an image - " . $check["mime"] . ".");
    }
// Check if file already exists
    if (file_exists($target_file)) {
        //刪除原有圖片
        unlink($target_file);
//        log_file("overwirite image $target_file.");
    }
// Check file size
    if ($_FILES[$file_id]["size"] > 5000000) {
//        log_file("Sorry, your file is too large.");
        return false;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
//        log_file("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        return false;
    }
// Check if $uploadOk is set to 0 by an error
//    if ($uploadOk == 0) {
//        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file

    if (!move_uploaded_file($_FILES[$file_id]["tmp_name"], $target_file)) {
//        log_file("Sorry, there was an error uploading your file.");
        return false;
    }
//    log_file("The file " . basename($_FILES[$file_id]["name"]) . " has been uploaded.");
    return get_file_name($target_name) . $file_type;

}


?>