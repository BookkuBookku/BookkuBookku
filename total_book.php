<?php
 require('menu.php');

?>
    <h2> 전체 도서 </h2>
<?php
  $query = "SELECT NAME, BID
           FROM BOOK
           ORDER BY NAME";

  $stmt = $conn -> prepare($query);
  $stmt -> execute();

while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){//결과를 출력한다.
  $name = $row['NAME'];
  $bid = $row['BID'];
?>

  <p> <a href="book_detail.php?bid=<?=$bid?>"> <?= $name?> </a></p>

  <?php
  }
  ?>
post방식으로 a태그 어케 넘김????
