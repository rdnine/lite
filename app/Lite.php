<?php

class Lite
{
  public static $request;
  public static $extension = '.php';

  public static $cfg;
  public static $routes = [];

  public static $build = "";

  public function __construct($config, $routes, $request = "/") {
    self::$cfg = $config;
    self::$routes = $routes;
    self::$request = !empty($request) ? $request : "/";

    self::router($request);
  }

	// Where the magic happens
	public static function c2r ($args = [], $target) {

		$search = [];
		$replace = [];

		foreach ($args as $index => $value) {
			array_push($search, "{{ $index }}");
			array_push($replace, $value);
		}

		return str_replace(
			$search,
			$replace,
			$target
		);
  }
  
  public function router($route)
  {
    $route = self::parse($route);

    if(array_key_exists($route, self::$routes)) {
      if(file_exists('controllers' . DS . self::$routes[$route] . self::$extension)) {
        include 'controllers' . DS . self::$routes[$route] . self::$extension;
      } else {
        include 'controllers' . DS . "error" . DS . "404" . self::$extension;
      }
    } else {
      include 'controllers' . DS . "error" . DS . "404" . self::$extension;
    }
  }

  public function parse($route)
  {
    if($route != "/") {
      $route = ltrim($route, '/');
      $route = rtrim($route, '/');
    }

    return $route;
  }

  public static function load ($path = FALSE)
  {
		if ($path) {
      if (file_exists(SRC . 'views' . DS . "{$path}" . ".html")) {
        return file_get_contents(SRC . 'views' . DS . "{$path}" . ".html");
			}
    }
    
		return FALSE;
	}

  public static function loade ($path = FALSE)
  {
		if ($path) {
			if (file_exists(SRC . 'views' . DS . "components" . DS . "{$path}" . ".html")) {
        return file_get_contents(SRC .'views' . DS . "components" . DS . "{$path}" . ".html");
			}
		}

		return false;
	}

  public static function minifyPage($buffer)
  {
		/* origin http://jesin.tk/how-to-use-php-to-minify-html-output/ */
		$search = array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s');

		$replace = array('>', '<', '\\1');

		if (preg_match("/\<html/i", $buffer) == 1 && preg_match("/\<\/html\>/i", $buffer) == 1) {
			$buffer = preg_replace($search, $replace, $buffer);
		}

		$buffer = preg_replace('/<!--(.|\s)*?-->/', '', $buffer);

		return $buffer;
  }

  public static function render($tpl)
  {

    if(is_string($tpl)) {
      self:: $build = self::c2r(["lite-path" => self::$cfg->path], $tpl);
    } else {
      self:: $build = ".::RENDER::.::ERROR::.";
    }
  }

  public static function run()
  {
    if (!is_null(self::$build) && is_string(self::$build)) {
      echo self::minifyPage(self::$build);
    } else {
      echo ".::TEMPLATE::.::ERROR::.";
    }
  }
}