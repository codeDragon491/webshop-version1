<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
// Get the userimage and save it with a unique id
$sFileExtension = pathinfo($_FILES['fileUserImage']['name'], PATHINFO_EXTENSION);
$sFolder = 'images/';
$sFileName = 'userimage-' . uniqid() . '.' . $sFileExtension;
$sSaveFileTo = $sFolder . $sFileName;
move_uploaded_file($_FILES['fileUserImage']['tmp_name'], $sSaveFileTo);

//GETTING FROM FILE:
$sajUsers = file_get_contents('../users.txt');
$ajUsers = json_decode($sajUsers);

//_________________________________________________________//

// getting it from the front end:
$sUserId = $_POST['txtUpdateUserId'];
$sNewUserRole = $_POST['txtUpdateUserRole'];
$sNewUserEmailorPhoneNumber = $_POST['txtUpdateUserEmailorPhoneNumber'];
$sNewUserName = $_POST['txtUpdateUserName'];
$sNewUserLastName = $_POST['txtUpdateUserLastName'];
$sNewUserPassword = $_POST['txtUpdateUserPassword'];
$sNewUserImageUrl = $sFolder . $sFileName;

//_________________________________________________________//

$match_found = false;
//The is getting it from the database.
for ($i = 0; $i < count($ajUsers); $i++) {
    if ($sUserId === $ajUsers[$i]->id) { //checks if the value of the id is equal to the value in the array.
        /*if ( fnCheckEmailFormat ( $sNewUserEmail ) ) {
        $key =  $ajUsers[$i]->phonenumber;
        array_search ($key, $ajUsers);
        if ( isset ($key) ) {
        unset($ajUsers[$i]->phonenumber);// call the function which checks if is a valid email
        $ajUsers[$i]->email = $sNewUserEmailorPhoneNumber;
        }
        $ajUsers[$i]->email = $sNewUserEmailorPhoneNumber;
        // then assign an email key to the object user
        }*/
        $ajUsers[$i]->role = $sNewUserRole;
        $ajUsers[$i]->username = $sNewUserEmailorPhoneNumber;
        $ajUsers[$i]->name = $sNewUserName;
        $ajUsers[$i]->lastname = $sNewUserLastName;
        $ajUsers[$i]->password = $sNewUserPassword;
        $ajUsers[$i]->image = $sNewUserImageUrl;
        $match_found = true;
        break;
    }
}

//_________________________________________________________//

if ($match_found) {

    //PUTTING TO FILE:
    $sajNewUsers = json_encode($ajUsers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents('users.txt', $sajNewUsers);

    echo $sjResponse = '{"status":"ok", "id":"' . $sUserId . '", "role":"' . $sNewUserRole . '", "username":"' . $sNewUserEmailorPhoneNumber . '", "name":"' . $sNewUserName . '", "lastname":"' . $sNewUserLastName . '", "image":"' . $sNewUserImageUrl . '"}';
    exit; //end the if statement and exit if it works.
} else {
    echo $sjResponse = '{"status":"error"}'; // it didnt work.
    exit;
}

//_________________________________________________________//

/*function fnCheckEmailFormat ( $sNewUserEmail ){ //checks if the property is valid. Called in line 6.
$sNewUserEmail = $sNewUserEmailorPhoneNumber;
if ( !filter_var( $sNewUserEmail, FILTER_VALIDATE_EMAIL ) ){
return false; // returns false if its not valid. Then it wont run the if.
}
return true; // else it will run the signin.
}

function fnCheckDigitFormat ( $sNewUserPhoneNumber ){ //checks if the property is valid. Called in line 6.
$sNewUserPhoneNumber = $sNewUserEmailorPhoneNumber;
if ( !preg_match( "/^[0-99]+$/", $sNewUserPhoneNumber ) ){
return false; // returns false if its not valid. Then it wont run the if.
}
return true; // else it will run the signin.
}*/
