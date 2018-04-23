<?php

//GETTING FROM FILE:
$sajProducts = file_get_contents( 'products.txt' );
$ajProducts = json_decode( $sajProducts );

usort( $ajProducts, sortHighToLow);
      
function sortHighToLow ( $a, $b ) { //Sort the array using a user defined function
    return $a->price > $b->price ? -1 : 1;  //Compare the prices, evaluates to false
    // return $a->price < $b->price ? 1 : -1;  // Gives the same result
}                                                                                                                                                                                                  
$sajProducts = json_encode( $ajProducts );
echo $sajProducts;

?>