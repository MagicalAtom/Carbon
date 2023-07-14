<?php

namespace App;

use Carbon\App;
use Carbon\Application;
use Carbon\Carbon;
use Carbon\Colors;
use Carbon\Helper\Helper;
use Carbon\Value;

class UserPageContainer
{
// dont touch class method , define your method after runApplication in class

    private
    $widget;

    use Application;

    public function __construct()
    {
        Carbon::run(__FILE__);
        Carbon::reload();
        $this->getAllWidget();
    }


    protected function getClassName()
    {
        return __CLASS__;
    }


    protected function getAllWidget()
    {
        $this->widget = array_slice(get_class_methods($this->getClassName()), 4);
    }


    public function runApplication()
    {
        foreach ($this->widget as $w) {

            Helper::runApp(call_user_func([$this->getClassName(), $w]));
        }
    }


    // Run Application after this comment


//    SayHello ==================================
    public static function SayHello()
    {

        $sayHello = Carbon::Text('Hello', ['class' => 'sayHello', 'color' => Colors::red()]);


        // dont touch this , all method copy this line for runing all widget
        return App::returnWidgets(... get_defined_vars()); // all widget this line same
    }


}

