<?php

class Value
{
// cursor
    public  const CURSOR_POINTER = 'pointer';
    public  const CURSOR_CELL = 'cell';
    public  const CURSOR_COPY = 'copy';
    public  const CURSOR_ZOOM_IN = 'zoom-in';
    public  const CURSOR_ZOOM_OUT = 'zoom-out';
    public  const CURSOR_WAIT = 'wait';
    public  const CURSOR_NO_DROP = 'no-drop';

//     Text > Weight
    public const WEIGHT_LIGHT = 300;
    public const WEIGHT_NORMAL = 600;
    public const WEIGHT_BOLD = 900;


// Position

    public const POSITION_ABSOLUTE = 'absolute';
    public const POSITION_RELATIVE = 'relative';



//    Direction . Text

public const DIRECTION_RIGHT_TO_LEFT = 'rtl';
public const DIRECTION_LEFT_TO_RIGHT = 'ltr';



//Align => Using Text {

public const TEXT_ALIGN_CENTER = 'center';
public const TEXT_ALIGN_END = 'end';
public const TEXT_ALIGN_START = 'start';


//                         PRIORITY


public const PRIORITY_LOW = '-1';
public const PRIORITY_LOW2 = '10';
public const PRIORITY_MID = '29';
public const PRIORITY_MID2 = '50';
public const PRIORITY_HIGH = '100';
public const PRIORITY_HIGH2 = '9999';



// Main Align

public const MAIN_EVENLY = 'space-evenly';
public const MAIN_BETWEEN = "space-between";
public const MAIN_AROUND = 'space-around';
public const MAIN_CENTER = 'center';
public const MAIN_END = 'end';
public const MAIN_DEFAULT = 'start';



// Cross Align

    public const CROSS_CENTER = 'center';
    public const CROSS_END = 'end';
    public const CROSS_DEFAULT = 'start';
    public const CROSS_FIT = 'stretch';
    public const CROSS_BASELINE = 'baseline';



//    Border style


public const BORDER_STYLE_DOT = 'dotted';
public const BORDER_STYLE_DASHED = 'dashed';
public const BORDER_STYLE_SOLID = 'solid';
}