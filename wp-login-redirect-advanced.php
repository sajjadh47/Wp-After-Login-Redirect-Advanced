<?php
/*
Plugin Name: After Login Redirect
Plugin URI : https://wordpress.org/plugins/wp-after-login-redirect-advanced/
Description: Redirect User After Successfully Logged in To Any Page You Want Easily. Filter By User ID, Username, User Email & User Role.
Version: 1.0.5
Author: Sajjad Hossain Sagor
Author URI: https://profiles.wordpress.org/sajjad67
Text Domain: wp-after-login-redirect-advanced

License: GPL2
This WordPress Plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

This free software is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this software. If not, see http://www.gnu.org/licenses/gpl-2.0.html.
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ---------------------------------------------------------
// Define Plugin Folders Path
// ---------------------------------------------------------
define( "WPLRA_PLUGIN_PATH", plugin_dir_path( __FILE__ ) );

define( "WPLRA_PLUGIN_URL", plugin_dir_url( __FILE__ ) );

define( "WPLRA_TEMPLATE_PATH", plugin_dir_path( __FILE__ ) . "/includes/templates/" );

add_action( "init", "wplra_add_plugin_core_file" );

function wplra_add_plugin_core_file()
{
	if( current_user_can( 'administrator' ) )
	{
		require_once WPLRA_PLUGIN_PATH . 'includes/enqueue.php';
		
		require_once WPLRA_PLUGIN_PATH . 'includes/functions.php';
		
		require_once WPLRA_PLUGIN_PATH . 'includes/dashboard.php';
	}

	require_once WPLRA_PLUGIN_PATH . 'public/redirect.php';
}
