<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Основы PHP</h1>
    <p>
        PHP Hypertext PreProcessor - исторически технология, расширяющая
        возможности HTML "вставками" кода. 
        Обнаруживая тег &It;<?php ?> сервер, прорабатывающий страницу,
        переходит в программный режим, создавая возможность условных, 
        циклических конструкций, а также использования переменных и 
        функций. 
    </p>
    <?php $x = 10; ?> 
    <p>
        PHP язык процедурный, хотя и поддерживает ООП. Пространств имен
        изначально не было, поэтому для разделения имен функций
        и переменных было принято начинать все переменный с знака "$".
        Типизация динамическая, читающая, но не объектная
    </p>
    <?php for( $i =0; $i < $x; $i++ ) {?>
        <p>
            <?= $i ?>
        </P>
    <?php } ?>
    <br>
    <?php for( $i =0; $i < $x; $i++ ) : ?>
        <p>
            <?php if($i % 2 == 0) : ?>
                <?= $i ?>
            <?php endif; ?>
        </P>
    <?php endfor ?>

    <?php include "footer.php" ; ?> 
</body>
</html>