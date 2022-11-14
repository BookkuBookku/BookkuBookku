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
  <br/> <br/>
  <h2><?= $name?></h2>
  <p>작가: <?= $author?> </p>

  <form method="POST" action="reading.php"><!-- 읽기 -->
    <input type="hidden" name="bid" value="<?= $bid ?>"/>
    <p> <input type="submit" value="읽기"/> </p>
  </form>
