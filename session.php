<?php
session_start();//세션을 생성하여 로그인 id를 기억한다.
  if( isset( $_SESSION[ 'id' ] ) ) {
    $login = TRUE;
  }
?>
