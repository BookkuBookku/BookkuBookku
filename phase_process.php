<?php
// DB와 연결
  $tns = "(DESCRIPTION=
          (ADDRESS_LIST= (ADDRESS=(PROTOCOL=TCP)(HOST=localhost)(PORT=1521)))
          (CONNECT_DATA= (SERVICE_NAME=XE)) )";
  $dsn = "oci:dbname=".$tns.";charset=utf8";
  $username = 'BookkuBookku'; $password = '0000';
  try {
    $dbh = new PDO($dsn, $username, $password);
  } catch (PDOException $e) {
    echo("에러 내용: ".$e -> getMessage());
  }

    $id = $_POST['id'];
    $pid = $_POST['pid'];
    $contents = $_POST['contents'];
    $comments_date = date("Y-m-d");

    $query = "INSERT INTO COMMENTS (ID, PID, CONTENTS, COMMENTS_DATE) VALUES (:id, :pid, :contents, :comments_date)";
    $stmt = $dbh -> prepare($query);
    $stmt->bindParam(':id',$id);
    $stmt->bindParam(':pid',$pid);
    $stmt->bindParam(':contents',$contents);
    $stmt->bindParam(':comments_date',$comments_date);

    if(empty($contents)){
      echo "<script>alert('댓글을 입력해주세요.');</script>";
    }

    if(!empty($contents)){
      if($stmt -> execute()){
        echo "<script>alert('댓글이 등록되었습니다.');</script>";
        header("Refresh: 0; URL=phase_detail.php?pid=$pid");
      }
    }

?>
