<?php

// session_start();
///////////////////////////////////////////////////////////////////////////////////////////////////////////
// $lifetime=30000;
//  session_start();
//  setcookie(session_name(),session_id(),time()+$lifetime);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
 // die(ini_get("session.gc_maxlifetime"));
$page_title = "Home - BoardSpeck";
$page_name = "share";
include ("include/header.php");
if(isset($_SESSION['user_id'])){
$user = userFullInfo($conn, $_SESSION['user_id']);
}else{
  header("Location:index");
}
?>
<input type="hidden" name="" value="">
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
              Point Per Visit: <?php echo $user['rate']?><br>
              Points Earn: <?php echo $user['points']?><br>
              Total Amount Earned: NGN <?php echo $user['points']?><br>


            <?php } ?>
            </div>
            <div class="well">
              <h3>Important Information</h3>
              <li>Ensure that you are logged in all the time...</li>
              <li>If you read posts on this website...you will earn your points</li>
              <li>If you share the posts to your social media accounts, you will earn a point if people visits with your link.One per person</li>
              <li>Your points will be paid at the minimum of 1000 points...1000points = NGN1000 </li>
              If you have any enquiry to make please contact 08168785581 (Whatsapp Enabled)
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
