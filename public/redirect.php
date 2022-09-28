<?php

function wplra_redirect_after_login( $redirect_to, $request, $user )
{
	$wplra_redirect_enabled = get_option( "wplra_login_redirect_enable" );

	if ( $wplra_redirect_enabled == 'on' )
	{
		if ( ! empty( get_option( "wplra_login_redirect_filters" ) ) )
		{
			foreach ( json_decode( get_option( "wplra_login_redirect_filters" ) ) as $value )
			{
				switch ( $value->filter_by )
				{
					case "id":

						if ( isset( $user->ID ) )
						{
							if ( $user->ID == $value->filter_by_value )
							{
								return $value->redirect_to_url;
							}
							else
							{
								return $redirect_to;
							}
						}
					
					break;

					case 'email':
						
						if ( isset($user->user_email ) )
						{
							if ( $user->user_email == $value->filter_by_value )
							{
								return $value->redirect_to_url;
							}
							else
							{
								return $redirect_to;
							}
						}

					break;

					case 'role':
						
						if ( isset( $user->roles ) && is_array( $user->roles ) )
						{
					        //check for role
					        if ( in_array( $value->filter_by_value, $user->roles ) )
					        {
					            return $value->redirect_to_url;
					        }
					        else
					        {
								return $redirect_to;
							}
					    }
					
					break;

					case 'username':
						
						if ( isset( $user->user_login ) )
						{
							if ( $user->user_login == $value->filter_by_value )
							{
								return $value->redirect_to_url;
							}
							else
							{
								return $redirect_to;
							}
						}
					
					break;
					
					default:
						
						return $redirect_to;
					break;
				}
			}
		}
	}
	else
	{
		return $redirect_to;
	}
}

add_filter( 'login_redirect', 'wplra_redirect_after_login', 10, 3 );
