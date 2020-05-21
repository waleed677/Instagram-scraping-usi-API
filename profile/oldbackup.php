<?php
include('../include/simple_html_dom.php');
require("../include/config.php");

$tag = $_GET['tag'];
$url = "http://insusers.com/hashtag/".$tag;
$html = file_get_html($url);

$mainUrl = $html->find('.loadhashtag',0)->attr['data-href'];
$nextUrl=  $html->find('#paging a',0)->attr['href'];
$pageno = explode("&",$nextUrl);
$page = str_replace("?","",$pageno[0]);
$nextpage =  $pageno[1];
?>

<!DOCTYPE html>
<html lang="en">
<head>

  <!-- SITE TITTLE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $tag; ?> - Insmk</title>
  
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

<section class=' section'>
	<!-- Container Start -->
	<div class='container'>
	<div class="row">	
          <div class="col-lg-2"></div>
          <div class="col-lg-10">
          <h1 class="text-center">Posts tagged as #<?php echo $tag; ?> on Instagram</h1>
          <p style="font-size:18px;text-align:center">
        <?php echo $html->find('p',0)->plaintext  ?>
        </p>
          <div class="text-center">
          </div>
          </div>
         </div><!--/ container -->
         <br>
		<div class='row'>

			<section id="pinBoot" class="posts">
			<?php  
			
			foreach($html->find('.mediapost') as $profile){ 
				if($profile->find('.card')){
				
				?>
			<article class="white-panel">
		<div class="media m-0">
			<div class="d-flex mr-3">
			<a href="">
			<img class="img-fluid rounded-circle" src="<?php  
			if($profile->find('img',0) != ""){
			echo $profile->find('.avatar',0)->attr['src'];  
			}
			?>" alt="User"></a></div>
			<div class="media-body"><p class="m-0 name username">
			<?php if($profile->find('img',0) != ""){  ?>
        <a href="<?php echo BASE_URL ?>profile/?username=<?php echo str_replace("/","",$profile->find('.text-default',0)->attr['href']);  ?>">
			<?php echo $profile->find('.text-default',0)->plaintext; ?>
      </a>
      <?php  	} ?>
			</p><small><span class="time"><i class="fa fa-clock-os" aria-hidden="true"></i>
			<?php  
			if($profile->find('img',0) != ""){
			echo $profile->find('.text-muted',0)->plaintext;  
			}
			?>
		</span>
			</small>
			</div>
			</div><br>
			<?php  if($profile->find('.carousel',0) != ""){  ?>
				<?php $id=explode("/",$profile->find('.post-img a',0)->attr['href']);?>
				<div class="carousel-post">
				<a href="<?php echo BASE_URL ?>medias/?id=<?php echo $id[4];?>"> </a>
				<img class="img-fluid" src="<?php  
		if($profile->find('img',0) != ""){
		echo $profile->find('img',0)->attr['data-src'];  
		}
		?>">
		<span class="carousel"></span>
		
		
				</div>

			<?php  } else if ($profile->find('.video',0) != ""){ ?>
				<?php $id=explode("/",$profile->find('.post-img a',0)->attr['href']);?>
				<div class="videos-post">
				<a href="<?php echo BASE_URL ?>medias/?id=<?php echo $id[4];?>"> </a>
				<img class="img-fluid" src="<?php  
		if($profile->find('img',0) != ""){
		echo $profile->find('img',0)->attr['data-src'];  
		}
		?>">
		<span class="videos"></span>
		</div>
			
			<?php }else{ ?>
				<?php $id=explode("/",$profile->find('.post-img a',0)->attr['href']);?>
				<a href="<?php echo BASE_URL ?>medias/?id=<?php echo $id[4];?>">
				<img class="img-fluid" src="<?php  
		if($profile->find('img',0) != ""){
		echo $profile->find('img',0)->attr['data-src'];  
		}
		?>"> </a>
			<?php  } ?>

			<div class="cardbox-base"><ul class="float-right"><li><a><i class="fa fa-comments"></i><?php  
			if($profile->find('img',0) != ""){
			echo $profile->find('.pull-right',0)->plaintext;  
			}
			?></a></li><li><a><em class="mr-5"></em></a></li></ul><ul><li><a><i class="fa fa-thumbs-up"></i><?php  
			if($profile->find('img',0) != ""){
			echo $profile->find('.pull-left',0)->plaintext;  
			}
			?></a></li><li><a><span></span></a></li></ul></div>
			<p><?php  
			
		//echo $profile->find('.limit p a',0)->attr['href'];
			$para= explode("#",$profile->find('p',0)->plaintext);  
			echo $para[0]."<br>";
			foreach($profile->find('.limit p a') as $taglink){
				if( strpos($taglink->plaintext,"@") !== false ) { ?>
					<a class="tags" href='<?php  echo BASE_URL ?>profile/?username=<?php echo str_replace("@",'',$taglink->plaintext);  ?> '><?php echo $taglink->plaintext;  ?></a>

				<?php } else{  ?>
				<a class="tags" href='<?php  echo BASE_URL ?>hashtag/?tag=<?php echo str_replace("#",'',$taglink->plaintext);  ?> '><?php echo $taglink->plaintext;  ?></a>
				
			<?php }} ?></p>
			</article>
				<?php }}   ?>
			</section>


			
		</div>

		<div class="row">
         <div class="col-lg-6"></div>
         <div class="col-lg-3">
         <img id="loader" src="<?php echo BASE_URL ?>assets/images/loader.svg">

         <!-- <button class="nav-link text-white add-button " id="load">load More</button> -->
         <input type="hidden" id = "page" value = "<?php  echo $page; ?>">
         <input type="hidden" id = "nextpage" value = "<?php  echo $nextpage; ?>" >
         </div>
         </div>


	</div>
	<!-- Container End -->
</section>

<?php  include('../include/footer.php'); ?>

<!-- JAVASCRIPTS -->
<!-- JAVASCRIPTS -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='<?php echo BASE_URL  ?>assets/plugins/jQuery/jquery.min.js'></script>
<script src='<?php echo BASE_URL  ?>assets/plugins/bootstrap/js/popper.min.js'></script>
<script src='<?php echo BASE_URL  ?>assets/plugins/bootstrap/js/bootstrap.min.js'></script>
<script src='<?php echo BASE_URL  ?>assets/plugins/bootstrap/js/bootstrap-slider.js'></script>
  <!-- tether js -->
<script src='<?php echo BASE_URL  ?>assets/plugins/tether/js/tether.min.js'></script>
<script src='<?php echo BASE_URL  ?>assets/plugins/raty/jquery.raty-fa.js'></script>
<script src='<?php echo BASE_URL  ?>assets/plugins/slick-carousel/slick/slick.min.js'></script>
<script src='<?php echo BASE_URL  ?>assets/plugins/jquery-nice-select/js/jquery.nice-select.min.js'></script>
<script src='<?php echo BASE_URL  ?>assets/plugins/fancybox/jquery.fancybox.pack.js'></script>
<!-- <script src='<?php echo BASE_URL  ?>assets/plugins/smoothscroll/SmoothScroll.min.js'></script> -->
<!-- google map -->
<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places'></script>
<script src='<?php echo BASE_URL  ?>assets/plugins/google-map/gmap.js'></script>
<script src='<?php echo BASE_URL  ?>assets/js/script.js'></script>
<script src='<?php echo BASE_URL  ?>assets/js/pin.js'></script>
 
 <script>
var ajaxResult=[];
var id;
  function nFormatter(num){
    if(num >= 1000000000){
      return (num/1000000000).toFixed(1).replace(/\.0$/,"") + "G";
    }
    if(num >= 1000000){
      return (num/1000000).toFixed(1).replace(/\.0$/,"") + "M";
    }
    if(num >= 1000){
      return (num/1000).toFixed(1).replace(/\.0$/,"") + "K";
    }
    return num;
  }

</script>

<script>

	/// Load More Code ////
  
$(document).ready(function(){
	$(window).scroll(function() {
  
	if($(window).scrollTop() + $(window).height() == $(document).height()) {
	  $("#loader").show();
	page = document.getElementById("page").value;
	after = document.getElementById("nextpage").value;
	urls = '<?php echo BASE_URL ?>hashtag/loadmoredata.php?tag=<?php echo $tag; ?>&page='+page+'&after='+after;
	$.ajax({
		url:urls,
		type:'get',
		
		success:function(response){
			
			document.getElementById("page").value = response.page;
			document.getElementById("nextpage").value= response.next;
			$("#loader").hide();
			var data = response.substring(153);
			console.log(data);
			$('.posts').append(data);
			console.log(response.page);

		}

	});
	
  
	}

  });
  });

  function updateValue(){
	page = document.getElementById("page").value;
	after = document.getElementById("nextpage").value;
	urls = '<?php echo BASE_URL ?>hashtag/getjson.php?tag=<?php echo $tag; ?>&page='+page+'&after='+after;
	console.log(urls);
	  $.ajax({
		url:urls,
		type:'get',
		dataType: 'JSON',
		success:function(response){
			document.getElementById("page").value = response.page;
			document.getElementById("nextpage").value= response.next;
			console.log(response.page);
		

		}

	  });
  }

</script> 
</body>

</html>



<!-- https://www.instagram.com/graphql/query/?query_hash=c9100bf9110dd6361671f113dd02e7d6&variables={%22user_id%22:%221739874098%22,%22include_chaining%22:false,%22include_reel%22:true,%22include_suggested_users%22:false,%22include_logged_out_extras%22:false,%22include_highlight_reels%22:false,%22include_related_profiles%22:false} -->