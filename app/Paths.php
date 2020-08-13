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

if (!defined('PUBLIC')) {
    define('PUBLIC', ROOT . DS . 'public' . DS);
}
