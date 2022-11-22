<?php
 require('menu.php');

?>
    <h2>북꾸러미</h2>
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
