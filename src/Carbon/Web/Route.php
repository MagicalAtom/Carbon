<?php
namespace Apex\Router\Web;

class Route{

//    Routing System Like Laravel
// for Example : [Controller (Just Controller , Please Just Controller Name) , Method Name]
//
public static $class;
public static $method;
public static $url;
public static $name;
public static $current;
public function name($Routename){
    global $routes;
    self::$name = $Routename;
    array_push($routes[self::$current],['url'=>trim(self::$url,"/ "), 'class'=>self::$class, 'method'=>self::$method,'name'=>self::$name]);
}

public static function get($url,array $MethodAction){
    self::$class = $MethodAction[0];
    self::$method = $MethodAction[1];
    self::$url = trim($url,"/ ");
    self::$current = 'get';
    global $routes;
    return new self;

}


public static function post($url,$MethodAction){

    self::$class = $MethodAction[0];
    self::$method = $MethodAction[1];
    self::$url = trim($url,"/ ");
    self::$current = 'post';
    global $routes;

    return new self;

}


public static function put($url,$MethodAction){

    self::$class = $MethodAction[0];
    self::$method = $MethodAction[1];
    self::$url = trim($url,"/ ");
    self::$current = 'put';
    return new self;

}
public static function delete($url,$MethodAction){

    self::$class = $MethodAction[0];
    self::$method = $MethodAction[1];
    self::$url = trim($url,"/ ");
    self::$current = 'delete';
    return new self;
}
}