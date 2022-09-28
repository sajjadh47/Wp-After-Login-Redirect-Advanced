<?php

add_action( "admin_enqueue_scripts", "wplra_enqueue_scripts" );

function wplra_enqueue_scripts()
{
	wp_enqueue_style ( "wplra_style_css", 	  WPLRA_PLUGIN_URL . "admin/assets/css/style.css", false );
	
	wp_enqueue_style ( "wplra_bootstrap_css", WPLRA_PLUGIN_URL . "admin/assets/css/bootstrap.css", false );
	
	wp_enqueue_script( "wplra_popper_js",     WPLRA_PLUGIN_URL . "admin/assets/js/popper.min.js", '' , true );
	
	wp_enqueue_script( "wplra_bootstrap_js",  WPLRA_PLUGIN_URL . "admin/assets/js/bootstrap.min.js", array( 'jquery', 'wplra_popper_js' ), '', true );
	
	wp_enqueue_script( "wplra_script", 		  WPLRA_PLUGIN_URL . "admin/assets/js/script.js", array( 'jquery', 'jquery-ui-autocomplete' ), '', true );
}
