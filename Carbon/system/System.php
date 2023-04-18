<?php

class System
{
    public static function GetLine($text = null){
        $get = readline($text);
        return $get;
    }

}