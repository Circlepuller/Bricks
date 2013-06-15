<?php

/**
 * @author    Dan Saunders <dsaunders at dansaunders dot me>
 * @version   1.0
 * @copyright 2013 Dan Saunders
 */

function defaultHandler()
{
  echo 'Hello, World!';

  return 200;
}

$app->get('/^\\/.*$/', 'defaultHandler');