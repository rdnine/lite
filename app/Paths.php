<?php

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

if (!defined('ROOT')) {
    define('ROOT', dirname(__DIR__));
}

if (!defined('ABSR')) {
    define('ABSR', $_SERVER["DOCUMENT_ROOT"]);
}

if (!defined('SRC')) {
    define('SRC', ROOT . DS . "src" . DS);
}

if (!defined('APP')) {
    define('APP', ROOT . DS . 'app' . DS);
}

if (!defined('CONTROLLERS')) {
    define('CONTROLLERS', ROOT . DS . 'controllers' . DS);
}

if (!defined('STATIC')) {
    define('STATIC', ROOT . DS . 'static' . DS);
}
