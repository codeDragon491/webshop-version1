<?php

// Load all the products and decode them to an array
$sajProducts = file_get_contents('../products.txt');
$ajProducts = json_decode($sajProducts);

// Encode then back to a string for display
$sajProducts = json_encode($ajProducts, JSON_UNESCAPED_UNICODE);
echo $sajProducts;
