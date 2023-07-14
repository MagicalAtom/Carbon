<?php
namespace Carbon\Component;
use
class Component implements ComponentInterFace
{
    // if send value to component ,
    // set @var in component {@}value
  public static  function Render($component,array $attributes = null){
        $name  = "Component/" .  $component . ".ca";

      if (!file_exists($name)){
          throw new \Exception('File not exist',404);
      }

        $getcomponent = file_get_contents($name);


        if(empty($attributes)){
            return  $getcomponent;
        }elseif(!empty($attributes)){
            $getcomponent = str_ireplace(array_keys($attributes),array_values($attributes),$getcomponent);
            return $getcomponent;
        }
    }
}