<?php

function wplra_prepare_filters_based_on_saved( $filter_by, $filter_by_value, $redirect_to_url )
{ ?>
	<div class="input-group mb-3 wplra_filtering_group_container">
	  	<div class="input-group-prepend">
	    	<span class="input-group-text">Redirect If</span>
	  	</div>

	  	<select name="wplra_select_filter_by_elem" id="wplra_select_filter_by_elem" class="form-control wplra_filter_select wplra_select_filter_by_elem">
	  		<option value="id" <?php echo $filter_by == "id" ? 'selected' : ''; ?>>User ID</option>
	  		<option value="email" <?php echo $filter_by == "email" ? 'selected' : ''; ?>>User Email</option>
	  		<option value="role" <?php echo $filter_by == "role" ? 'selected' : ''; ?>>User Role</option>
	  		<option value="username" <?php echo $filter_by == "username" ? 'selected' : ''; ?>>User Username</option>
		</select>

		<div class="input-group-append">
	    	<span class="input-group-text"> == </span>
	  	</div>

		<select name="wplra_filter_by_id" class="form-control wplra_filter_select wplra_filter_by_id wplra_saved_filter" <?php echo $filter_by == 'id' ? " style='display:block;'":""; ?>>
			<?php

				$users = get_users();

				foreach ( $users as $user )
				{
					if ( ! empty( $user->ID ) )
					{
						echo "<option value='$user->ID'";

						if ( $filter_by == 'id' )
						{	
							if ( $filter_by_value == $user->ID )
							{	
								echo ' selected ';
							}
						}

						echo ">$user->ID</option>";
					}
				}
			?>

		</select>

		<select name="wplra_filter_by_email" class="form-control wplra_filter_select wplra_filter_by_email" <?php echo $filter_by == 'email' ? " style='display:block;'":""; ?>>
			<?php
				
				$users = get_users();

				foreach ( $users as $user )
				{
					if ( ! empty( $user->user_email ) )
					{
						echo "<option value='$user->user_email'";

						if ( $filter_by == 'email' )
						{
							if ( $filter_by_value == $user->user_email )
							{
								echo ' selected ';
							}
						}

						echo ">$user->user_email</option>";
					}
				}
			?>
		</select>

		<select name="wplra_filter_by_role" class="form-control wplra_filter_select wplra_filter_by_role" <?php echo $filter_by == 'role' ? " style='display:block;'":""; ?>>
			<?php
				
				$roles = get_editable_roles();

				foreach ( $roles as $role_name => $role_info )
				{
					if ( ! empty( $role_name ) )
					{
						echo "<option value='$role_name'";

						if ( $filter_by == 'role' )
						{
							if ( $filter_by_value == $role_name )
							{
								echo ' selected ';
							}
						}

						echo ">$role_name</option>";
					}
				}
			?>
		</select>

		<select name="wplra_filter_by_username" class="form-control wplra_filter_select wplra_filter_by_username" <?php echo $filter_by == 'username' ? " style='display:block;'":""; ?>>
			<?php

				$users = get_users();

				foreach ( $users as $user )
				{
					if ( ! empty( $user->user_login ) )
					{
						echo "<option value='$user->user_login'";

						if ( $filter_by == 'username' )
						{
							if ( $filter_by_value == $user->user_login )
							{
								echo ' selected ';
							}
						}
					
						echo ">$user->user_login</option>";
					}
				}
			?>
		</select>

  		<div class="input-group-append">
		    <span class="input-group-text">To</span>
			<span class="input-group-text wplra_site_protocol" id="wplra_site_protocol"></span>
		</div>

		 <input type="text" class="form-control wplra_filter_select wplra_redirect_url" id="wplra_redirect_url" name="wplra_redirect_url" value="<?php echo $redirect_to_url; ?>" placeholder="Enter Redirect URL...">
			<span class="dashicons dashicons-plus-alt wplra_add_more_filter"></span>
			<span class="dashicons dashicons-minus wplra_delete_filter"></span>
		</div>
<?php }
