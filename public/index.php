<?php
ini_set("display_errors", '1');
date_default_timezone_set("America/Sao_Paulo");

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});


require_once  "../vendor/autoload.php";
require_once "../src/config.php";

require_once "../src/Routes/web.php";
require_once "../src/Router.php";
