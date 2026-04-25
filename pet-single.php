<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Pet Connect</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <link rel="stylesheet" href="./css/animate.css">
    
    <link rel="stylesheet" href="./css/owl.carousel.min.css">
    <link rel="stylesheet" href="./css/owl.theme.default.min.css">
    <link rel="stylesheet" href="./css/magnific-popup.css">


    <link rel="stylesheet" href="./css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="./css/jquery.timepicker.css">

    <link rel="stylesheet" href="./css/flaticon.css">
    <link rel="stylesheet" href="./css/style.css">
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
      /* Increase Magnific Popup image max height to 500px */
      .mfp-content .mfp-img {
        /* max-height: 1000px; */
        width: 500px;
      }

      /* Optionally limit popup container width so image doesn't stretch too wide */
      .mfp-figure {
        max-width: 90vw;
      }
    </style>
  </head>
  <body>

    
		<?php
    session_start();
      include "header.php";
      include "db/db.php";
      if(isset($_GET['id']))
      {
        $str="SELECT pets.*, pettypes.type_name
              FROM pets
              INNER JOIN pettypes ON pets.pet_type_id = pettypes.pet_type_id
              WHERE pets.pet_id = '$_GET[id]'";
              $result = mysqli_query($conn, $str);
              while($row = mysqli_fetch_assoc($result)) {
                  $petname=$row['name'];
                  $type=$row['type_name'];
                  $desc=$row['description'];
                  $age=$row['age'];
                  $gender=$row['gender'];
                  $breed=$row['breed'];
                  $health_status=$row['health_status'];
                  $images = explode(',', $row['image_url']); 
                  $firstImage = "../images/".$images[0];
              }
      }
      if(isset($_POST['adopt']))
      {
        // print_r($_SESSION['uname']);
        // die;
        $str="SELECT user_id FROM users WHERE email ='" . $_SESSION['uname']."'";
        $result = mysqli_query($conn, $str);
        $row = mysqli_fetch_assoc($result);
          $adopter_id = $row['user_id'];
          $pet_id = $_POST['pet_id'];
          $str = "INSERT INTO adoptionrequests (pet_id, adopter_id) VALUES ('$pet_id', '$adopter_id')";
          if(mysqli_query($conn, $str))
          {
            $str = "UPDATE pets SET status = 'Adopted' WHERE pet_id = '$pet_id'";
            if(mysqli_query($conn, $str))
            {
              echo "<script>
              Swal.fire({
                title: 'Success!',
                text: 'Adoption request sent successfully!',
                icon: 'success',
                confirmButtonText: 'OK'
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location='user/index.php';
                }
              });
              </script>";
            }
             else
            {
              echo "<script>
              Swal.fire({
                title: 'Error!',
                text: 'Error sending adoption request. Please try again.',
                icon: 'error',
                confirmButtonText: 'OK'
              });
              </script>";
            }
          }
      }
      // if(!isset($_SESSION['uname']))
      // {
      //   // Save the current page URL before redirecting
      //   $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
      //   header('Location:http://localhost/PetConnect/login.php');
      //   exit();
      // }
    ?>
    <!-- END nav -->
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="pet.php">Pets <i class="ion-ios-arrow-forward"></i></a></span> <span>Pet Details <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-0 bread">Pet Details</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 ftco-animate">
          	<p>
              <img src="images/<?php echo $firstImage; ?>" style="object-fit: cover; height: 400px; width: 100%;" alt="profile" class="img-fluid">
            </p>
            <h2 class="mb-3"><b>Description</b></h2>
            <table class="table">
              <tr>
                <th>Name</th>
                <td><?php echo $petname; ?></td>
              </tr>
              <tr>
                <th>Type</th>
                <td><?php echo $type; ?></td>
              </tr>
              <tr>
                <th>Gender</th>
                <td><?php echo $gender; ?></td>
              </tr>
              <tr>
                <th>Breed</th>
                <td><?php echo $breed; ?></td>
              </tr>
              <tr>
                <th>Age</th>
                <td><?php echo $age; ?> years</td>
              </tr>
              <tr>
                <th>Health Status</th>
                <td><?php echo $health_status; ?></td>
              </tr>
              <tr>
                <th>Description</th>
                <td><?php echo $desc; ?></td>
              </tr>
              <tr>
                <td colspan="2">
                  <form action="" method="post">
                    <input type="hidden" name="pet_id" value="<?php echo $_GET['id']; ?>">
                    <input type="submit" name="adopt" value="Adopt" class="btn btn-primary btn-lg w-100">
                  </form>
                </td>
              </tr>
            </table>
            
          </div> <!-- .col-md-8 -->
          <div class="col-lg-4 sidebar pl-lg-5 ftco-animate">

            <div class="sidebar-box ftco-animate">
              <h3>More Images</h3>
              <?php
                foreach($images as $image) {
                    echo '<div class="block-21 mb-4 d-flex">';
                    echo '<a href="images/'.$image.'" class="blog-img icon image-popup d-flex justify-content-center align-items-center" style="background-image: url(images/'.$image.'); height: 180px; width: 100%; background-size: cover;"></a>';
                    echo '</div>';
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php include "footer.php";?>
    
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
  </script>


  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


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