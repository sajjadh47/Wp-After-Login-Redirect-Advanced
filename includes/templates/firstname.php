<select name="wplra_filter_by_first_name" class="form-control wplra_filter_select wplra_filter_by_first_name">
	<?php
		$users = get_users();

		foreach ( $users as $user )
		{
			if ( ! empty($user->first_name ) )
			{
				echo "<option value='$user->first_name'>$user->first_name</option>";
			}
		}
	?>
</select>