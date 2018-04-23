<?php
// Get the userimage and save it with a unique id
$sFileExtension = pathinfo($_FILES['fileUserImage']['name'], PATHINFO_EXTENSION);
$sFolder = 'images/';
$sFileName = 'userimage-' . uniqid() . '.' . $sFileExtension;
$sSaveFileTo = $sFolder . $sFileName;
move_uploaded_file($_FILES['fileUserImage']['tmp_name'], $sSaveFileTo);

// Load all the users and decode them to an array
$sajUsers = file_get_contents('users.txt');
$ajUsers = json_decode($sajUsers);

$sNewUserEmailorPhoneNumber = $_POST['txtEmailorPhoneNumber'];

// Create the JSON ONBJECT with key values
$jNewUser = json_decode('{}');
if (count($ajUsers) === 0) { // if the aray is empty create an Admin
    //echo( "The array is empty creating admin" );
    $jNewUser->role = 'admin';
} else { // if it´s not empty create a user
    //echo( "The array isnt empty creating user" );
    $jNewUser->role = 'user';
}
// assign a random unique id value to the key id
$jNewUser->id = $sUserId = uniqid();

// Data coming from the server
/*if ( fnCheckEmailFormat ( $sNewUserEmail ) ) {          // call the function which checks if is a valid email
$jNewUser->email = $_POST['txtEmailorPhoneNumber']; // then assign an email key to the object user
}
else if ( fnCheckDigitFormat ( $sNewUserPhoneNumber ) ) {  // call the function which checks that it should only contain digits
$jNewUser->phonenumber = $_POST['txtEmailorPhoneNumber']; // then assign a phonenumber key to the object user
}*/
$jNewUser->username = $_POST['txtEmailorPhoneNumber'];
$jNewUser->name = $_POST['txtName'];
$jNewUser->lastname = $_POST['txtLastName'];
$jNewUser->password = $_POST['txtPassword'];
$jNewUser->image = $sFolder . $sFileName;

// Add the new user to the array
array_push($ajUsers, $jNewUser);

// Encode all the users and save it to the file;
$sajNewUsers = json_encode($ajUsers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents('users.txt', $sajNewUsers);

// Send this to the client
$sjResponse = '{"status":"ok","id":"' . $sUserId . '"}';
echo $sjResponse;
exit;
$sjResponse = '{"status":"error"}';
echo $sjResponse;
exit;

/*function checkEmailFormat ( $sNewUserEmail ) {

$sNewUserEmail = $_POST['txtEmailorPhoneNumber'];
if ( !filter_var( $sNewUserEmail, FILTER_VALIDATE_EMAIL ) ) {
return false;
}
return true;
}

function checkDigitFormat ( $sNewUserPhoneNumber ) {

$sNewUserPhoneNumber =  $_POST['txtEmailorPhoneNumber'];
if ( !preg_match( "/^[0-99]+$/", $sNewUserPhoneNumber ) ) {
return false;
}
return true;
}*/
