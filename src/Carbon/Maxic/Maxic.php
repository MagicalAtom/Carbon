<?php

include "MaxicInterFace.php";
require __DIR__ . "/../../vendor/autoload.php";
use Curl\Curl;

class Maxic implements MaxicInterFace
{
    public static  $curl = '';

    public function __construct(){
        self::$curl = new Curl();
    }

    public static function get($api,array $data = null)
{
   self::UrlCheck($api);
    return json_decode(self::$curl->get($api));

if (self::error()){
    return self::error();
}
    // passed array
if (isset($data)){
    self::$curl->get($api,$data);
    self::error();
}


}

public static function post($api,array $data)
{
    self::UrlCheck($api);

    $response = self::$curl->post($api,$data);
    return json_decode($response);

    if (self::error()){
        return self::error();
    }

}
    public static function put($api,array $data)
    {
        self::UrlCheck($api);

        $response = self::$curl->put($api,$data);
        return json_decode($response);

        if (self::error()){
            return self::error();
        }

    }
    public static function patch($api,array $data)
    {
        self::UrlCheck($api);

        $response = self::$curl->patch($api,$data);
        return json_decode($response);

        if (self::error()){
            return self::error();
        }

    }
    public static function delete($api,array $data)
    {

        self::UrlCheck($api);

        $response = self::$curl->delete($api,$data);
        return json_decode($response);

        if (self::error()){
            return self::error();
        }

    }
    public static function error(){
    if (self::$curl->error) {
        echo 'Error: ' . self::$curl->errorMessage . "\n";
    } else {
        echo 'Response:' . "\n";
        $response = json_decode(self::$curl->response);
        return $response;
    }
}

public static function UrlCheck($url){
    if (!filter_var($url,FILTER_VALIDATE_URL)){
        throw new Exception('Url not Valid');
    }
}
public static function setHeader($key,$value)
{
    self::$curl->setHeader($key,$value);
    if (self::error()){
        return self::error();
    }
}
public static function setCookie($key, $value)
{

self::setCookie($key,$value);

if (self::error()){
        return self::error();
    }
}

}
// Use lib $Maxic::get( . . .
$Maxic = new Maxic();
