<?php
 require('menu.php');
 $book_name = $_POST['book_name'];
 $book_names = "%".$book_name."%";
 ?>
<nav class="navbar navbar-expand-lg bg-light">
<div class="container-fluid" style="padding: 0px 75px 0px 60px;">
  <a class="navbar-brand" style="font-size:2em;">도서 검색</a>
   <form class="d-flex" role="search" method="POST" action="search.php">
     <input class="form-control me-2" type="text" name="book_name" placeholder="책 제목" aria-label="Search">
     <button class="btn btn-outline-success" type="submit">Search</button>
   </form>
 </div>
</nav>

<?php
  $query = "SELECT NAME, BID
           FROM BOOK
           WHERE NAME LIKE ?
           ORDER BY NAME";

  $stmt = $conn -> prepare($query);
  $stmt -> execute(array($book_names));



  if(!empty($row = $stmt -> fetch(PDO::FETCH_ASSOC))){
    do{
      $name = $row['NAME'];
      $bid = $row['BID'];
    ?>
      <p> <a href="book_detail.php?bid=<?=$bid?>"> <?= $name?> </a></p>
      <?php

    }while($row = $stmt -> fetch(PDO::FETCH_ASSOC));

  }else{?>
    <p> <?=$book_name?>을(를) 포함하는 책이 없습니다.</p>
<?php
  }
  ?>
