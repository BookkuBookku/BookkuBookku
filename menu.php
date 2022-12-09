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

//로그인 세션을 가져옴
 include 'session.php';
 $id = $_SESSION['id']; //로그인 한 유저를 가져옴
?>

<!doctype html>
<html>
  <title> 북꾸북꾸 </title>
  <head>
    <meta charset="utf-8">
    <link href=".\css\menu.css" rel="stylesheet" type="text/css" />
<!-- <link href="css/styles.css" rel="stylesheet"> -->
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand-lg bg-white">
  <div class="container-fluid" style="padding: 0px 75px 0px 60px; background-color:#ffffff;">
    <a href="index.php">
      <img src=".\assets\BookkubBookku_logo_h.png" alt="Logo" width="265" height="100" class="d-inline-block align-text-top">
    </a>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="total_book.php" style="font-size:1.4em; margin-left: 8px; margin-right:14px;">전체 도서</a>
            </li>
            <li class="nav-item">
             <a class="nav-link active" aria-current="page" href="my_lib.php?s=reading" style="font-size:1.4em; margin-right:14px;">내 서재</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="bugkkuleomi.php" style="font-size:1.4em; margin-right:14px;">북꾸러미</a>
            </li>
            <li class="nav-item">
             <a class="nav-link active" aria-current="page" href="attendance.php" style="font-size:1.4em; margin-right:14px;">출석체크</a>
            </li>
          </ul>
          <a class="nav-link active" aria-current="page" href="logout.php" style="font-size:1.4em;">로그아웃</a>
        </div>
      </div>
    </div>
  </nav>
