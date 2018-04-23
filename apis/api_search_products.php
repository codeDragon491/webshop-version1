<?php

//DATA coming from the BROWSER
$sSearch = $_GET['search'];
//TURN it into UPPERCASE
strtoupper($sSearch);

//GETTING from the TEXT FILE:
$sajProducts = file_get_contents('products.txt');
$ajProducts = json_decode($sajProducts);

$match_found = false;
//Collect all matching result in an array
$ajSearchResult = array();
//LOOPING THROUGH THE ARRAY OF PRODUCTS
for ($i = 0; $i < count($ajProducts); $i++) {

    if ($sSearch === $ajProducts[$i]->name) {
        $ajSearchResult[] = $ajProducts[$i];
        /*$ajSearchResult = array_filter($ajProducts, function ($jProduct) {
        return $jProduct->name === 'A';
        });*/
        $match_found = true;
    }
}
//if there is a match display the product
if ($match_found) {
    echo json_encode($ajSearchResult);
    exit;
}
//if not display ALL products
else {
    echo json_encode($ajProducts);
    exit;
}
