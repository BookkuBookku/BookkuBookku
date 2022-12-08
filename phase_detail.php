<?php
 require('menu.php');

 $pid = $_GET['pid'];
 $query = "SELECT PHASE.PID, BOOK.NAME BOOK_NAME, BOOK.AUTHOR, BOOK.BID, PHASE.SENTENCE, BOOK_USER.NAME, PHASE.PHASE_DATE
            FROM PHASE, BOOK, BOOK_USER
            WHERE BOOK.BID = PHASE.BID AND BOOK_USER.ID = PHASE.ID
              AND PHASE.PID = ?";

 $stmt = $conn -> prepare($query);
 $stmt -> execute(array($pid));

 if(!empty($row = $stmt -> fetch(PDO::FETCH_ASSOC))){//결과를 출력한다.
   $pid = $row['PID'];
   $book_name = $row['BOOK_NAME'];
   $bid = $row['BID'];
   $author = $row['AUTHOR'];
   $sentence = $row['SENTENCE'];
   $name = $row['NAME'];
   $date = $row['PHASE_DATE'];
 ?>
   <p> <a href="book_detail.php?bid=<?=$bid?>"> <?= $book_name?> </a></p>
   <p>작가: <?= $author?> </p>
   <p>작성자: <?= $name?> </p>
   <p>작성일: <?= $date?> </p>
   <p> <?= $sentence?> </br> </br> </a></p>
   <?php
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
