<link href=".\css\phase_detail.css" rel="stylesheet" type="text/css" />
<section>
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
    <div class="phase_box">
      <div class="phase_title">
        <div>
          <a class="book_name" href="book_detail.php?bid=<?=$bid?>"> <?= $book_name?> </a>
          <p class="book_author">작가: <?= $author?> </p>
        </div>
        <div>
          <p class="writer">작성자: <?= $name?> </p>
          <p class="date">작성일: <?= $date?> </p>
        </div>
      </div>
      <p class="phase"> <?= $sentence?></a></p>
    </div>    
    <?php
    }
  ?>
  <div id="disqus_thread"></div>
</section>

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
