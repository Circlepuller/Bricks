<?php

/**
 * @author    Dan Saunders <dsaunders at dansaunders dot me>
 * @version   1.1
 * @copyright 2013 Dan Saunders
 */

/**
 * An example controller. Controllers must be suffixed with "_controller" and
 * return an integer value representing the HTTP status code. Should a status
 * code not be returned, a 500 Internal Server Error shall be returned.
 *
 * @return int
 */
function default_controller()
{
  // Load the view rendering helper.
  autoload_function('render');

  // Render the view using the render helper we loaded earlier.
  render('default', array(
    'operational' => 'Yes!'
  ));

  /**
   * Now return a 200 OK since we've rendered the page without issue. (Or at
   * least hope so.)
   */
  return 200;
}
