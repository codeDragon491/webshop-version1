<?php
// Get the userimage and save it with a unique id
$sFileExtension = pathinfo($_FILES['fileUserImage']['name'], PATHINFO_EXTENSION);
$sFolder = 'images/';
$sFileName = 'userimage-' . uniqid() . '.' . $sFileExtension;
$sSaveFileTo = $sFolder . $sFileName;
move_uploaded_file($_FILES['fileUserImage']['tmp_name'], $sSaveFileTo);

// Load all the users and decode them to an array
$sajUsers = file_get_contents('../users.txt');
$ajUsers = json_decode($sajUsers);

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
if (fnCheckEmailFormat($sNewUserEmail)) { // call the function which checks if is a valid email
    $jNewUser->email = $_POST['txtUserEmailorPhoneNumber']; // then assign an email key to the object user
} else if (fnCheckDigitFormat($sNewUserPhoneNumber)) { // call the function which checks that it should only contain                                                                     digits
    $jNewUser->phonenumber = $_POST['txtUserEmailorPhoneNumber']; // then assign a phonenumber key to the object user
}
$jNewUser->name = $_POST['txtUserName'];
$jNewUser->lastname = $_POST['txtUserLastName'];
$jNewUser->password = $_POST['txtUserPassword'];
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

function fnCheckEmailFormat($sNewUserEmail)
{ //checks if the property is valid. Called in line 6.
    $sNewUserEmail = $_POST['txtUserEmailorPhoneNumber'];
    if (!filter_var($sNewUserEmail, FILTER_VALIDATE_EMAIL)) {
        return false; // returns false if its not valid. Then it wont run the if.
    }
    return true; // else it will run the signin.
}
function fnCheckDigitFormat($sNewUserPhoneNumber)
{ //checks if the property is valid. Called in line 6.
    $sNewUserPhoneNumber = $_POST['txtUserEmailorPhoneNumber'];
    if (!preg_match("/^[0-99]+$/", $sNewUserPhoneNumber)) {
        return false; // returns false if its not valid. Then it wont run the if.
    }
    return true; // else it will run the signin.
}
