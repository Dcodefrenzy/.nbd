<?php
ob_start();
session_start();
include("include/link_include.php");
include("include/authentication.php");
include("include/levelcheck.php");
include("include/student_limit.php");
include("include/level1_limit.php");
authenticate();
if(isset($_SESSION['id'])){
  $session = $_SESSION['id'];
}
$info = adminInfo($conn,$session);
extract($info);
$fname = ucwords($firstname);
$lname = ucwords($lastname);
$edit_info = getEditInfo($conn,$_GET['id'],'insight');
$error= [];
if(array_key_exists('submit', $_POST)){
  if(empty($_POST['title'])){
    $error['title']="Enter a Title";
  }
  if(empty($_POST['author'])){
    $error['author']="Enter a Author";
  }
  if(empty($_POST['category'])){
    $error['category']="Enter a Category";
  }
  if(empty($_POST['body'])){
    $error['body']="Enter a body";
  }
  if(empty($error)){
    $clean = array_map('trim', $_POST);
    editInsight($conn, $clean,$_GET['id']);
  }
}
?>
<section id="content">
  <div class="container">
    <div class="row">
      <?php if (isset($_GET['success'])){
        $msg = str_replace('_', ' ', $_GET['success']);
        echo '<div class="col-md-12">
        <div class="inner-box posting">
        <div class="alert alert-success alert-lg" role="alert">
        <h2 class="postin-title">✔ Successful! '.$msg.' </h2>
        <p>Thank you '.ucwords($firstname).', BoardSpeck is happy to have you around. </p>
        </div>
        </div>
        </div>';
      } ?>
      <div class="col-sm-12 col-md-10 col-md-offset-1">
        <div class="page-ads box">
          <h2 class="title-2">Welcome to the Edit page</h2>
          <div class="row search-bar mb30 red-bg">
            <div class="advanced-search">
              <form class="search-form" method="get">
                <div class="col-md-4 col-sm-12 search-col">
                  <h3>Please post your article.</h3>
                </div>
              </form>
            </div>
          </div>
          <form class="form-ad" action="" method="post" enctype="multipart/form-data">
            <div class="form-group mb30">
              <label class="control-label">Article Title</label><?php $display = displayErrors($error, 'title');
              echo $display ?> <input class="form-control input-md" name="title" placeholder="Write a suitable title for your article" value="<?php echo $edit_info['title']      ?>"  type="text">
            </div>
            <div class="form-group mb30">
              <label class="control-label">Article Author</label><?php $display = displayErrors($error, 'author');
              echo $display ?> <input class="form-control input-md" name="author" placeholder="Write a the name of the author" value="<?php echo $edit_info['author']      ?>"  type="text">
            </div>
            <div class="form-group mb30">
              <label class="control-labell">CATEGORY (<?php $categ = getEntityCategoryAdmin($conn,'package_name','package_name',$edit_info['category']); echo $categ['package_name'];?>) </label>  <?php $display = displayErrors($error, 'category');
              echo $display ?><br><select value="" class="dropdown-product selectpicker" name="category" required>
                <option value="">
                  --Select--
                </option>
                <?php  getPackageName($conn); ?>
              </select>
              <div class="form-group mb30">
                <label class="control-label" for="textarea">Body</label>
                <?php $display = displayErrors($error, 'body');
                echo $display ?>
                <textarea class="form-control" id="editor1" name="body" placeholder="" rows="4"><?php echo $edit_info['body'] ?></textarea>
              </div>
              <br/>
              <div class="form-group">
                <input type="submit" class="btn btn-common" name="submit" value="Edit">
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <a class="back-to-top" href="#"><i class="fa fa-angle-up"></i></a>
    <!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> -->
    <script type="text/javascript">
     CKEDITOR.replace( 'editor1',
     {
        toolbarGroups :
        [
            { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
              { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
              { name: 'links' },
                { name: 'insert' },
                    { name: 'others' },
                  { name: 'forms' },
                { name: 'tools' },
                '/',
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                { name: 'styles' },
                { name: 'colors' },
        ]
      });
    </script>
    <script src="assets/js/jquery-min.js" type="text/javascript">
    </script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript">
    </script>
    <script src="assets/js/material.min.js" type="text/javascript">
    </script>
    <script src="assets/js/material-kit.js" type="text/javascript">
    </script>
    <script src="assets/js/jquery.parallax.js" type="text/javascript">
    </script>
    <script src="assets/js/owl.carousel.min.js" type="text/javascript">
    </script>
    <script src="assets/js/wow.js" type="text/javascript">
    </script>
    <script src="assets/js/main.js" type="text/javascript">
    </script>
    <script src="assets/js/jquery.counterup.min.js" type="text/javascript">
    </script>
    <script src="assets/js/waypoints.min.js" type="text/javascript">
    </script>
    <script src="assets/js/jasny-bootstrap.min.js" type="text/javascript">
    </script>
    <script src="assets/js/form-validator.min.js" type="text/javascript">
    </script>
    <script src="assets/js/contact-form-script.js" type="text/javascript">
    </script>
    <script src="assets/js/jquery.themepunch.revolution.min.js" type="text/javascript">
    </script>
    <script src="assets/js/jquery.themepunch.tools.min.js" type="text/javascript">
    </script>
    <script src="assets/js/bootstrap-select.min.js">
    </script>
    <script src="assets/js/fileinput.js">
    </script>
  </body>
  <!-- Mirrored from demo.graygrids.com/themes/classix-template/post-ads.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Nov 2017 11:40:57 GMT -->
  </html>
