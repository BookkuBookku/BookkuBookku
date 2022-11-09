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
  <head>
    <meta charset="utf-8">
    <title> 북꾸북꾸 </title>
  </head>
  <body>
    <h1><a href="index.php">북꾸북꾸</a></h1>
    <ol>
      <li><a href="total_book.php">전체 도서</a></li>

      <li>내 서재</a></li>
      <ul>
        <li><a href="my_lib.php?id=reding">읽던 책</a></li>
        <li><a href="my_lib.php?id=like">찜한 책</a></li>
        <li><a href="my_lib.php?id=sentence">내 문구</a></li>
      </ul>

      <li><a href="bugkkuleomi.php">북꾸러미</a></li>

      <li><a href="attendance.php">출석체크</a></li>
    </ol>

    <p> <a  href="logout.php">로그아웃</a></p>

    <form method="POST" action="search.php"><!-- 검색 -->
      <p> <input  type="text" name="book_name" placeholder="책 이름"/>
        <input type="submit" value="검색"/>
      </p>
    </form>
