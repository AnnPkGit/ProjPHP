<?php
// Аутентификация
$_AUTH = false;
if( isset ($_POST['userlogin'])
&& isset ($_POST['userpassw'])) {
    // находим данные в БД по логину 
    $sql = "SELECT * FROM Users u WHERE u. `login` = '{$_POST['userlogin']}'" ;
    try{
        $res = $connection->query( $sql ) ;
        $row = $res->fetch( PDO::FETCH_ASSOC ) ;
        if( $row ) {
            $salt = $row['salt'] ;
            $hash = md5( $_POST['userpassw'] . $salt ) ;
            if($hash == $row['pass']) {
                $_AUTH = $row;
            }
            else {
                $_AUTH = "access dinied";
            }
        }
        else
        {
            $_AUTH = "access restricted";
        }
    }
    catch( PDOException $ex ) {
        echo $ex->getMessage() ;
        exit;
    }
}

/*
Таблица пользователей
CREATE TABLE Users (
    `id`      CHAR(36)     NOT NULL  PRIMARY KEY   COMMENT 'UUID' ,
    `login`   VARCHAR(64)  NOT NULL ,
    `name`    VARCHAR(64)  NOT NULL ,
    `salt`    CHAR(32)     NOT NULL  COMMENT 'random 128 bit hex string',
    `pass`    CHAR(32)     NOT NULL  COMMENT 'password hash' ,
    `email`   VARCHAR(64)  NOT NULL ,
    `confirm` CHAR(6)      NULL      COMMENT 'email confirm code' ,
    `reg_dt`  DATETINE     NOT NULL  DEFAULT CURRENT_TIMESTAMP ,
) ENGINE = InnoDB, DEFAULT CHARSET = UTF8

INSERT INTO Users VALUES ( UUID(), 'admin', 'Rood Administrator')

CHAR(N) строка фиксированной длины (ровно N символов). Если передается меньше,
         то дополняется
VARCHAR(N) строка переменной длинны

try {
    $connection->query( 
        <<<SQL
CREATE TABLE Users (
    `id`      CHAR(36)     NOT NULL  PRIMARY KEY   COMMENT 'UUID' ,
    `login`   VARCHAR(64)  NOT NULL ,
    `name`    VARCHAR(64)  NOT NULL ,
    `salt`    CHAR(32)     NOT NULL  COMMENT 'random 128 bit hex string',
    `pass`    CHAR(32)     NOT NULL  COMMENT 'password hash' ,
    `email`   VARCHAR(64)  NOT NULL ,
    `confirm` CHAR(6)      NULL      COMMENT 'email confirm code' ,
    `reg_dt`  DATETIME     NOT NULL  DEFAULT CURRENT_TIMESTAMP 
    ) ENGINE = InnoDB, DEFAULT CHARSET = UTF8
SQL) ; 
echo "USER OK" ;
}
catch( PDOException $ex ) {
    echo $ex->getMessage() ;
}

$salt = md5(random_bytes(16)) ;
$pass = md5( '123' . $salt ) ;
$sql = "INSERT INTO Users VALUES( UUID(), 'admin', 'Rood Administrator', 
'$salt', '$pass', 'amin@i.ua', '123456', CURRENT_TIMESTAMP )" ;

try{
    $connection->query( $sql ) ;
    echo "INSERT OK" ;
}
catch( PDOException $ex ) {
    echo $ex->getMessage() ;
}
exit;
*/

?>