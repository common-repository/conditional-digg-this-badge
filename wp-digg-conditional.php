<?php
/*
Plugin Name: Conditional Digg Badge
Plugin URI: http://www.earn-web-cash.com/scripts-plugins-and-modules/wp-plugin-digg-badge/
Description:  This is a simple plugin that automatically adds a Digg badge to your articles - with a twist.  It queries the Digg server to see if your article already has a threshhold of Diggs (i.e. 10), and only displays the badge if your article has some popularity.
Version: 1.1
Author: Brian Rock
Author URI: http://www.earn-web-cash.com
*/

/********************************************************************
 Copyright Information (GNU GPL)
 
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

********************************************************************/

add_filter('the_content', 'wpDiggConditional');
add_action('wp_head', 'wpDiggScript');

function wpDiggScript() {
	$root = get_option('siteurl');
	echo "\r\n" . '<script src="' . $root . '/wp-content/plugins/conditional-digg-this-badge/wp-digg-conditional.js" type="text/javascript"></script>' . "\r\n";
	
	//  If you use prototype.js already, you can comment out this line
	echo '<script src="' . $root . '/wp-content/plugins/conditional-digg-this-badge/prototype.js" type="text/javascript"></script>' . "\r\n";
}

function wpDiggConditional($content = '') {
	if (is_single() || is_page()) {
		$root = get_option('siteurl');
		$postID = get_the_ID();
		$permalink = get_permalink();
	
		$addition = '<div id="wpDiggBadge-' . $postID. '"><script type="text/javascript">checkDigg("' . $permalink. '", "' . $postID. '", "' . $root . '"); </script></div>';
	
		return $addition . $content;
	} else {
		return $content;
	}
}
