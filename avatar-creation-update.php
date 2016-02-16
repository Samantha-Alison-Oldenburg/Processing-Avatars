<?php
/*
Plugin Name: Avatar Creation Update
Plugin URI: dopeman.com
Version: 0.06
Author: G-Ma
Description: This is important
*///$mysqli = new MySQLi(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$avatar_table = 'wp_xnvw_user_avatar_info';
define( 'SHORTINIT', true );
require_once( $_SERVER['DOCUMENT_ROOT'] . '/WP5/wp-load.php' );

include $_SERVER['DOCUMENT_ROOT'] . '/WP5/wp-load.php';
$aResult = array(); 
$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// Test the connection:
if (mysqli_connect_errno()){
    // Connection Error
	$aResult['error'] ="SQL ERROR";
    exit("Couldn't connect to the database: ".mysqli_connect_error());
}  
    header('Content-Type: application/json');

	$aResult['functionName'] = $_POST['functionName']; 
	
	$aResult['uid'] = $_POST['uid'];
	
	$aResult['avatardata'] = $_POST['avatardata'];
    if( isset($_POST['functionName']) && !(isset($aResult['error']))) {

        switch($_POST['functionName']) {
            case 'update_avatar':
               if( !($_POST['uid'])) {
                   $aResult['error'] = 'Error in uid!';
               }
			   elseif (!($_POST['avatardata']) ) {
				   $aResult['error'] = ' Error in avatardata!';
			   }
               else {
				   $sqlquery = "UPDATE " . $avatar_table . " SET avatar_info = \"" . $_POST['avatardata'] . "\" WHERE user_id = \"" . $_POST['uid'] ."\"";
				   echo ($sqlquery);
					if ($db->query($sqlquery)){
						 $aResult['error'] = 'There is no error ';
					}
					else {
						$aResult['error'] = 'Query Error:' . $db->error;
					}
                   //$wpdb->update($avatar_table, array('avatar_info' => $_POST['avatardata']), array('user_id'  => $_POST['uid']) , array("%s"), array("%d") );
				  
			   }
               break;

            default:
               $aResult['error'] = 'Not found function '.$_POST['functionName'].'!';
               break;
        }

    }
   
?>