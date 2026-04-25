<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Pet Connect</title>
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
      if(!isset($_SESSION['uname']))
      {
        // Save the current page URL before redirecting
        $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
        header('Location:login.php');
        exit();
      }
      include "db/db.php";
      if(isset($_GET['q']))
      {
        $q=trim($_GET['q']);
        $str="SELECT pets.*, pettypes.type_name
            FROM pets
            INNER JOIN pettypes ON pets.pet_type_id = pettypes.pet_type_id
            INNER JOIN users ON pets.owner_id = users.user_id
            WHERE pets.status = 'available' 
            AND pets.name LIKE '%".$q."%'
            OR pets.description LIKE '%".$q."%'
            OR pets.breed LIKE '%".$q."%'
            OR pettypes.type_name LIKE '%".$q."%'
            OR pets.gender = '".$q."'
            OR pets.age = '".$q."'
            AND pets.owner_id != '".$_SESSION['uid']."'";
        $result = mysqli_query($conn, $str);
      }elseif(!isset($_GET['q'])){
        $str="SELECT pets.*, pettypes.type_name
            FROM pets
            INNER JOIN pettypes ON pets.pet_type_id = pettypes.pet_type_id
            INNER JOIN users ON pets.owner_id = users.user_id
            WHERE pets.status = 'available' AND pets.owner_id != '".$_SESSION['uid']."'";
        $result = mysqli_query($conn, $str);
      }
    ?>

    <!-- END nav -->
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Pets <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-0 bread">Pets</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section bg-light">
      <div class="container">
        <form action="" method="get">
        <div class="row">
          
            <div class="col-md-7"></div>
            <div class="col-md-4">
              <input type="search" name="q" id="searchPet" class="form-control" placeholder="Search by name, breed, description" value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
            </div>
            <div class="col-md-1">
              <button type="submit" class="btn btn-primary">Search</button>
            </div>
          </form>
        </div>
        <!-- <br> -->
        
        <br>
        <div class="row d-flex">
          <?php
            if(mysqli_num_rows($result) == 0) {
              echo "<h4>No pets available for adoption.</h4>";
            } 
            else {
              while($row = mysqli_fetch_assoc($result)) {
                  $pet_id = $row['pet_id'];
                  $petname=$row['name'];
                  $type=$row['type_name'];
                 
                  $age=$row['age'];
                  $gender=$row['gender'];
                  $breed=$row['breed'];
                  
                  $images = explode(',', $row['image_url']); 
                  $firstImage = "../images/".$images[0];
          ?>
          <div class="col-md-4  ftco-animate">
            <div class="blog-entry align-self-stretch">
              <a href="pet-single.php?id=<?php echo $pet_id; ?>" class="block-20 rounded" style="background-image: url('images/<?php echo $firstImage; ?>');">
              </a>
              <div class="text p-4">
              	<div class="meta mb-2">
                  <div><a href="#" class="meta-chat"><?php echo $type;?></a></div>
                </div>
                <h3 class="heading">
                  <a href="pet-single.php?id=<?php echo $pet_id; ?>">
                   <table class="table" style="width: 100%;">
                      <tr>
                        <td colspan="2" align="center"><b><?php echo $petname; ?></b></td>
                      </tr>
                      <tr>
                        <th>Type</th>
                        <td><?php echo $type; ?></td>
                      </tr>
                      <tr>
                        <th>Age</th>
                        <td><?php echo $age; ?> years</td>
                      </tr>
                      <tr>
                        <th>Gender</th>
                        <td><?php echo $gender; ?></td>
                      </tr>
                      <tr>
                        <th>Breed</th>
                        <td><?php echo $breed; ?></td>
                      </tr>
                    </table>
                  </a>
                </h3>
              </div>
            </div>
          </div>
          <?php } } ?>
          
        </div>
      </div>
    </section>

    <?php include "footer.php";?>
  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

  <script>
	function onload() {
    document.getElementById("navblog").classList.add("active");
		document.getElementById("navabout").classList.remove("active");
		document.getElementById("navhome").classList.remove("active");
		document.getElementById("navvet").classList.remove("active");
		document.getElementById("navservices").classList.remove("active");
		document.getElementById("navgallery").classList.remove("active");
		document.getElementById("navpricing").classList.remove("active");
		document.getElementById("navcontact").classList.remove("active");
	}
	window.onload = onload();


  // Function to handle breed selection and redirect
  function redirectToBreed(select) {
    const breed = select.value;
    if (breed) {
      window.location.href = "?breed=" + encodeURIComponent(breed);
    }

  }
  
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
<script src="../js/breed.js"></script>

    
  </body>
</html>