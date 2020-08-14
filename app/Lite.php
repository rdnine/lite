<?php

class Lite
{
  public static $request;
  public static $extension = '.php';

  public static $build = "";

  public function __construct($request = "/") {
    self::$request = $request;

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
    global $cfg;

    $route = self::parse($route);
    //print 'controllers' . DS . $route . self::$extension;

    if(file_exists('controllers' . DS . $route . self::$extension)) {
      include 'controllers' . DS . $route . self::$extension;
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
    global $cfg;

    if(is_string($tpl)) {
      self:: $build = self::c2r(["lite-path" => $cfg->path], $tpl);
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