<select name="wplra_filter_by_username" class="form-control wplra_filter_select wplra_filter_by_username">
	<?php
		$users = get_users();

		foreach ( $users as $user )
		{
			if ( ! empty( $user->user_login ) )
			{
				echo "<option value='$user->user_login'>$user->user_login</option>";
			}
		}
	?>
</select>
