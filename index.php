<?php
 require('menu.php');
?>

    <h2>
      <?php
      if(!isset($_GET['id'])){
        //id를 통해 로그인한 유저의 이름을 가져옴
        $query = "SELECT NAME FROM BOOK_USER WHERE ID = ?";
        $stmt = $conn -> prepare($query);
        $stmt -> execute(array($id));

        if(!empty($row = $stmt -> fetch(PDO::FETCH_ASSOC))){
          $name = $row['NAME'];
          echo $name."님, 환영합니다.";
        }
      }
        ?>
    </h2>
  </body>
</html>
