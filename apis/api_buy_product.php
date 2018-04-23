<?php

// Data comes from the browser
$sProductId = $_GET['id'];
//echo $sProductId;

//GETTING FROM FILE:
$sajProducts = file_get_contents('products.txt');
$ajProducts = json_decode($sajProducts);

$match_found = false;
// begin looping through the array.
for ($i = 0; $i < count($ajProducts); $i++) {

    //check if the data from the frontend matches any data in the backend - Check each one, one by one.
    if ($sProductId === $ajProducts[$i]->id) { //check if the value of the id is equal to the value in the array.
        $ajProducts[$i]->quantity = $ajProducts[$i]->quantity - 1; //increase the quanity of the object by one if there is a match
        $match_found = true;
        break;
    }
}

//PUTTING TO FILE:
$sajProducts = json_encode($ajProducts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents('products.txt', $sajProducts);

if ($match_found) {
    echo $sjResponse = '{"status": "ok", "quantity": "' . $ajProducts[$i]->quantity . '"}';
    exit; //end the if statement and exit if it works.
} else {
    echo $sjResponse = '{"status": "error"}'; // it didnt work.
    exit;
}
