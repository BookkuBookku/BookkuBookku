<?php
 require('menu.php');

 $pid = $_GET['pid'];
 $query = "SELECT PHASE.PID, BOOK.NAME BOOK_NAME, BOOK.AUTHOR, BOOK.BID, PHASE.ROUTE, BOOK_USER.NAME
            FROM PHASE, BOOK, BOOK_USER
            WHERE BOOK.BID = PHASE.BID AND BOOK_USER.ID = PHASE.ID
              AND PHASE.PID = ?";

 $stmt = $conn -> prepare($query);
 $stmt -> execute(array($pid));

 while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){//결과를 출력한다.
   $pid = $row['PID'];
   $book_name = $row['NAME'];
   $bid = $row['BID'];
   $author = $row['AUTHOR'];
   $route = $row['ROUTE'];
 ?>
   <p> <a href="book_detail.php?bid=<?=$bid?>"> <?= $book_name?> </a></p>
   <p>작가: <?= $author?> </p>
   <p>글쓴이: <?= $author?> </p>
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
?>

<div id="disqus_thread"></div>
<script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    /*
    var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    */
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://bookkubookku.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
