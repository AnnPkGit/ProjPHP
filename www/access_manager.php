<?php

// echo "<pre>" ;
// print_r( $_SERVER ) ;
// REQUEST_URI
// include "db_connect.php";

$path = $_SERVER[ 'REQUEST_URI' ] ;
$path_parts = explode('/', $path) ;
//echo "<pre>" ; print_r( $path_parts ) ;

// switch($path_parts[1]) {
//     case ''     : 
//     case 'index'     : 
//     case 'index.php' : 
//         include "index.php" ;
//         break ;
//     default : 
//         echo "404" ;
// }

include "_layout.php" ;
?>