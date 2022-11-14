<?php
 require('menu.php');

 $bid = $_GET['bid'];
 //$bid = $_POST['bid'];
 //기본 정보
 $query = "SELECT NAME, AUTHOR
          FROM BOOK
          WHERE BID = ?";

  $stmt = $conn -> prepare($query);
  $stmt -> execute(array($bid));

 if ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
   $name = $row['NAME'];
   $author = $row['AUTHOR'];
 }

  ?>
  <h2><?= $name?></h2>
  <p>작가: <?= $author?> </p>

  <form method="POST" action="reading.php"><!-- 읽기 -->
    <input type="hidden" name="bid" value="<?= $bid ?>"/>
    <p> <input type="submit" value="읽기"/> </p>
  </form>

  <form method="POST" action="book_like.php"><!-- 찜 -->
    <input type="hidden" name="bid" value="<?= $bid ?>"/>
    <input type="hidden" name="id" value="<?= $id ?>"/>
    <p> <input type="submit" value="찜"/> </p>
  </form>
