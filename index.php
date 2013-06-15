<?php

/**
 * @author    Dan Saunders <dsaunders at dansaunders dot me>
 * @version   1.0
 * @copyright 2013 Dan Saunders
 */

function autoloader($class)
{
  require_once "inc/$class.class.php";
}

spl_autoload_register('autoloader');

$app = new Application(dirname(__FILE__));

require_once 'routes.php';

$app->run();