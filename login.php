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

 include 'session.php';

//입력 받은 내용과 DB와 비교하여 로그인
  if(isset($_POST['login_id']) && isset($_POST['pwd']) ){
    $login_id = $_POST['login_id'];
    $pwd = $_POST['pwd'];

    $query = "SELECT ID FROM BOOK_USER WHERE LOGIN_ID = ? AND PASSWORD = ?";
    $stmt = $conn -> prepare($query);
    $stmt -> execute(array($login_id, $pwd));

    $row = $stmt -> fetch(PDO::FETCH_ASSOC);
    //select 문의 결과가 없으면 정보가 없으므로 로그인 실해

    if (empty($row)) {
      echo "<script>alert('로그인 실패! 유효하지 않은 정보입니다.');</script>";
      header("Refresh: 0; URL=login.php");

    }else{
      $_SESSION['id'] = $row['ID'];
      header("Refresh: 0; URL=index.php");
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title> 북꾸북꾸 - Login</title>
  </head>

  <body>
    <form method="POST">
      <p> 북꾸북꾸 </p>
      <p> ID: <input  type="text" name="login_id" placeholder="id(e-mail)"/></p>
      <p> Password: <input  type="password" name="pwd" placeholder="Password"/></p>
      <input type="submit" value="Login" />
    </form>
    <p> <a  href="signup.php">회원가입</a></p>
  </body>
</html>
