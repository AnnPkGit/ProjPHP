<?php
// одна из задача контроллера - разделить работу по методам запроса
// echo "<pre>" ; print_r( $_SERVER ) ;

session_start() ;   // сессии - перед обращением к сессии обязательно. $_SESSION[] - формируется стартом
switch( strtoupper( $_SERVER[ 'REQUEST_METHOD' ] ) ) {
case 'GET'  :
    $view_data = [] ;
    if( isset( $_SESSION[ 'reg_error' ] ) ) {
        $view_data['reg_error'] = $_SESSION[ 'reg_error' ] ;
        unset( $_SESSION[ 'reg_error' ] ) ;
        // при ошибке сохраняются введенные данные - восстанавливаем
        $view_data['login']    = $_SESSION[ 'login' ] ;
        $view_data['email']    = $_SESSION[ 'email' ] ;
        $view_data['userName'] = $_SESSION[ 'userName' ] ;
    }
    if( isset( $_SESSION[ 'reg_ok' ] ) ) {
        $view_data['reg_ok'] = $_SESSION[ 'reg_ok' ] ;
        unset( $_SESSION[ 'reg_ok' ] ) ;
    }
    include "_layout.php" ;  // ~return View
    break ;

case 'POST' :  
    // данные формы регистрации - обрабатываем
    if( empty( $_POST['login'] ) ) {
        $_SESSION[ 'reg_error' ]['login'] = "Empty login" ;
    }
    else if( empty( $_POST['userPassword1'] ) ) {
        $_SESSION[ 'reg_error' ]['first_password']= "Empty userPassword1" ;
    }
    else if( empty( $_POST['email'] ) ) {
        $_SESSION[ 'reg_error' ]['email'] = "Empty email" ;
    }
    else if( $_POST['userPassword1'] !== $_POST['confirm'] ) {
        $_SESSION[ 'reg_error' ]['password']  = "Passwords mismatch" ;
    } else {
        try {
            $prep = $connection->prepare( 
                "SELECT COUNT(id) FROM Users u WHERE u.`login` = ? " ) ;
            $prep->execute( [ $_POST['login'] ] ) ;
            $cnt = $prep->fetch( PDO::FETCH_NUM )[0] ;
        }
        catch( PDOException $ex ) {
            $_SESSION[ 'reg_error' ] = $ex->getMessage() ;
        }
        if( $cnt > 0 ) {
            $_SESSION[ 'reg_error' ]['login'] = "Login in use" ;
        }
    }
    if( isset( $_FILES['avatar'] ) ) {
        if( $_FILES['avatar']['error'] !== 0 ) { 
            $_SESSION[ 'reg_error' ]['avatar'] = "Broken avatar file" ;   
        }
        if( $_FILES['avatar']['size'] <= 0 ) {   
            $_SESSION[ 'reg_error' ]['avatar'] = "File is too small" ;
        }
        if(check_extencion($_FILES['avatar']['name']) === false){
            $_SESSION[ 'reg_error' ]['avatar'] = "Wrong file format" ;
        }
    }
    else {
        $_SESSION[ 'reg_error' ]['avatar'] = "Choose avatar" ;
    }
    if( empty( $_SESSION[ 'reg_error' ] ) ) {
        // подключаем фукнцию отправки почты
        @include_once "helper/send_email.php" ;
        if( ! function_exists( "send_email" ) ) {
            $_SESSION[ 'reg_error' ] = "Inner error" ;
        }
    }
    if( empty( $_SESSION[ 'reg_error' ] ) ) {  // не было ошибок выше
        // $_SESSION[ 'reg_error' ] = "OK" ;
        $salt = md5( random_bytes(16) ) ;
        $pass = md5( $_POST['confirm'] . $salt ) ;
        $confirm_code = bin2hex( random_bytes(3) ) ;
        $avatar = rand(1, 10000000) . $_FILES['avatar']['name'];
    
        send_email( $_POST['email'], 
            "phpsite.local Email verification", 
            "<b>Hello, {$_POST['userName']}</b><br/>
            Type code <strong>$confirm_code</strong> to confirm email<br/>
            Or follow next <a href='https://phpsite.local/confirm?code={$confirm_code}&email={$_POST['email']}'>link</a>" ) ;

        $sql = "INSERT INTO Users(`id`,`login`,`name`,`salt`,`pass`,`email`,`confirm`,`avatar`) 
                VALUES(UUID(),?,?,'$salt','$pass',?,'$confirm_code', '$avatar')" ;
        try {
            $prep = $connection->prepare( $sql ) ;
            $prep->execute( [ $_POST['login'], $_POST['userName'], $_POST['email'] ] ) ;
            $_SESSION[ 'reg_ok' ] = "Reg ok" ;

            move_uploaded_file( 
            $_FILES['avatar']['tmp_name'],
            './avatars/' . $avatar
            ) ;          
        }
        catch( PDOException $ex ) {
            $_SESSION[ 'reg_error' ]['exception'] = $ex->getMessage() ;
        }
    }
    else {  // были ошибки - сохраняем в сессии все введенные значения (кроме пароля)
        $_SESSION['login']    = $_POST['login'] ;
        $_SESSION['email']    = $_POST['email'] ;
        $_SESSION['userName'] = $_POST['userName'] ;
    }

    // echo "<pre>" ; print_r( $_POST ) ;
    // на запросы кроме GET (кроме API) всегда возвращается redirect
    header( "Location: /" . $path_parts[1] ) ;
    break ;
}

function check_extencion($filename){
    $pos = strrpos( $filename, '.' ) ;         
    $ext = substr( $filename, $pos + 1 ) ;     
    switch( $ext ) {                           
        case 'png' :
        case 'jpg' :
        case 'gif' :
            return true ;  
        default:  return false ;               
    }
}

?>