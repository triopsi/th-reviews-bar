<?php
/**
 * Plugin Name: TH Reviews Bar
 * Plugin URI: https://www.wiki.profoxi.de
 * Description: A simple reviews plugin. Create and display reviews on your site or posts. Includes: Widget
 * Version: 1.0.1
 * Author: triopsi
 * Author URI: http://wiki.profoxi.de
 * Text Domain: thrb
 * Domain Path: /lang/
 * License: GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0
 *
 * Thrb is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * thrb is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with thrb. If not, see https://www.gnu.org/licenses/gpl-3.0.
 *
 * @package thrb
 **/

// Definie plugin version.
if ( ! defined( 'thrb_VERSION' ) ) {
	define( 'thrb_VERSION', '1.0.1' );
}

// Loads plugin's text domain.
add_action( 'init', 'thrb_load_plugin_textdomain' );

// Admin.
require_once 'inc/thrb-admin.php';
require_once 'inc/thrb-types.php';
require_once 'inc/thrb-post-metabox.php';
require_once 'inc/thrb-help.php';
require_once 'inc/thrb-setting.php';
require_once 'inc/thrb-reviews.php';

// Shortcode.
require_once 'inc/thrb-user.php';
require_once 'inc/thrb-shortcode.php';

// Widget.
require_once 'inc/thrb-widget.php';

/**
 * Init Script. Load languages
 *
 * @return void
 */
function thrb_load_plugin_textdomain() {
	load_plugin_textdomain( 'thrb', '', 'th-reviews-bar/lang/' );
}
