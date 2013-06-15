<?php

/**
 * @author    Dan Saunders <dsaunders at dansaunders dot me>
 * @version   1.0
 * @copyright 2013 Dan Saunders
 */

/**
 * @package Bricks
 */
class Application
{
  private $directory;
  private $router;

  /**
   * @param string $directory
   */
  public function __construct($directory)
  {
    $this->directory = $directory;

    if (array_key_exists('PATH_INFO', $_SERVER) && $_SERVER['PATH_INFO']) {
      $this->router = new Router($_SERVER['PATH_INFO']);
    } else {
      $this->router = new Router();
    }
  }

  /**
   * @param string $path
   * @param string $handler
   */
  public function get($path, $handler)
  {
    $this->router->route('GET', $path, $handler);
  }

  /**
   * @param string $path
   * @param string $handler
   */
  public function post($path, $handler)
  {
    $this->router->route('POST', $path, $handler);
  }

  /**
   * @return string
   */
  public function getDirectory()
  {
    return $this->directory;
  }

  /**
   * @return Router
   */
  public function getRouter()
  {
    return $this->router;
  }

  public function run()
  {
    if (array_key_exists('REQUEST_METHOD', $_SERVER) &&
      $_SERVER['REQUEST_METHOD']) {
      $response = $this->router->resolve($_SERVER['REQUEST_METHOD']);
    } else {
      $response = $this->router->resolve();
    }

    header("X-PHP-Response-Code: $response[0]", true, $response[0]);

    echo $response[1];
  }
}
