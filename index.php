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

/*
|--------------------------------------------------------------------------
| Ignite
|--------------------------------------------------------------------------
|
| Just keep it simple
|
*/

$uri = str_replace($cfg->path, '', $_SERVER['REQUEST_URI']);

$uri = explode("/", $uri);

if($uri[1] != "") {
  $request = $uri[1];
} else {
  $request = $cfg->start;
}

$app = new Lite($request);

$app::run();