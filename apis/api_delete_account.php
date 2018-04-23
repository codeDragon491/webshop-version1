<?php

//GETTING FROM FILE:
$sajUsers = file_get_contents('users.txt');
$ajUsers = json_decode($sajUsers);

// Data comes from the browser
$sUserEmailorPhoneNumber = $_POST['txtEmailorPhoneNumber'];
$sUserPassword = $_POST['txtPassword'];

$match_found = false;
// begin looping through the array.
for ($i = 0; $i < count($ajUsers); $i++) {

    //check if the data from the frontend matches any date in the backend - Check each one, one by one.
    if (($sUserEmailorPhoneNumber === $ajUsers[$i]->email || $sUserEmailorPhoneNumber === $ajUsers[$i]->phonenumber) && ($sUserPassword === $ajUsers[$i]->password)) { //checks if the value of the username is equal to the value in the array.
        array_splice($ajUsers, $i, 1);
        $match_found = true;
        break;
    }
}

//PUTTING TO FILE:
$sajUsers = json_encode($ajUsers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents('users.txt', $sajUsers);

if ($match_found) {
    echo $sjResponse = '{"status":"ok"}';
    exit; //end the if statement and exit if it works.
} else {
    echo $sjResponse = '{"status":"error"}'; // it didnt work.
    exit;
}
