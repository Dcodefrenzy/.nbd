<?php
$time = $_SERVER['REQUEST_TIME'];

/**
* for a 30 minute timeout, specified in seconds
*/
$timeout_duration = 1800;

/**
* Here we look for the user's LAST_ACTIVITY timestamp. If
* it's set and indicates our $timeout_duration has passed,
* blow away any previous $_SESSION data and start a new one.
*/
if (isset($_SESSION['LAST_ACTIVITY']) &&
   ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    session_start();
}

/**
* Finally, update LAST_ACTIVITY so that our timeout
* is based on it and not the user's login time.
*/
$_SESSION['LAST_ACTIVITY'] = $time;
$page_title = "Home - BoardSpeck";
$page_name = "share";
include ("include/header.php");
if(isset($_SESSION['user_id'])){
$user = userFullInfo($conn, $_SESSION['user_id']);
}else{
  header("Location:index");
}
?>
<!-- BEGIN .main-slider -->

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
            <strong>Account Details</strong>
          </div>
          <div class="composs-panel-inner">
            <div class="composs-blog-list lets-do-1">


<?php if($user['user_status']== 2){
?>
<h4>This Account has been suspended for suspicious activities on our page. You are advised to stop sharing with this account as you can never earn from Boardspeck post sharing</h4>
<p>If you think this is a misunderstanding, Please contact the Boardspeck Web Office from the Contact Us Section of this website</p>

<?php }else{ ?>



              Name: <?php echo $user['firstname'] .' '.$user['lastname']; ?><br>
              Verification Status: <?php if($user['verification'] == 1){
                echo "Verified";
              }else{
                echo "Not Verified";
              } ?><br>
              Points: <?php echo $user['points']?><br>
              Total Amount Earned: <?php echo $user['points']?> Naira<br>


            <?php } ?>
            </div>
          </div>

          <!-- END .composs-panel -->
        </div>
        <!-- END .composs-main-content -->
      </div>
      <!-- BEGIN #sidebar -->
      <aside id="sidebar">

        <!-- BEGIN .widget -->

      <!-- BEGIN .widget -->

      <!-- BEGIN .widget -->
      <div class="widget">
      <div class="widget-content">
      <!--<a href="#" target="_blank"><img src="images/o2.jpg" alt="" /></a>-->
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
      <!-- END .widget -->
      </div>

      <!-- BEGIN .widget -->



      <!-- BEGIN .widget -->

      <!-- BEGIN .widget -->


      <!-- END #sidebar -->
      </aside>
    </div>
    <!-- END .wrapper -->
  </div>
  <!-- BEGIN .content -->
</div>
<?php
include("include/footer.php");
?>
