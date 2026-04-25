<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">


    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <?php
    session_start();
    include "header.php";
    include "db/db.php";
    $str="SELECT pets.* , pettypes.type_name FROM pets
    inner join pettypes on pets.pet_type_id = pettypes.pet_type_id";
    $result = mysqli_query($conn, $str);
    
    ?>
    <!-- END nav -->
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Gallery <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-0 bread">Gallery</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
			<div class="container">
				<div class="row" style="overflow-y: auto; max-height:500px;">
          <?php
            while($row = mysqli_fetch_assoc($result)) {
              $images = explode(',', $row['image_url']);
              $i=0;
              foreach($images as $image) {
                if($i++ >= 2) break; // Limit to first 6 images per pet
                  $imagePath = "images/".$image;
            ?>
          <div class="col-md-4 ftco-animate">
            <div class="work mb-4 img d-flex align-items-end" style="background-image: url(<?php echo $imagePath; ?>);">
            	<a href="<?php echo $imagePath; ?>" class="icon image-popup d-flex justify-content-center align-items-center">
      					<span class="fa fa-expand"></span>
      				</a>
            	<div class="desc w-100 px-4">
                <div class="text w-100 mb-3">
                	<span><?php echo $row['type_name']; ?></span>
                	<h2><a href="pet-single.php?id=<?php echo $row['pet_id']; ?>"><?php echo $row['name']; ?></a></h2>
                </div>
              </div>
            </div>
          </div>
          <?php
          }
        }
          ?>
        </div>
			</div>
		</section>

    <?php include "footer.php";?>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

  <script>
	function onload() {
    document.getElementById("navgallery").classList.add("active");
		document.getElementById("navabout").classList.remove("active");
		document.getElementById("navhome").classList.remove("active");
		document.getElementById("navvet").classList.remove("active");
		document.getElementById("navservices").classList.remove("active");
		document.getElementById("navpricing").classList.remove("active");
		document.getElementById("navblog").classList.remove("active");
		document.getElementById("navcontact").classList.remove("active");
	}
	window.onload = onload();
  </script>

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>


    
  </body>
</html>