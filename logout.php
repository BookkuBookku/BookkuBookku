<?php
  include 'session.php';
  if($login){
    session_destroy();//세션을 종료하여 로그아웃하고 로그인창으로 이동한다.
    echo "<script>alert('로그아웃 하였습니다.');</script>";
    header("Refresh: 0; URL=login.php");
  }
?>
