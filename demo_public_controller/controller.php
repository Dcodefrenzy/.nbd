<?php
// define("DB_PATH", dirname(dirname(__FILE__)));
// include DB_PATH."/models/model.php";
function decodeDate($date){
  $split = explode('-',$date);
  $month = $split[1];
  $day = $split[2];
  $year = $split[0];
  if($month == 1 ){
    $month = "January";
  }
  if($month == 2 ){
    $month = "February";
  }
  if($month == 3 ){
    $month = "March";
  }
  if($month == 4){
    $month = "April";
  }
  if($month == 5){
    $month = "May";
  }
  if($month == 6 ){
    $month = "June";
  }
  if($month == 7 ){
    $month = "July";
  }
  if($month == 8 ){
    $month = "August";
  }
  if($month == 9 ){
    $month = "September";
  }
  if($month == 10 ){
    $month = "October";
  }
  if($month == 11 ){
    $month = "November";
  }
  if($month == 12 ){
    $month = "December";
  }
  $newDate = $month.' '.$day.', '.$year;
  return $newDate;
}
function userFullInfo($dbconn,$sess){
  $stmt = $dbconn->prepare("SELECT * FROM user WHERE hash_id = :sid");
  $data = [
    ':sid' => $sess
  ];
  $stmt->execute($data);
  $row = $stmt->fetch(PDO::FETCH_BOTH);
  return $row;
}
// function previewBody($string, $count){
//   $original_string = $string;
//   $words = explode(' ', $original_string);
//   if(count($words) > $count){
//     $words = array_slice($words, 0, $count);
//     $string = implode(' ', $words);
//   }
//   return $string;
// }
function getPostInfo($dbconn,$tb,$id){
  $stmt =  $dbconn->prepare("SELECT * FROM $tb WHERE hash_id=:idd");
  $stmt->bindParam(":idd", $id);
  $stmt->execute();
  $row= $stmt->fetch(PDO::FETCH_BOTH);
  return $row;
}
function getPreviewInsightsPost($dbconn){
  if(isset($_SESSION['user_id'])){
    $userhash = $_SESSION['user_id'];
    $sh = "&sh=$userhash";
  }else{
    $sh = "";
    $userhash = "";
  }
  $vis = "Show";
  $stmt = $dbconn->prepare("SELECT * FROM insight WHERE visibility=:sh ORDER BY id DESC LIMIT 7");
  $stmt->bindParam("sh", $vis);
  $stmt->execute();
  $i = 0;
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    extract($row);
    $bd = previewBody($body,30);
    $NDate = decodeDate($date_created); $post = cleans($title);
    echo '<div class="item">
    <div class="item-header">
    <a href="insight?post='.$post.'&id='.$hash_id.$sh.'"><div style="width:200px; height:150px; overflow:hidden"><img src="'.$image_1.'" alt="'.$title.'" /></div></a>
    </div>
    <div class="item-content">
    <h2><a href="insight?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($title).'</a></h2>
    <span class="item-meta">
    <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$NDate.'</span>
    </span>
    <p>'.$bd. '<a href="insight?post='.$post.'&id='.$hash_id.$sh.'" class="item-meta-item meta-button">Read More<i class="fa fa-caret-right"></i></a></p>
    </div>
    </div>';
    if (($i++ % 4) == 1 ){
      echo '<div class="item"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <ins class="adsbygoogle"
      style="display:block"
      data-ad-format="fluid"
      data-ad-layout-key="-dv-21+4j+6-3s"
      data-ad-client="ca-pub-8913707638008127"
      data-ad-slot="9334540834"></ins>
      <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
        </script></div>';
      }
    }
  }
  function getPreviewInsight($dbconn){
    if(isset($_SESSION['user_id'])){
      $userhash = $_SESSION['user_id'];
      $sh = "&sh=$userhash";
    }else{
      $sh = "";
      $userhash = "";
    }
    $vis = "show";
    $stmt = $dbconn->prepare("SELECT * FROM insight WHERE visibility=:sh ORDER BY id DESC LIMIT 5" );
    $stmt->bindParam(":sh", $vis);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $NDate = decodeDate($date_created); $post = cleans($title);
      echo '<div class="item">
      <a href="insight?post='.$post.'&id='.$hash_id.$sh.'" class="main-slider-owl-title" style="font-size:18pt; text-shadow: 6px 6px 10px #000000;">'.$title.'</a>
      <a href="insight?post='.$post.'&id='.$hash_id.$sh.'" class="main-slider-owl-calendar"><strong><i class="fa fa-clock-o"></i>'.$NDate.'</strong></a><div style="width:100%; max-height:80vh; overflow:hidden"><img src="'.$image_1.'" height="42" alt="'.$title.'" /></div>
      </div>';
    }
  }
  function getPreviewEvent($dbconn){
    if(isset($_SESSION['user_id'])){
      $userhash = $_SESSION['user_id'];
      $sh = "&sh=$userhash";
    }else{
      $sh = "";
      $userhash = "";
    }
    $stmt = $dbconn->prepare("SELECT * FROM event ORDER BY start_date ASC LIMIT 5" );
    $stmt->bindParam("sh", $vis);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $SDate = decodeDate($start_date);
      $EDate = decodeDate($end_date); $post = cleans($name);
      echo '<div class="item">
      <div style="margin-left:10px" class="item-content">
      <h4><a href="event?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($name).'</a> </h4><span>at '.$venue.'</span>';
      if($SDate == $EDate){
        echo '<p>'.$SDate.'</p>';
      }else{
        echo '<p>'.$SDate.' - '.$EDate.'</p>';
      }
      echo '</div></div>';
    }
    echo'<span class="item-meta">
    <a href="view_event" class="item-meta-item meta-button">View More Events <i class="fa fa-caret-right"></i></a>
    </span>';
  }
  function getArticlePreview($dbconn){
    if(isset($_SESSION['user_id'])){
      $userhash = $_SESSION['user_id'];
      $sh = "&sh=$userhash";
    }else{
      $sh = "";
      $userhash = "";
    }
    $vis = "show";
    $stmt = $dbconn->prepare("SELECT * FROM blog WHERE visibility=:sh ORDER BY id DESC LIMIT 5" );
    $stmt->bindParam(":sh", $vis);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $SDate = decodeDate($date_created); $post = cleans($title);
      echo '  <div class="item">
      <div class="item-header">
      <a href="article?post='.$post.'&id='.$hash_id.$sh.'" class="img-read-later-button rm-btn-small">Read</a>
      <a href="article?post='.$post.'&id='.$hash_id.$sh.'"><img src="'.$image_1.'" alt="'.$title.'" /></a>
      </div>
      <div class="item-content">
      <h4><a href="article?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($title).'</a></h4>
      <span class="item-meta">
      <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
      </span>
      </div>
      </div>';
    }
    echo'<span class="item-meta">
    <a href="articles" class="item-meta-item meta-button">View More Articles <i class="fa fa-caret-right"></i></a>
    </span>';
  }
  function getCampusArticlePreview($dbconn){
    if(isset($_SESSION['user_id'])){
      $userhash = $_SESSION['user_id'];
      $sh = "&sh=$userhash";
    }else{
      $sh = "";
      $userhash = "";
    }
    $vis = "show";
    $stmt = $dbconn->prepare("SELECT * FROM campus_article WHERE visibility=:sh ORDER BY id DESC LIMIT 3" );
    $stmt->bindParam(":sh", $vis);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $SDate = decodeDate($date_created); $post = cleans($title);
      echo '  <div class="item">
      <div class="item-header">
      <a href="article?post='.$post.'&id='.$hash_id.$sh.'" class="img-read-later-button rm-btn-small">Read</a>
      <a href="article?post='.$post.'&id='.$hash_id.$sh.'"><img src="'.$image_1.'" alt="'.$title.'" /></a>
      </div>
      <div class="item-content">
      <h4><a href="article?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($title).'</a></h4>
      <span class="item-meta">
      <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
      </span>
      </div>
      </div>';
    }
    echo'<span class="item-meta">
    <a href="campus_articles" class="item-meta-item meta-button">View More Campus Articles<i class="fa fa-caret-right"></i></a>
    </span>';
  }
  function getCampusNewsPreview($dbconn){
    if(isset($_SESSION['user_id'])){
      $userhash = $_SESSION['user_id'];
      $sh = "&sh=$userhash";
    }else{
      $sh = "";
      $userhash = "";
    }
    $vis = "show";
    $stmt = $dbconn->prepare("SELECT * FROM campus_news WHERE visibility=:sh ORDER BY id DESC LIMIT 3" );
    $stmt->bindParam(":sh", $vis);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $SDate = decodeDate($date_created); $post = cleans($headline);
      echo '  <div class="item">
      <div class="item-header">
      <a href="campus_news?post='.$post.'&id='.$hash_id.$sh.'" class="img-read-later-button rm-btn-small">Read</a>
      <a href="campus_news?post='.$post.'&id='.$hash_id.$sh.'"><img src="'.$image_1.'" alt="'.$headline.'" /></a>
      </div>
      <div class="item-content">
      <h4><a href="campus_news?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($headline).'</a></h4>
      <span class="item-meta">
      <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
      </span>
      </div>
      </div>';
    }
    echo'<span class="item-meta">
    <a href="campus_news" class="item-meta-item meta-button">View More Campus News <i class="fa fa-caret-right"></i></a>
    </span>';
  }
  function getGlobalNewsPreview($dbconn){
    if(isset($_SESSION['user_id'])){
      $userhash = $_SESSION['user_id'];
      $sh = "&sh=$userhash";
    }else{
      $sh = "";
      $userhash = "";
    }
    $vis = "show";
    $cat = "8a8ol2G34157b07l";
    $stmt = $dbconn->prepare("SELECT * FROM news WHERE visibility=:sh AND category=:cat ORDER BY id DESC LIMIT 3" );
    $stmt->bindParam(":sh", $vis);
    $stmt->bindParam(":cat", $cat);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $SDate = decodeDate($date_created); $post = cleans($headline);
      echo '  <div class="item">
      <div class="item-header">
      <a href="news?post='.$post.'&id='.$hash_id.$sh.'" class="img-read-later-button rm-btn-small">Read</a>
      <a href="news?post='.$post.'&id='.$hash_id.$sh.'"><img src="'.$image_1.'" alt="'.$headline.'" /></a>
      </div>
      <div class="item-content">
      <h4><a href="news?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($headline).'</a></h4>
      <span class="item-meta">
      <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
      </span>
      </div>
      </div>';
    }
    echo'<span class="item-meta">
    <a href="news?c='.$cat.'" class="item-meta-item meta-button">View More Global <i class="fa fa-caret-right"></i></a>
    </span>';
  }
  function getAfricaNewsPreview($dbconn){
    if(isset($_SESSION['user_id'])){
      $userhash = $_SESSION['user_id'];
      $sh = "&sh=$userhash";
    }else{
      $sh = "";
      $userhash = "";
    }
    $vis = "show";
    $cat = "7398irnA16fc538a4";
    $stmt = $dbconn->prepare("SELECT * FROM news WHERE visibility=:sh AND category=:cat ORDER BY id DESC LIMIT 3" );
    $stmt->bindParam(":sh", $vis);
    $stmt->bindParam(":cat", $cat);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $SDate = decodeDate($date_created); $post = cleans($headline);
      echo '  <div class="item">
      <div class="item-header">
      <a href="news?post='.$post.'&id='.$hash_id.$sh.'" class="img-read-later-button rm-btn-small">Read</a>
      <a href="news?post='.$post.'&id='.$hash_id.$sh.'"><img src="'.$image_1.'" alt="'.$headline.'" /></a>
      </div>
      <div class="item-content">
      <h4><a href="news?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($headline).'</a></h4>
      <span class="item-meta">
      <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
      </span>
      </div>
      </div>';
    }
    echo'<span class="item-meta">
    <a href="news?c='.$cat.'" class="item-meta-item meta-button">View More African News <i class="fa fa-caret-right"></i></a>
    </span>';
  }
  function getNigeriaNewsPreview($dbconn){
    if(isset($_SESSION['user_id'])){
      $userhash = $_SESSION['user_id'];
      $sh = "&sh=$userhash";
    }else{
      $sh = "";
      $userhash = "";
    }
    $vis = "show";
    $cat = "gia5235e9940N73ir";
    $stmt = $dbconn->prepare("SELECT * FROM news WHERE visibility=:sh AND category=:cat ORDER BY id DESC LIMIT 3" );
    $stmt->bindParam(":sh", $vis);
    $stmt->bindParam(":cat", $cat);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $SDate = decodeDate($date_created); $post = cleans($headline);
      echo '  <div class="item">
      <div class="item-header">
      <a href="news?post='.$post.'&id='.$hash_id.$sh.'" class="img-read-later-button rm-btn-small">Read</a>
      <a href="news?post='.$post.'&id='.$hash_id.$sh.'"><img src="'.$image_1.'" alt="'.$headline.'" /></a>
      </div>
      <div class="item-content">
      <h4><a href="news?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($headline).'</a></h4>
      <span class="item-meta">
      <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
      </span>
      </div>
      </div>';
    }
    echo'<span class="item-meta">
    <a href="news?c='.$cat.'" class="item-meta-item meta-button">View More Nigerian News <i class="fa fa-caret-right"></i></a>
    </span>';
  }
  function getInsightPreview($dbconn){
    if(isset($_SESSION['user_id'])){
      $userhash = $_SESSION['user_id'];
      $sh = "&sh=$userhash";
    }else{
      $sh = "";
      $userhash = "";
    }
    $vis = "show";
    $stmt = $dbconn->prepare("SELECT * FROM insight WHERE visibility=:sh  ORDER BY id DESC LIMIT 3" );
    $stmt->bindParam(":sh", $vis);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $SDate = decodeDate($date_created); $post = cleans($title);
      echo '  <div class="item">
      <div class="item-header">
      <a href="insight?post='.$post.'&id='.$hash_id.$sh.'" class="img-read-later-button rm-btn-small">Read</a>
      <a href="insight?post='.$post.'&id='.$hash_id.$sh.'"><img src="'.$image_1.'" alt="'.$title.'" /></a>
      </div>
      <div class="item-content">
      <h4><a href="insight?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($title).'</a></h4>
      <span class="item-meta">
      <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
      </span>
      </div>
      </div>';
    }
    echo'<span class="item-meta">
    <a href="insight" class="item-meta-item meta-button">View More Insignts <i class="fa fa-caret-right"></i></a>
    </span>';
  }
  function getReportPreview($dbconn){
    $vis = "Show";
    $stmt = $dbconn->prepare("SELECT * FROM report WHERE visibility=:sh ORDER BY id DESC LIMIT 4" );
    $stmt->bindParam("sh", $vis);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $SDate = decodeDate($date_created); $post = cleans($title);
      echo '  <div class="item">
      <div style="margin-left:10px" class="item-content">
      <h4><a href="'.$link.'">'.strtoupper($title).'</a></h4>
      <span class="item-meta">
      <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
      </span>
      </div>
      </div>';
    }
    echo'<span class="item-meta">
    <a href="report" class="item-meta-item meta-button">View More More <i class="fa fa-caret-right"></i></a>
    </span>';
  }
  function getPaginatedInsight($dbconn,$fs,$pp){
    if(isset($_SESSION['user_id'])){
      $userhash = $_SESSION['user_id'];
      $sh = "&sh=$userhash";
    }else{
      $sh = "";
      $userhash = "";
    }
    $vis = "show";
    $stmt = $dbconn->prepare("SELECT * FROM insight WHERE visibility=:sh ORDER BY id DESC LIMIT $fs,$pp");
    $stmt->bindParam(":sh", $vis);
    // $stmt->bindParam(":bk", $pp);
    $stmt->execute();
      $i = 0;
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $SDate = decodeDate($date_created); $post = cleans($title);
      $post = cleans($title);
      $bd = previewBody($body,33);
      echo '<div class="item">
      <div class="item-header">
      <a href="insight?post='.$post.'&id='.$hash_id.$sh.'" class="img-read-later-button">Read</a>
      <a href="insight?post='.$post.'&id='.$hash_id.$sh.'"><div style="width:200px; height:150px; overflow:hidden"><img   src="'.$image_1.'" alt="'.$title.'" /></div></a>
      </div>
      <div class="item-content">
      <h2><a href="insight?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($title).'</a></h2>
      <span class="item-meta">
      <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
      </span>
      <p>'.$bd.'<a  href="insight?post='.$post.'&id='.$hash_id.$sh.'" class="item-meta-item meta-button">Read More<i class="fa fa-caret-right"></i></a></p>
      </div>
      </div>';
      if (($i++ % 4) == 1 ){
        echo '<div class="item"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <ins class="adsbygoogle"
        style="display:block"
        data-ad-format="fluid"
        data-ad-layout-key="-dv-21+4j+6-3s"
        data-ad-client="ca-pub-8913707638008127"
        data-ad-slot="9334540834"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
          </script></div>';
        }
    }
  }
  function getEntityCategory($dbconn,$tb,$nm,$gid){
    $stmt = $dbconn->prepare("SELECT $nm FROM $tb WHERE hash_id=:gid");
    $stmt->bindParam(":gid", $gid);
    $stmt->execute();
    $nm = $stmt->fetch(PDO::FETCH_BOTH);
    return $nm;
  }
  function getPaginatedNews($dbconn,$fs,$pp){
    if(isset($_SESSION['user_id'])){
      $userhash = $_SESSION['user_id'];
      $sh = "&sh=$userhash";
    }else{
      $sh = "";
      $userhash = "";
    }
    $vis = "show";
    $stmt = $dbconn->prepare("SELECT * FROM news WHERE visibility=:sh ORDER BY id DESC LIMIT $fs,$pp");
    $stmt->bindParam(":sh", $vis);
    // $stmt->bindParam(":bk", $pp);
    $stmt->execute();
      $i = 0;
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $SDate = decodeDate($date_created); $post = cleans($headline);
      $bd = previewBody($body,33);
      echo '<div class="item">
      <div class="item-header">
      <a href="news?post='.$post.'&id='.$hash_id.$sh.'" class="img-read-later-button">Read</a>
      <a href="news?post='.$post.'&id='.$hash_id.$sh.'"><div style="width:200px; height:150px; overflow:hidden"><img   src="'.$image_1.'" alt="'.$headline.'" /></div></a>
      </div>
      <div class="item-content">
      <h2><a href="news?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($headline).'</a></h2>
      <span class="item-meta">
      <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
      </span>
      <p>'.$bd.'<a href="news?post='.$post.'&id='.$hash_id.$sh.'" class="item-meta-item meta-button">Read More<i class="fa fa-caret-right"></i></a></p>
      </div>
      </div>';
      if (($i++ % 4) == 1 ){
        echo '<div class="item"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <ins class="adsbygoogle"
        style="display:block"
        data-ad-format="fluid"
        data-ad-layout-key="-dv-21+4j+6-3s"
        data-ad-client="ca-pub-8913707638008127"
        data-ad-slot="9334540834"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
          </script></div>';
        }
    }
  }
  function getPaginatedCampusNews($dbconn,$fs,$pp){
    if(isset($_SESSION['user_id'])){
      $userhash = $_SESSION['user_id'];
      $sh = "&sh=$userhash";
    }else{
      $sh = "";
      $userhash = "";
    }
    $vis = "show";
    $stmt = $dbconn->prepare("SELECT * FROM campus_news WHERE visibility=:sh ORDER BY id DESC LIMIT $fs,$pp");
    $stmt->bindParam(":sh", $vis);
    // $stmt->bindParam(":bk", $pp);
    $stmt->execute();
      $i = 0;
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $SDate = decodeDate($date_created); $post = cleans($headline);
      $bd = previewBody($body,33);
      echo '<div class="item">
      <div class="item-header">
      <a href="campus_news?post='.$post.'&id='.$hash_id.$sh.'" class="img-read-later-button">Read</a>
      <a href="campus_news?post='.$post.'&id='.$hash_id.$sh.'"><div style="width:200px; height:150px; overflow:hidden"><img src="'.$image_1.'" alt="'.$headline.'" /></div></a>
      </div>
      <div class="item-content">
      <h2><a href="campus_news?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($headline).'</a></h2>
      <span class="item-meta">
      <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
      </span>
      <p>'.$bd.'<a href="campus_news?post='.$post.'&id='.$hash_id.$sh.'"  class="item-meta-item meta-button">Read More<i class="fa fa-caret-right"></i></a></p>
      </div>
      </div>';
      if (($i++ % 4) == 1 ){
        echo '<div class="item"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <ins class="adsbygoogle"
        style="display:block"
        data-ad-format="fluid"
        data-ad-layout-key="-dv-21+4j+6-3s"
        data-ad-client="ca-pub-8913707638008127"
        data-ad-slot="9334540834"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
          </script></div>';
        }
    }
  }
  function getCatPaginatedInsight($dbconn,$fs,$pp,$cat){
    if(isset($_SESSION['user_id'])){
      $userhash = $_SESSION['user_id'];
      $sh = "&sh=$userhash";
    }else{
      $sh = "";
      $userhash = "";
    }
    $vis = "show";
    $stmt = $dbconn->prepare("SELECT * FROM insight WHERE visibility=:sh AND category=:cat ORDER BY id DESC LIMIT $fs,$pp");
    $stmt->bindParam(":sh", $vis);
    $stmt->bindParam(":cat", $cat);
    $stmt->execute();
      $i = 0;
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $SDate = decodeDate($date_created); $post = cleans($title);
      $bd = previewBody($body,33);
      echo '<div class="item">
      <div class="item-header">
      <a href="insight?post='.$post.'&id='.$hash_id.$sh.'" class="img-read-later-button">Read</a>
      <a href="insight?post='.$post.'&id='.$hash_id.$sh.'"><div style="width:200px; height:150px; overflow:hidden"><img   src="'.$image_1.'" alt="'.$title.'" /></div></a>
      </div>
      <div class="item-content">
      <h2><a href="insight?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($title).'</a></h2>
      <span class="item-meta">
      <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
      </span>
      <p>'.$bd.'<a href="insight?post='.$post.'&id='.$hash_id.$sh.'" class="item-meta-item meta-button">Read More<i class="fa fa-caret-right"></i></a></p>
      </div>
      </div>';
      if (($i++ % 4) == 1 ){
        echo '<div class="item"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <ins class="adsbygoogle"
        style="display:block"
        data-ad-format="fluid"
        data-ad-layout-key="-dv-21+4j+6-3s"
        data-ad-client="ca-pub-8913707638008127"
        data-ad-slot="9334540834"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
          </script></div>';
        }
    }
  }
  function getCatPaginatedNews($dbconn,$fs,$pp,$cat){
    if(isset($_SESSION['user_id'])){
      $userhash = $_SESSION['user_id'];
      $sh = "&sh=$userhash";
    }else{
      $sh = "";
      $userhash = "";
    }
    $vis = "show";
    $stmt = $dbconn->prepare("SELECT * FROM news WHERE visibility=:sh AND category=:cat ORDER BY id DESC LIMIT $fs,$pp");
    $stmt->bindParam(":sh", $vis);
    $stmt->bindParam(":cat", $cat);
    $stmt->execute();
      $i = 0;
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $SDate = decodeDate($date_created); $post = cleans($headline);
      $bd = previewBody($body,33);
      echo '<div class="item">
      <div class="item-header">
      <a href="news?post='.$post.'&id='.$hash_id.$sh.'" class="img-read-later-button">Read</a>
      <a href="news?post='.$post.'&id='.$hash_id.$sh.'"><div style="width:200px; height:150px; overflow:hidden"><img   src="'.$image_1.'" alt="'.$headline.'" /></div></a>
      </div>
      <div class="item-content">
      <h2><a href="news?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($headline).'</a></h2>
      <span class="item-meta">
      <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
      </span>
      <p>'.$bd.'<a href="news?post='.$post.'&id='.$hash_id.$sh.'" class="item-meta-item meta-button">Read More<i class="fa fa-caret-right"></i></a></p>
      </div>
      </div>';
      if (($i++ % 4) == 1 ){
        echo '<div class="item"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <ins class="adsbygoogle"
        style="display:block"
        data-ad-format="fluid"
        data-ad-layout-key="-dv-21+4j+6-3s"
        data-ad-client="ca-pub-8913707638008127"
        data-ad-slot="9334540834"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
          </script></div>';
        }
    }
  }
  function getCatPaginatedCampusNews($dbconn,$fs,$pp,$cat){
    if(isset($_SESSION['user_id'])){
      $userhash = $_SESSION['user_id'];
      $sh = "&sh=$userhash";
    }else{
      $sh = "";
      $userhash = "";
    }
    $vis = "show";
    $stmt = $dbconn->prepare("SELECT * FROM campus_news WHERE visibility=:sh AND campus=:cat ORDER BY id DESC LIMIT $fs,$pp");
    $stmt->bindParam(":sh", $vis);
    $stmt->bindParam(":cat", $cat);
    $stmt->execute();
      $i = 0;
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $SDate = decodeDate($date_created); $post = cleans($headline);
      $bd = previewBody($body,33);
      echo '<div class="item">
      <div class="item-header">
      <a href="campus_news?post='.$post.'&id='.$hash_id.$sh.'" class="img-read-later-button">Read</a>
      <a href="campus_news?post='.$post.'&id='.$hash_id.$sh.'"><div style="width:200px; height:150px; overflow:hidden"><img   src="'.$image_1.'" alt="'.$headline.'" /></div></a>
      </div>
      <div class="item-content">
      <h2><a href="campus_news?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($headline).'</a></h2>
      <span class="item-meta">
      <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
      </span>
      <p>'.$bd.'<a href="campus_news?post='.$post.'&id='.$hash_id.$sh.'" class="item-meta-item meta-button">Read More<i class="fa fa-caret-right"></i></a></p>
      </div>
      </div>';
      if (($i++ % 4) == 1 ){
        echo '<div class="item"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <ins class="adsbygoogle"
        style="display:block"
        data-ad-format="fluid"
        data-ad-layout-key="-dv-21+4j+6-3s"
        data-ad-client="ca-pub-8913707638008127"
        data-ad-slot="9334540834"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
          </script></div>';
        }
    }
  }
  function getPaginatedArticle($dbconn,$fs,$pp){
    if(isset($_SESSION['user_id'])){
      $userhash = $_SESSION['user_id'];
      $sh = "&sh=$userhash";
    }else{
      $sh = "";
      $userhash = "";
    }
    $vis = "show";
    $stmt = $dbconn->prepare("SELECT * FROM blog WHERE visibility=:sh ORDER BY id DESC LIMIT $fs,$pp");
    $stmt->bindParam(":sh", $vis);
    // $stmt->bindParam(":ff", $fs);
    // $stmt->bindParam(":bk", $pp);
    $stmt->execute();
      $i = 0;
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $SDate = decodeDate($date_created); $post = cleans($title);
      $bd = previewBody($body,33);
      echo '<div class="item">
      <div class="item-header">
      <a href="article?post='.$post.'&id='.$hash_id.$sh.'" class="img-read-later-button">Read</a>
      <a href="article?post='.$post.'&id='.$hash_id.$sh.'"><div style="width:200px; height:150px; overflow:hidden"><img   src="'.$image_1.'" alt="'.$title.'" /></div></a>
      </div>
      <div class="item-content">
      <h2><a href="article?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($title).'</a></h2>
      <span class="item-meta">
      <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
      </span>
      <p>'.$bd.'<a href="article?post='.$post.'&id='.$hash_id.$sh.'" class="item-meta-item meta-button">Read More<i class="fa fa-caret-right"></i></a></p>
      </div>
      </div>';
      if (($i++ % 4) == 1 ){
        echo '<div class="item"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <ins class="adsbygoogle"
        style="display:block"
        data-ad-format="fluid"
        data-ad-layout-key="-dv-21+4j+6-3s"
        data-ad-client="ca-pub-8913707638008127"
        data-ad-slot="9334540834"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
          </script></div>';
        }
    }
  }
  function getPaginatedCampusArticle($dbconn,$fs,$pp){
    if(isset($_SESSION['user_id'])){
      $userhash = $_SESSION['user_id'];
      $sh = "&sh=$userhash";
    }else{
      $sh = "";
      $userhash = "";
    }
    $stmt = $dbconn->prepare("SELECT * FROM campus_article ORDER BY id DESC LIMIT $fs,$pp");
    // $stmt->bindParam(":ff", $fs);
    // $stmt->bindParam(":bk", $pp);
    $stmt->execute();
      $i = 0;
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      if(isset($_SESSION['user_id'])){
        $userhash = $_SESSION['user_id'];
        $sh = "&sh=$userhash";
      }else{
        $sh = "";
        $userhash = "";
      }
      extract($row);
      $SDate = decodeDate($date_created); $post = cleans($title);
      $bd = previewBody($body,33);
      echo '<div class="item">
      <div class="item-header">
      <a href="campus_articles?post='.$post.'&id='.$hash_id.$sh.'" class="img-read-later-button">Read</a>
      <a href="campus_articles?post='.$post.'&id='.$hash_id.$sh.'"><div style="width:200px; height:150px; overflow:hidden"><img   src="'.$image_1.'" alt="'.$title.'" /></div></a>
      </div>
      <div class="item-content">
      <h2><a href="campus_articles?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($title).'</a></h2>
      <span class="item-meta">
      <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
      </span>
      <p>'.$bd.'<a href="campus_articles?post='.$post.'&id='.$hash_id.$sh.'"class="item-meta-item meta-button">Read More<i class="fa fa-caret-right"></i></a></p>
      </div>
      </div>';
      if (($i++ % 4) == 1 ){
        echo '<div class="item"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <ins class="adsbygoogle"
        style="display:block"
        data-ad-format="fluid"
        data-ad-layout-key="-dv-21+4j+6-3s"
        data-ad-client="ca-pub-8913707638008127"
        data-ad-slot="9334540834"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
          </script></div>';
        }
    }
  }
  function getPaginatedExploits($dbconn,$fs,$pp){
    if(isset($_SESSION['user_id'])){
      $userhash = $_SESSION['user_id'];
      $sh = "&sh=$userhash";
    }else{
      $sh = "";
      $userhash = "";
    }
    $vis = "show";
    $stmt = $dbconn->prepare("SELECT * FROM exploits WHERE visibility=:sh ORDER BY id DESC LIMIT $fs,$pp");
    // $stmt->bindParam(":ff", $fs);
    $stmt->bindParam(":sh", $vis);
    // $stmt->bindParam(":bk", $pp);
    $stmt->execute();
      $i = 0;
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $SDate = decodeDate($date_created); $post = cleans($title);
      $bd = previewBody($body,33);
      echo '<div class="item">
      <div class="item-header">
      <a href="exploits?post='.$post.'&id='.$hash_id.$sh.'" class="img-read-later-button">Read</a>
      <a href="exploits?post='.$post.'&id='.$hash_id.$sh.'"><div style="width:200px; height:150px; overflow:hidden"><img   src="'.$image_1.'" alt="'.$title.'" /></div></a>
      </div>
      <div class="item-content">
      <h2><a href="exploits?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($title).'</a></h2>
      <span class="item-meta">
      <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
      </span>
      <p>'.$bd.'<a href="exploits?post='.$post.'&id='.$hash_id.$sh.'"class="item-meta-item meta-button">Read More<i class="fa fa-caret-right"></i></a></p>
      </div>
      </div>';
      if (($i++ % 4) == 1 ){
        echo '<div class="item"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <ins class="adsbygoogle"
        style="display:block"
        data-ad-format="fluid"
        data-ad-layout-key="-dv-21+4j+6-3s"
        data-ad-client="ca-pub-8913707638008127"
        data-ad-slot="9334540834"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
          </script></div>';
        }
    }
  }
  function getCatPaginatedCampusArticle($dbconn,$fs,$pp,$cat){
    if(isset($_SESSION['user_id'])){
      $userhash = $_SESSION['user_id'];
      $sh = "&sh=$userhash";
    }else{
      $sh = "";
      $userhash = "";
    }
    $vis = "show";
    $stmt = $dbconn->prepare("SELECT * FROM campus_article WHERE visibility=:sh AND campus=:cat ORDER BY id DESC LIMIT $fs,$pp");
    $stmt->bindParam(":sh", $vis);
    $stmt->bindParam(":cat", $cat);
    // $stmt->bindParam(":bk", $pp);
    $stmt->execute();
      $i = 0;
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $SDate = decodeDate($date_created); $post = cleans($title);
      $bd = previewBody($body,33);
      echo '<div class="item">
      <div class="item-header">
      <a href="campus_articles?post='.$post.'&id='.$hash_id.$sh.'" class="img-read-later-button">Read</a>
      <a href="campus_articles?post='.$post.'&id='.$hash_id.$sh.'"><div style="width:200px; height:150px; overflow:hidden"><img   src="'.$image_1.'" alt="'.$title.'" /></div></a>
      </div>
      <div class="item-content">
      <h2><a href="campus_articles?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($title).'</a></h2>
      <span class="item-meta">
      <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
      </span>
      <p>'.$bd.'<a href="campus_articles?post='.$post.'&id='.$hash_id.$sh.'" class="item-meta-item meta-button">Read More<i class="fa fa-caret-right"></i></a></p>
      </div>
      </div>';
      if (($i++ % 4) == 1 ){
        echo '<div class="item"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <ins class="adsbygoogle"
        style="display:block"
        data-ad-format="fluid"
        data-ad-layout-key="-dv-21+4j+6-3s"
        data-ad-client="ca-pub-8913707638008127"
        data-ad-slot="9334540834"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
          </script></div>';
        }
    }
  }
  function getCatPaginatedExploits($dbconn,$fs,$pp,$cat){
    if(isset($_SESSION['user_id'])){
      $userhash = $_SESSION['user_id'];
      $sh = "&sh=$userhash";
    }else{
      $sh = "";
      $userhash = "";
    }
    $vis = "show";
    $stmt = $dbconn->prepare("SELECT * FROM exploits WHERE visibility=:sh AND campus=:cat ORDER BY id DESC LIMIT $fs,$pp");
    $stmt->bindParam(":sh", $vis);
    $stmt->bindParam(":cat", $cat);
    // $stmt->bindParam(":bk", $pp);
    $stmt->execute();
      $i = 0;
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      if(isset($_SESSION['user_id'])){
        $userhash = $_SESSION['user_id'];
        $sh = "&sh=$userhash";
      }else{
        $sh = "";
        $userhash = "";
      }
      extract($row);
      $SDate = decodeDate($date_created); $post = cleans($title);
      $bd = previewBody($body,33);
      echo '<div class="item">
      <div class="item-header">
      <a href="exploits?post='.$post.'&id='.$hash_id.$sh.'" class="img-read-later-button">Read</a>
      <a href="exploits?post='.$post.'&id='.$hash_id.$sh.'"><div style="width:200px; height:150px; overflow:hidden"><img   src="'.$image_1.'" alt="'.$title.'" /></div></a>
      </div>
      <div class="item-content">
      <h2><a href="exploits?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($title).'</a></h2>
      <span class="item-meta">
      <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
      </span>
      <p>'.$bd.'<a href="exploits?post='.$post.'&id='.$hash_id.$sh.'" class="item-meta-item meta-button">Read More<i class="fa fa-caret-right"></i></a></p>
      </div>
      </div>';
      if (($i++ % 4) == 1 ){
        echo '<div class="item"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <ins class="adsbygoogle"
        style="display:block"
        data-ad-format="fluid"
        data-ad-layout-key="-dv-21+4j+6-3s"
        data-ad-client="ca-pub-8913707638008127"
        data-ad-slot="9334540834"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
          </script></div>';
        }
    }
  }
  function getPaginatedAfrica($dbconn,$fs,$pp,$ct){
    $stmt = $dbconn->prepare("SELECT * FROM news WHERE category =:cat ORDER BY id DESC LIMIT $fs,$pp");
    $stmt->bindParam(":cat", $ct);
    // $stmt->bindParam(":bk", $pp);
    $stmt->execute();
      $i = 0;
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $SDate = decodeDate($date_created); $post = cleans($headline);
      $bd = previewBody($body,33);
      echo '<div class="item">
      <div class="item-header">
      <a href="'.$link.'" class="img-read-later-button">Read</a>
      <a href="'.$link.'"><div style="width:200px; height:150px; overflow:hidden"><img src="'.$image_1.'" alt="'.$headline.'" /></div></a>
      </div>
      <div class="item-content">
      <h2><a href="'.$link.'">'.strtoupper($headline).'</a></h2>
      <span class="item-meta">
      <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
      </span>
      <p>'.$body.'</p>
      </div>
      </div>';
      if (($i++ % 4) == 1 ){
        echo '<div class="item"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <ins class="adsbygoogle"
        style="display:block"
        data-ad-format="fluid"
        data-ad-layout-key="-dv-21+4j+6-3s"
        data-ad-client="ca-pub-8913707638008127"
        data-ad-slot="9334540834"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
          </script></div>';
        }
    }
  }
  function getPaginatedReport($dbconn,$fs,$pp){
    $stmt = $dbconn->prepare("SELECT * FROM report ORDER BY id DESC LIMIT $fs,$pp");
    // $stmt->bindParam(":ff", $fs);
    // $stmt->bindParam(":bk", $pp);
    $stmt->execute();
      $i = 0;
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $SDate = decodeDate($date_created); $post = cleans($title);
      $bd = previewBody($body,33);
      echo '<div class="item">
      <div class="item-content" style="margin-left:0px">
      <h2><a href="'.$link.'">'.strtoupper($title).'</a></h2>
      <span class="item-meta">
      <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
      </span>
      <p>'.$body.'</p>
      <h2><a href="'.$link.'">Download</a></h2>
      </div>
      </div>';
      if (($i++ % 4) == 1 ){
        echo '<div class="item"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <ins class="adsbygoogle"
        style="display:block"
        data-ad-format="fluid"
        data-ad-layout-key="-dv-21+4j+6-3s"
        data-ad-client="ca-pub-8913707638008127"
        data-ad-slot="9334540834"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
          </script></div>';
        }
    }
  }
  function getPaginatedEvent($dbconn,$fs,$pp){
    if(isset($_SESSION['user_id'])){
      $userhash = $_SESSION['user_id'];
      $sh = "&sh=$userhash";
    }else{
      $sh = "";
      $userhash = "";
    }
    $stmt = $dbconn->prepare("SELECT * FROM event ORDER BY id DESC LIMIT $fs,$pp");
    // $stmt->bindParam(":ff", $fs);
    // $stmt->bindParam(":bk", $pp);
    $stmt->execute();
      $i = 0;
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $SDate = decodeDate($start_date);
      $EDate = decodeDate($end_date);  $post = cleans($name);
      $bd = previewBody($about,22);
      echo '<div class="item">
      <div class="item-content" style="margin-left:0px">
      <h2><a href="event?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($name).'</a></h2>
      <span class="item-meta">
      <span class="item-meta-item">Start Date:<i class="fa fa-clock-o"></i>'.$SDate.'</span>
      <span class="item-meta-item">End Date:<i class="fa fa-clock-o"></i>'.$SDate.'</span>
      <span class="item-meta-item">Venue:<i class="fa fa-map-marker"></i>'.$venue.'</span>
      </span>
      <p>'.$bd.'<a href="event?post='.$post.'&id='.$hash_id.$sh.'" class="item-meta-item meta-button">Read More<i class="fa fa-caret-right"></i></a></p>
      </div>
      </div>';
      if (($i++ % 4) == 1 ){
        echo '<div class="item"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <ins class="adsbygoogle"
        style="display:block"
        data-ad-format="fluid"
        data-ad-layout-key="-dv-21+4j+6-3s"
        data-ad-client="ca-pub-8913707638008127"
        data-ad-slot="9334540834"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
          </script></div>';
        }
    }
  }
  function getPaginatedGrant($dbconn,$fs,$pp){
    if(isset($_SESSION['user_id'])){
      $userhash = $_SESSION['user_id'];
      $sh = "&sh=$userhash";
    }else{
      $sh = "";
      $userhash = "";
    }
    $vis = "show";
    $stmt = $dbconn->prepare("SELECT * FROM grants WHERE visibility=:vs ORDER BY id DESC LIMIT $fs,$pp");
    $stmt->bindParam(":vs", $vis);
    // $stmt->bindParam(":ff", $fs);
    // $stmt->bindParam(":bk", $pp);
    $stmt->execute();
      $i = 0;
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $SDate = decodeDate($date_created); $post = cleans($title);
      $bd = previewBody($body,22);
      echo '<div class="item">
      <div class="item-content" style="margin-left:0px">
      <h2><a href="trainingDetails?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($title).'</a></h2>
      <span class="item-meta">
      </span>
      <span class="item-meta">
      <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
      </span>
      <p>'.$bd.'<a href="trainingDetails?post='.$post.'&id='.$hash_id.$sh.'"class="item-meta-item meta-button">Read More<i class="fa fa-caret-right"></i></a></p>
      </div>
      </div>
      ';
      if (($i++ % 4) == 1 ){
        echo '<div class="item"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <ins class="adsbygoogle"
        style="display:block"
        data-ad-format="fluid"
        data-ad-layout-key="-dv-21+4j+6-3s"
        data-ad-client="ca-pub-8913707638008127"
        data-ad-slot="9334540834"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
          </script></div>';
        }
    }
  }
  function fetchCampusLink($dbconn,$categ,$tb){
    $active = 1;
    $stmt = $dbconn->prepare("SELECT * FROM campus WHERE $tb=:ac ORDER BY campus_name ASC");
    $stmt->bindParam(":ac",$active);
    $stmt->execute();
    echo '<li><a href="'.$categ.'">General</a></li>';
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      echo '<li><a href="'.$categ.'?c='.$hash_id.'">'.$campus_name.'</a></li>';
    }
  }
  function fetchFeatureLink($dbconn,$categ){
    $stmt = $dbconn->prepare("SELECT * FROM package_name ORDER BY package_name ASC");
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      echo '<li><a href="'.$categ.'?c='.$hash_id.'">'.$package_name.'</a></li>';
    }
  }
  function fetchNewsLink($dbconn,$categ){
    $stmt = $dbconn->prepare("SELECT * FROM news_category ORDER BY news_category ASC");
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      echo '<li><a href="'.$categ.'?c='.$hash_id.'">'.$news_category.'</a></li>';
    }
  }
  function getSearchResult($dbconn,$tb,$key,$fs,$pp){
    $stmt = $dbconn->prepare("SELECT * FROM $tb WHERE title LIKE :key OR body LIKE :key ORDER BY id DESC LIMIT $fs,$pp");
    $bindKey = "%".$key."%";
    $stmt->bindParam(":key",$bindKey);
    $stmt->execute();
    if($stmt->rowCount() > 0){
      while($row= $stmt->fetch(PDO::FETCH_BOTH)){
        extract($row);
        $SDate = decodeDate($date_created); $post = cleans($title);
        echo '<div class="item">
        <div class="item-content" style="margin-left:0px">
        <h2><a href="'.$link.'">'.strtoupper($title).'</a></h2>
        <span class="item-meta">
        <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
        </span>
        <p>'.$body.'</p>
        </div>
        </div>';
      }
    }else{
      echo '<div class="composs-comments">
      <div class="comment-list">
      <div class="comments-big-message">
      <i class="material-icons">search</i>
      <strong>No Result</strong>
      <p>Try other search keywords</p>
      </div>
      </div>
      </div>';
    }
  }
  function getSearchResultCount($dbconn,$tb,$key,$fs,$pp){
    $stmt = $dbconn->prepare("SELECT * FROM $tb WHERE title LIKE :key OR body LIKE :key ORDER BY id DESC LIMIT $fs,$pp");
    $bindKey = "%".$key."%";
    $stmt->bindParam(":key",$bindKey);
    $stmt->execute();
    $cnt = $stmt->rowCount();
    return $cnt;
  }
  function getPaginatedTraining($dbconn,$fs,$pp){
    $vis = "show";
    $stmt = $dbconn->prepare("SELECT * FROM training WHERE visibility=:vs ORDER BY id DESC LIMIT $fs,$pp");
    $stmt->bindParam(":vs", $vis);
    // $stmt->bindParam(":ff", $fs);
    // $stmt->bindParam(":bk", $pp);
    $stmt->execute();
      $i = 0;
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $SDate = decodeDate($date_created); $post = cleans($title);
      $bd = previewBody($body,33);
      echo '<div class="item">
      <div class="item-content" style="margin-left:0px">
      <h2><a href="'.$link.'">'.strtoupper($title).'</a></h2>
      <span class="item-meta">
      <a href="'.$link.'" class="item-meta-item meta-button">Visit Page<i class="fa fa-caret-right"></i></a>
      </span>
      <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
      <p>'.$body.'</p>
      </div>
      <span class="item"><div class="sharethis-inline-share-buttons" data-description="'.$bd.'" data-url="https://boardspeck.com/program" data-title="Would you love to attend? - '.$title.'"></div></span>
      </div>';
    }
  }
  function doUserRegister($dbconn, $input){
    $rnd = rand(0000000000,9999999999);
    $split = $input['firstname'];
    $id = $rnd.$split;
    $hash_id = str_shuffle($id);
    $hash = password_hash($input['pword'], PASSWORD_BCRYPT);
    #insert data
    $stmt = $dbconn->prepare("INSERT INTO user(firstname,lastname,email,phone_number,hash,hash_id,time_created,date_created) VALUES(:fn, :ln,:pn, :e, :h,:hid,NOW(),NOW())");
    #bind params...
    $data = [ ':fn' => $input['firstname'],
    ':ln' => $input['lastname'],
    ':e' => $input['email'],
    ':e' => $input['phonenumber'],
    ':h' => $hash,
    ':hid' => $hash_id
  ];
  $stmt->execute($data);
  $verlink = "https://mysite.com/u_verify?vcid=$hash_id";
  $suc = 'Registration Successful';
  $message = preg_replace('/\s+/', '_', $suc);
  header("Location:userRegistration?success=$message");
}
function userLogin($dbconn, $input){
  $stmt = $dbconn->prepare("SELECT * FROM user WHERE email = :e ");
  $stmt ->bindParam(":e", $input['email']);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_BOTH);
  if($stmt->rowCount() !=1 || !password_verify($input['pword'], $row['hash'])){
    $suc = 'Invalid Email or Password';
    $message = preg_replace('/\s+/', '_', $suc);
    header("Location:userLogin?err=$message");
  }else{
    $verification = 1;
    $statement = $dbconn->prepare("SELECT * FROM user WHERE email = :e AND verification=:ver ");
    $statement ->bindParam(":e", $input['email']);
    $statement ->bindParam(":ver", $verification);
    $statement->execute();
    if($statement->rowCount() !=1){
      $state = $dbconn->prepare("SELECT * FROM user WHERE email = :e ");
      $state ->bindParam(":e", $input['email']);
      $state->execute();
      $row = $state->fetch(PDO::FETCH_BOTH);
      extract($row);
      $suc = 'Dear '.ucwords($firstname).', Your Account has not been Verified';
      $message = preg_replace('/\s+/', '_', $suc);
      header("Location:userLogin?wn=$message");
    }else{
      extract($row);
      $_SESSION['user_id'] = $hash_id;
      setUserLogin($dbconn,$hash_id);
      if(isset($_GET['rd'])){
        header("Location:".$_GET['rd']);
      }else{
        header("Location:share");
      }
    }
  }
}
function setUserLogin($dbconn,$id){
  $lg = "Logged In";
  $stmt = $dbconn->prepare("UPDATE user SET last_login=NOW(),login_status=:lg WHERE hash_id=:id");
  $stmt->bindParam(":id",$id);
  $stmt->bindParam(":lg",$lg);
  $stmt->execute();
}
function setUserLogout($dbconn,$id){
  $lg = "Logged Out";
  $stmt = $dbconn->prepare("UPDATE user SET last_logout=NOW(),login_status=:lg WHERE hash_id=:id");
  $stmt->bindParam(":id",$id);
  $stmt->bindParam(":lg",$lg);
  $stmt->execute();
}
function getInsightHeader($dbconn){
  if(isset($_SESSION['user_id'])){
    $userhash = $_SESSION['user_id'];
    $sh = "&sh=$userhash";
  }else{
    $sh = "";
    $userhash = "";
  }
  $vis = "Show";
  $stmt = $dbconn->prepare("SELECT * FROM insight WHERE visibility=:sh ORDER BY id DESC LIMIT 2" );
  $stmt->bindParam(":sh", $vis);
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    extract($row);
    $SDate = decodeDate($date_created); $post = cleans($title);
    echo '<div class="item">
    <div class="item-header">
    <a href="insight?post='.$post.'&id='.$hash_id.$sh.'" class="img-read-later-button rm-btn-small">Read</a>
    <a href="#"><img src="'.$image_1.'" alt="'.$title.'" /></a>
    </div>
    <div class="item-content">
    <h4><a href="insight?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($title).'</a></h4>
    <span class="item-meta">
    <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
    </span>
    </div>
    </div>';
  }
  echo'<span class="item-meta">
  <a href="insight" class="item-meta-item meta-button">View More Insights <i class="fa fa-caret-right"></i></a>
  </span>';
}
function getCampusNewsHeader($dbconn){
  if(isset($_SESSION['user_id'])){
    $userhash = $_SESSION['user_id'];
    $sh = "&sh=$userhash";
  }else{
    $sh = "";
    $userhash = "";
  }
  $vis = "show";
  $stmt = $dbconn->prepare("SELECT * FROM campus_news WHERE visibility=:sh ORDER BY id DESC LIMIT 2" );
  $stmt->bindParam(":sh", $vis);
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    extract($row);
    $SDate = decodeDate($date_created); $post = cleans($headline);
    echo '<div class="item">
    <div class="item-header">
    <a href="campus_news?post='.$post.'&id='.$hash_id.$sh.'" class="img-read-later-button rm-btn-small">Read</a>
    <a href="#"><img src="'.$image_1.'" alt="'.$headline.'" /></a>
    </div>
    <div class="item-content">
    <h4><a href="campus_news?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($headline).'</a></h4>
    <span class="item-meta">
    <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
    </span>
    </div>
    </div>';
  }
  echo'<span class="item-meta">
  <a href="campus_news" class="item-meta-item meta-button">View More Campus News <i class="fa fa-caret-right"></i></a>
  </span>';
}
function getReportHeader2($dbconn){
  if(isset($_SESSION['user_id'])){
    $userhash = $_SESSION['user_id'];
    $sh = "&sh=$userhash";
  }else{
    $sh = "";
    $userhash = "";
  }
  $vis = "show";
  $stmt = $dbconn->prepare("SELECT * FROM news WHERE visibility=:sh ORDER BY id DESC LIMIT 2" );
  $stmt->bindParam(":sh", $vis);
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    extract($row);
    $SDate = decodeDate($date_created); $post = cleans($headline);
    echo '<div class="item">
    <div style="margin-left:10px" class="item-content">
    <h4><a href="news?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($headline).'</a></h4>
    <span class="item-meta">
    <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
    </span>
    </div>
    </div>';
  }
}
function getInsightHeader2($dbconn){
  if(isset($_SESSION['user_id'])){
    $userhash = $_SESSION['user_id'];
    $sh = "&sh=$userhash";
  }else{
    $sh = "";
    $userhash = "";
  }
  $vis = "Show";
  $stmt = $dbconn->prepare("SELECT * FROM insight WHERE visibility=:sh ORDER BY id DESC LIMIT 2" );
  $stmt->bindParam(":sh", $vis);
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    extract($row);
    $SDate = decodeDate($date_created); $post = cleans($title);
    echo '<div class="item">
    <div style="margin-left:10px" class="item-content">
    <h4><a href="insight?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($title).'</a></h4>
    <span class="item-meta">
    <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
    </span>
    </div>
    </div>';
  }
}
function getNewsHeader($dbconn,$rg){
  if(isset($_SESSION['user_id'])){
    $userhash = $_SESSION['user_id'];
    $sh = "&sh=$userhash";
  }else{
    $sh = "";
    $userhash = "";
  }
  $vis = "show";
  $stmt = $dbconn->prepare("SELECT * FROM news WHERE visibility=:sh AND category=:rg ORDER BY id DESC LIMIT 2" );
  $stmt->bindParam(":sh", $vis);
  $stmt->bindParam(":rg", $rg);
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    extract($row);
    $SDate = decodeDate($date_created); $post = cleans($headline);
    echo '<div class="item">
    <div class="item-header">
    <a href="news?post='.$post.'&id='.$hash_id.$sh.'" class="img-read-later-button rm-btn-small">Read</a>
    <a href="news?post='.$post.'&id='.$hash_id.$sh.'"><img src="'.$image_1.'" alt="'.$headline.'" /></a>
    </div>
    <div class="item-content">
    <h4><a href="news?post='.$post.'&id='.$hash_id.$sh.'">'.strtoupper($headline).'</a></h4>
    <span class="item-meta">
    <span class="item-meta-item"><i class="fa fa-clock-o"></i>'.$SDate.'</span>
    </span>
    </div>
    </div>';
  }
  if($rg == "8a8ol2G34157b07l"){
    echo'<span class="item-meta">
    <a href="news?c=8a8ol2G34157b07l" class="item-meta-item meta-button">More Global News <i class="fa fa-caret-right"></i></a>
    </span>';
  }elseif($rg == "gia5235e9940N73ir"){
    echo'<span class="item-meta">
    <a href="news?c=gia5235e9940N73ir" class="item-meta-item meta-button">More Nigerian News <i class="fa fa-caret-right"></i></a>
    </span>';
  }
}
?>
