<?php

//GETTING FROM FILE:
$sajUsers = file_get_contents('users.txt');
$ajUsers = json_decode($sajUsers);

// Data comes from the browser
$sUserId = $_GET['id'];
//echo $sUserId;

$match_found = false;
// begin looping through the array.
for ($i = 0; $i < count($ajUsers); $i++) {

    if ($sUserId === $ajUsers[$i]->id) { //checks if the value of the id is equal to the value in the array.
        array_splice($ajUsers, $i, 1); //delete json object/user if there is a match
        $match_found = true;
        break;
    }
}

//PUTTING TO FILE:
$sajUsers = json_encode($ajUsers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents('users.txt', $sajUsers);

if ($match_found) {
    echo $sjResponse = '{"status": "ok"}';
    exit; //end the if statement and exit if it works.
} else {
    echo $sjResponse = '{"status": "error"}'; // it didnt work.
    exit;
}
