<?php
 require('menu.php');

?>

<nav class="navbar bg-light">
  <div class="container-fluid" style="padding: 0px 75px 0px 60px;">
    <a class="navbar-brand" style="font-size:2em;"><b>출석체크</b></a>
      <form class="d-flex" role="search" method="POST" action="search.php">
        <input class="form-control me-2" type="text" name="book_name" placeholder="책 제목" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
  </div>
</nav>

<form method="POST" action="attendance_process.php"><!-- 출석 버튼 -->
  <input type="hidden" name="id" value="<?= $id ?>"/>
  <p> <input type="submit" value="출석하기"/> </p>
</form>

<?php
  $query = "SELECT COUNTS
         FROM ATTEND
         WHERE ID = ?";

  $stmt = $conn -> prepare($query);
  $stmt -> execute(array($id));

  if (!empty($row = $stmt -> fetch(PDO::FETCH_ASSOC))){
    $counts = $row['COUNTS'];
    echo "누적 출석 횟수: ".$counts;

  }?>

<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <link href='.\node_modules\fullcalendar\main.css' rel='stylesheet' />
    <script src='.\node_modules\fullcalendar\main.js'></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        });
        calendar.render();
      });

    </script>
  </head>
  <body>
    <div id='calendar' ></div>
  </body>
</html>
