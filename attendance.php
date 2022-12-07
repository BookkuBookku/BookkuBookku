<style>
  @import url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_2001@1.1/Cafe24Ohsquare.woff');
</style>

<?php
 require('menu.php');
?>

<nav class="navbar bg-light">
  <div class="container-fluid" style="padding: 0px 75px 0px 60px;">
    <a class="navbar-brand" style="font-size:2em;">출석체크</a>
      <form class="d-flex" role="search" method="POST" action="search.php">
        <input class="form-control me-2" type="text" name="book_name" placeholder="책 제목" aria-label="Search">
        <button class="btn btn-outline-success" type="submit" >Search</button>
      </form>
  </div>
</nav>

<form method="POST" action="attendance_process.php"><!-- 출석 버튼 -->
  <input type="hidden" name="id" value="<?= $id ?>"/>
  <p> <input style="margin-left: 65px;" type="submit" value="출석하기"/> </p>
</form>

<?php
//출석 날짜 배열
  $query = "SELECT TO_CHAR(ATTEND_DATE, 'YYYY-MM-DD') ATTEND_DATE
         FROM ATTEND
         WHERE ID = ?";

  $stmt = $conn -> prepare($query);
  $stmt -> execute(array($id));

  $date_array = [];
  while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){//결과를 출력한다.
         $attend_date = $row['ATTEND_DATE'];
         $oneday_attend = ['title' => '출석', 'start' => $attend_date, 'backgroundColor' => "#00BFB9", 'borderColor' => '#00BFB9'];
         array_push($date_array, $oneday_attend);
  };
  $json = json_encode($date_array);
  $bytes = file_put_contents("calendar_json.json", $json);
  
  $counts = count ($date_array);
  ?>
<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
    <link href='.\node_modules\fullcalendar\main.css' rel='stylesheet' />
    <script src='.\node_modules\fullcalendar\main.js'></script>
    <script src='.\node_modules\fullcalendar\ko.js'></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        $(function () {
            var request = $.ajax({
                url: "calendar_json.json", // 변경하기
                method: "GET",
                dataType: "json"
            });

            request.done(function (data) {
                console.log(data); // log 로 데이터 찍어주기.

                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                  initialView: 'dayGridMonth',
                  locale: 'ko',
                  events: data
                });

                calendar.render();
            });

            request.fail(function( jqXHR, textStatus ) {
                alert( "Request failed: " + textStatus );
            });
        });
      });

    </script>
  </head>
  <body>
    <div id='calendar' ></div>
  </body>
</html>
