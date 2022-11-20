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
$status = $_POST['status'];

//둘다 없는 경우->새로 만들어야함








//둘중 하나 있는 경우 -> uodate로 수정








if ($status == 'reading'){



}elseif ($status == 'like'){

}

$query = "INSERT INTO BOOK_USER (LOGIN_ID, PASSWORD, NAME)
            VALUES (:login_id, :pwd, :name)";
$stmt = $dbh -> prepare($query);
$stmt->bindParam(':login_id',$login_id);
$stmt->bindParam(':pwd',$pwd);
$stmt->bindParam(':name',$name);

//header("Refresh: 0; URL=cancle.php");

?>
