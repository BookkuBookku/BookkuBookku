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

  $id = $_POST['id'];
  $today = date("Y-m-d");

  $query = "SELECT ATTEND_DATE, COUNTS
         FROM ATTEND
         WHERE ID = ?";

  $stmt = $conn -> prepare($query);
  $stmt -> execute(array($id));

  if (!empty($row = $stmt -> fetch(PDO::FETCH_ASSOC))){
    $date = $row['ATTEND_DATE'];
    $counts = $row['COUNTS'];
    if(date("y/m/d") == $date){
      echo "<script>alert('이미 출석을 하셨습니다!');</script>";
      header("Refresh: 0; URL=attendance.php");
    }else{
      $counts = $counts+1;
      $query1 = "UPDATE ATTEND SET ATTEND_DATE = '$today', COUNTS = '$counts' WHERE ID = '$id'";
      $stmt = $conn -> prepare($query1);
      $stmt -> execute();

      echo "<script>alert('출석을 완료하였습니다.');</script>";
      header("Refresh: 0; URL=attendance.php");
    }
  }else{//처음 출석하는 경우
    $counts = 1;
    $query = "INSERT INTO ATTEND (ID, COUNTS, ATTEND_DATE)
            VALUES (:id, :counts, :today)";
    $stmt = $conn -> prepare($query);
    $stmt->bindParam(':id',$id);
    $stmt->bindParam(':counts',$counts);
    $stmt->bindParam(':today',$today);
    $stmt -> execute();

    echo "<script>alert('출석을 완료하였습니다.');</script>";
    header("Refresh: 0; URL=attendance.php");
  }
?>
