<?php

session_start();

// Load all the users and decode them to an array
$sajUsers = file_get_contents('users.txt');
$ajUsers = json_decode($sajUsers); //turns the string into an array.

// Data comes from the browser
$sUserEmailorPhoneNumber = $_POST['txtEmailorPhoneNumber'];
$sUserPassword = $_POST['txtPassword'];

$match_found = false;
// begin looping through the array.
for ($i = 0; $i < count($ajUsers); $i++) {

    $sUserId = $ajUsers[$i]->id;
    $sUserRole = $ajUsers[$i]->role;
    $sUserEmailorPhoneNumber == $ajUsers[$i]->username;
    //$sUserEmailorPhoneNumber == $ajUsers[$i]->email || $sUserEmailorPhoneNumber == $ajUsers[$i]->phonenumber;
    $sUserName = $ajUsers[$i]->name;
    $sUserLastName = $ajUsers[$i]->lastname;
    $sUserImageUrl = $ajUsers[$i]->image;

    /*if ( ( $sUserEmailorPhoneNumber == $ajUsers[$i]->email || $sUserEmailorPhoneNumber == $ajUsers[$i]->phonenumber ) && ( $sUserPassword == $ajUsers[$i]->password ) ) { //checks if the value of the email or phonenumber and password is equal to the value in the array*/
    if ($sUserEmailorPhoneNumber === $ajUsers[$i]->username && $sUserPassword === $ajUsers[$i]->password) {
        $match_found = true;
        break;
    }
}

if ($match_found) {
    $_SESSION['sUserId'] = $sUserId;
    echo $sjResponse = '{"status":"ok", "id":"' . $sUserId . '", "role":"' . $sUserRole . '", "username":"' . $sUserEmailorPhoneNumber . '", "name":"' . $sUserName . '", "lastname":"' . $sUserLastName . '", "image":"' . $sUserImageUrl . '"}';
    exit; //end the if statement and exit if it works.
} else {
    echo $sjResponse = '{"status":"error"}'; // it didnt work.
    exit;
}
