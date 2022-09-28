<?php

add_action( 'admin_menu', 'wplra_add_dashboard_page' );

// ---------------------------------------------------------
// Add Plugin Settings page to wp dashboard
// ---------------------------------------------------------

function wplra_add_dashboard_page()
{
	add_menu_page( "Login Redirect", "Login Redirect", "manage_options" , "wplra-login-redirect-advanced", "wplra_redirect_user_after_login", "dashicons-menu" );
}

function wplra_redirect_user_after_login()
{
	require_once WPLRA_PLUGIN_PATH . 'includes/render.php'; ?>

	<div class="wrap">
		<h2>Redirect User After Login Conditionally</h2>
		<div class="notice wplra_login_redirect_filter_message"> <p></p> </div><br>
		<form action="" method="post" id="wplra_login_redirect_filter_form">
			<div class="form-group row">
				<div class="col-sm-2" style="line-height: 35px;">Enable Redirection</div>
				<div class="col-sm-10">
					<div class="form-check">
						<div class="wplra-filter-slider">
							<input type="checkbox" name="wplra-filter-slider" class="wplra-filter-slider-checkbox" id="wplra_login_redirect_enable" <?php checked( "on", get_option( "wplra_login_redirect_enable" )); ?>>
							<label class="wplra-filter-slider-label" for="wplra_login_redirect_enable">
								<span class="wplra-filter-slider-inner"></span>
								<span class="wplra-filter-slider-circle"></span>
							</label>
						</div>
					</div>
				</div>
			</div><?php
			
			$filters = get_option( "wplra_login_redirect_filters" );

			if ( ! empty( $filters ) && $filters !== 'null' )
			{
				foreach ( json_decode( get_option( "wplra_login_redirect_filters" ) ) as $value )
				{
					wplra_prepare_filters_based_on_saved( $value->filter_by, $value->filter_by_value, $value->redirect_to_url );
				}
			}
			else
			{
				?>
				<div class="input-group mb-3 wplra_filtering_group_container">
					<div class="input-group-prepend">
						<span class="input-group-text">Redirect If</span>
					</div>
					<select name="wplra_select_filter_by_elem" id="wplra_select_filter_by_elem" class="form-control wplra_filter_select wplra_select_filter_by_elem">
						<option value="id">User ID</option>
						<option value="email">User Email</option>
						<option value="role">User Role</option>
						<option value="username">User Username</option>
					</select>
					<div class="input-group-append">
						<span class="input-group-text"> == </span>
					</div>
					<?php wplra_add_login_filter_templates(); ?>
					<div class="input-group-append">
						<span class="input-group-text">To</span>
						<span class="input-group-text wplra_site_protocol" id="wplra_site_protocol"></span>
					</div>
					<input type="text" class="form-control wplra_filter_select wplra_redirect_url" id="wplra_redirect_url" name="wplra_redirect_url" value='' placeholder="Enter Redirect URL...">
					<span class="dashicons dashicons-plus-alt wplra_add_more_filter"></span>
					<span class="dashicons dashicons-minus wplra_delete_filter"></span>
				</div>
			<?php } ?>
			<button type="submit" class="button button-secondary" name="wplra_login_redirect_filter_submit" id="wplra_login_redirect_filter_submit">Save Changes</button>
			<?php wp_nonce_field( 'wplra_login_redirect_filters_values_submit', 'wplra_login_redirect_filters_fields_submit' ); ?>
			<button type="submit" class="button button-secondary" name="wplra_login_redirect_filter_reset" id="wplra_login_redirect_filter_reset">Reset</button>
		</form>
	</div>
<?php }
