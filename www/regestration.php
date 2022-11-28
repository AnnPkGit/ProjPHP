<br/>
<form method="post">
  <label>Логин: <input name="login" /></label><br/>
  <label>Пароль: <input name="password" /></label><br/>
  <label>Повторите пароль: <input name="repassword" /></label><br/>
  <label>Имя: <input name="name" /></label><br/>
  <label>Эмэйл: <input name="email" /></label><br/>
  <button>Регистрация</button>
  <br/>
</form>

<?php 
$minLen = 3;
if( isset( $_POST ) ) {   
  if(strlen($_POST['login']) < $minLen)
  {
    print_r( 'login invalid' );
    exit;
  }
  if(strlen($_POST['password']) < $minLen)
  {
    print_r( 'password invalid' );
    exit;
  }
  if($_POST['password'] !== $_POST['repassword'] )
  {
    print_r( 'passwords do not match' );
    exit;
  }
  if(strlen($_POST['name']) < $minLen)
  {
    print_r( 'name invalid' );
    exit;
  }
  if(strlen($_POST['email']) < $minLen)
  {
    print_r( 'email invalid' );
    exit;
  }
  $password = $_POST['password'];
  $login = $_POST['login'];
  $name = $_POST['name'];
  $email = $_POST['email'];

  $salt = md5(random_bytes(16)) ;
  $pass = md5(  $password . $salt ) ;

  $sqluser = "SELECT * FROM Users WHERE login = '$login'" ;
  try
  {
    $res = $connection->query( $sqluser );
    $existinglogin = $res->fetchAll(PDO::FETCH_ASSOC);
    if( $existinglogin[0]['login'] === $login)
    {
      print_r( 'user with that login already exists' );
      exit;
    }
  }
  catch( PDOException $ex ) {
     echo $ex->getMessage();
     exit;
  }

  $sql = "INSERT INTO Users VALUES( UUID(), '$login', '$name', 
  '$salt', '$pass', '$email', '123456', CURRENT_TIMESTAMP )" ;

  try{
    $connection->query( $sql ) ;
    echo "REGISTRATION OK" ;
  }
  catch( PDOException $ex ) {
    echo $ex->getMessage() ;
  }
  exit;
} ?>