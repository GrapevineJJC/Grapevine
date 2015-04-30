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
  * Safely load stylesheets
  *
  **/
function safely_add_stylesheet() {
	wp_enqueue_style( 'prefix-style', plugins_url('css/grapevine.css', __FILE__) );
}
add_action( 'wp_enqueue_scripts', 'safely_add_stylesheet' );
 
add_action('init', 'google_font_style'); 
function google_font_style(){ 
    wp_register_style( 'GoogleFonts', 'http://fonts.googleapis.com/css?family=Lato:300'); 
    wp_enqueue_style( 'GoogleFonts' ); 
}
 
/* supposedly the correct way to load jquery */
add_action( 'wp_enqueue_scripts', 'load_jquery' );
function load_jquery() {
	wp_enqueue_style( 'jquery-style', "http://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" );
	wp_enqueue_script( 'jquery' );
	wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", false, null);
    wp_enqueue_script('jquery');
	wp_enqueue_script( 'jquery-ui-core' );	
	wp_enqueue_script( 'plugins/dragDropPlugin.js' );	
	wp_enqueue_script( 'plugins/accordionPlugin.js' );	
	wp_enqueue_script( 'bootstrap', "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js" );

}

//Load Bootstrap CSS and JavaScript
add_action ( 'wp_enqueue_scripts', 'bootstrap_cdn_scripts_styles', 10 );

function bootstrap_cdn_scripts_styles() {
	wp_enqueue_style( 'bootstrap-css', '//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css', array(), '3.0.3', 'all' );
	wp_enqueue_script( 'bootstrap-js', '//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js',   array(), '3.0.3', true );
}

 /* suppposedly the correct way to load bootstrap */
 add_action( 'wp_enqueue_scripts', 'load_bootstrap' );
 function load_bootstrap() {
 	wp_enqueue_script( 'bootstrap', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js', array('jquery'), 3.3, true);
 }
 
 /* loading javascript for maps */
add_action( 'wp_enqueue_scripts', 'load_javascript' );
function load_javascript() {
 	wp_enqueue_script( 'javascript', '/wp-content/plugins/grapevine/maps.js' );
}
 
/* loading Google Maps API */
// <script src="http://maps.googleapis.com/maps/api/js"></script>

/**
 * This function used to register google map script.
 * @author Flipper Code <hello@flippercode.com>
 * @version 1.0.0
 * @package Maps
 * 4/27/15 ~ Grabbed this from another plugin - JC
 */
function wpgmp_scripts_method(){
    wp_enqueue_script('wpgmp_map','http://www.google.com/jsapi');
}


 
 //LOAD PLUGIN
 function load_grapevine(){
    //wp_enqueue_script( 'grapevine_script', plugins_url( 'plugins/dragDropPlugin.js' , __FILE__ ), array(), null, true);
}
add_action( 'wp_enqueue_scripts', 'load_grapevine' );

/** WE CAN EVENTUALLY LOAD OUR JAVASCRIPT VALIDATION FORMS HERE **/

include 'grape_user_support.php';
add_action( 'register_form', 'grape_register_form' );

include 'home.php';
add_shortcode('home', 'launchHomePage');

include 'feed.php';
add_shortcode('feed', 'feed');

include 'bucketlist.php';
add_shortcode('bucketlist', 'testBucketlist');

include 'events.php';
add_shortcode('events', 'testEvents');

include 'editprofile.php';
add_shortcode('editprofile', 'editprofile');

include 'addToBucketlist.php';
add_shortcode('addToBucketlist', 'addToBucketlist');

include 'maps.php';
add_shortcode('maps', 'maps');

include 'turnToXML.php';
add_shortcode('turnToXML', 'turnToXML');

include 'edit_propic.php';
add_shortcode('propic', 'propic');



/** Removes the admin bar for anyone who is not the administrator (grapevine_admin) **/
//add_filter( 'show_admin_bar', '__return_false' );	//removes admin bar for everyone, including grapevine_admin
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
 	 	show_admin_bar(false);
	}
}

function my_wp_nav_menu_args( $args = '' ) {
	if( !is_user_logged_in() ) {
		$args['menu'] = 'logged-out';
	}
		return $args;
	}
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );




/** REDIRECT USER AFTER SUCCESSFUL LOGIN **/
add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );
function my_login_redirect( $redirect_to, $request, $user ) {

	//echo 'IN MY_LOGIN_REDIRECT\n';
	
	//is there a user to check?
	$current_user = wp_get_current_user();
	$username = $current_user->user_login;
	
	//echo 'user is '.$username;
	global $wpdb;
	
	return home_url("/?page_id=66");
// 				
// 	//if ( isset( $user->returning_user ) && is_array( $user->returning_user) ) {
// 		echo '$user->returning_user is'.$user->returning_user;
// 		if ($user->returning_user == 0 ) {
// 			echo '$user->returning_user is'.$user->returning_user.' in the if statement!';
// 			// redirect them to the default place
// 			$wpdb->update( 'wp_grape_users',
// 				array(	'returning_user' => 1),
// 				array(	'ID' => $user->ID),			// WHERE clause
// 				array( '%d' ),						// data format
// 				array( '%d' )	);						// WHERE format
// 				
// 			//return home_url("/?page_id=44");	//First time logging in, make bucketlist.
// 		} else {
// 				//echo '$user->returning_user is'.$username;
// 			//return home_url("/?page_id=2"); // Else, returning user, bring to events page
// 		}
	//}
}