<?php
$page_title = "Training - BoardSpeck";
$page_name = "view_training";
$stmt = $conn->prepare("SELECT * FROM grants WHERE hash_id =:idd");
$stmt->bindParam(":idd", $_GET['id']);
// $stmt->bindParam(":bk", $pp);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_BOTH);
extract($row);
// $SDate = decodeDate($start_date);
// $EDate = decodeDate($end_date);
include("include/header.php");
?>
<!-- BEGIN .content -->
<div class="content">
  <!-- BEGIN .wrapper -->
  <div class="wrapper">
    <div class="content-wrapper">
      <!-- BEGIN .composs-main-content -->
      <div class="composs-main-content composs-main-content-s-1">
        <!-- BEGIN .composs-panel -->
        <div class="composs-panel">
          <div class="composs-panel-title">
            <strong>Training</strong>
          </div>
          <div class="composs-panel-inner">
            <div class="composs-main-article-head">
              <div class="composs-main-article-media" >
                <img src="<?php echo $image_1 ?>" alt="<?php echo $title ?>" style="min-width:100%" />
              </div>
            </div>
            <div class="map-block">
              <div class="map-block-header">
                <h3><?php echo $title ?></h3>
                <div class="paragraph-row">
                  <div class="column4">
                    <a href="<?php echo $link?>" class="item"><i class="material-icons"></i> Visit Website</a>
                  </div>
                </div>
                <span class="item"><div class="sharethis-inline-share-buttons"></div></span>
              </div>
              <div class="item">
                <div class="item-content" style="margin-left:0px">
                  <p> <?php echo $body ?> </p>
                </div>
              </div>
              <!-- END .composs-panel -->
            </div>
            <!-- BEGIN .composs-panel -->
            <!-- END .composs-main-content -->
          </div>
          <div class="header-content-o">
          	<!--<a href="#" target="_blank"><img src="images/o1.jpg" alt="" /></a>-->
          	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
          	<!-- box ads -->
          	<ins class="adsbygoogle"
          	style="display:block"
          	data-ad-client="ca-pub-8913707638008127"
          	data-ad-slot="9737468736"
          	data-ad-format="auto"></ins>
          	<script>
          	(adsbygoogle = window.adsbygoogle || []).push({});
          	</script>
          </div>	<div class="header-content-o">
          		<!--<a href="#" target="_blank"><img src="images/o1.jpg" alt="" /></a>-->
          		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
          		<!-- box ads -->
          		<ins class="adsbygoogle"
          		style="display:block"
          		data-ad-client="ca-pub-8913707638008127"
          		data-ad-slot="9737468736"
          		data-ad-format="auto"></ins>
          		<script>
          		(adsbygoogle = window.adsbygoogle || []).push({});
          		</script>
          	</div>
        </div>
        <!-- END .wrapper -->
      </div>
      <?php include 'include/global_aside.php' ?>
      <!-- BEGIN .content -->
    </div>
    <?php
    include("include/footer.php");
    ?>
