<?php
 require('menu.php');
?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link href=".\css\total_book.css" rel="stylesheet" type="text/css" />
<nav class="navbar bg-white">
  <div class="container-fluid" style="padding: 0px 75px 0px 60px;">
    <a class="navbar-brand" style="font-size:2em; margin-left: 27px;">전체 도서</a>
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
            ORDER BY NAME";

    $stmt = $conn -> prepare($query);
    $stmt -> execute();

  while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){//결과를 출력한다.
    $name = $row['NAME'];
    $author = $row['AUTHOR'];
    $bid = $row['BID'];
  ?>
    <div class="book_box"  OnClick="location.href ='book_detail.php?bid=<?=$bid?>'" style="cursor:pointer;">
      <div class="book_cover">
        <p class="cover_title"><?= $name?></p>
      </div>
      <div>
        <p class="book_name"> <?= $name?> </p>
        <p class="book_author"> <?= $author?> </p>
      </div>
    </div>

  <?php
  }
  ?>
</section>
<script>
  document.addEventListener('DOMContentLoaded', function() {

  });
</script>
