<?php

//GETTING FROM FILE:
$sajProducts = file_get_contents('../products.txt');
$ajProducts = json_decode($sajProducts);

usort($ajProducts, sortLowToHigh);
function sortLowToHigh($a, $b)
{ //Sort the array using a user defined function
    return $a->price < $b->price ? -1 : 1; //Compare the prices, evalutes to true
    // return $a->price > $b->price ? 1 : -1; // Gives the same result
}

$sajProducts = json_encode($ajProducts);
echo $sajProducts;
