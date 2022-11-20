<?php
 require('menu.php');
?>
<nav class="navbar navbar-expand-lg bg-light">
<div class="container-fluid" style="padding: 0px 75px 0px 60px;">
  <a class="navbar-brand" style="font-size:2em;"><b>내 서재</b></a>
   <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="total_book.php" style="font-size:1.4em;">전체 도서</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="my_lib.php?id=reding" style="font-size:1.4em;">읽던 책</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="my_lib.php?id=like" style="font-size:1.4em;">찜한 책</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="my_lib.php?id=sentence" style="font-size:1.4em;">문구</a>
    </li>
  </ul>
   <form class="d-flex" role="search">
     <input class="form-control me-2" type="search" placeholder="책 제목" aria-label="Search">
     <button class="btn btn-outline-success" type="submit">Search</button>
   </form>
 </div>
</nav>


<?php
 if($_GET['id']=='reding'){?>
   <h2>읽던 책</h2>
 <?php
}elseif ($_GET['id']=='like') {?>
  <h2>찜한 책</h2>
<?php


}elseif ($_GET['id']=='sentence') {?>
  <h2>내 문구</h2>
<?php


}


?>
