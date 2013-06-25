<?php

/**
 * @author    Dan Saunders <dsaunders at dansaunders dot me>
 * @version   1.1
 * @copyright 2013 Dan Saunders
 */

/**
 * @param string $path
 * @return string
 */
function url($path)
{
  global $app;

  return $app->getRouter()->getBaseUrl() . $path;
}
