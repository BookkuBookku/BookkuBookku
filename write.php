<?php
 require('menu.php');
 $bid = $_POST['bid'];

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

<link href=".\css\write.css" rel="stylesheet" type="text/css" />
<section>
  <p class="book_name"><?= $name?></p>
  <p class="book_author">작가: <?= $author?> </p>
  <form method="POST" action="write_process.php">
    <p> <textarea maxlength = '350' cols="50" rows="10" name="sentence" placeholder="마음에 드는 문장을 작성해 주세요"></textarea></p>
    <input type="hidden" name="bid" value="<?= $bid ?>"/>
    <input type="hidden" name="id" value="<?= $id ?>"/>
    <p><input class="submit" type="submit" value="공유하기"/></p>
  </form>
</section>
 