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

<html>
  <head>
    <meta charset="utf-8" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href=".\css\signUp.css" rel="stylesheet" type="text/css" />
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
              <form method="POST" action="signup_process.php">
                  <div class="form-group">
                     <label>ID</label>
                     <input type="text" class="form-control" name="login_id" placeholder="ID (e-mail)">
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <input type="password" class="form-control" name="pwd" placeholder="Password">
                  </div>
                  <div class="form-group">
                     <label>Name</label>
                     <input type="text" class="form-control" name="name" placeholder="Name">
                  </div>
                    <button type="submit" class="btn btn-black" value="submit">Sign up</button>
              </form>
                    <button type="submit" class="btn btn-secondary" onclick="location.href='login.php'">Back</button>
            </div>
         </div>
      </div>
</body>
</html>  