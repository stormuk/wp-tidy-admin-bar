<?php
/*
 * Plugin Name: WP Tidy Admin Bar
 * Description: Simple options to tidy up the uncessary clutter in the WordPres Admin Bar
 * Version: 1.0
 * Author: Adam Pope
 * Author URI: http://www.stormconsultancy.co.uk
 * License: MIT
 *
 * Copyright (c) 2012 Storm Consultancy (EU) Ltd, 
 * http://www.stormconsultancy.co.uk/
 * 
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 * 
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

// Plugin Version
define('WP_TIDY_ADMIN_BAR_CURRENT_VERSION', '1' );

$HIDE_ELEMENTS = array(
  'site-name' => "Site Name",
  'wp-logo' => 'WordPress Logo',
  'appearance' => 'Appearance',
  'avatar' => 'Avatar', 
  'my-account' => "Current User", 
  'search' => 'Search Box',
  'new-link' => 'New Link', 
  'new-media' => 'New Media',
  'new-page' => 'New Page',
  'new-plugin' => 'New Plugin',
  'new-post' => 'New Post',
  'new-theme' => 'New Theme',
  'new-user' => 'New User', 
  'new-content' => "New Content - Hides all of the 'New X' links above",
  'edit' => "Edit Content",
  'comments' => 'Comments',
  'updates' => 'Updates'
);


// Special case for avatars
if(get_option('hide_avatar') == '1'){
  add_action(
    'admin_bar_menu',
    function() {
      add_filter( 'pre_option_show_avatars', '__return_zero' );
    },
    0
  );
}

function custom_admin_bar_remove() {
  global $wp_admin_bar;
  global $HIDE_ELEMENTS;

  foreach($HIDE_ELEMENTS as $k => $v){
    if(get_option('hide_'.$k) == '1'){
      $wp_admin_bar->remove_menu($k);
    }
  } 
}

add_action('wp_before_admin_bar_render', 'custom_admin_bar_remove', 0);

require_once (dirname(__FILE__).'/wp-tidy-admin-bar-options.php');

?>