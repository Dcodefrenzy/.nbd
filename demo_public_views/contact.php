<?php
$page_title = "Contact - BoardSpeck";
$page_name = "contact";
include("include/header.php");
if(array_key_exists("submit", $_POST)){
  $email = $_POST['email'];
  $name = $_POST['name'];
  $message = $_POST['comment'];

  $to = "boardspeck@gmail.com";
  $subject = "Message From $name to Boardspeck Office";
  $txt = $message. "<hr>the email to this message is $email";
  $headers = "From: $email" . "\r\n" .
  "CC: banjimayowa@gmail.com";

  mail($to,$subject,$txt,$headers);
}
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
 									<strong>Contact</strong>
 								</div>

 								<div class="composs-panel-inner">
 									<div class="map-block">
 										<div class="map-block-header">
 											<h3>BoardSpeck </h3>
 											<div class="paragraph-row">

 												<div class="column4">
 													<ul>
 														<li><a href="mailto:boardspeck@gmail.com"><i class="fa fa-envelope"></i>boardspeck@gmail.com</a></li>
 													</ul>
 												</div>

 											</div>
 										</div>
 										<!-- <div class="map-block-content google-maps">
                      <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d990.9127101880074!2d3.366189884076693!3d6.565679294688696!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sng!4v1520420440411" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

 										</div> -->
 									</div>
 								</div>

 							<!-- END .composs-panel -->
 							</div>

 							<!-- BEGIN .composs-panel -->
 							<div class="composs-panel">

 								<div class="composs-panel-title">
 									<strong>Contact us</strong>
 								</div>

 								<div class="composs-panel-inner">
 									<div class="comment-form">
 										<div id="respond" class="comment-respond">

 											<form action="#" method="post" class="comment-form">
 												<div class="alert-message ot-shortcode-alert-message alert-green">
 													<strong>Success! This a success message</strong>
 												</div>
 												<!-- <div class="alert-message ot-shortcode-alert-message alert-red">
 													<strong>Error! This an error message</strong>
 												</div>
 												<div class="alert-message ot-shortcode-alert-message">
 													<strong>Warning! This a warning message</strong>
 												</div> -->
 												<div class="contact-form-content">
 													<p class="contact-form-user">
 														<label class="label-input">
 															<span>Name<i class="required">*</i></span>
 															<input type="text" placeholder="Nickname" name="name" value="" required>
 														</label>
 													</p>
 													<p class="contact-form-email">
 														<label class="label-input">
 															<span>E-mail<i class="required">*</i></span>
 															<input type="email" placeholder="E-mail" name="email" value="" required>
 														</label>
 													</p>
 													<p class="contact-form-comment">
 														<label class="label-input">
 															<span>Message text<i class="required">*</i></span>
 															<textarea name="comment" placeholder="Message text" required></textarea>
 														</label>
 													</p>
 													<p class="form-submit">
 														<input name="submit" type="submit" id="submit" class="submit button" value="Send this message">
 													</p>
 												</div>
 											</form>

 										</div>
 									</div>
 								</div>

 							<!-- END .composs-panel -->
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

      <?php
      include("include/footer.php");
       ?>
