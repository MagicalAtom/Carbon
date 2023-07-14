<?php
require_once "../vendor/autoload.php";

use Carbon\Carbon;
use Carbon\Helper\Helper as runApp;
Carbon::run(__FILE__);
Carbon::reload();

runApp::runApp(Carbon::Text(['text'=>'df','class'=>'sad']));









