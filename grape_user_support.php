<?php
//

add_action( 'register_form', 'grape_register_form' );

function grape_register_form(){

	echo "<br/><h3>Extra Registration Form Details</h3><br/><br/>";
	createmenu("school", array('Boston College', 'Northeastern University', 'Harvard University', 'Columbia University'));
}

function createmenu($name, $option ){
	echo "<select name=\"$name\">";
	foreach ( $option as $opt ){
		echo "<option value=\"$opt\">$opt</option>";
	}
	echo "</select><br/><br/>";
}

//Save user meta
add_action( 'user_register', 'grape_user_register' );
function grape_user_register( $user_id ) {
    	update_user_meta(  $user_id, 'grape_school', $_POST['school'] );
}
