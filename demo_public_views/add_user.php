<?php
ob_start();
$page_title = "Register - BoardSpeck";
$page_name = "register";
include("include/header.php");

$error= [];

if(array_key_exists('submit', $_POST)){

  if(empty($_POST['firstname'])){
    $error['firstname']="Enter a firstname";
  }

  if(empty($_POST['lastname'])){
    $error['lastname']="Enter a lastname";
  }

  if(empty($_POST['email'])){
    $error['email']="Enter a email";
  }
  if(empty($_POST['phonenumber'])){
    $error['phonenumber']="Enter a phonenumber";
  }

  if(doesUserEmailExist($conn,$_POST['email'])){
    $error['email'] = "*Email already exists on our system, Please enter another email";
  }

  if(empty($_POST['pword'])){
    $error['pword']="Enter a password";
  }
  if(empty($_POST['cpword'])){
    $error['cpword']="Confirm password";
  }

  if($_POST['pword']!=$_POST['cpword']){
    $error['pword'] ="Password mismatch";
  }

  if(empty($error)){
    $clean = array_map('trim', $_POST);
    doUserRegister($conn, $clean);
    $firstname = $clean['firstname'];
    $lastname = $clean['lastname'];

     $to = "boardspeck@gmail.com";
     $subject = "Boardspeck Web Office Sharer Registration";
     $txt = "Hello Admin, A new Admin($firstname $lastname)  has registered to the web office. Kindly check for Verification";
     $headers = "From: info@boardspeck.com" . "\r\n" .
     "CC: banjimayowa@gmail.com";

     mail($to,$subject,$txt,$headers);
  }
}

 ?>

<section id="content">
<div class="container">
<div class="row">
<?php
if (isset($_GET['success'])){
$msg = str_replace('_', ' ', $_GET['success']);

  echo '<div class="col-md-12">
<div class="inner-box posting">
<div class="alert alert-success alert-lg" role="alert">
<h2 class="postin-title">✔ Congratulations! '.$msg.' </h2>

<p>Thank you, Your account will be verified at the BoardSpeck Web Office. You would recieve a notification via your email</p>
</div>
</div>
</div>';
}


 ?>

<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
<div class="page-login-form box">

<h3>
Register
</h3>
<form role="form" class="login-form" method="POST" action="">
<div class="form-group">
<div class="input-icon">
  <?php $display = displayErrors($error, 'firstname');
  echo $display ?>
<i class="icon fa fa-user"></i>
<input type="text" id="sender-email" class="form-control" name="firstname" placeholder="Firstname">
</div>
</div>
<div class="form-group">
<div class="input-icon">
  <?php $display = displayErrors($error, 'lastname');
  echo $display ?>
<i class="icon fa fa-user"></i>
<input type="text" id="sender-email" class="form-control" name="lastname" placeholder="Lastname">
</div>
</div>
<div class="form-group">
  <?php $display = displayErrors($error, 'email');
  echo $display ?>
<div class="input-icon">
<i class="icon fa fa-envelope"></i>
<input type="text" id="sender-email" class="form-control" name="email" placeholder="Email Address">
</div>
</div>
<div class="form-group">
  <?php $display = displayErrors($error, 'phonenumber');
  echo $display ?>
<div class="input-icon">
<i class="icon fa fa-envelope"></i>
<input type="text" id="sender-email" class="form-control" name="phonenumber" placeholder="Phone Number">
</div>
</div>
<div class="form-group">
<div class="input-icon">
  <?php $display = displayErrors($error, 'pword');
  echo $display ?>
<i class="icon fa fa-unlock-alt"></i>
<input type="password" class="form-control" name="pword" placeholder="Password">
</div>
</div>
<div class="form-group">
  <?php $display = displayErrors($error, 'cpword');
  echo $display ?>
<div class="input-icon">
<i class="icon fa fa-unlock-alt"></i>
<input type="password" class="form-control" name="cpword" placeholder="Retype Password">
</div>
</div>

<div class="checkbox">
  &nbsp &nbsp
<input type="checkbox" id="remember" name="rememberme" value="forever" style="float: left;">
<label for="remember">By creating account you agree to our Terms & Conditions</label>
</div>
<input type="submit"  name="submit"
<button class="btn btn-common log-btn"></button>

</form>
</div>
</div>
</div>
</div>
</section>




<script type="text/javascript" src="assets/js/jquery-min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/material.min.js"></script>
<script type="text/javascript" src="assets/js/material-kit.js"></script>
<script type="text/javascript" src="assets/js/jquery.parallax.js"></script>
<script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="assets/js/wow.js"></script>
<script type="text/javascript" src="assets/js/main.js"></script>
<script type="text/javascript" src="assets/js/jquery.counterup.min.js"></script>
<script type="text/javascript" src="assets/js/waypoints.min.js"></script>
<script type="text/javascript" src="assets/js/jasny-bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/form-validator.min.js"></script>
<script type="text/javascript" src="assets/js/contact-form-script.js"></script>
<script type="text/javascript" src="assets/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.themepunch.tools.min.js"></script>
<script src="assets/js/bootstrap-select.min.js"></script>
<?php
include("include/footer.php");
?>
