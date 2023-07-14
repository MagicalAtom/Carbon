<?php
//include "src/loader.php";


function url($filename){
$path = pathinfo($filename);
$extension = $path['extension'];
$filename = $path['filename'];
if (in_array($extension,['png','jpg','jpeg','gif'])){
    return '../image/'  . $filename . "." .  $extension;
}elseif ($extension == 'css'){
    return '../css/'  . $filename . "." .  $extension;
}elseif ($extension == 'js'){
    return '../js/'  . $filename . "." .  $extension;
}elseif ($extension == 'woff2'){
    return '../font/'  . $filename . "." .  $extension;
}
}

function getFormData($key = null){
if (!empty($_POST)){
    if (isset($_POST[$key])){
        return $_POST[$key];
    }else{
        return $_POST;
    }
}
}
function import($file){
if (file_exists($file . ".php")){
    require_once $file . '.php';
}
}
function site(){
    $config = [
        'url' => 'other2.test', // put url this section
    ];

 $folder = substr($_SERVER['SCRIPT_NAME'], 1, 6) . "helper.php/";
    $domain = 'http://' . $config['url'] . "/";
    return $domain . $folder;
}






