<?php
/*
Plugin Name: Processing Avatars
Plugin URI: dopeman.com
Version: 0.06
Author: G-Ma
Description: Nae domain dopeman.com
*/
//$mysqli = new MySQLi(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// create table

global $processing_avatar_db_version;
$processing_avatar_db_version = '1.0';

function install() {
	global $wpdb;
	global $processing_avatar_db_version;

	$table_name = $wpdb->prefix . 'avatar_table';

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		user_id mediumint(9) NOT NULL AUTO_INCREMENT,
		conndition text NOT NULL,
		name text NOT NULL,
		avatar_info text NOT NULL,
		url varchar(55) DEFAULT '' NOT NULL,
		points int NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'processing_avatar_db_version', $processing_avatar_db_version );
}

function processing_avatar_install_data() {
	global $wpdb;

	$welcome_name = 'Mr. WordPress';
	$welcome_text = 'Congratulations, you just completed the installation!';

	$table_name = $wpdb->prefix . 'avatar_table';

	// $wpdb->insert(
	// 	$table_name,
	// 	array(
	// 		'user_id' => $user_id,
	// 		'name' => $welcome_name,
	// 		'text' => $welcome_text,
	// 	)
	// );
}
register_activation_hook( __FILE__, 'processing_avatar_install' );
register_activation_hook( __FILE__, 'processing_avatar_install_data' );
// rest of plugin

$avatar_table =  $table_prefix  . 'user_avatar_info';

check_for_users_without_avatars();

function check_for_users_without_avatars()
{
	global $avatar_table;
	global $wpdb;

	$link = new MySQLi(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if ($link->connect_errno) {
    	printf("Connect failed: %s\n", $link->connect_error);
    	exit();
	}

	$user_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->users" );


	$avatar_info_count = $wpdb->get_var( "SELECT COUNT(*) FROM " . $avatar_table);


	if($users_count != $avatar_info_count)
	{
		$fetch_users_count_query = "SELECT ID, user_login FROM " . $users_table . " ORDER by ID";
		$fetch_users_result = $wpdb->get_results($fetch_users_count_query, ARRAY_A);

		foreach($fetch_users_result as $row)
		{
			$id = $row['ID'];
			if ($wpdb->get_results("SELECT * FROM " . $avatar_table . " WHERE user_id = " . $id) == NULL)
			{
				$insert_data = array(
						'user_id' => $row['ID'],
						'user_login' => $row['user_login']
					);

				if (!($wpdb->insert( $avatar_table, $insert_data)))
				{
					$message = "wrong answer";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
			}
		}
	}

}

function json_get_user_avatar_info($user_id){
	global $avatar_table;
	global $wpdb;
	$query = "SELECT * FROM " . $avatar_table . " WHERE user_id = " . $user_id;
	$result = $wpdb->get_results($query, ARRAY_A);

	return wp_json_encode($result);
}



function get_user_avatar_info($user_id)
{
	global $avatar_table;
	global $wpdb;
	$query = "SELECT * FROM " . $avatar_table . " WHERE user_id = " . $user_id;
	$result = $wpdb->get_row($query, ARRAY_A);

	if ($result['avatar_info'] != NULL)
	{
		return $result['avatar_info'];
	}
	else
	{
		$message = "There seems to be a problem with your avatar... Sorry. Try making your avatar again by editing your profile. " .
			"In the meantime, a default avatar will be displayed. ";
			echo $result;
	//	echo "<script type='text/javascript'>alert('$message');</script>";
		return '2, 6, 4, 2, 5, 0, 0, 0, 0, 0, 0';
	}
}

function processing_get_avatar($avatar, $user, $size, $default, $alt = '')
{
	/*I borrowed this code from buddy press*/
	// If passed an object, assume $user->user_id
	if ( is_object( $user ) ) {
		if ( isset( $user->user_id ) ) {
			$id = $user->user_id;
		} else {
			$id = $user->ID;
		}

	// If passed a number, assume it was a $user_id
	} elseif ( is_numeric( $user ) ) {
		$id = $user;

	// If passed a string and that string returns a user, get the $id
	} elseif ( is_string( $user ) && ( $user_by_email = get_user_by( 'email', $user ) ) ) {
		$id = $user_by_email->ID;
	}

	/*This uncommented garbage is my code*/
	$test_var = true;

	$html_width = 'width = "' . $size . '" ';
	$html_height = 'height = "' . $size . '" ';

	$avatar_data = get_user_avatar_info($id);
	$json_data = json_get_user_avatar_info($id);

	 if ($test_var)
	 $avatar = '<script src="'.plugin_dir_url( $file ). 'processing-avatars/processing-1.4.8.js"></script> ' . '<canvas id="avatarSketch" data-processing-sources="'. plugin_dir_url( $file ). 'processing-avatars/sketch_151226a/sketch_151226a.pde" width="26" height="26" ></canvas>' . '<script  type="application/javascript">' . ' var pjs = Processing.getInstanceById("avatarSketch"); var json = '. $json_data.  ' ;
		  // var data = json; if (data){ for (p = 0, end = data.parts.length; p<end;p++){
			// 	var part = data.parts[p]; pjs.addPart(part.sImage, part.W, part.H, part.posX, part.pasY);}}
			// 	console.log(data);
				console.log(json);
				//pjs.addPart(json.sImage, json.width, json.height, json.xPos, json.yPos);

				</script>';

	//  $avatar = '<script src="'.plugin_dir_url( $file ). 'processing-avatars/processing-1.4.8.js"></script> ' . '<canvas data-processing-sources="'. plugin_dir_url( $file ). 'processing-avatars/sketch_151226a/sketch_151226a.pde" width="26" height="26" ></canvas>' . '<script  type="application/javascript">' . ' var arg = [0, 0, ' . 26 . ', ' . 26 . ', '. ' 2, 6, 4, 2, 5, 0, 0, 0, 0, 0, 0' . ' ]; ' . ' </script>';
	 else
	// 	$avatar = '<script src="http://www.scigamescrew.com/public_html/staging/wp-content/plugins/processing-avatars//processing-1.4.8.js"></script> ' . '<canvas data-processing-sources="http://www.scigamescrew.com/public_html/staging/wp-content/plugins/processing-avatars//sketch_151226a.pde" ' . $html_width . $html_height . '></canvas>' . '<script  type="application/javascript">' . ' var arg = [0, 0, ' . $size . ', ' . $size . ', ' . $avatar_data . ']; ' . ' </script>';
	 	$avatar = '<script src="'.plugin_dir_url( $file ). 'processing-avatars/processing-1.4.8.js"></script> ' . '<canvas data-processing-sources="'. plugin_dir_url( $file ). 'processing-avatars/sketch_151226a/sketch_151226a.pde" width="$html_width" height="$html_height" ></canvas>' . '<script  type="application/javascript">' . ' var arg = [0, 0, ' . $size . ', ' . $size . ', '.  $avatar_data . ' ]; ' . ' </script>';
// plugin_dir_url( $file )
	return $avatar;
}
add_filter( 'get_avatar', 'processing_get_avatar', 1019, 5 );
?>
