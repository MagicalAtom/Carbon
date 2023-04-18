<?php
class includes
{
public static function sweetAlert(){
$load = <<<EOD
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
EOD;
echo $load;
}

public static function bootStrap(){
    $bootStrap = <<<EOD
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    EOD;
    echo $bootStrap;
}



public static function jQuery(){
    $jQuery = <<<EOD
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
EOD;
echo $jQuery;
}
public static function Tailwind(){
$tailwindCss = <<<EOD
<script src="https://cdn.tailwindcss.com"></script>

EOD;
echo $tailwindCss;
}


}