<select name="wplra_filter_by_email" class="form-control wplra_filter_select wplra_filter_by_email">
	<?php
		$users = get_users();

		foreach ( $users as $user )
		{
			if ( ! empty( $user->user_email ) )
			{
				echo "<option value='$user->user_email'>$user->user_email</option>";
			}
		}
	?>
</select>