<?php

/**
 * @author    Dan Saunders <dsaunders at dansaunders dot me>
 * @version   1.1
 * @copyright 2013 Dan Saunders
 */

/**
 * @param string $file
 * @return mixed
 */
function json_load($file)
{
  return json_decode(file_get_contents($file));
}
