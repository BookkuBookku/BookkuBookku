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
  $today = date("Y-m-d");

  //입력 받은 내용 업데이트
  //$query1 = "INSERT INTO PHASE (BID, ID, ROUTE, PHASE_DATE)
  //              VALUES (:bid, :id, :phase_like,:phase_date)";
  //$stmt = $conn -> prepare($query1);
  //$stmt->bindParam(':bid',$bid);
  //$stmt->bindParam(':id',$id);
  //$stmt->bindParam(':phase_like', 0);
  //$stmt->bindParam(':phase_date',$phase_date);
  //$stmt -> execute()

  //sentence 업데이트 및 저장
  $query = "SELECT PID FROM PHASE";

  $stmt = $conn -> prepare($query);
  $stmt -> execute();

//이상함 while로 했는데도 1개만 반환됨... oracle에서는 3개 반환 잘 됨ㄱ-..
  while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){//결과를 출력한다.
    $pid = $row['PID'];
    echo $pid;
  }

  $route = "C:\\Apache24\\htdocs\\BookkuBookku\\Phase\\".$bid."_".$pid."\.txt";

  
  ?>
