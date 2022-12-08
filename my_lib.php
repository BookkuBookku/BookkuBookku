<?php
 require('menu.php');
?>
<nav class="navbar navbar-expand-lg bg-light">
<div class="container-fluid" style="padding: 0px 75px 0px 60px;">
  <a class="navbar-brand" style="font-size:2em;">내 서재</a>
   <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="my_lib.php?s=reading" style="font-size:1.4em;">읽던 책</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="my_lib.php?s=like" style="font-size:1.4em;">찜한 책</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="my_lib.php?s=sentence" style="font-size:1.4em;">문구</a>
    </li>
  </ul>
   <form class="d-flex" role="search" method="POST" action="search.php">
     <input class="form-control me-2" type="text" name="book_name" placeholder="책 제목" aria-label="Search">
     <button class="btn btn-outline-success" type="submit">Search</button>
   </form>
 </div>
</nav>

<?php
$s = $_GET['s'];
 if($s =='reading'){?>
   <h2>읽던 책</h2>
   <?php
     $query = "SELECT DISTINCT BOOK.NAME, BOOK.AUTHOR, BOOK.BID
              FROM MY_LIB, BOOK
              WHERE BOOK.BID = MY_LIB.BID
                AND MY_LIB.ID = ? AND MY_LIB.READING = 'T' ";

     $stmt = $conn -> prepare($query);
     $stmt -> execute(array($id));

     if(!empty($row = $stmt -> fetch(PDO::FETCH_ASSOC))){
       do{
         $name = $row['NAME'];
         $bid = $row['BID'];
       ?>
         <p> <a href="book_detail.php?bid=<?=$bid?>"> <?= $name?> </a></p>
         <?php

       }while($row = $stmt -> fetch(PDO::FETCH_ASSOC));

     }else{
       echo "읽던 책이 없습니다.";
     }

}elseif ($s =='like') {?>
  <h2>찜한 책</h2>
  <?php
    $query = "SELECT DISTINCT BOOK.NAME, BOOK.AUTHOR, BOOK.BID
             FROM MY_LIB, BOOK
             WHERE BOOK.BID = MY_LIB.BID
               AND MY_LIB.ID = ? AND MY_LIB.BOOK_LIKE = 'T' ";

    $stmt = $conn -> prepare($query);
    $stmt -> execute(array($id));

    if(!empty($row = $stmt -> fetch(PDO::FETCH_ASSOC))){
      do{//결과를 출력한다.
        $name = $row['NAME'];
        $bid = $row['BID'];
      ?>
        <p> <a href="book_detail.php?bid=<?=$bid?>"> <?= $name?> </a></p>
        <?php
        }while($row = $stmt -> fetch(PDO::FETCH_ASSOC));

    }else{
      echo "찜한 책이 없습니다.";
    }

}elseif ($s =='sentence') {?>
  <h2>내 문구</h2>
  <?php
    $query = "SELECT PHASE.PID, BOOK.NAME, BOOK.BID, PHASE.SENTENCE
             FROM PHASE, BOOK
             WHERE BOOK.BID = PHASE.BID
               AND PHASE.ID = ?";

    $stmt = $conn -> prepare($query);
    $stmt -> execute(array($id));

    if(!empty($row = $stmt -> fetch(PDO::FETCH_ASSOC))){
      do{
        //결과를 출력한다.
          $pid = $row['PID'];
          $name = $row['NAME'];
          $bid = $row['BID'];
          $sentence = $row['SENTENCE'];
        ?>
          <p> <a href="phase_detail.php?pid=<?=$pid?>"> <?= $name?> </a></p>
          <?= $sentence?>

          <form method="POST" action="phase_delete.php"><!-- 삭제 -->
            <input type="hidden" name="pid" value="<?= $pid ?>"/>
            <input type="submit" value="삭제"/>
          </form>

           </br> </br>
          <?php
      }while($row = $stmt -> fetch(PDO::FETCH_ASSOC));

    }else{
      echo "작성한 문구가 없습니다.";
    }
}
?>
