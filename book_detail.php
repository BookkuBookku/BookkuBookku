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

  <link href=".\css\book_detail.css" rel="stylesheet" type="text/css" />
  <section class="book_detail_section">
    <div class="book_cover">
      <p class="cover_title"><?= $name?></p>
    </div>
    <div class="book_info_div">
      <div class="book_info">
        <p class="book_name"> <?= $name?> </p>
        <p class="book_author"> 저자명: <?= $author?> </p>
      </div>
      <div class="buttons">
        <form method="POST" action="reading.php"><!-- 읽기 -->
          <input type="hidden" name="bid" value="<?= $bid ?>"/>
          <input type="submit" value="읽기" class="read_btn"/>
        </form>

        <form method="POST" action="book_process.php"><!-- 찜 -->
          <input type="hidden" name="bid" value="<?= $bid ?> "/>
          <input type="hidden" name="id" value="<?= $id ?>"/>
          <input type="hidden" name="status" value="like"/>
          <p> <input type="submit" value="찜" class="heart_btn"/> </p>
        </form>
      </div> 
    </div>
  </section>
 
