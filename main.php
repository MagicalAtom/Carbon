<?php


$pro = Carbon::Box(
    [
        'width' => '400px',
        'height' => '400px',
'margin' => [
  'left' => 'auto',
  'right' => 'auto',
    'top' => '40px'
],
        'class' => 'main',
        'border' => [
            'style' => 'solid',
            'color' => Colors::orange(),
            'size' => '12px',
        ]

    ]
);

$heading = Component::Render('heading',['@text' => 'Carbon','@class'=>'main']);

$heading2  = Carbon::Center($heading,'top');


$form = Form::Open('/');

$formClose = Form::Close();

$boxEnd = Carbon::BoxEnd();




$file = $pro  . $heading2 . $form . $formClose . $boxEnd;

Carbon::Register(__FILE__,$file);