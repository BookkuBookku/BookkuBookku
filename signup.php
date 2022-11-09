<?php
// DB와 연결
  $tns = "(DESCRIPTION=
          (ADDRESS_LIST= (ADDRESS=(PROTOCOL=TCP)(HOST=localhost)(PORT=1521)))
          (CONNECT_DATA= (SERVICE_NAME=XE)) )";
  $dsn = "oci:dbname=".$tns.";charset=utf8";
  $username = 'BookkuBookku'; $password = '0000';
  try {
    $conn = new PDO($dsn, $username, $password);
  } catch (PDOException $e) {
    echo("에러 내용: ".$e -> getMessage());
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>북꾸북꾸 - 회원가입</title>
  </head>

  <body>
    <form method="POST" action="signup_process.php">
      <h2>북꾸북 회원가입</h2>
        <p> ID(e-mail): <input  type="text" name="login_id" placeholder="e-mail형식"/></p>
        <p> Password: <input  type="password" name="pwd" placeholder="Password"/></p>
        <p> 이름: <input  type="text" name="name" placeholder="이름"/></p>
        <p><input type="submit" value="submit"/></p>
        <p> <a  href="login.php">돌아가기</a></p>
      </form>
  </body>
</html>
