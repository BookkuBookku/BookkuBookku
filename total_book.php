<?php
 require('menu.php');
?>
<nav class="navbar bg-light">
  <div class="container-fluid" style="padding: 0px 75px 0px 60px;">
    <a class="navbar-brand" style="font-size:2em;">전체 도서</a>
      <form class="d-flex" role="search" method="POST" action="search.php">
        <input class="form-control me-2" type="text" name="book_name" placeholder="책 제목" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
  </div>
</nav>

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