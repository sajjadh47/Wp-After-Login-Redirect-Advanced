<?php

if ( isset( $_POST['wplra_login_redirect_filter_reset'] ) )
{
		if ( ! isset( $_POST['wplra_login_redirect_filters_fields_submit'] )
	    	|| ! wp_verify_nonce( $_POST['wplra_login_redirect_filters_fields_submit'], 'wplra_login_redirect_filters_values_submit' )
		)
		{
		   function wplra_reset_nonce_error_message()
		   {
				$class = 'notice notice-warning';
				
				$message = __( 'Sorry, your nonce did not verify.', 'wplra' );

				printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
			}

			add_action( 'admin_notices', 'wplra_reset_nonce_error_message' );

		exit;
	}
	else
	{
		if( current_user_can( 'administrator' ) )
		{
			delete_option( "wplra_login_redirect_filters" );

			update_option( "wplra_login_redirect_enable", 'off' );

			function wplra_reset_success_message()
			{
				$class = 'notice notice-success';
				
				$message = __( 'Filters Reset Successfully', 'wplra' );

				printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
			}

			add_action( 'admin_notices', 'wplra_reset_success_message' );
		}
	}
}

add_action( "admin_head", "wplra_redirect_url_suggestion" );

function wplra_redirect_url_suggestion()
{
	$is_https = isset( $_SERVER['HTTPS'] ) && ( $_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1 )
    || isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https';

    $protocol = ( $is_https ) ? 'https://' : 'http://';

	echo

	"<script>

		var wplra_all_posts_pages_sugestion = [";

	$post_types = get_post_types( array('public'   => true, '_builtin' => false ), 'names', 'or' );

	$all_post_types = array();

	foreach ( $post_types  as $post_type )
	{	
		$all_post_types[] = $post_type;
	}

	$args = array(
		'posts_per_page'   => -1,
		'post_type'        => $all_post_types,
	);

	foreach( get_posts( $args ) as $post )
	{	
    	echo '"'. str_replace( $protocol, "", get_the_permalink( $post->ID ) ) .'",';
  	}

	echo "];";

	echo "var wplra_site_protocol = '$protocol';";

	echo "</script>";
}

function wplra_add_login_filter_templates()
{
	$files = array_slice( scandir( WPLRA_TEMPLATE_PATH ), 2 );

	foreach ( $files as $file )
	{
		require_once WPLRA_TEMPLATE_PATH . $file;
	}
}

add_action( "wp_ajax_wplra_login_redirect_filter_toggle_enable_disable", "wplra_login_redirect_filter_toggle_enable_disable" );

add_action( "wp_ajax_wplra_login_redirect_filter", "wplra_login_redirect_filter" );

function wplra_login_redirect_filter_toggle_enable_disable()
{
	if ( ! isset( $_POST['wplra_login_redirect_filters_fields_submit'] )
	    	|| ! wp_verify_nonce( $_POST['wplra_login_redirect_filters_fields_submit'], 'wplra_login_redirect_filters_values_submit' )
		)
	{
		$responce = array('error');

		$responce['message'] = 'Sorry, your nonce did not verify.';

	   	wp_send_json( $response );
	}
	else
	{
		if ( isset( $_POST['wplra_login_redirect_enable'] ) && !empty( $_POST['wplra_login_redirect_enable'] ) )
		{
			if ( $_POST['wplra_login_redirect_enable'] == 'on' )
			{
				if( current_user_can( 'administrator' ) )
				{
					update_option( "wplra_login_redirect_enable", 'on' );

					die();
				}
			}
			elseif ( $_POST['wplra_login_redirect_enable'] == 'off' )
			{
				if( current_user_can( 'administrator' ) )
				{
					update_option( "wplra_login_redirect_enable", 'off' );

					die();
				}
			}
		}
    }
}

function wplra_login_redirect_filter()
{
	if ( ! isset( $_POST['wplra_login_redirect_filters_fields_submit'] )
	    	|| ! wp_verify_nonce( $_POST['wplra_login_redirect_filters_fields_submit'], 'wplra_login_redirect_filters_values_submit' )
		)
	{
		$responce = array('error');

		$responce['message'] = 'Sorry, your nonce did not verify.';

		wp_send_json( $response );
	}
	else
	{
		if (isset( $_POST['filters'] ) )
		{
			if( current_user_can( 'administrator' ) )
			{
				update_option( "wplra_login_redirect_filters", json_encode( $_POST['filters'] ) );

				die();
			}
		}
	}
}
