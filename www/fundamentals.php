<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP funcs</title>
</head>
<body>
    <h1>Основы языка PHP</h1>
    <h2>Общая характеристика</h2>
    <p>
        Процедурный язык интерпритируемого (REPL Read-Evaluate-Print-Loop) типа.
        Типизация - динамическая. 
        анализатор проверяет скрипт при открытии,
         но ошибки проявляются по мере выполнения.
        Есть поддержка ООП. 
    </p>
    <h2>Переменные</h2>
    <p>
        Переменные появляются в момент первого присваивания.
        Имя переменной обязательно начинается со значка доллара.
        Область видимости переменной - глобальная или внутри функции.
        Область видимости не ограничивается одним файлом 
    </p>
    <p>
        В силу "глобальной" видимости в подключенных файлах
        чекать не влияет ли переменная на глоб переменную.
        isset - проверяет определена ли переменная
        unset(name) - разрушение переменной. если необходимо быть увернным
        в том , что ранее переменной не было.
        Положительный аспект - по наличию установленной переменнойможно определить подключается
        файл к другому файлу или вызывается самостоятельно.
    </p>
    <p>
        Массивы ассоциативные
    </p>

    <div style="border: 1px solid green">
    <?php
    $x = 20;
    $x += 10;
    $x .= 10; //строковый +
    $x .= `a`;

    if( isset($x))
    { 
        echo "X already defined: $x";
        echo is_numeric( $x ) ? "Numeric" : "NaN";
    }
    else 
    {
        print('<script>console.log("X not defined")</script>');
        echo "X not defined";
    }

    echo "<br/>"; 

    // Arrays
    $arr = [];
    $arr2 = array();
    $arr[] = 10; // push
    $arr[] = 20;
    $arr[] = 30;

    $arr[10] = 'ten';
    $arr['2'] = 200;


    foreach($arr as $key => $val) {
        echo "arr[$key] = $val <br/>";
    }

    $arr[10] = `ten`;

    $arr3 = [
       'host' => 'loacalhost',
       'ip' => '127.0.0.1',
       'user' => 'admin'
    ];

    echo count($arr3), "<br/>";
    foreach($arr as $key => $val) {
        if(is_array($val)) {
            foreach($arr as $k => $v) {
                echo "arr[$key][$k] = $v <br/>";
            }
        }
        else{
            echo "arr[$key] = $val <br/>";
        }
    }

    //вложенность не ограничена 
    //$arr3['auth']['pass']
    
    echo "<br/>"; 

    const CONST_VALUE =100500;
    echo CONST_VALUE, "<br/>";

    echo sayHello();

    function sayHello($user = "Admin") {
        global $x;
        return "Hello $user"
        . CONST_VALUE
        . $x ;
    }

    ?>
    </div>
</body>
</html>