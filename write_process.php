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
  $query1 = "INSERT INTO PHASE (BID, ID, PHASE_DATE)
                VALUES (:bid, :id, :phase_date)";
  $stmt = $conn -> prepare($query1);
  $stmt->bindParam(':bid',$bid);
  $stmt->bindParam(':id',$id);
  $stmt->bindParam(':phase_date',$phase_date);
  $stmt -> execute();

  //sentence 업데이트 및 저장
  $query2 = "SELECT MAX(PID) PID FROM PHASE";
  $stmt = $conn -> prepare($query2);
  $stmt -> execute();

  while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
    $pid = $row['PID'];
  }

  $route = $bid."_".$pid."\.txt";
  //문장 파일 생성: 오류 발생
  $myfile = @fopen($route, "w") or die("Unable to open file!");
  $txt = $sentence;
  fwrite($myfile, $txt);
  fclose($myfile);

  //DB에 경로 추가
  $query3 = "UPDATE PHASE SET route = :route WHERE PID = :pid";
  $stmt = $conn -> prepare($query3);
  $stmt->bindParam(':route',$route);
  $stmt->bindParam(':pid',$pid);
  $stmt -> execute()

  ?>
