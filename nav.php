<?php
$bg = Carbon::backGround(['color'=>Colors::pink()]);
$menu = Carbon::Row(
    [
        'class' => 'help',
        'width' => '600px',
        'CrossAlign' => Carbon::CROSS_CENTER,
        'MainAlign' => Carbon::MAIN_EVENLY,
        'bg-Color' =>  Carbon::Color('yellow','50'),
        'rounded' => '10px'


    ]
);
$sub =
    Carbon::Cursor(
        Carbon::Border([
            'border' => [
                'style' => 'solid',
                'color' => Carbon::Color('red','900'),
                'size' => '1px'
            ],
            'rounded' => '9999px'
        ],Carbon::Text(['text'=>'shop','class'=>'sub', 'size' => '20'])),Value::CURSOR_POINTER) .
    Carbon::Border([
        'border' => [
            'style' => 'solid',
            'color' => Carbon::Color('red','900'),
            'size' => '1px'
        ],
    ],Carbon::Text(['text'=>'home','class'=>'sub', 'size' => '20'])) .
    Carbon::Border([
        'border' => [
            'style' => 'solid',
            'color' => Carbon::Color('red','900'),
            'size' => '1px'
        ],
    ],
        Carbon::Cursor(
        Carbon::Text(['text'=>'contact','class'=>'sub', 'size' => '20']),Carbon::CURSOR_WAIT)




    ) ;

$menuEnd = Carbon::RowEnd();

$all1 = $menu  . $sub .  $menuEnd;

$all = Carbon::Center($all1,'top');

Carbon::Register(__FILE__,$all);


