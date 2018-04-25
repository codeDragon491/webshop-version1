<?php

// Get the productimage and save it with a unique id
$sFileExtension = pathinfo($_FILES['fileProductImage']['name'], PATHINFO_EXTENSION);
$sFolder = 'images/';
$sFileName = 'productimage-' . uniqid() . '.' . $sFileExtension;
$sSaveFileTo = $sFolder . $sFileName;
move_uploaded_file($_FILES['fileProductImage']['tmp_name'], $sSaveFileTo);

// Load all the products and decode them to an array
$sajProducts = file_get_contents('../products.txt');
$ajProducts = json_decode($sajProducts); //turns the string it into an array.

//If there is no array create it!
if (!is_array($ajProducts)) { //checks the arrays validity.
    $ajProducts = []; // if its not valid then replaces the file with an empty array.
}

$jProduct = json_decode('{}'); // json object

//take and convert data from the frontend to an json object, set the value for each key one by one
$jProduct->id = $sProductId = uniqid();
$jProduct->name = $_POST['txtProductName'];
$jProduct->price = $_POST['nrProductPrice'];
$jProduct->quantity = $_POST['nrProductQuantity'];
$jProduct->image = $sFolder . $sFileName;

// Add the new json object/product to the array
array_push($ajProducts, $jProduct);

// Take the json products array and convert it to a string . With Pretty print added to improve readability for humans.
$sajNewProducts = json_encode($ajProducts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
// Save all the products to the file;
file_put_contents('products.txt', $sajNewProducts);

// Send this back to the client
$sjResponse = '{"status": "ok","id": "' . $sProductId . '"}';
echo $sjResponse;
exit;
$sjResponse = '{"status": "error"}';
exit;
echo $sjResponse;
