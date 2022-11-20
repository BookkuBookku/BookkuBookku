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


?>
