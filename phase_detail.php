<link href=".\css\phase_detail.css" rel="stylesheet" type="text/css" />
<section>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
  <?php
  require('menu.php');

  $pid = $_GET['pid'];
  $query = "SELECT PHASE.PID, BOOK.NAME BOOK_NAME, BOOK.AUTHOR, BOOK.BID, PHASE.SENTENCE, BOOK_USER.NAME, PHASE.PHASE_DATE, PHASE.PHASE_LIKE
              FROM PHASE, BOOK, BOOK_USER
              WHERE BOOK.BID = PHASE.BID AND BOOK_USER.ID = PHASE.ID
                AND PHASE.PID = ?
              ORDER BY PHASE.PHASE_DATE DESC";

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
    $like = $row['PHASE_LIKE'];
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
          <p class="like">좋아요: <?= $like?> </p>

          <form method="POST" action="phase_process.php"><!--좋아요 !-->
            <input type="hidden" name="pid" value="<?= $pid ?> "/>
            <input type="hidden" name="like_count" value="<?= $like ?>"/>
            <input type="hidden" name="status" value="like"/>
            <button type="submit" id="like_btn" value="submit">♥ 좋아요</button>
          </form>

        </div>
      </div>
      <p class="phase"> <?= $sentence?></a></p>
    </div>
    <?php
    }
  ?>
  <div id="disqus_thread"></div>
</section>

<!-- <script>
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
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript> -->

<div id="form-commentInfo"><!--댓글 입력창 !-->
    <form method="POST" action="phase_process.php">
        <input maxlength = '250' id="comment-input" name="contents" placeholder="댓글을 입력해 주세요.">
        <input type="hidden" name="pid" value="<?= $pid ?> "/>
        <input type="hidden" name="id" value="<?= $id ?>"/>
        <input type="hidden" name="status" value="comment"/>
        <button type="submit" id="submit" value="submit">등록</button>
    </div>
    </form>
</div>

<?php
  $query = "SELECT BOOK_USER.NAME, COMMENTS.CONTENTS, COMMENTS.COMMENTS_DATE, COMMENTS.PID, BOOK_USER.ID, COMMENTS.CID
              FROM COMMENTS, BOOK_USER, PHASE
              WHERE COMMENTS.ID = BOOK_USER.ID
                AND PHASE.PID = COMMENTS.PID
                AND PHASE.PID = ?
              ORDER BY COMMENTS.CID";
  $stmt = $conn -> prepare($query);
  $stmt -> execute(array($pid));

  if(!empty($row = $stmt -> fetch(PDO::FETCH_ASSOC))){
    do{//결과를 출력한다.
      $name = $row['NAME'];
      $contents = $row['CONTENTS'];
      $comments_date = $row['COMMENTS_DATE'];
      ?>
      <div class="comment_box">
        <div class="comment_title">
            <p class="user_id"><?= $name?> </p>
            <p class="comment_date"> <?= $comments_date?> </p>
        </div>
        <div>
            <p class="comment_contents"><?= $contents?> </p>
        </div>
      <?php
      $u_id = $row['ID'];
        if($u_id==$id){ //댓글 삭제 버튼
          $cid = $row['CID'];
          ?>
          <form method="POST" action="phase_process.php" style="margin-bottom: 0px;"><!--삭제 !-->
            <input type="hidden" name="cid" value="<?= $cid ?> "/>
            <input type="hidden" name="pid" value="<?= $pid ?> "/>
            <input type="hidden" name="status" value="delete"/>
            <button type="submit" id="delete_btn" value="submit">삭제</button>
          </form>
          </div>
          <?php
        }
      }while($row = $stmt -> fetch(PDO::FETCH_ASSOC));

    }else{
      ?>
      <p> 작성된 댓글이 없습니다. </p>
      <?php
    }

?>
</section>
