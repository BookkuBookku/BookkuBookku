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
      header("Refresh: 0; URL=total_book.php");
    }
  }
?>

<html>
  <title> 북꾸북꾸 </title>
  <head>
    <meta charset="utf-8" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href=".\css\login.css" rel="stylesheet" type="text/css" />
  </head>
<body>
<div class="sidenav">
         <div class="login-main-text" style="text-align : right;">
            <img src=".\assets\BookkubBookku_logo_v.png" alt="Logo" width="195" height="245">
         </div>
      </div>
      <div class="main">
         <div class="col-md-6 col-sm-12">
            <div class="login-form">
              <form method="POST">
                  <div class="form-group">
                     <label>ID</label>
                     <input type="text" class="form-control" name="login_id" placeholder="ID (e-mail)">
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <input type="password" class="form-control" name="pwd" placeholder="Password">
                  </div>
                    <button type="submit" class="btn btn-black">Login</button>
              </form>
                    <button type="submit" class="btn btn-secondary" onclick="location.href='signup.php'">Register</button>
            </div>
         </div>
      </div>
</body>
</html>  
