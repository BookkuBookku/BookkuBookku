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

  //입력 받은 내용과 DB을 M_CUSTOMER에 업데이트
    $query = "INSERT INTO BOOK_USER (LOGIN_ID, PASSWORD, NAME)
                VALUES (:login_id, :pwd, :name)";
    $stmt = $dbh -> prepare($query);
    $stmt->bindParam(':login_id',$login_id);
    $stmt->bindParam(':pwd',$pwd);
    $stmt->bindParam(':name',$name);

    //LOGIN_ID 확인
    $login_id = $_POST['login_id'];
    if(empty($login_id)){
      echo "<script>alert('ID는 비울 수 없습니다.');</script>";
    }
    //LOGIN_ID중복 확인
    $select_query = "SELECT LOGIN_ID FROM BOOK_USER WHERE LOGIN_ID = ?";
    $stmt2 = $dbh -> prepare($select_query);
    $stmt2 -> execute(array($login_id));
    $row = $stmt2 -> fetch(PDO::FETCH_ASSOC);
    if(!empty($row)){
      echo "<script>alert('중복된 ID입니다.');</script>";
      $login_id = null;
    }

    //비밀번호 확인
    $pwd = $_POST['pwd'];
    if(empty($pwd)){
      echo "<script>alert('Password는 비울 수 없습니다.');</script>";
    }

    //이름 확인
    $name = $_POST['name'];
    if(empty($name)){
      echo "<script>alert('이름은 비울 수 없습니다.');</script>";
    }

    //inset문 실행
    if(!empty($name) && !empty($pwd) && !empty($login_id)){
      if($stmt -> execute()){
        echo "<script>alert('회원가입이 완료되었습니다. 환영합니다!');</script>";
        header("Refresh: 0; URL=login.php");
      }
    }else{
      header("Refresh: 0; URL=signup.php");
    }

?>
