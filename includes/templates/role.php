<select name="wplra_filter_by_role" class="form-control wplra_filter_select wplra_filter_by_role">
	<?php
		$roles = get_editable_roles();

		foreach ( $roles as $role_name => $role_info )
		{
			if ( ! empty( $role_name ) )
			{
				echo "<option value='$role_name'>$role_name</option>";
			}
		}
	?>
</select>