<?php

/**
 * Lite - Lightweight PHP
 * 
 * @package Lite
 * @author Rafael Duarte <rafael@rdnine.dev>
 */


/*
|--------------------------------------------------------------------------
| The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for the application. Just sit back and relax
|
*/

require __DIR__.'/vendor/autoload.php';

$cfg = require __DIR__. '/app/Config.php';

$routes = require __DIR__. '/app/Routes.php';

/*
|--------------------------------------------------------------------------
| Ignite
|--------------------------------------------------------------------------
|
| Just keep it simple
|
*/

$request = str_replace($cfg->path, '', $_SERVER['REQUEST_URI']);

$app = new Lite($cfg, $routes, $request);

$app::run();