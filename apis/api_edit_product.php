<?php

// Get the productimage and save it with a unique id
$sFileExtension = pathinfo($_FILES['fileProductImage']['name'], PATHINFO_EXTENSION);
$sFolder = 'images/';
$sFileName = 'productimage-' . uniqid() . '.' . $sFileExtension;
$sSaveFileTo = $sFolder . $sFileName;
move_uploaded_file($_FILES['fileProductImage']['tmp_name'], $sSaveFileTo);

//GETTING FROM FILE:
$sajProducts = file_get_contents('products.txt');
$ajProducts = json_decode($sajProducts);

//_________________________________________________________//

// getting DTA from the front end:
$sProductId = $_POST['txtUpdateProductId'];
$jNewProductName = $_POST['txtUpdateProductName'];
$jNewProductPrice = $_POST['nrUpdateProductPrice'];
$jNewProductQuantity = $_POST['nrUpdateProductQuantity'];
$jNewProductImage = $sFolder . $sFileName;

$match_found = false;
// getting it from the database
for ($i = 0; $i < count($ajProducts); $i++) {
    if ($sProductId === $ajProducts[$i]->id) { //checks if the value of the id is equal to the value in the array
        $ajProducts[$i]->name = $jNewProductName;
        $ajProducts[$i]->price = $jNewProductPrice;
        $ajProducts[$i]->quantity = $jNewProductQuantity;
        $ajProducts[$i]->image = $jNewProductImage;
        $match_found = true;
        break;
    }
}

//_________________________________________________________//
if ($match_found) {

    //PUTTING TO FILE:
    $sajNewProducts = json_encode($ajProducts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents('products.txt', $sajNewProducts);

    echo $sjResponse = '{"status":"ok", "id":"' . $sProductId . '"}';
    exit;
} else {
    echo $sjResponse = '{"status":"error"}'; // it didnt work.
    exit;
}
