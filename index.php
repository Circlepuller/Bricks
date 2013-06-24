<?php

/**
 * @author    Dan Saunders <dsaunders at dansaunders dot me>
 * @version   1.1
 * @copyright 2013 Dan Saunders
 */

/**
 * @param  string $str
 * @param  string $sub
 * @return bool
 */
function endswith($str, $sub)
{
  return substr($str, strlen($str) - strlen($sub)) == $sub;
}

/**
 * @param  string $function
 * @return bool
 */
function autoload_function($function)
{
  $function = strtolower($function);

  if (endswith($function, '_controller')) {
    require_once "controllers/$function.function.php";
  } else {
    require_once "helpers/$function.function.php";
  }

  return function_exists($function);
}

/**
 * @param  string $class
 * @return bool
 */
function autoload_class($class)
{
  $class = strtolower($class);

  if (endswith($class, 'helper')) {
    require_once "helpers/$class.class.php";
  } else if (endswith($class, 'model')) {
    require_once "models/$class.class.php";
  } else {
    require_once "core/$class.class.php";
  }

  return class_exists($class);
}

session_start();
spl_autoload_register('autoload_class');
autoload_function('json_load');

$app = new Application(dirname(__FILE__));

// Load the JSON routes file (preferred) - if it exists
if (file_exists('routes.json')) {
  foreach (json_load('routes.json') as $method => $routes) {
    foreach ($routes as $pattern => $handler) {
      $app->getRouter()->route($method, $pattern, $handler);
    }
  }
}

// Load the PHP routes file - if it exists
if (file_exists('routes.php')) {
  require_once 'routes.php';
}

$app->run();