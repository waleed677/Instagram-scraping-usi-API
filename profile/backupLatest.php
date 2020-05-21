<?php
include('../include/simple_html_dom.php');
require("../include/config.php");
require("../include/functions.php");
$username = $_GET["username"];

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <!-- SITE TITTLE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $username; ?>- Insmk</title>
  
  <!-- FAVICON -->
  <link href="img/favicon.png" rel="shortcut icon">
  <!-- PLUGINS CSS STYLE -->
  <!-- <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet"> -->
  <!-- Bootstrap -->
   <!-- Bootstrap -->
   <link rel='stylesheet' href='<?php echo BASE_URL  ?>assets/plugins/bootstrap/css/bootstrap.min.css'>
  <link rel='stylesheet' href='<?php echo BASE_URL  ?>assets/plugins/bootstrap/css/bootstrap-slider.css'>
  <!-- Font Awesome -->
  <link href='<?php echo BASE_URL  ?>assets/plugins/font-awesome/css/font-awesome.min.css' rel='stylesheet'>
  <!-- Owl Carousel -->
  <link href='<?php echo BASE_URL  ?>assets/plugins/slick-carousel/slick/slick.css' rel='stylesheet'>
  <link href='<?php echo BASE_URL  ?>assets/plugins/slick-carousel/slick/slick-theme.css' rel='stylesheet'>
  <!-- Fancy Box -->
  <link href='<?php echo BASE_URL  ?>assets/plugins/fancybox/jquery.fancybox.pack.css' rel='stylesheet'>
  <link href='<?php echo BASE_URL  ?>assets/plugins/jquery-nice-select/css/nice-select.css' rel='stylesheet'>
  <!-- CUSTOM CSS -->
  <link href='<?php echo BASE_URL  ?>assets/css/style.css' rel='stylesheet'>
  <link href="<?php echo BASE_URL  ?>assets/css/instagram.css" rel="stylesheet">
  

</head>

<body class="body-wrapper">
<div class="se-pre-con"></div>

<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php  include('../include/menu.php'); ?>
			</div>
		</div>
	</div>
</section>

<!--===============================
=            Hero Area            =
================================-->

<section class=" section" style="padding:0px;">
	<!-- Container Start -->
	<div class="container">

		<div class="profile">

			<div class="profile-image">

				<img src="" alt="" class="profile-pic">

			</div>

			<div class="profile-user-settings">

				<h1 class="profile-user-name name"></h1>

				

			</div>

			<div class="profile-stats">

				<ul>
					<li><span class="profile-stat-count postcount"></span> posts</li>
					<li><span class="profile-stat-count followers"></span> followers</li>
					<li><span class="profile-stat-count following"></span> following</li>
				</ul>

			</div>

			<div class="profile-bio">

				<p class="biography"><span class="profile-real-name name"></span></p>

			</div>

		</div>
		<!-- End of profile section -->

	</div>
	<!-- End of container -->

<div class="container">
  <hr>
    <!-- ==============================================
	    Hero
      =============================================== -->

      <section class="hero" id="hero" style="display:none;">
         <div class="container">
          <div class="row">	
          <div class="col-lg-2"></div>
          <div class="col-lg-8">
          <h1 class="text-center"><span class="name"></span> account is private  </h1>
          <p style="font-size:18px;text-align:center">Sorry to say that, but this account is private.. go back to Home</p>
          <div class="text-center">
          <a class="nav-link text-white add-button " href="<?php echo BASE_URL; ?>"><i class="fa fa-right"></i>Go Back</a>
          </div>
          </div>
         </div><!--/ container -->
        </section>

      <section class="heros">
         <div class="container">
          <div class="row">	
          <section id="pinBoot" class="posts">

          </section>
		  
		   
         </div><!--/ container -->
         <div class="row">
         <div class="col-lg-6"></div>
         <div class="col-lg-3">
         <img id="loader" src="<?php echo BASE_URL ?>assets/images/loader.svg">

         <!-- <button class="nav-link text-white add-button " id="load">load More</button> -->
         <input type="hidden" id = "userid" >
         <input type="hidden" id = "after" >
         <input type="hidden" id = "profilepic" >
         <input type="hidden" id = "tag" >
         <input type="hidden" id = "username" value="<?php  echo $username; ?>" >
         <input type="hidden" id="base" value="<?php echo BASE_URL; ?>">
         </div>
         </div>
         </div>
        </section>




  
 

</div>
	
	<!-- Container End -->
</section>

<!--===================================
=            Client Slider            =
====================================-->




<?php  include('../include/footer.php'); ?>

<!-- JAVASCRIPTS -->
<!-- JAVASCRIPTS -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='<?php echo BASE_URL  ?>assets/plugins/jQuery/jquery.min.js'></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src='<?php echo BASE_URL  ?>assets/plugins/bootstrap/js/popper.min.js'></script>
<script src='<?php echo BASE_URL  ?>assets/plugins/bootstrap/js/bootstrap.min.js'></script>
<script src='<?php echo BASE_URL  ?>assets/plugins/bootstrap/js/bootstrap-slider.js'></script>
  <!-- tether js -->
<script src='<?php echo BASE_URL  ?>assets/plugins/tether/js/tether.min.js'></script>
<script src='<?php echo BASE_URL  ?>assets/plugins/raty/jquery.raty-fa.js'></script>
<script src='<?php echo BASE_URL  ?>assets/plugins/slick-carousel/slick/slick.min.js'></script>
<script src='<?php echo BASE_URL  ?>assets/plugins/jquery-nice-select/js/jquery.nice-select.min.js'></script>
<script src='<?php echo BASE_URL  ?>assets/plugins/fancybox/jquery.fancybox.pack.js'></script>
<
<!-- google map -->
<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places'></script>
<script src='<?php echo BASE_URL  ?>assets/plugins/google-map/gmap.js'></script>
<script src='<?php echo BASE_URL  ?>assets/js/script.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inview/1.0.0/jquery.inview.js"></script>
<script src='<?php echo BASE_URL  ?>assets/js/pin.js'></script>
<script src='<?php echo BASE_URL  ?>assets/js/ajax.js'></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>

</body>

</html>



