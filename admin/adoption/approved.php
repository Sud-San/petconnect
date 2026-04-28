<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- AdminLTE CSS (Minimal Setup) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  </head>
<body class="hold-transition sidebar-mini transition" id="mainBody">
<div class="wrapper">


    <?php include "../header_panel.php"; ?>
    <?php include "../../db/db.php"?>
    <?php ob_start(); ?>
    <?php
      if(isset($_POST['reject']))
      {
        $request_id = $_POST['request_id'];
        $str="UPDATE adoptionrequests SET status='rejected' WHERE request_id=$request_id";
        mysqli_query($conn,$str);
        echo "<script>window.location='index.php';</script>";
      }
      if(isset($_POST['accept']))
      {
        $request_id = $_POST['request_id'];
        $str="UPDATE adoptionrequests SET status='accepted' WHERE request_id=$request_id";
        mysqli_query($conn,$str);
        echo "<script>window.location='index.php';</script>";
      }
    ?>
    
  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pets</h1>
          </div>
        </div>
      </div>


    <section class="content">
      <div class="container-fluid">
        <!-- <a href=""><button class="btn btn-primary">Add User</button></a><br> -->
        <!-- Dashboard Widgets Example -->
        <div class="row">
            
            <!-- Pet Details -->
             <table class="table table-hover" border="1">
                <tr>
                    <th>Id</th>
                    <th>Profile</th>
                    <th>Pet Name</th>
                    <th>Owner Name</th>
                    <th>Pet Type</th>
                    <th>Adopter Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php
                    $str="SELECT pets.*, pettypes.type_name, adoptionrequests.request_id, adoptionrequests.adopter_id, adoptionrequests.status AS adoption_status, users.name AS oname
                    FROM pets
                    INNER JOIN pettypes ON pets.pet_type_id = pettypes.pet_type_id
                    INNER JOIN users ON pets.owner_id = users.user_id
                    INNER JOIN adoptionrequests ON pets.pet_id = adoptionrequests.pet_id
                    WHERE adoptionrequests.status='accepted' or adoptionrequests.status='rejected'";
                    $result = mysqli_query($conn, $str);
                    while($row = mysqli_fetch_assoc($result)) {
                        $request_id = $row['request_id'];
                        $pet_id = $row['pet_id'];
                        $adopter_id = $row['adopter_id'];
                        $petname=$row['name'];
                        $type=$row['type_name'];
                        $owner_name = $row['oname'];
                        $status=$row['status'];
                        $adoption_status = $row['adoption_status'];
                        $images = explode(',', $row['image_url']); 
                        $firstImage = "../../images/".$images[0];

                        $adopter_name = '';
                        $str1="SELECT users.name AS adopter_name
                        FROM adoptionrequests
                        INNER JOIN users ON adoptionrequests.adopter_id = users.user_id
                        WHERE adoptionrequests.request_id = $request_id";
                        $result1 = mysqli_query($conn, $str1);
                        $row1 = mysqli_fetch_assoc($result1);
                        $adopter_name = $row1['adopter_name'];
                        // print_r($adopter_name);
                        // die;
                        
                ?>
                <tr>
                    <td><?php echo $request_id; ?></td>
                    <td><img src="<?php echo $firstImage; ?>" alt="profile" width="100" ></td>
                    <td><?php echo $petname; ?></td>
                    <td><?php echo $owner_name; ?></td>
                    <td><?php echo $type; ?></td>
                    <td><?php echo $adopter_name; ?></td>
                    <td><?php echo $adoption_status; ?></td>
                    <td>
                      <form method="POST" action="" style="display: inline;">
                        <input type="hidden" name="request_id" value="<?php echo $request_id; ?>">
                        <input type="hidden" name="pet_id" value="<?php echo $pet_id; ?>">
                        <input type="hidden" name="adopter_id" value="<?php echo $adopter_id; ?>">
                        <button type="submit" name="reject" class="btn"><i class="fa-solid fa-square-xmark fa-xl" style="color: #d71709;"></i></button> | 
                      </form>
                      <form method="POST" action="" >
                        <input type="hidden" name="request_id" value="<?php echo $request_id; ?>">
                        <input type="hidden" name="pet_id" value="<?php echo $pet_id; ?>">
                        <input type="hidden" name="adopter_id" value="<?php echo $adopter_id; ?>">
                        <button type="submit" name="accept" class="btn"><i class="fa-solid fa-square-check fa-xl" style="color: #63E6BE;"></i></button>
                      </form>
                     
                    </td>
                </tr>
                <?php } ?>
             </table>      
        </div>
      </div>
    </section>
  </div>
  </div>
  <?php include "../footer.php";?>
<?php ob_end_flush(); ?>

  <!-- JS Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script>
  document.getElementById('menuAdoption').classList.add('menu-open');
  document.getElementById('linkAdoption').classList.add('active');
  document.getElementById('linkAdoption').classList.add('bg-dark');

</script>
</body>
</html>
