<select name="wplra_filter_by_last_name" class="form-control wplra_filter_select wplra_filter_by_last_name">
	<?php
		$users = get_users();

		foreach ( $users as $user )
		{
			if ( ! empty( $user->last_name ) )
			{
				echo "<option value='$user->last_name'>$user->last_name</option>";
			}
		}
	?>
</select>