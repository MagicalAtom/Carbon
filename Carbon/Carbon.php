<?php

use Curl\Encoder;

//error_reporting(0);
require_once('mainLoader.php');
class Carbon extends Value implements CarbonInterFace
{
    use Assets;

    // store style in folder  . . .
    protected static $stylePath = 'public' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR;
    protected static $htmlPath = 'public' . DIRECTORY_SEPARATOR;
    protected static $filename = '';
    protected static $Htmlfilename = '';
    protected static $rewrite = null;


    // use Image asset or url ====>
    protected static $ImageEngine;
    protected static $width;
    protected static $height;

    // set style folder
    public static function setStylePath($stylePath)
    {
        self::$stylePath = $stylePath;
    }

    public static function rewrite()
    {
        self::$rewrite = true;
    }



    public static function run($file){
        self::FileName($file);
        self::importStyle();
    }

    public static function Register($filepath,$program)
    {
        $filename = pathinfo($filepath);
        define(strtoupper($filename['filename']),$program);
    }

    public static function FileName($file)
    {
        $path = pathinfo($file);
        self::$filename = $path['filename'] . ".css";
    }

    protected static function showError($keywords, $property)
    {
        foreach (array_keys($property) as $key) {
            echo (in_array($key, array_values($keywords)) ? null : '<font color="red">found error , not found</font>' . "<br>" . "{{ " . $key . " }}" . "<br>" . "in Carbon" . "<br>");
        }
    }



    public static function importStyle()
    {
        echo "<link" . " href=" . self::$stylePath . self::$filename . '?v=' . uniqid() . ' rel=stylesheet >';
        echo "<link" . " href=" . "Carbon" . DIRECTORY_SEPARATOR .  "StyleEngine" . DIRECTORY_SEPARATOR .  "Colors.css " . "rel=stylesheet>";
    }

    public static function Text(array $property)
    {
        $keywords = ["text", "color", "size", "position", "Right", "Left", "Top", "Bottom", "lineHeight", "font", "weight", "decoration", "direction", "textAlign", "class"];
        self::showError($keywords, $property);
        if ($property['text']) {
            $text = $property['text'];
            @$color = $property['color'];
            @$size = $property['size'];
            @$lineHeight = $property['lineHeight'];
            @$font = $property['font'];
            @$position = $property['position'];
            @$top = $property['Top'];
            @$bottom = $property['Bottom'];
            @$left = $property['Left'];
            @$right = $property['Right'];
            @$weight = $property['weight'];
            @$decoration = $property['decoration'];
            @$direction = $property['direction'];
            @$textAlign = $property['textAlign'];
            @$class = $property['class'];

            if (!$property['class']) {
                return '<p>' . $property['text'] . '</p>';
            } else {
                if (!file_exists(self::$stylePath . self::$filename))
                    touch(self::$stylePath . self::$filename);
                if (
                    !($color) && !($size) && !($font) && !($weight) && !($decoration)
                    && !($direction) && !($textAlign) && !($position) && !($top) && !($bottom) && !($right) && !($left)
                ) {
                    return '<p class=' . $class . '>' . $text . '</p>';
                } else {
                    $Style = $class ? "." . $class . "{\n" : null;
                    $Style .= $color ? 'color' . ":" . $color . ";\n" : '';
                    $Style .= $size ? 'font-size' . ":" . $size . "px;\n" : '';
                    $Style .= $font ? 'font-family' . ":" . $font . ";\n" : '';
                    $Style .= $weight ? 'font-weight' . ":" . $weight . ";\n" : '';
                    $Style .= $decoration ? 'text-decoration' . ":" . $decoration . ";\n" : '';
                    $Style .= $direction ? 'direction' . ":" . $direction . ";\n" : '';
                    $Style .= $textAlign ? 'text-align' . ":" . $textAlign . ";\n" : '';
                    $Style .= $lineHeight ? 'line-height' . ":" . $lineHeight . ";\n" : '';
                    $Style .= $position ? 'position' . ":" . $position . ";\n" : '';
                    $Style .= $top && $position ? 'top' . ":" . $top . ";\n" : '';
                    $Style .= $bottom && $position ? 'bottom' . ":" . $top . ";\n" : '';
                    $Style .= $right && $position ? 'right' . ":" . $top . ";\n" : '';
                    $Style .= $left && $position ? 'left' . ":" . $left . ";\n" : '';
                    $Style .= "}\n";
                }
                if (strpos(file_get_contents(self::$stylePath . self::$filename), $class) !== false) {
                    if (self::$rewrite) {
                        self::write(self::$stylePath . self::$filename, $Style);
                    }
                    return '<p class=' . $class . '>' . $text . '</p>';
                } elseif ($Style) {
                    self::write(self::$stylePath . self::$filename, $Style);
                    return '<p class=' . $class . '>' . $text . '</p>';
                }
            }
        }
    }

    public static function Font($name, $url)
    {

        if ($name && $url) {
            if (!file_exists(self::$stylePath . self::$filename))
                touch(self::$stylePath . self::$filename);
            $Style = "@font-face {\n";
            $Style .= "font-family" . ": " . $name . ";\n";
            $Style .= "src" . ": " . "url(" . "'$url'" . ") " . 'format("woff2");' . "\n";
            $Style .= "}" . "\n";
            if (strpos(file_get_contents(self::$stylePath . self::$filename), $name) !== false) {
                if (self::$rewrite) {
                    self::write(self::$stylePath . self::$filename, $Style);
                }
                return true;
            } else {

                self::write(self::$stylePath . self::$filename, $Style);
            }
        }
    }



    public static function Center($element,$align)
    {
        if ($element && $align) {
            $Style = "text-align: center;position: absolute;top: 50%;left: 0;right: 0;margin: auto;transform: translateY(-50%);";
            if ($align == 'top'){
            return '<center>' . $element . "</center>";
            }elseif ($align == 'center'){
                return "<div style=\"{$Style}\">$element</div>";
            }
            }
    }

    public static function backGround(array $property)
    {

        self::showError(["color", "image"], $property);
        if (isset($property['color'])) {
            $color = $property['color'];
            $Style = 'body' . "{\n";
            $Style .= 'background-color' . ": " . $color . ";\n";
            $Style .= "}\n";
            if (strpos(file_get_contents(self::$stylePath . self::$filename), 'body') !== false) {
                if (self::$rewrite) {
                    self::write(self::$stylePath . self::$filename, $Style);
                }
                return true;
            } else {
                self::write(self::$stylePath . self::$filename, $Style);
            }
        } elseif ($property['image']) {
            $image = $property['image'];
            $Style = 'body' . "{\n";
            $Style .= 'background-image' . ": " . "url(" . "'$image'" . ")" . ";\n";
            $Style .= "}\n";
            if (strpos(file_get_contents(self::$stylePath . self::$filename), 'body') !== false) {
                if (self::$rewrite) {
                    self::write(self::$stylePath . self::$filename, $Style);
                }
                return true;
            } else {
                self::write(self::$stylePath . self::$filename, $Style);
            }
        }
    }

    public static function Page(array $property = null)
    {
        self::showError(["@title", "@content"], $property);
        $getcomponent = Component::Render('page');
        if (empty($property)) {
            return $getcomponent;
        }
        if ($property['@title'] && $property['@content']) {
            $title = $property['@title'];
            $content = $property['@content'];
            return Component::Render('page', ['@title' => $title, '@content' => $content]);
        } else {
            throw new Exception('please set a @title , @content in parameter 2');
        }
    }


    public static function SafeArea($element)
    {
        if ($element) {
            return "<div style='margin-top:20px; margin-right:20px; margin-left: 20px;'> " . $element . "</div>";
        }
    }

    public static function Button(array $property)
    {
        $keywords = ["class", "rounded", "bootstrap", "Text", "position", "Right", "Left", "Top", "Bottom", "bg-Color", "Color", "border", "size", "style", "color", "width", "height"];
        self::showError($keywords, $property);
        if ($property['class'] && $property['Text']) {
            $class = $property['class'];
            $text = $property['Text'];
            @$backgroundColor = $property['bg-Color'];
            @$Color = $property['Color'];
            @$radius = $property['rounded'];
            @$borderSize = $property['border']['size'];
            @$borderStyle = $property['border']['style'];
            @$borderColor = $property['border']['color'];
            @$paddingTop = $property['padding']['top'];
            @$paddingRight = $property['padding']['right'];
            @$paddingLeft = $property['padding']['left'];
            @$paddingBottom = $property['padding']['bottom'];
            @$bootstrap = $property['bootstrap'];
            @$position = $property['position'];
            @$top = $property['Top'];
            @$bottom = $property['Bottom'];
            @$left = $property['Left'];
            @$right = $property['Right'];
            @$width = $property['width'];
            @$height = $property['height'];
            if (!$property['class']) {
                return "<button class='{$bootstrap}'>" . $text . "</button>";
            } else {
                if (!file_exists(self::$stylePath . self::$filename))
                    touch(self::$stylePath . self::$filename);
                if (
                    !($backgroundColor) && !($Color) && !($borderSize) && !($borderStyle) && !($borderColor) && !($width) && !($height)
                    && !($paddingLeft) && !($paddingRight) && !($paddingTop)
                    && !($position) && !($top) && !($bottom) && !($right) && !($left)
                    && !($paddingBottom)
                ) {
                    return "<button class='$class $bootstrap '>" . $text . "</button>";
                } else {
                    $Style = $class ? "." . $class . "{\n" : null;
                    $Style .= $Color ? 'color' . ":" . $Color . ";\n" : '';
                    $Style .= $backgroundColor ? 'background-color' . ":" . $backgroundColor . ";\n" : '';
                    $Style .= $borderSize && $borderColor && $borderStyle ? 'border' . ":" . $borderSize . " " . $borderStyle . " " . $borderColor . ";\n" : '';
                    $Style .= $paddingTop || $paddingRight || $paddingLeft || $paddingBottom ? 'padding' . ":" . $paddingTop . " " . $paddingRight . " " . $paddingBottom . " " . $paddingLeft . ";\n" : '';
                    $Style .= $radius ? 'border-radius' . ":" . $radius . ";" : '';
                    $Style .= $position ? 'position' . ":" . $position . ";\n" : '';
                    $Style .= $top ? 'top' . ":" . $top . ";\n" : '';
                    $Style .= $bottom ? 'bottom' . ":" . $top . ";\n" : '';
                    $Style .= $right ? 'right' . ":" . $top . ";\n" : '';
                    $Style .= $left ? 'left' . ":" . $left . ";\n" : '';
                    $Style .= $width ? 'width' . ":" . $width . ";\n" : '';
                    $Style .= $height ? 'height' . ":" . $height . ";\n" : '';
                    $Style .= "}\n";
                }
                if (strpos(file_get_contents(self::$stylePath . self::$filename), $class) !== false) {
                    if (self::$rewrite) {
                        self::write(self::$stylePath . self::$filename, $Style);
                    }
                    return "<button class='$class $bootstrap '>" . $text . "</button>";
                } elseif ($Style) {
                    self::write(self::$stylePath . self::$filename, $Style);
                    return "<button class='$class $bootstrap '>" . $text . "</button>";
                }
            }
        }
    }

    public static function Image($width, $height)
    {
        self::$width = $width;
        self::$height = $height;
        self::$ImageEngine = true;
    }

    public static function Url($imageUrl)
    {
        if (self::$width && self::$height && self::$ImageEngine) {
            $width = self::$width;
            $height = self::$height;
            $image = $imageUrl;
            $imageData = base64_encode(file_get_contents($image));
            return '<img ' . 'width= ' . "\"$width\"" . " height= " . "\"$height\"" . ' src="data:image/jpeg;base64,' . $imageData . '">';
        }
    }

    /*
     *  after storage path
     *  folder in storage path
     * folder/image.[png , jpg , jpeg]
     */
    public static function Asset($imageLocation)
    {
        if (self::$width && self::$height && self::$ImageEngine) {
            $width = self::$width;
            $height = self::$height;
            $image = $imageLocation;
            return '<img ' . 'width= ' . "\"$width\"" . " height= " . "\"$height\"" . " src=\"storage/$imageLocation\"  >";
        }
    }


    public static function reload()
    {
        file_put_contents(self::$stylePath . self::$filename, '');
    }


    public static function Border(array $property,$element)
    {
        $keywords = ['border','padding','rounded'];
        self::showError($keywords, $property);
        @$paddingTop = $property['padding']['top'];
        @$paddingRight = $property['padding']['right'];
        @$paddingLeft = $property['padding']['left'];
        @$paddingBottom = $property['padding']['bottom'];
        @$borderSize = $property['border']['size'];
        @$borderStyle = $property['border']['style'];
        @$borderColor = $property['border']['color'];
        @$radius = $property["rounded"];
        @$backGroundColor = $property['bg-Color'];
        if ($element){
            $Style = "";
            $Style .= $backGroundColor ? 'background-color' . ":" . $backGroundColor . ";" : '';
            $Style .= $radius ? 'border-radius' . ":" . $radius . "px;" : '';
            $Style .= $paddingBottom ? 'padding-bottom' . ":" . $paddingBottom . ";" : '';
            $Style .= $paddingTop ? 'padding-top' . ":" . $paddingTop . ";" : '';
            $Style .= $paddingRight ? 'padding-right' . ":" . $paddingRight . ";" : '';
            $Style .= $paddingLeft ? 'padding-left' . ":" . $paddingLeft . ";" : '';
            $Style .= $borderSize && $borderColor && $borderStyle ? 'border' . ":" . $borderSize . " " . $borderStyle . " " . $borderColor . ";" : '';
            if ($Style){
                return "<div style=\"$Style\" >" . $element . "</div>";
            }
        }




    }



    public static function Cursor($element,$type)
    {

        if ($element && $type) {
            return "<div style=\"cursor: {$type}\" >" . $element . "</div>";

        }



    }

    public static function Style($class, array $style)
    {
        if ($class){
            $Style_final = ".{$class} {\n";
            foreach ($style as $property=>$value) {
                $Style_final .= "$property" . " : " . $value . ";\n";
            }
            $Style_final .= "}";
            if (strpos(file_get_contents(self::$stylePath . self::$filename), $class) !== false) {
                if (self::$rewrite) {
                    self::write(self::$stylePath . self::$filename, $Style_final);
                }
            } elseif ($Style_final) {
                self::write(self::$stylePath . self::$filename, $Style_final);
            }
        }



    }

    public static function Box(array $property)
    {
        $keywords = [
            "padding",
            "margin",
            "border",
            "bg-Color",
            "rounded",
            "width",
            "height",
            "bootstrap",
            "class",
            "position",
            "priority",
            "Right",
            "display",
            "Left",
            "Top",
            "Bottom"
        ];
        self::showError($keywords, $property);
        @$paddingTop = $property['padding']['top'];
        @$paddingRight = $property['padding']['right'];
        @$paddingLeft = $property['padding']['left'];
        @$paddingBottom = $property['padding']['bottom'];
        @$marginTop = $property['margin']['top'];
        @$marginRight = $property['margin']['right'];
        @$marginLeft = $property['margin']['left'];
        @$marginBottom = $property['margin']['bottom'];
        @$borderSize = $property['border']['size'];
        @$borderStyle = $property['border']['style'];
        @$borderColor = $property['border']['color'];
        @$position = $property['position'];
        @$top = $property['Top'];
        @$bs = $property['bootstrap'];
        @$bottom = $property['Bottom'];
        @$left = $property['Left'];
        @$right = $property['Right'];
        @$backGroundColor = $property['bg-Color'];
        @$radius = $property['rounded'];
        @$width = $property['width'];
        @$Priority = $property['priority'];
        @$display = $property['display'];
        @$height = $property['height'];
        @$element = $property['element'];
        @$class = $property['class'];
        $Style = "";
        $Style .= $backGroundColor ? 'background-color' . ":" . $backGroundColor . ";" : '';
        $Style .= $height ? 'height' . ":" . $height . ";" : '';
        $Style .= $width ? 'width' . ":" . $width . ";" : '';
        $Style .= $radius ? 'border-radius' . ":" . $radius . "px;" : '';
        $Style .= $paddingBottom ? 'padding-bottom' . ":" . $paddingBottom . ";" : '';
        $Style .= $paddingTop ? 'padding-top' . ":" . $paddingTop . ";" : '';
        $Style .= $paddingRight ? 'padding-right' . ":" . $paddingRight . ";" : '';
        $Style .= $paddingLeft ? 'padding-left' . ":" . $paddingLeft . ";" : '';
        $Style .= $position ? 'position' . ":" . $position . ";\n" : '';
        $Style .= $Priority ? 'z-index' . ":" . $Priority . ";\n" : '';
        $Style .= $display ? 'display' . ":" . $display . ";\n" : '';
        $Style .= $top ? 'top' . ":" . $top . ";\n" : '';
        $Style .= $bottom ? 'bottom' . ":" . $bottom . ";\n" : '';
        $Style .= $right ? 'right' . ":" . $right . ";\n" : '';
        $Style .= $left ? 'left' . ":" . $left . ";\n" : '';
        $Style .= $marginTop ? 'margin-top' . ":" . $marginTop . ";" : '';
        $Style .= $marginBottom ? 'margin-bottom' . ":" . $marginBottom . ";" : '';
        $Style .= $marginRight ? 'margin-right' . ":" . $marginRight . ";" : '';
        $Style .= $marginLeft ? 'margin-left' . ":" . $marginLeft . ";" : '';
        $Style .= $borderSize && $borderColor && $borderStyle ? 'border' . ":" . $borderSize . " " . $borderStyle . " " . $borderColor . ";" : '';
        return "<div class='$class $bs '  style='$Style' > ";
    }
public static function BoxEnd()
{
return '</div>';
}


    public static function Color($color, $shade = 400)
{

return "var(--{$color}-{$shade})";


}



    public static function Column(array $property)
    {
        $keywords = [
            "padding",
            "margin",
            "border",
            "bg-Color",
            "responsive",
            "rounded",
            "width",
            "height",
            "class",
            "priority",
            "MainAlign",
            "CrossAlign",
            "position",
            "Right",
            "Left",
            "Top",
            "Bottom",
            "bootstrap",
        ];
        self::showError($keywords, $property);
        if ($property['class']) {
            @$class = $property['class'];
            @$radius = $property['radius'];
            @$paddingTop = $property['padding']['top'];
            @$paddingRight = $property['padding']['right'];
            @$paddingLeft = $property['padding']['left'];
            @$paddingBottom = $property['padding']['bottom'];
            @$marginTop = $property['margin']['top'];
            @$marginRight = $property['margin']['right'];
            @$marginLeft = $property['margin']['left'];
            @$marginBottom = $property['margin']['bottom'];
            @$borderSize = $property['border']['size'];
            @$borderStyle = $property['border']['style'];
            @$borderColor = $property['border']['color'];
            @$backGroundColor = $property['bg-Color'];
            @$position = $property['position'];
            @$top = $property['Top'];
            @$bottom = $property['Bottom'];
            @$left = $property['Left'];
            @$right = $property['Right'];
            @$Priority = $property['priority'];
            @$justify = $property['MainAlign'];
            @$align = $property['CrossAlign'];
            @$wrap = $property['responsive'];
            @$bs = $property['bootstrap'];
            @$width = $property['width'];
            @$height = $property['height'];
            if (!$property['class']) {
                return '<div>';
            } else {
                if (!file_exists(self::$stylePath . self::$filename))
                    touch(self::$stylePath . self::$filename);
                if (
                    !($backGroundColor)  && !($height) && !($width) &&
                    !($align)
                    && !($justify) && !($Priority) && !($borderColor) && !($borderStyle) && !($borderSize)
                    && !($marginLeft) && !($marginRight) && !($marginTop)
                    && !($paddingLeft) && !($paddingRight) && !($paddingTop)
                    && !($position) && !($top) && !($bottom) && !($right) && !($left)
                    && !($paddingBottom) && !($marginBottom)  && !($wrap)
                ) {
                    return '<div class=' . $class . " " . " " . $bs . '>';
                } else {
                    $Style = $class ? "." . $class . "{\n" : null;
                    $Style .= $backGroundColor ? 'background-color' . ":" . $backGroundColor . ";\n" : '';
                    $Style .= $radius ? 'border-radius' . ":" . $radius . ";\n" : '';
                    $Style .= 'display' . ": " . "flex" . ";\n";
                    $Style .= $position ? 'position' . ":" . $position . ";\n" : '';
                    $Style .= $top ? 'top' . ":" . $top . ";\n" : '';
                    $Style .= $bottom ? 'bottom' . ":" . $top . ";\n" : '';
                    $Style .= $right ? 'right' . ":" . $top . ";\n" : '';
                    $Style .= $left ? 'left' . ":" . $left . ";\n" : '';
                    $Style .= $height ? 'height' . ":" . $height . ";\n" : '';
                    $Style .= $width ? 'width' . ":" . $width . ";\n" : '';
                    $Style .= $Priority ? 'z-index' . ":" . $Priority . ";\n" : '';
                    $Style .= $wrap ? 'flex-wrap' . ":" . $wrap . ";\n" : '';
                    $Style .= $justify ? 'justify-content' . ":" . $justify . ";\n" : '';
                    $Style .= $Priority ? 'order' . ":" . $Priority . ";\n" : '';
                    $Style .= 'flex-direction' . ":" . "column" . ";\n";
                    $Style .= $align ? 'align-items' . ": " . $align . ";\n" : '';
                    $Style .= $borderSize && $borderColor && $borderStyle ? 'border' . ":" . $borderSize . " " . $borderStyle . " " . $borderColor . ";\n" : '';
                    $Style .= $paddingTop || $paddingRight || $paddingLeft || $paddingBottom ? 'padding' . ":" . $paddingTop . " " . $paddingRight . " " . $paddingBottom . " " . $paddingLeft . ";\n" : '';
                    $Style .= $marginTop || $marginRight || $marginLeft || $marginBottom ? 'margin' . ":" . $marginTop . " " . $marginRight . " " . $marginBottom . " " . $marginLeft . ";\n" : '';
                    $Style .= "}\n";
                }
                if (strpos(file_get_contents(self::$stylePath . self::$filename), $class) !== false) {
                    if (self::$rewrite) {
                        self::write(self::$stylePath . self::$filename, $Style);
                    }
                    return '<div class=' . $class . " " . " " . $bs . '>';
                } elseif ($Style) {
                    self::write(self::$stylePath . self::$filename, $Style);
                    return '<div class=' . $class . " " . " " . $bs . '>';
                }
            }
        }
    }

    public static function ColumnEnd()
    {
        return "</div>";
    }





    public static function Row(array $property)
    {
        $keywords = [
            "padding",
            "margin",
            "border",
            "bg-Color",
            "responsive",
            "rounded",
            "width",
            "height",
            "class",
            "priority",
            "MainAlign",
            "CrossAlign",
            "position",
            "Right",
            "Left",
            "Top",
            "Bottom",
            "bootstrap",
        ];
        self::showError($keywords, $property);
        if (@$property['class']) {
            @$radius = $property['rounded'];
            @$paddingTop = $property['padding']['top'];
            @$paddingRight = $property['padding']['right'];
            @$paddingLeft = $property['padding']['left'];
            @$paddingBottom = $property['padding']['bottom'];
            @$class = $property['class'];
            @$marginTop = $property['margin']['top'];
            @$marginRight = $property['margin']['right'];
            @$marginLeft = $property['margin']['left'];
            @$marginBottom = $property['margin']['bottom'];
            @$borderSize = $property['border']['size'];
            @$borderStyle = $property['border']['style'];
            @$borderColor = $property['border']['color'];
            @$backGroundColor = $property['bg-Color'];
            @$position = $property['position'];
            @$top = $property['Top'];
            @$bottom = $property['Bottom'];
            @$left = $property['Left'];
            @$right = $property['Right'];
            @$Priority = $property['priority'];
            @$justify = $property['MainAlign'];
            @$align = $property['CrossAlign'];
            @$wrap = $property['responsive'];
            @$bs = $property['bootstrap'];
            @$width = $property['width'];
            @$height = $property['height'];
            if (!$class) {
                return '<div>';
            } else {
                if (!file_exists(self::$stylePath . self::$filename))
                    touch(self::$stylePath . self::$filename);
                if (
                    !($backGroundColor)  && !($height) && !($width) &&
                    !($align)
                    && !($justify) && !($Priority) && !($borderColor) && !($borderStyle) && !($borderSize)
                    && !($marginLeft) && !($marginRight) && !($marginTop)
                    && !($paddingLeft) && !($paddingRight) && !($paddingTop)
                    && !($position) && !($top) && !($bottom) && !($right) && !($left)
                    && !($paddingBottom) && !($marginBottom)  && !($wrap)
                ) {
                    return '<div class=' . $class . " " . " " . $bs . '>';
                } else {
                    $Style = $class ? "." . $class . "{\n" : null;
                    $Style .= $backGroundColor ? 'background-color' . ":" . $backGroundColor . ";\n" : '';
                    $Style .= $radius ? 'border-radius' . ":" . $radius . ";\n" : '';
                    $Style .= 'display' . ": " . "flex" . ";\n";
                    $Style .= $position ? 'position' . ":" . $position . ";\n" : '';
                    $Style .= $top ? 'top' . ":" . $top . ";\n" : '';
                    $Style .= $bottom ? 'bottom' . ":" . $top . ";\n" : '';
                    $Style .= $right ? 'right' . ":" . $top . ";\n" : '';
                    $Style .= $left ? 'left' . ":" . $left . ";\n" : '';
                    $Style .= $height ? 'height' . ":" . $height . ";\n" : '';
                    $Style .= $width ? 'width' . ":" . $width . ";\n" : '';
                    $Style .= $Priority ? 'z-index' . ":" . $Priority . ";\n" : '';
                    $Style .= $wrap ? 'flex-wrap' . ":" . $wrap . ";\n" : '';
                    $Style .= $justify ? 'justify-content' . ":" . $justify . ";\n" : '';
                    $Style .= $Priority ? 'order' . ":" . $Priority . ";\n" : '';
                    $Style .= 'flex-direction' . ":" . "row" . ";\n";
                    $Style .= $align ? 'align-items' . ": " . $align . ";\n" : '';
                    $Style .= $borderSize && $borderColor && $borderStyle ? 'border' . ":" . $borderSize . " " . $borderStyle . " " . $borderColor . ";\n" : '';
                    $Style .= $paddingTop || $paddingRight || $paddingLeft || $paddingBottom ? 'padding' . ":" . $paddingTop . " " . $paddingRight . " " . $paddingBottom . " " . $paddingLeft . ";\n" : '';
                    $Style .= $marginTop || $marginRight || $marginLeft || $marginBottom ? 'margin' . ":" . $marginTop . " " . $marginRight . " " . $marginBottom . " " . $marginLeft . ";\n" : '';
                    $Style .= "}\n";
                }
                if (strpos(file_get_contents(self::$stylePath . self::$filename), $class) !== false) {
                    if (self::$rewrite) {
                        self::write(self::$stylePath . self::$filename, $Style);
                    }
                    return '<div class=' . $class . " " . " " . $bs . '>';
                } elseif ($Style) {
                    self::write(self::$stylePath . self::$filename, $Style);
                    return '<div class=' . $class . " " . " " . $bs . '>';
                }
            }
        }
    }

    public static function RowEnd()
    {
        return "</div>";
    }





    public static function TextBox(array $property)
    {
        $keywords = ["class", "Text", "bs", "name", "position", "Right", "Left", "Top", "Bottom", "padding", "backGroundColor", "Color", "border", "size", "style", "color", "width", "height"];
        self::showError($keywords, $property);
        if ($property['class'] && $property['name']) {
            $class = $property['class'];
            $name = $property['name'];
            @$backgroundColor = $property['backGroundColor'];
            @$Color = $property['Color'];
            @$borderSize = $property['border']['size'];
            @$borderStyle = $property['border']['style'];
            @$borderColor = $property['border']['color'];
            @$paddingTop = $property['padding']['top'];
            @$paddingRight = $property['padding']['right'];
            @$paddingLeft = $property['padding']['left'];
            @$paddingBottom = $property['padding']['bottom'];
            @$position = $property['position'];
            @$top = $property['Top'];
            @$bottom = $property['Bottom'];
            @$left = $property['Left'];
            @$right = $property['Right'];
            @$width = $property['width'];
            @$bs = $property['bs'];
            @$height = $property['height'];
            if (!$class) {
                return "<input name='$name' type='text'> ";
            } else {
                if (!file_exists(self::$stylePath . self::$filename))
                    touch(self::$stylePath . self::$filename);
                if (
                    !($backgroundColor) && !($Color) && !($borderSize) && !($borderStyle) && !($borderColor) && !($width) && !($height)
                    && !($paddingLeft) && !($paddingRight) && !($paddingTop) && !($position) && !($top) && !($bottom) && !($right) && !($left)
                    && !($paddingBottom)
                ) {
                    return "<input class='$class $bs' name='$name' type='text'>";
                } else {
                    $Style = $class ? "." . $class . "{\n" : null;
                    $Style .= $Color ? 'color' . ":" . $Color . ";\n" : '';
                    $Style .= $position ? 'position' . ":" . $position . ";\n" : '';
                    $Style .= $top ? 'top' . ":" . $top . ";\n" : '';
                    $Style .= $bottom ? 'bottom' . ":" . $top . ";\n" : '';
                    $Style .= $right ? 'right' . ":" . $top . ";\n" : '';
                    $Style .= $left ? 'left' . ":" . $left . ";\n" : '';
                    $Style .= $backgroundColor ? 'background-color' . ":" . $backgroundColor . ";\n" : '';
                    $Style .= $borderSize && $borderColor && $borderStyle ? 'border' . ":" . $borderSize . " " . $borderStyle . " " . $borderColor . ";\n" : '';
                    $Style .= $paddingTop || $paddingRight || $paddingLeft || $paddingBottom ? 'padding' . ":" . $paddingTop . " " . $paddingRight . " " . $paddingBottom . " " . $paddingLeft . ";\n" : '';
                    $Style .= $width ? 'width' . ":" . $width . ";\n" : '';
                    $Style .= $height ? 'height' . ":" . $height . ";\n" : '';
                    $Style .= "}\n";
                }
                if (strpos(file_get_contents(self::$stylePath . self::$filename), $class) !== false) {
                    if (self::$rewrite) {
                        self::write(self::$stylePath . self::$filename, $Style);
                    }
                    return "<input class='$class $bs' name='$name' type='text'>";
                } elseif ($Style) {
                    self::write(self::$stylePath . self::$filename, $Style);
                    return "<input class='$class $bs' name='$name' type='text'>";
                }
            }
        }
    }


    public static function Spinner($color = 'black')
    {
        // first step for using this  method add bootstrap to project

        $Spinner = "
            <div class='spinner-border'  role='status' style=\"color:$color\">
            ";
        return $Spinner;
    }



    public static function checkBox($class, $name)
    {


        if ($class) {
            return '
    <input type="checkbox" class="$class" name="$name" >
            ';
        }
    }

    public static function Rotation($deg, $element)
    {
        return "
        <div style='transform: rotate({$deg});'>{$element}</div>
        ";
    }

    public static function Grow($big, $element)
    {
        return "
        <div style='transform: scale({$big});'>{$element}</div>
        ";
    }

    public static function List(array $property, array $items, array $items_style)
    {
        if ($property['class'] && $property['items-class']) {
            // main Style
            $class = $property['class'];
            $items_class = $property['items-class'];
            @$style = $property['style'];
            @$display = $property['display'];
            @$borderSize = $property['border']['size'];
            @$borderStyle = $property['border']['style'];
            @$borderColor = $property['border']['color'];
            @$paddingTop = $property['padding']['top'];
            @$paddingRight = $property['padding']['right'];
            @$paddingLeft = $property['padding']['left'];
            @$paddingBottom = $property['padding']['bottom'];
            @$marginTop = $property['margin']['top'];
            @$marginRight = $property['margin']['right'];
            @$marginLeft = $property['margin']['left'];
            @$marginBottom = $property['margin']['bottom'];
            @$bgColor = $property['bg-Color'];
            @$bs_lists = $property['bs_items'];
            @$bs = $property['bs'];

            // Items Style

            @$bgColor2 = $items_style['bg-Color'];
            @$borderSize2 = $items_style['border']['size'];
            @$borderStyle2 = $items_style['border']['style'];
            @$borderColor2 = $items_style['border']['color'];
            @$paddingTop2 = $items_style['padding']['top'];
            @$paddingRight2 = $items_style['padding']['right'];
            @$paddingLeft2 = $items_style['padding']['left'];
            @$paddingBottom2 = $items_style['padding']['bottom'];
            @$marginTop2 = $items_style['margin']['top'];
            @$marginRight2 = $items_style['margin']['right'];
            @$marginLeft2 = $items_style['margin']['left'];
            @$marginBottom2 = $items_style['margin']['bottom'];


            $Style = "";
            $Style .= $bgColor ? 'background-color' . ":" . $bgColor . ";\n" : '';
            $Style .= $borderSize && $borderColor && $borderStyle ? 'border' . ":" . $borderSize . " " . $borderStyle . " " . $borderColor . ";\n" : '';
            $Style .= $paddingTop || $paddingRight || $paddingLeft || $paddingBottom ? 'padding' . ":" . $paddingTop . " " . $paddingRight . " " . $paddingBottom . " " . $paddingLeft . ";\n" : '';
            $Style .= $marginTop ? 'margin-top' . ":" . $marginTop . ";" : '';
            $Style .= $marginBottom ? 'margin-bottom' . ":" . $marginBottom . ";" : '';
            $Style .= $marginRight ? 'margin-right' . ":" . $marginRight . ";" : '';
            $Style .= $marginLeft ? 'margin-left' . ":" . $marginLeft . ";" : '';
            $Style .= $display ? 'display' . ":" . $display . ";\n" : '';
            $Style .= $style ? 'list-style' . ":" . $style . ";\n" : '';



            $Style2 = "";
            $Style2 .= $bgColor2 ? 'background-color' . ":" . $bgColor2 . ";\n" : '';
            $Style2 .= $borderSize2 && $borderColor2 && $borderStyle2 ? 'border' . ":" . $borderSize2 . " " . $borderStyle2 . " " . $borderColor2 . ";\n" : '';
            $Style2 .= $paddingTop2 || $paddingRight2 || $paddingLeft2 || $paddingBottom2 ? 'padding' . ":" . $paddingTop2 . " " . $paddingRight2 . " " . $paddingBottom2 . " " . $paddingLeft2 . ";\n" : '';
            $Style2 .= $marginTop2 ? 'margin-top' . ":" . $marginTop2 . ";" : '';
            $Style2 .= $marginBottom2 ? 'margin-bottom' . ":" . $marginBottom2 . ";" : '';
            $Style2 .= $marginRight2 ? 'margin-right' . ":" . $marginRight2 . ";" : '';
            $Style2 .= $marginLeft2 ? 'margin-left' . ":" . $marginLeft2 . ";" : '';

            echo "<ul class=\"$class $bs\" style=\"$Style\">";

            foreach ($items as $item) {
                echo "<li class=\"$items_class $bs_lists\" style=\"$Style2\">" . $item . "</li>";
            }
            echo "</ul>";

        }
    }




    public static function OptionsList(array $property, array $opetions, array $options_style)
    {
        if ($property['class'] && $property['options-class']) {
            // main Style
            $class = $property['class'];
            $options_class = $property['options-class'];
            @$borderSize = $property['border']['size'];
            @$borderStyle = $property['border']['style'];
            @$borderColor = $property['border']['color'];
            @$paddingTop = $property['padding']['top'];
            @$paddingRight = $property['padding']['right'];
            @$paddingLeft = $property['padding']['left'];
            @$paddingBottom = $property['padding']['bottom'];
            @$marginTop = $property['margin']['top'];
            @$marginRight = $property['margin']['right'];
            @$marginLeft = $property['margin']['left'];
            @$marginBottom = $property['margin']['bottom'];
            @$bgColor = $property['bg-Color'];
            @$bs_options = $property['bs_options'];
            @$name = $property['name'];
            @$bs = $property['bs'];

            // Items Style

            @$bgColor2 = $options_style['bg-Color'];
            @$borderSize2 = $options_style['border']['size'];
            @$borderStyle2 = $options_style['border']['style'];
            @$borderColor2 = $options_style['border']['color'];
            @$paddingTop2 = $options_style['padding']['top'];
            @$paddingRight2 = $options_style['padding']['right'];
            @$paddingLeft2 = $options_style['padding']['left'];
            @$paddingBottom2 = $options_style['padding']['bottom'];
            @$options_text = $options_style['text'];
            $Style = "";
            $Style .= $bgColor ? 'background-color' . ":" . $bgColor . ";\n" : '';
            $Style .= $borderSize && $borderColor && $borderStyle ? 'border' . ":" . $borderSize . " " . $borderStyle . " " . $borderColor . ";\n" : '';
            $Style .= $paddingTop || $paddingRight || $paddingLeft || $paddingBottom ? 'padding' . ":" . $paddingTop . " " . $paddingRight . " " . $paddingBottom . " " . $paddingLeft . ";\n" : '';
            $Style .= $marginTop ? 'margin-top' . ":" . $marginTop . ";" : '';
            $Style .= $marginBottom ? 'margin-bottom' . ":" . $marginBottom . ";" : '';
            $Style .= $marginRight ? 'margin-right' . ":" . $marginRight . ";" : '';
            $Style .= $marginLeft ? 'margin-left' . ":" . $marginLeft . ";" : '';

            $Style2 = "";
            $Style2 .= $bgColor2 ? 'background-color' . ":" . $bgColor2 . ";\n" : '';
            $Style2 .= $borderSize2 && $borderColor2 && $borderStyle2 ? 'border' . ":" . $borderSize2 . " " . $borderStyle2 . " " . $borderColor2 . ";\n" : '';
            $Style2 .= $paddingTop2 || $paddingRight2 || $paddingLeft2 || $paddingBottom2 ? 'padding' . ":" . $paddingTop2 . " " . $paddingRight2 . " " . $paddingBottom2 . " " . $paddingLeft2 . ";\n" : '';




            echo "<select id=\"Carbon\" name=\"$name\" style=\"$Style\" class=\"$bs $class\">";


            echo "<option value=\"0\">$options_text</option>";

            foreach ($opetions as $option) {

                echo "<option value=\"$option\" style=\"$Style2\" class=\"$bs_options $options_class\">" . $option . "</option>";
            }
            echo "</select>";

        }









    }


    public static function Expanded($element){
return "<div style='flex-grow: 1;'>
{$element}
</div>";
    }

}