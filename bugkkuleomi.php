<?php
 require('menu.php');

?>

<nav class="navbar bg-light">
  <div class="container-fluid" style="padding: 0px 75px 0px 60px;">
    <a class="navbar-brand" style="font-size:2em;"><b>북꾸러미</b></a>
      <form class="d-flex" role="search" method="POST" action="search.php">
        <input class="form-control me-2" type="text" name="book_name" placeholder="책 제목" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
  </div>
</nav>

<?php
  $query = "SELECT PHASE.PID, PHASE.SENTENCE, BOOK.NAME
           FROM PHASE,BOOK
           WHERE PHASE.BID = BOOK.BID";

  $stmt = $conn -> prepare($query);
  $stmt -> execute();

while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){//결과를 출력한다.
  if(empty($row)){
    echo "저장된 문구가 없습니다.";
  }
  $pid = $row['PID'];
  $sentence = $row['SENTENCE'];
  $name = $row['NAME'];
?>
  <p> <a href="phase_detail.php?pid=<?=$pid?>"> <?= $name?> </a></p>
  <p> <?= $sentence?> </br> </br> </a></p>
  <?php
  }
?>
