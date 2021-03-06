<?php

/**
 * @author    Dan Saunders <dsaunders at dansaunders dot me>
 * @version   1.1
 * @copyright 2013 Dan Saunders
 */

/**
 * @package Bricks
 */
class Router
{
  /**
   * @var string
   */
  private $base_url;

  /**
   * @var array
   */
  private $matches;

  /**
   * @var string
   */
  private $method;

  /**
   * @var string
   */
  private $path;

  /**
   * @var array
   */
  private $routes;

  /**
   * @param string $path
   */
  public function __construct($directory, $path = '/')
  {
    $this->base_url = str_replace('\\', '/', substr($directory, strlen($_SERVER['DOCUMENT_ROOT'])));
    $this->matches = array();
    $this->path = $path;
    $this->routes = array();
  }

  /**
   * @return string
   */
  public function getBaseUrl()
  {
    return $this->base_url;
  }

  /**
   * @return array
   */
  public function getMatches()
  {
    return $this->matches;
  }

  /**
   * @return string
   */
  public function getMethod()
  {
    return $this->method;
  }

  /**
   * @return string
   */
  public function getPath()
  {
    return $this->path;
  }

  /**
   * @todo   Have a better default 404 page, the current one is horrible
   *
   * @param  string $method
   * @return array
   */
  public function resolve($method = 'GET')
  {
    $this->method = $method;

    if (array_key_exists($method, $this->routes)) {
      foreach (array_keys($this->routes[$method]) as $pattern) {
        if (preg_match($pattern, $this->path, $this->matches)) {
          ob_start();

          $response_code = $this->routes[$method][$pattern]();
          $response_body = ob_get_contents();

          ob_end_clean();

          // If we do not receive a response code, it is a 500
          if (!isset($response_code) || !is_int($response_code)) {
            $response_code = 500;
          }

          return array($response_code, $response_body);
        }
      }
    }

    // We didn't receive anything so nothing was found
    return array(404, '404'); // Poor implementation
  }

  /**
   * @param string $method
   * @param string $pattern
   * @param string $handler
   */
  public function route($method, $pattern, $handler)
  {
    $method  = strtoupper($method);
    $handler = $handler . '_controller';

    if (!autoload_function($handler)) {
      return;
    }

    // Create a copy of the routing map
    $routes = $this->routes;

    if (!array_key_exists($method, $routes)) {
      $routes[$method] = array();
    }

    if (!array_key_exists($pattern, $routes[$method])) {
      $routes[$method][$pattern] = $handler;

      // Now save the copy, because it added a path
      $this->routes = $routes;
    }
  }
}
