<?php

/**
 * @author    Dan Saunders <dsaunders at dansaunders dot me>
 * @version   1.1
 * @copyright 2013 Dan Saunders
 */

/**
 * A simple render function to ease rendering views.
 *
 * @param string $__file
 * @param array  $__vars
 * @param string $__format
 * @param bool   $__globals
 */
function render($__file, $__vars = array(), $__format = 'html', $__globals = false)
{
  // I feel bad for this, eventually this should be safer and the ilk.
  extract($__vars);

  if ($__globals) {
    extract($GLOBALS, EXTR_SKIP);
  }

  include "views/$__file.$__format";
}
