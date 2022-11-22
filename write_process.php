<?php
// DB와 연결
$tns = "(DESCRIPTION=
        (ADDRESS_LIST= (ADDRESS=(PROTOCOL=TCP)(HOST=localhost)(PORT=1521)))
        (CONNECT_DATA= (SERVICE_NAME=XE)) )";
$dsn = "oci:dbname=".$tns.";charset=utf8";
$username = 'BookkuBookku'; $password = '0000';
try {
  $conn = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
  echo("에러 내용: ".$e -> getMessage());
}

  $bid = $_POST['bid'];
  $id = $_POST['id'];
  $sentence = $_POST['sentence'];
  $phase_date = date("Y-m-d");

  //입력 받은 내용 업데이트
  $query1 = "INSERT INTO PHASE (BID, ID, SENTENCE, PHASE_DATE)
                VALUES (:bid, :id, :sentence, :phase_date)";
  $stmt = $conn -> prepare($query1);
  $stmt->bindParam(':bid',$bid);
  $stmt->bindParam(':id',$id);
  $stmt->bindParam(':sentence',$sentence);
  $stmt->bindParam(':phase_date',$phase_date);
  $stmt -> execute();

  echo "<script>alert('문장을 등록하였습니다!');</script>";
  header("Refresh: 0; URL=book_detail.php?bid=$bid");
  ?>
