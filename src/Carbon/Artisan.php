<?php

class Artisan
{

    public static function delete($filename){
        $filenamepath = pathinfo("public/css/$filename" . ".css");
        if (!file_exists($filenamepath['dirname'] . DIRECTORY_SEPARATOR . $filenamepath['basename'])) {
            die('file not exists!!!');
        }else{
            echo "delete cache style . . . " . PHP_EOL;
            sleep(2);
            file_put_contents($filenamepath['dirname'] . DIRECTORY_SEPARATOR . $filenamepath['basename'],'');
        }
    }



    public static function Compress($filename){



        $filenamepath = pathinfo("public/css/$filename" . ".css");

        if (!file_exists($filenamepath['dirname'] . DIRECTORY_SEPARATOR . $filenamepath['basename'])) {
            die('file not exists!!!');
        }else {
            sleep(3);
            $get = file_get_contents($filenamepath['dirname'] . DIRECTORY_SEPARATOR . $filenamepath['basename']);

            if (empty($get) || $get == '' || $get == ' ' ){
                die('this file empty!');
            }
//replace all new lines and spaces
//
            $compress = $get;
            $compress = str_replace(" {", "{", $compress);
            $compress = str_replace("{ ", "{", $compress);
            $compress = str_replace(" }", "}", $compress);
            $compress = str_replace("} ", "}", $compress);
            $compress = str_replace(": ", ":", $compress);
            $compress = preg_replace('#\.(.*){}#', "", $compress);
//        $compress = preg_replace('#.\w{} #',"",$compress);
            $compress = preg_replace(
                array('/\s*(\w)\s*{\s*/', '/\s*(\S*:)(\s*)([^;]*)(\s|\n)*;(\n|\s)*/', '/\n/', '/\s*}\s*/'),
                array('$1{ ', '$1$3;', "", '} '),
                $compress
            );

            //write the entire string
            file_put_contents($filenamepath['dirname'] . DIRECTORY_SEPARATOR . $filenamepath['basename'], $compress);

        }

    }

}