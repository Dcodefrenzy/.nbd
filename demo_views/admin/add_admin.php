<?php
ob_start();
session_start();
// include("include/link_include.php");

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

  if(doesEmailExist($conn,$_POST['email'])){
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
    doAdminRegister($conn, $clean);


 //      $from = "info@mckodev.com.ng"; //enter your email address
 // $to = "banjimayowa@gmail.com"; //enter the email address of the contact your sending to
 // $subject = "BOARDSPECK New Admin User Registration"; // subject of your email
$firstname = $clean['firstname'];
$lastname = $clean['lastname'];

 $to = "boardspeck@gmail.com";
 $subject = "Boardspeck Web Office Admin Registration";
 $txt = "Hello Admin, A new Admin($firstname $lastname)  has registered to the web office. Kindly check for Verification";
 $headers = "From: info@boardspeck.com" . "\r\n" .
 "CC: banjimayowa@gmail.com";

 mail($to,$subject,$txt,$headers);

  }
}

 ?>
 <!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.graygrids.com/themes/classix-template/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Nov 2017 11:40:54 GMT -->
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="author" content="BoardSpeck">
<title>BoardSpeck Web Office </title>

<link rel="shortcut icon" href="assets/img/favicon.png">

<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/jasny-bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/jasny-bootstrap.min.css" type="text/css">

<link rel="stylesheet" href="assets/css/material-kit.css" type="text/css">

<link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" href="assets/fonts/line-icons/line-icons.css" type="text/css">

<link rel="stylesheet" href="assets/css/main.css" type="text/css">

<link rel="stylesheet" href="assets/extras/animate.css" type="text/css">

<link rel="stylesheet" href="assets/extras/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/extras/owl.theme.css" type="text/css">
<link rel="stylesheet" href="assets/extras/settings.css" type="text/css">

<link rel="stylesheet" href="assets/css/responsive.css" type="text/css">

<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
</head>
<body>



<div class="page-header" style="background: url(assets/img/banner1.jpg);">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<h2 class="page-title">Register on the BoardSpeck Web Office</h2>
</div>
</div>
</div>
</div>
</div>



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
<p>Thank you, BoardSpeck is happy to have you around. Your Account will be Verified and you will be notified Via your Email Address</p>
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
<input type="text" id="sender-email" class="form-control" name="phonenumber" placeholder="Phonenumber">
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
<input type="checkbox" id="remember" name="rememberme" value="forever" style="float: left;">
<label for="remember">By creating account you agree to our Terms & Conditions</label>
</div>
<input type="submit"  name="submit"
<button class="btn btn-common log-btn"></button>
<label for="remember">Already registered and Verified? <a href="adminLogin"> Sign In</a></label>


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
</body>

<!-- Mirrored from demo.graygrids.com/themes/classix-template/signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Nov 2017 11:40:55 GMT -->
</html>
