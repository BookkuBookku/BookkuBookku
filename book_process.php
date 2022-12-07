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

$query = "SELECT * FROM MY_LIB WHERE ID = ? AND BID = ?";
$stmt = $conn -> prepare($query);
$stmt -> execute(array($id, $bid));

$row = $stmt -> fetch(PDO::FETCH_ASSOC);

if(empty($row)){//둘다 없는 경우->새로 만들어야함
  if ($status == 'reading'){//읽기
    $reading = 'T';
    $book_like = 'F';

    $query = "INSERT INTO MY_LIB (BID, ID, READING, BOOK_LIKE)
                VALUES (:bid, :id, :reading, :book_like)";

    $stmt = $conn -> prepare($query);
    $stmt->bindParam(':bid',$bid);
    $stmt->bindParam(':id',$id);
    $stmt->bindParam(':reading', $reading);
    $stmt->bindParam(':book_like', $book_like);
    $stmt -> execute();
    echo "<script>alert('책갈피가 설정되었습니다.');</script>";

  }elseif ($status == 'like'){//찜
    $reading = 'F';
    $book_like = 'T';

    $query = "INSERT INTO MY_LIB (BID, ID, READING, BOOK_LIKE)
                VALUES (:bid, :id, :reading, :book_like)";

    $stmt = $conn -> prepare($query);
    $stmt->bindParam(':bid',$bid);
    $stmt->bindParam(':id',$id);
    $stmt->bindParam(':reading', $reading);
    $stmt->bindParam(':book_like', $book_like);
    $stmt -> execute();
    echo "<script>alert('찜이 설정되었습니다.');</script>";
  }

}else{//둘중 하나라도있는 경우 -> uodate로 수정
  if ($status == 'reading'){
    $reading = $row['READING'];
    if($reading=='T'){//T이면 F로
      $reading = 'F';
    }else{//F면 T로
      $reading = 'T';
    }
    //업데이트 쿼리
    $query1 = "UPDATE MY_LIB SET READING = '$reading' WHERE ID = '$id'AND BID = '$bid'";
    $stmt = $conn -> prepare($query1);
    $stmt -> execute();

    if($reading=='T'){
      echo "<script>alert('책갈피가 설정되었습니다.');</script>";
    }else{
      echo "<script>alert('책갈피가 해제되었습니다.');</script>";
    }

  }elseif ($status == 'like'){
    $book_like = $row['BOOK_LIKE'];
    if($book_like=='T'){//T이면 F로
      $book_like = 'F';
    }else{//F면 T로
      $book_like = 'T';
    }
    //업데이트 쿼리
    $query1 = "UPDATE MY_LIB SET BOOK_LIKE = '$book_like' WHERE ID = '$id'AND BID = '$bid'";
    $stmt = $conn -> prepare($query1);
    $stmt -> execute();

    if($book_like=='T'){
      echo "<script>alert('찜이 설정되었습니다.');</script>";
    }else{
      echo "<script>alert('찜이 해제되었습니다.');</script>";
    }
  }

}
header("Refresh: 0; URL=book_detail.php?bid=$bid");
?>
