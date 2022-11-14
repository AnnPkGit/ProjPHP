<?php 

echo createFooter();

function createFooter(){
    global $x;
    global $i;
    
    $year = date("Y");
    return "<b>This is a footer $x   $year </b>" .$i;
}

?>