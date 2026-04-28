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
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Breed</th>
                    <th>Health Status</th>
                    <th>Description</th>
                    <th>Status</th>
                    
                </tr>
                <?php
                    $str="SELECT pets.*, pettypes.type_name, users.name AS oname
                    FROM pets
                    INNER JOIN pettypes ON pets.pet_type_id = pettypes.pet_type_id
                    INNER JOIN users ON pets.owner_id = users.user_id";
                    $result = mysqli_query($conn, $str);
                    while($row = mysqli_fetch_assoc($result)) {
                        $pet_id = $row['pet_id'];
                        $petname=$row['name'];
                        $type=$row['type_name'];
                        $desc=$row['description'];
                        $age=$row['age'];
                        $gender=$row['gender'];
                        $breed=$row['breed'];
                        $health_status=$row['health_status'];
                        $owner_name = $row['oname'];
                        $status=$row['status'];
                        $images = explode(',', $row['image_url']); 
                        $firstImage = "../images/".$images[0];
                ?>
                <tr>
                    <td><?php echo $pet_id; ?></td>
                    <td><img src="../../images/<?php echo $firstImage; ?>" alt="profile" width="100" ></td>
                    <td><?php echo $petname; ?></td>
                    <td><?php echo $owner_name; ?></td>
                    <td><?php echo $type; ?></td>
                    <td><?php echo $age; ?></td>
                    <td><?php echo $gender; ?></td>
                    <td><?php echo $breed; ?></td>
                    <td><?php echo $health_status; ?></td>
                    <td><?php echo $desc; ?></td>
                    <td><?php if($status == "available") { echo "<span class='badge bg-success'>Available</span>"; } else { echo "<span class='badge bg-danger'>Adopted</span>"; } ?></td>
                    
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
  document.getElementById('menuPets').classList.add('menu-open');
  document.getElementById('linkPets').classList.add('active');
  document.getElementById('linkPets').classList.add('bg-dark');

</script>
</body>
</html>
