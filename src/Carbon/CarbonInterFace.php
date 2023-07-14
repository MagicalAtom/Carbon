<?php
interface CarbonInterFace
{
    public static function Text(array $property);
    public static function Font($name,$url);
    public static function Center($element,$align);
    public static function backGround(array $property);
    public static function Page(array $property = null);
    public static function SafeArea($element);
    public static function Button(array $property);
    public static function Image($width,$height);
    public static function Url($imageUrl);
    public static function Asset($imageLocation);
    public static function Box( array $property);
    public static function BoxEnd();
    public static function TextBox(array $property);
    public static function Spinner($color);
    public static function checkBox($class,$name);
    public static function Rotation($deg,$element);
    public static function Grow($big,$element);
    public static function List(array $property,array $items,array $items_style);
    public static function OptionsList(array $property,array $opetions,array $options_style);
    public static function Color($color,$shade);
    public static function Border(array $property,$element);
    public static function Cursor($element,$custom);
    public static function Register($filepath,$program);
    public static function Style($class, array $style);

//
public static function Row(array $property);
public static function RowEnd();
public static function Column(array $property);
public static function ColumnEnd();

}