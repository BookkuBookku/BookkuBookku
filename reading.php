<?php
 require('menu.php');
 $bid = $_POST['bid'];
?>

<form method="POST" action="book_process.php"><!-- 책갈피 -->
  <input type="hidden" name="bid" value="<?= $bid ?>"/>
  <input type="hidden" name="id" value="<?= $id ?>"/>
  <input type="hidden" name="status" value="reading"/>
  <p> <input type="submit" value="책갈피"/> </p>
</form>

<form method="POST" action="write.php"><!-- 문장공유 -->
  <input type="hidden" name="bid" value="<?= $bid ?>"/>
  <input type="hidden" name="status" value="reading"/>
  <p> <input type="submit" value="문장 공유"/> </p>
</form>

<?php
$query = "SELECT NAME, ROUTE
         FROM BOOK
         WHERE BID = ?";

 $stmt = $conn -> prepare($query);
 $stmt -> execute(array($bid));

if ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
  $name = $row['NAME'];
  $route = $row['ROUTE'];
}

//파일 열기
$fp = fopen($route, "r") or die("책을 불러올 수 없습니다！");
// 파일 내용 출력
echo $name."<br><br>";

while( !feof($fp) ) {
  $member = fgets($fp); // 한 줄씩 $member 변수에 저장하고
  echo $member."<br>";
}

// 파일 닫기
fclose($fp);
 ?>
