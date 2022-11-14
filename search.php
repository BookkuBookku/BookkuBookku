<?php
 require('menu.php');
$book_name = $_POST['book_name'];
$book_name = "%".$book_name."%";
?>
    <h2>도서 검색</h2>
<?php
  $query = "SELECT NAME, BID
           FROM BOOK
           WHERE NAME LIKE ?
           ORDER BY NAME";

  $stmt = $conn -> prepare($query);
  $stmt -> execute(array($book_name));

while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){//결과를 출력한다.
  $name = $row['NAME'];
  $bid = $row['BID'];
?>

  <p> <a href="book_detail.php?bid=<?=$bid?>"> <?= $name?> </a></p>

  <?php
  }
  ?>
