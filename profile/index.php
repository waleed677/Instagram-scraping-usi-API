<?php
include('../include/simple_html_dom.php');
require("../include/config.php");
require("../include/functions.php");
$username = $_GET["username"];
$mainUrl =  'https://www.instagram.com/'.$username.'/?__a=1';
$url = file_get_contents($mainUrl);
$response = json_decode($url);

$profilePic = $response->graphql->user->profile_pic_url;
$name = $response->graphql->user->full_name;
$biography = $response->graphql->user->biography;
$followers = $response->graphql->user->edge_followed_by->count;
$following = $response->graphql->user->edge_follow->count;
$postcount = $response->graphql->user->edge_owner_to_timeline_media->count;
$posts = $response->graphql->user->edge_owner_to_timeline_media->edges;
$userId = $response->graphql->user->id;
$nextPage = $response->graphql->user->edge_owner_to_timeline_media->page_info->has_next_page;
if($nextPage){
  $after = $response->graphql->user->edge_owner_to_timeline_media->page_info->end_cursor;
}else{
  $after = "";
}

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

				<img src="<?php echo $profilePic;  ?>" alt="" class="profile-pic">

			</div>

			<div class="profile-user-settings">

				<h1 class="profile-user-name name"><?php  echo $name; ?></h1>

				

			</div>

			<div class="profile-stats">

				<ul>
					<li><span class="profile-stat-count postcount"><?php  echo $postcount; ?></span> posts</li>
					<li><span class="profile-stat-count followers"><?php  echo $followers; ?></span> followers</li>
					<li><span class="profile-stat-count following"><?php  echo $following; ?></span> following</li>
				</ul>

			</div>

			<div class="profile-bio">

				<p class="biography"><span class="profile-real-name name"><?php  echo convertAll($biography); ?></span></p>

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
          <?php  foreach($posts as $articles) { 
          $isVideo = $articles->node->is_video;
          $url = $articles->node->display_url;
          $mediaid = $articles->node->shortcode;
          $date = '@'.$articles->node->taken_at_timestamp;
            
            ?>
          <article class="white-panel">
              <input type="hidden" id = "after" value="<?php  echo $after; ?>" >
              <input type="hidden" id = "istafter" value="<?php  echo $after; ?>" >
          <div class="media m-0">
          <div class="d-flex mr-3">
          <a href=""><img class="img-fluid rounded-circle" src="<?php echo $profilePic; ?>" alt="User"></a>
          </div>
          <div class="media-body">
          <p class="m-0 name username"><?php echo $username; ?></p>
          
          <small><span class="time"><i class="fa fa-clock-os" aria-hidden="true"></i><?php echo time_elapsed_string($date);  ?></span></small>
        
          </div></div><br>
          <?php if($isVideo){ ?>
            <div class="videos-post"><a href="<?php echo $BASE_URL; ?>media/?id=<?php echo trim($mediaid); ?>"><img class="img-fluid" src="<?php echo  $url; ?>"></a><img class="img-fluid" src="<?php echo $url; ?>"><span class="videos"></span></div>
          <?php }else{  ?>
            <a href="<?php echo $BASE_URL; ?>media/?id=<?php echo trim($mediaid); ?>"><img class="img-fluid" src="<?php echo  $url; ?>"></a>

          <?php } ?>
          <div class="cardbox-base">
          <ul class="float-right">
          <li>
          <i class="fa fa-comments"  id= "format"> <?php echo $articles->node->edge_media_to_comment->count;   ?></i></li>
          <li><a><em class="mr-5"></em></a></li></ul>
          <ul>
          <li><i class="fa fa-thumbs-up" id= "format"><?php echo $articles->node->edge_media_preview_like->count;  ?></i></li>
          <li><span></span></<span></li></ul>
          </div>
          <p><?php  
          if($articles->node->edge_media_to_caption->edges[0] != ""){
          $caption = $articles->node->edge_media_to_caption->edges[0]->node->text;
          echo convertAll($caption);
          }else{
              $caption = "";
          }
           ?></p>
          </article>

          <?php } ?>

          </section>
		  
		   
         </div><!--/ container -->
         <div class="row">
         <div class="col-lg-6"></div>
         <div class="col-lg-3">
         <img id="loader" src="<?php echo BASE_URL ?>assets/images/loader.svg">

         <!-- <button class="nav-link text-white add-button " id="load">load More</button> -->
         <input type="hidden" id = "userid" value="<?php echo $userId;  ?>" >
         
         <input type="hidden" id = "profilepic" value="<?php  echo $profilePic; ?>" >
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
<script type="text/javascript">
 



</script>
</body>

</html>



