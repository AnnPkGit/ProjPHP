<?php
// контроллер подтверждения почты
// сюда можно попасть а) по ссылке из письма, тогда в параметрах есть email
// б) со страницы ввода кода, тогда в параметрах только код, но должна быть авторизация

if( empty( $_GET[ 'code' ] ) ) {   // несанкционированный переход
    echo "Неправильный код" ;
    exit ;
}

if( isset( $_GET[ 'code' ] ) ) {  // переход по ссылке из письма
    $confirm_to_search = $_GET['code'];
    $email_to_search = "";
    if (isset( $_GET[ 'email' ])) {
        $email_to_search = $_GET['email'];
    }
    else {
        $email_to_search  = $_CONTEXT['auth_user']['email'];
    }
    
    $sql = "SELECT * FROM `users` WHERE `email` = '$email_to_search' AND `confirm` = '$confirm_to_search'" ;
    try {
        $res = $connection->query( $sql ) ;   
        if($res->fetch( PDO::FETCH_ASSOC ) == NULL) {
            echo "INVALID CONFIRM CODE" ;
            exit;
        }
        else {
           $sql_update = "UPDATE Users SET `confirm` = NULL WHERE `email`='$email_to_search' AND `confirm` = '$confirm_to_search'" ;
            try {
                $res_of_update = $connection->query($sql_update );
            }
            catch( PDOException $ex ) {
                echo $ex->getMessage() ;
                exit;
            }
        }
    }
    catch( PDOException $ex ) {
        echo $ex->getMessage() ;
        exit;
    }
    echo "EMAIL CONFIRMED";
}
else {   // б) со страницы ввода кода

}
// print_r( $_GET ) ;
/* Составить запрос для подтверждения кода при известном коде и
почте (email). Подтверждением будем считать сброс сохраненного кода
в NULL
*/