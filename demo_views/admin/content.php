<?php
ob_start();
session_start();
$page_title = "Content";
include("include/link_include.php");
include("include/authentication.php");
include("include/levelcheck.php");
include("include/level1_limit.php");
include("include/student_limit.php");
// include("include/level2_limit.php");
authenticate();
if(isset($_SESSION['id'])){
  $session = $_SESSION['id'];
}
$info = adminInfo($conn,$session);
extract($info);
$fname = ucwords($firstname);
$lname = ucwords($lastname);
 ?>
<div id="content">
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
<!-- <div class="col-sm-3 page-sideabr">
<aside>

<div class="inner-box">
<div class="widget-title">
<h4>Advertisement</h4>
</div>
<img src="assets/img/img1.jpg" alt="">
</div>
</aside>
</div> -->
<div class="col-sm-9 page-content" style="width:100%;overflow-x:scroll; ">

<h2 class="title-2"><i class="fa fa-star-o"></i> Contents</h2>

<form class="form-ad"  action="index.html" method="post">
  <div class="col-md-4 col-sm-4 col-xs-12 search-bar search-bar-nostyle">
<div class="input-group-addon search-category-container">
  <select class="dropdown-product selectpicker" id="country" name="">
    <option value="">-select Country-</option>
  <option value="country=ng">Nigeria</option>
  <option value="country=us">United State</option>
  <option value="country=ca">Canada</option>
  </select>
  <select class="dropdown-product selectpicker" id="category" name="">
    <option value="">-General-</option>
  <option value="&category=health">Health</option>
  <option value="&category=sports">Sports</option>
  <option value="&category=entertainment">Entertainment</option>
  <option value="&category=business">Business</option>
</select><br><br><br>
  <button type="button"  class="btn btn-common" name="button" id="submit">Check</button>
</div>

</div>
</form>




<hr style="display:block; clear:both;">
<div class="table-responsive">
<table class="table table-striped table-bordered add-manage-table">
  <tr>
  <th>Title</th>
    <th>Info</th>
    <th>Image</th>
    <th>Date</th>
  </tr>
<tbody id="tbody">
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>

<script type="text/javascript">

var country = document.getElementById('country');
var category = document.getElementById('category');
window.addEventListener("load", function(e){
  var method = 'GET';
  // var params = 'country='+ 'au';
  // params += '&apiKey=1a6c9b047b5e445cab79d79694c9ff4b';
  // params += '&text='+ txt.innerHTML;
  var url = 'https://newsapi.org/v2/top-headlines?country=ng&apiKey=1a6c9b047b5e445cab79d79694c9ff4b';
  ajax(url, method);
}, false);

submit.addEventListener('click', function(e){
var method = 'GET';
// var params = 'country='+ 'au';
// params += '&apiKey=1a6c9b047b5e445cab79d79694c9ff4b';
// params += '&text='+ txt.innerHTML;
var url = 'https://newsapi.org/v2/top-headlines?'+country.value+category.value+'&apiKey=1a6c9b047b5e445cab79d79694c9ff4b';
ajax(url, method);

e.preventDefault();
},false);




function ajax(url, method){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
    var res = JSON.parse(xhr.responseText);
    if(res){
        tbody.innerHTML= "";
      res.articles.forEach(function(value){
      var  tr = document.createElement('tr'),
      info = document.createElement('td'),
      tit = document.createElement('td'),
      img = document.createElement('td'),
      pt = document.createElement('td'),
      image = document.createElement('img'),
      anchor = document.createElement('a'),
      imgAnchor = document.createElement('a'),
      title = document.createElement('p'),
      author = document.createElement('p'),
      ptime = document.createElement('p'),
      source = document.createElement('p'),
      tbody = document.getElementById('tbody'),
      titleVal,
      authorVal,
      sourceVal,
      timeVal,


      timeVal = document.createTextNode(value.publishedAt)
      ptime.appendChild(timeVal);

      titleVal = document.createTextNode(value.title);
      title.appendChild(titleVal);

      authorVal = document.createTextNode("Author: "+value.author);
      author.appendChild( authorVal);

      sourceVal = document.createTextNode("Source: "+value.source.name);
      source.appendChild(sourceVal);

      anchor.setAttribute("href",value.url);
      anchor.setAttribute("target","_blank");
      anchor.appendChild(title);



      image.setAttribute("class","img-responsive");
      image.setAttribute("src",value.urlToImage);
      imgAnchor.setAttribute("href",value.urlToImage);
      imgAnchor.appendChild(image);


      info.setAttribute("class","ads-details-td");
      info.appendChild(source);
      info.appendChild(author);

      img.setAttribute("class","add-img-td");
      img.appendChild(imgAnchor);

      tit.setAttribute("class","ads-details-td");
      tit.appendChild(anchor);

      pt.setAttribute("class","ads-details-td");
      pt.appendChild(ptime);

      tr.appendChild(tit);
      tr.appendChild(img);
      tr.appendChild(info);
      tr.appendChild(ptime);


      tbody.appendChild(tr);

});
    }
    console.log(res);
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  xhr.setRequestHeader("Authorization","Bearer 1a6c9b047b5e445cab79d79694c9ff4b");
  // xhr.setRequestHeader("Access-Control-Allow-Origin","https://boardspeck.com");
  // xhr.setRequestHeader("ACCEPT","*/*");
  var sd = xhr.send();
  //console.log(sd);
}




</script>

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

<!-- Mirrored from demo.graygrids.com/themes/classix-template/account-saved-search.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Nov 2017 11:42:23 GMT -->
</html>
