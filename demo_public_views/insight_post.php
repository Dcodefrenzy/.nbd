<?php
ob_start();
$page_title = "Insight - BoardSpeck";
$page_name = "insight_post";
$stmt = $conn->prepare("SELECT * FROM insight WHERE hash_id =:idd");
$stmt->bindParam(":idd", $_GET['id']);
// $stmt->bindParam(":bk", $pp);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_BOTH);
extract($row);
$SDate = decodeDate($date_created);
include("include/header.php");
 ?>
 <!-- BEGIN .content -->
 <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.12';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
 <div class="content">
   <!-- BEGIN .wrapper -->
   <div class="wrapper">
     <div class="content-wrapper">
       <!-- BEGIN .composs-main-content -->
       <div class="composs-main-content composs-main-content-s-1">
         <div class="theiaStickySidebar">
           <!-- BEGIN .composs-panel -->
           <div class="composs-panel">
             <!-- <div class="composs-panel-title">
               <strong>Blog page style #1</strong>
             </div> -->
             <div class="composs-panel-inner">
               <div class="composs-main-article-content">
                 <h1><?php echo $title ?></h1>
                 <div class="composs-main-article-head">
                   <div class="composs-main-article-media" >
                     <img src="<?php echo $image_1 ?>" alt="<?php echo $title ?>" style="min-width:100%" />
                   </div>
                   <div class="composs-main-article-meta">
                     <span class="item"><i class="fa fa-clock-o"></i><?php echo $SDate ?></span>
                <span class="item"><i class="fa fa-user"></i><?php echo $author ?></span>
                     <span class="item"><i class="fa fa-folder"></i><?php $categ = getEntityCategory($conn,'package_name','package_name',$category); echo $categ['package_name'];?></span>
<span class="item"><div class="sharethis-inline-share-buttons" ></div></span>
                   </div>
                 </div>
                 <div class="shortcode-content">
                  <?php echo $body ?>
                 </div>
               </div>
               <div class="fb-comments" data-mobile="true" data-href="http://news.mckodev.com.ng/insight?id=<?php echo $_GET['id'] ?>" data-width="700px" data-numposts="10"></div>
             </div>
           <!-- END .composs-panel -->
           </div>
         </div>
       <!-- END .composs-main-content -->
       </div>
       <!-- BEGIN #sidebar -->
        <?php include 'include/event_aside.php' ?>
     </div>
   <!-- END .wrapper -->
   </div>
 <!-- BEGIN .content -->
 </div>
 <script>window.twttr = (function(d, s, id) {
 var js, fjs = d.getElementsByTagName(s)[0],
   t = window.twttr || {};
 if (d.getElementById(id)) return t;
 js = d.createElement(s);
 js.id = id;
 js.src = "https://platform.twitter.com/widgets.js";
 fjs.parentNode.insertBefore(js, fjs);
 t._e = [];
 t.ready = function(f) {
   t._e.push(f);
 };
 return t;
}(document, "script", "twitter-wjs"));</script>
<?php
  include("include/footer.php");
 ?>
