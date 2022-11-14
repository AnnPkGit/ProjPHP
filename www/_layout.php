<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP SITE</title>
</head>
<body>

    <a href="/basics">Введение PHP</a><br/>
    <a href="/fundamentals">Основы PHP</a><br/>
    <a href="/layout">Шаблонизация</a><br/>
    <a href="/home">Домой</a><br/>


    <?php
    switch( $path_parts[1] ) {
    case '': 
    case "home":
    case 'index': 
        include "index.php" ;
        break ;

    case 'fundamentals': 
        include "fundamentals.php" ;
        break ;

    case 'layout': 
        include "layout.php" ;
        break ;

    case 'basics': 
        include "basics.php" ;
        break ;

    default : 
        echo "404" ;
    }
    ?>
<hr/>
    <?php $x = 10 ; $i = 10 ; include "footer.php" ?>
</body>
</html>