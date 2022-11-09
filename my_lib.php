<?php
 require('menu.php');


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
