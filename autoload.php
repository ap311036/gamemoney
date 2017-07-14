<?php
function allAutoload($class_name)
{
    $path = __DIR__;
    $folders = array(
        $path . "/lib/",
    );

    foreach ($folders as $folder) {
        $file_name = $folder . $class_name . ".php";
        if (is_readable($file_name)) {
            require($file_name);
        }
    }
}

spl_autoload_register("allAutoload");

?>