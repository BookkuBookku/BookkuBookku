<?php
 require('menu.php');

?>
    <h2>출석체크</h2>
<?php
  $query = "SELECT COUNTS
         FROM ATTEND
         WHERE ID = ?";

  $stmt = $conn -> prepare($query);
  $stmt -> execute(array($id));

  if (!empty($row = $stmt -> fetch(PDO::FETCH_ASSOC))){
    $counts = $row['COUNTS'];
    echo "누적 출석 횟수: ".$counts;

  }

?>
<form method="POST" action="attendance_process.php"><!-- 출석 버튼 -->
  <input type="hidden" name="id" value="<?= $id ?>"/>
  <p> <input type="submit" value="출석하기"/> </p>
</form>
