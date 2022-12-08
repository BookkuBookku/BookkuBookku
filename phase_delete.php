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

  $pid = $_POST['pid'];

  $query = "DELETE FROM PHASE
              WHERE PID = ?";

  $stmt = $conn -> prepare($query);
  $stmt -> execute(array($pid));

  echo "<script>alert('문장을 삭제하였습니다!');</script>";
  header("Refresh: 0; URL=my_lib.php?s=sentence");

  ?>
