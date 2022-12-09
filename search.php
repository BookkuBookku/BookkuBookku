<?php
 require('menu.php');
 $book_name = $_POST['book_name'];
 $book_names = "%".$book_name."%";
 ?>

<link href=".\css\total_book.css" rel="stylesheet" type="text/css" />
<nav class="navbar navbar-expand-lg bg-light">
<div class="container-fluid" style="padding: 0px 75px 0px 60px;">
  <a class="navbar-brand" style="font-size:2em;">도서 검색</a>
   <form class="d-flex" role="search" method="POST" action="search.php">
     <input class="form-control me-2" type="text" name="book_name" placeholder="책 제목" aria-label="Search">
     <button class="btn btn-outline-success" type="submit">Search</button>
   </form>
 </div>
</nav>

<section class="total_book_section">
<?php
  $query = "SELECT NAME, AUTHOR, BID
           FROM BOOK
           WHERE NAME LIKE ?
           ORDER BY NAME";

  $stmt = $conn -> prepare($query);
  $stmt -> execute(array($book_names));


  if(!empty($row = $stmt -> fetch(PDO::FETCH_ASSOC))){
    do{
      $name = $row['NAME'];
      $author = $row['AUTHOR'];
      $bid = $row['BID'];
    ?>
      <div class="book_box"  OnClick="location.href ='book_detail.php?bid=<?=$bid?>'" style="cursor:pointer;">
        <div class="book_cover">
          <p><?= $name?></p>
        </div>
        <div>
          <p class="book_name"> <?= $name?> </p>
          <p class="book_author"> <?= $author?> </p>
        </div>
        <!-- <p> <a href="book_detail.php?bid=<?=$bid?>"></a></p> -->
      </div>
           
    <?php

    }while($row = $stmt -> fetch(PDO::FETCH_ASSOC));

  }else{?>
      <p class="message"> "<?=$book_name?>"을(를) 포함하는 책이 없습니다.</p>

  <?php
  }
  ?>
</section>