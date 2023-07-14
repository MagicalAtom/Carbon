<?php
include "FormInterFace.php";
class Form implements FormInterFace
{
    public static function Open($action)
    {
    if ($action){
    return "<form" . " action" . "= " . "'$action'" . " " . "method" . "= " . "'POST'" . " " . "enctype=" . "multipart/form-data" . ">";
    }

    }
    public static function Close()
    {
        return "</form>";
    }


}
?>