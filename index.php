<?php

require("inc/functions.php");
$username = "waleedarshadawan";
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

<link> 
<link href='css/instagram.css' rel='stylesheet'>
<link href='css/style.css' rel='stylesheet'>
<link href='css/media.css' rel='stylesheet'>
</head>

<body>


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
          <a class="nav-link text-white add-button " href="/"><i class="fa fa-right"></i>Go Back</a>
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
            <div class="videos-post"><a href="media/?id=<?php echo trim($mediaid); ?>"><img class="img-fluid" src="<?php echo  $url; ?>"></a><img class="img-fluid" src="<?php echo $url; ?>"><span class="videos"></span></div>
          <?php }else{  ?>
            <a href="media/?id=<?php echo trim($mediaid); ?>"><img class="img-fluid" src="<?php echo  $url; ?>"></a>

          <?php } ?>
          <div class="cardbox-base">
          <ul class="float-right">
          <li>
          Comments <?php echo $articles->node->edge_media_to_comment->count;   ?></i></li>
          <li><a><em class="mr-5"></em></a></li></ul>
          <ul>
          <li>Likes<?php echo $articles->node->edge_media_preview_like->count;  ?></i></li>
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
         <img id="loader" src="images/loader.svg">
         <!-- <button class="nav-link text-white add-button " id="load">load More</button> -->
         <input type="hidden" id = "userid" value="<?php echo $userId;  ?>" >
         
         <input type="hidden" id = "profilepic" value="<?php  echo $profilePic; ?>" >
         <input type="hidden" id = "username" value="<?php  echo $username; ?>" >
         </div>
         </div>
         </div>
        </section>




  
 

</div>
	
	<!-- Container End -->
</section>



 


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inview/1.0.0/jquery.inview.js"></script>
<script src='js/pin.js'></script>
<script src='js/ajax.js'></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
<script type="text/javascript">
</body>

</html>



