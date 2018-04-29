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
            <div class="map-block">
              <div class="map-block-header">


                <h3><?php echo $title ?></h3>
                <div class="paragraph-row">
                  <div class="column4">
                     <a href="<?php echo $link?>" class="item"><i class="material-icons"></i> Visit Website</a>
                  </div>
                  <div class="column4">
                    <i class="material-icons large-icon">location_city</i>
                    <!-- <i class="material-icons large-icon">location_on</i> -->
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



        </div>

        <!-- END .wrapper -->
      </div>

      <?php include 'include/global_aside.php' ?>

      <!-- BEGIN .content -->
    </div>

    <?php
    include("include/footer.php");
    ?>
