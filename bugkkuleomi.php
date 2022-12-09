<?php
 require('menu.php');

?>

<link href=".\css\bookkuleomi.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css"> 
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> 
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<nav class="navbar bg-light">
  <div class="container-fluid" style="padding: 0px 75px 0px 60px;">
    <a class="navbar-brand" style="font-size:2em;">북꾸러미</a>
      <form class="d-flex" role="search" method="POST" action="search.php">
        <input class="form-control me-2" type="text" name="book_name" placeholder="책 제목" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
  </div>
</nav>
<section class="bookku_section" style="overflow: hidden;">
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
  <div class="phase_box" data-aos="fade-up">
  <!-- <div class="phase_box"> -->
    <a class="book_name" href="phase_detail.php?pid=<?=$pid?>"> <?= $name?> </a>
    <p class="phase"> <?= $sentence?></p>
    <a class="comment" href="phase_detail.php?pid=<?=$pid?>">댓글</a>
  </div>
    <?php
    }
  ?>
</section>
<script> 
  AOS.init();
</script>
