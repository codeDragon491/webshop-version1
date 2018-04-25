<?php 

// Load all the users and decode them to an array
$sajUsers = file_get_contents('../users.txt');
$ajUsers = json_decode($sajUsers);

// Encode then back to a string for display
$sajUsers = json_encode( $ajUsers , JSON_UNESCAPED_UNICODE );
echo $sajUsers;

?>
