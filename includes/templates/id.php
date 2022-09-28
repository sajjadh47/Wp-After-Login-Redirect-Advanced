<select name="wplra_filter_by_id" class="form-control wplra_filter_select wplra_filter_by_id">
	<?php
		$users = get_users();

		foreach ( $users as $user )
		{

			if ( ! empty( $user->ID ) )
			{
				echo "<option value='$user->ID'>$user->ID</option>";
			}
		}
	?>
</select>