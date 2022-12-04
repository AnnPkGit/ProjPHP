<?php

include_once "helper/send_email.php" ;
if( ! function_exists( "send_email" ) ) {
    echo "include error" ;
    exit ;
}

send_email( "denniksam@gmail.com", 
    "Email verification", 
    "<b>Hello</b><br/>Type code XXXXXX to confirm email" ) ;
    
?>