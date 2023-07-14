<?php
include "Helper/Helper.php";
trait Assets
{
    protected static function write($filename,$style){
        file_put_contents($filename,$style,FILE_APPEND);
    }
    protected static function writeFile($filename,$style){
        file_put_contents($filename,$style,FILE_APPEND);
    }

    protected static function check($file,$class){
        if (str_contains(file_get_contents($file), "." . $class)){
            return false;
        }else{
            return true;
        }
    }



}

