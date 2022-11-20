<?php
 require('menu.php');

?>
    <h2>북꾸러미</h2>
<?php
  $query = "SELECT PHASE.PID, PHASE.ROUTE, BOOK.NAME
           FROM PHASE,BOOK
           WHERE PHASE.BID = BOOK.BID";

  $stmt = $conn -> prepare($query);
  $stmt -> execute();

while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){//결과를 출력한다.
  if(empty($row)){
    echo "저장된 문구가 없습니다.";
  }
  $pid = $row['PID'];
  $route = $row['ROUTE'];
  $name = $row['NAME'];
?>
  <p> <a href="phase_detail.php?pid=<?=$pid?>"> <?= $name?> </a></p>
  <?php
  //파일 열기
  $fp = fopen($route, "r") or die("문장을 불러올 수 없습니다.");
  // 파일 내용 출력

  while( !feof($fp) ) {
    $member = fgets($fp); // 한 줄씩 $member 변수에 저장하고
    echo $member."<br>";
  }

  // 파일 닫기
  fclose($fp);
  }
?>
