<?php   

// Load all the users and decode them to an array
$sajSubscribers = file_get_contents('subscribers.txt');
$ajSubscribers = json_decode($sajSubscribers);

// Refactored version
$jNewSubsriber = json_decode('{}');
$jNewSubsriber->id = $sSubsriberId = uniqid();
$jNewSubsriber->email = $_POST['txtEmail'];
$jNewSubsriber->name = $_POST['txtName'];
$jNewSubsriber->lastname = $_POST['txtLastName'];
$jNewSubsriber->address = $_POST['txtAddress'];
$jNewSubsriber->latitude = $_POST['lat'];
$jNewSubsriber->longtitude = $_POST['lng'];
// Add the new user to the array
array_push( $ajSubscribers, $jNewSubsriber );

// Encode all the users and save it to the file;
$sajNewSubscribers = json_encode( $ajSubscribers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );   
//echo $sajNewUsers;
file_put_contents('../subscribers.txt', $sajNewSubscribers);

// send this to the client
$sjResponse = '{"status":"ok","id":"'.$sSubsriberId.'"}';
echo $sjResponse;
exit;
$sjResponse = '{"status":"error"}';
echo $sjResponse;
exit;

?>
