<?php

interface MaxicInterFace
{
public static function get($api,array $data);
public static function post($api, array $data);
public static function put($api,array $data);
public static function patch($api,array $data);
public static function delete($api,array $data);
public static function setHeader($key,$value);
public static function setCookie($key,$value);
}