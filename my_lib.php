<?php
 require('menu.php');
?>
<nav class="navbar navbar-expand-lg bg-light">
<div class="container-fluid" style="padding: 0px 75px 0px 60px;">
  <a class="navbar-brand" style="font-size:2em;"><b>내 서재</b></a>
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

   while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){//결과를 출력한다.
     $name = $row['NAME'];
     $bid = $row['BID'];
   ?>
     <p> <a href="book_detail.php?bid=<?=$bid?>"> <?= $name?> </a></p>
     <?php
     }
     if(empty($row)){
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

  while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){//결과를 출력한다.
    $name = $row['NAME'];
    $bid = $row['BID'];
  ?>
    <p> <a href="book_detail.php?bid=<?=$bid?>"> <?= $name?> </a></p>
    <?php
    }
    if(empty($row)){
      echo "찜한 책이 없습니다.";
    }

}elseif ($s =='sentence') {?>
  <h2>내 문구</h2>
  <?php
    $query = "SELECT PHASE.PID, BOOK.NAME, BOOK.AUTHOR, BOOK.BID, PHASE.ROUTE
             FROM PHASE, BOOK
             WHERE BOOK.BID = PHASE.BID
               AND PHASE.ID = ?";

    $stmt = $conn -> prepare($query);
    $stmt -> execute(array($id));

  while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){//결과를 출력한다.
    $pid = $row['PID'];
    $name = $row['NAME'];
    $bid = $row['BID'];
    $route = $row['ROUTE'];
  ?>
    <p> <a href="phase_detail.php?pid=<?=$pid?>"> <?= $name?> </a></p>
    <?php
    //파일 열기
    $fp = fopen($route, "r") or die("문장을 불러올 수 없습니다.");
    // 파일 내용 출력

    while( !feof($fp) ) {
      $member = fgets($fp); // 한 줄씩 $member 변수에 저장하고
      echo $member."<br>";
    }

    // 파일 닫기
    fclose($fp);
    }
    if(empty($row)){
      echo "작성한 문구가 없습니다.";
    }
}
?>
