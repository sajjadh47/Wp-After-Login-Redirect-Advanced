jQuery( document ).ready( function( $ )
{
	$( document ).on( "change", ".wplra_select_filter_by_elem", function( event )
    {
		var parent = $( this ).closest( '.wplra_filtering_group_container' );
		
        var val = $( this ).val();
		
        $( parent ).find( "select" ).not( $( this ) ).hide();
		
        $( parent ).find( ".wplra_filter_by_" + val ).show();
	});

    $( document ).on( 'keydown.autocomplete', ".wplra_redirect_url", function()
    {
    	var options =
        {
    		source: wplra_all_posts_pages_sugestion,
        };

        $( this ).autocomplete( options );
    });

    $( ".wplra_site_protocol" ).text( wplra_site_protocol );

    $( "#wplra_login_redirect_filter_form .wplra_filtering_group_container" ).first().find( "span.wplra_delete_filter" ).css( "visibility", "hidden" );

    $( document ).on( "click", "span.wplra_add_more_filter", function( event )
    {
    	$( this ).closest( '.wplra_filtering_group_container' ).after( $( this ).closest( '.wplra_filtering_group_container' ).clone() );
    	
        $( '.wplra_filtering_group_container' ).not( $( "#wplra_login_redirect_filter_form .wplra_filtering_group_container" ).first() ).find( "span.wplra_delete_filter" ).css( "visibility","visible" );
    	
        $( '.wplra_filtering_group_container' ).last().find( 'select' ).not( '.wplra_select_filter_by_elem' ).hide();
    	
        $( '.wplra_filtering_group_container' ).last().find( 'select.wplra_filter_by_id' ).show();
    	
        $( '.wplra_filtering_group_container' ).last().find( '.wplra_redirect_url' ).val( '' );
    });

    $( document ).on( "click","span.wplra_delete_filter", function( event )
    {
    	$( this ).closest( '.wplra_filtering_group_container' ).remove();
    });


    $( "#wplra_login_redirect_enable" ).click( function( event )
    {
        if ( $( this ).is( ':checked' ) )
        {
            var data =
            {
                wplra_login_redirect_enable : 'on',
                action  : 'wplra_login_redirect_filter_toggle_enable_disable',
                wplra_login_redirect_filters_fields_submit   : $( "#wplra_login_redirect_filters_fields_submit" ).val()
            };

            $.post( ajaxurl, data, function( response )
            {
                $( ".wplra_login_redirect_filter_message p" ).text( "Filters Enabled!" );

                $( ".wplra_login_redirect_filter_message" ).removeClass( 'notice-warning' ).addClass( 'notice-success' ).show( 'slow' );

            });
        }
        else
        {
            var data =
            {
                redirect_enable : 'off',
                action  : 'wplra_login_redirect_filter_toggle_enable_disable',
                wplra_login_redirect_filters_fields_submit   : $( "#wplra_login_redirect_filters_fields_submit" ).val()
            };

            $.post( ajaxurl, data, function( response)
            {
                $( ".wplra_login_redirect_filter_message p" ).text( "Filters Disabled!" );

                $( ".wplra_login_redirect_filter_message" ).removeClass( 'notice-success' ).addClass( 'notice-warning' ).show( 'slow' );
            });
        }
    });

    $( "#wplra_login_redirect_filter_submit" ).click( function( event )
    {
    	event.preventDefault();

        var empty = false;

        $( ".wplra_filtering_group_container" ).each( function( index, el )
        {
            if ($( this ).find( '.wplra_redirect_url' ).val() == '' )
            {
                $( ".wplra_login_redirect_filter_message p" ).text( "Redirect URL Can not be Empty!" );

                $( ".wplra_login_redirect_filter_message" ).addClass( 'notice-warning' ).show( 'slow' );

                empty = true;

                return;
            };
        });

        if ( ! empty )
        {
            $( this ).text( 'Saving...' );

            var filters = [];

            $( ".wplra_filtering_group_container" ).each( function( index, el )
            {
                filter_by_ = $( this ).find( '.wplra_select_filter_by_elem' ).val();

                filters.push(
                {
                    filter_by       :  filter_by_,
                    filter_by_value :  $( this ).find( ".wplra_filter_by_"+  filter_by_ ).val(),
                    redirect_to_url :  $( this ).find( '.wplra_redirect_url' ).val()
                });
            });

            var data =
            {
                filters : filters,
                action  : 'wplra_login_redirect_filter',
                wplra_login_redirect_filters_fields_submit   : $( "#wplra_login_redirect_filters_fields_submit" ).val()
            };

            $.post(ajaxurl, data, function( response )
            {
                $( "#wplra_login_redirect_filter_submit" ).text( 'Settings Saved' );

                setTimeout( function()
                {
                    $( "#wplra_login_redirect_filter_submit" ).text( 'Save Changes' );

                }, 2000 );

                $( ".wplra_login_redirect_filter_message p" ).text( "Settings Saved Successfully!" );

                $( ".wplra_login_redirect_filter_message" ).removeClass( 'notice-warning' ).addClass( 'notice-success' ).show( 'slow' );
            });
        }
    });
});