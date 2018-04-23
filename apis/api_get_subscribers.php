<?php

// Load all the subsribers and decode them to an array
$sajSubscribers = file_get_contents( 'subscribers.txt' );
$ajSubscribers = json_decode($sajSubscribers);

$sajSubscribers = json_encode( $ajSubscribers , JSON_UNESCAPED_UNICODE );
echo $sajSubscribers;

?>