<?php 

/* Plugin Name: Grapevine
Description: This plugin stores data for Users, Events, and Bucket Lists.
Author: Catherine, Julie, Julia
Version: 0.1
Author URI: nope
*/

global $grapevine_db_version;
$grapevine_db_version = "1.0";
global $debug;
$debug = 0;

/**
 *  grapevine_install() - creates the tables that store Users, Events, and Bucket Lists.
 **/
 
 function grapevine_install() {
 	
 		global $wpdb;
 		global $grapevine_db_version;
 		require_once ( ABSPATH . 'wp-admin/includes/upgrade.php' );
 		
 		$events_table_name = $wpdb->prefix. "events";
 		$sql = "CREATE TABLE IF NOT EXISTS $events_table_name (
 			EventID INT not null auto_increment,
 			EventName varchar(100) not null,
 			LocationAddress varchar(100) not null,
 			Latitude DOUBLE not null,
 			Longitude DOUBLE not null,
 			EventPhoto varchar(50) not null,
 			PRIMARY KEY (EventID)
 		) engine = InnoDB;";
 		dbDelta ( $sql );
 		
 		$bucketlists_table_name = $wpdb->prefix. "bucketlists";
 		$sql = "CREATE TABLE IF NOT EXISTS $bucketlists_table_name (
 			BucketListID INT not null auto_increment,
 			CreatedByUser varchar(30) not null,
 			BucketListName varchar(70) not null,
 			PRIMARY KEY (BucketListID)
 		) engine = InnoDB;";
 		dbDelta ($sql);
 		
 		add_option ( "grapevine_db_version", $grapevine_db_version );
 		
  }
  register_activation_hook ( __FILE__, 'grapevine_install' );
  
  /** grapevine_deactivate() - cleans up when the plugin is deactivated,
   ** delete database tables.  Careful of the order of deletion!
   ** Usually we do not want to remove events and event registrations.
   ** Admins can remove manually if needed. 
   **/
   
 function grapevine_deactivate()
 {
 	global $wpdb;
 	
 		/** drop this first before deleting bucketlists **/
 		$table_name = $wpdb->prefix . "bucketlists";
 		$sql = "DROP TABLE IF EXISTS $table_name;";
 		// $wpdb->query ( $sql );
 		
 		/** drop this first before deleting events **/
 		$table_name = $wpdb->prefix . "events";
 		$sql = "DROP TABLE IF EXISTS $table_name;";
 		// $wpdb->query ( $sql );		
 		
 }
 register_deactivation_hook ( __FILE__, 'grapevine_deactivate');
 
 /**
  *
  * DO WE WANT TO ADD STYLESHEET HERE EVENTUALLY ??
  *
  **/
 
/* supposedly the correct way to load jquery */
add_action( 'wp_enqueue_scripts', 'load_jquery' );
function load_jquery() {
	wp_enqueue_style( 'jquery-style', "http://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-core' );	
}

 /* suppposedly the correct way to load bootstrap */
 add_action( 'wp_enqueue_scripts', 'load_bootstrap' );
 function load_bootstrap() {
 	wp_enqueue_script( 'bootstrap', 'http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js', array('jquery'), 3.3, true);
 }

/** WE CAN EVENTUALLY LOAD OUR JAVASCRIPT VALIDATION FORMS HERE **/

include 'grape_user_support.php';
add_action( 'register_form', 'grape_register_form' );

include 'home.php';
add_shortcode('home', 'launchHomePage');


include 'bucketlist.php';
add_shortcode('bucketlist', 'testBucketlist');

include 'events.php';
add_shortcode('events', 'testEvents');

include 'editprofile.php';
add_shortcode('editprofile', 'editprofile');

/** REDIRECT USER AFTER SUCCESSFUL LOGIN **/