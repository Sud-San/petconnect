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
            <h1 class="m-0">Pet Types</h1>
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
                    <th>Name</th>
                </tr>
                <?php
                    $str="select * from pettypes";
                    $data=mysqli_query($conn,$str);
                    while($row=mysqli_fetch_array($data)){
                ?>
                <tr>
                    <td><?php echo $row["pet_type_id"];?></td>
                    <td><?php echo $row["type_name"];?></td>
                    <!-- <td>
                        <a href=""><button class="btn"><i class="fa-solid fa-user-pen"></i></button></a> | 
                        <a href=""><button class="btn"><i class="fa-solid fa-user-xmark"></i></button></a>
                    </td> -->
                </tr>
                <?php }?>
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
  function toggleDarkMode() {
    document.getElementById('mainBody').classList.toggle('dark-mode');
  }
</script>

<script>
  document.getElementById('menuPets').classList.add('menu-open');
  document.getElementById('linkPets').classList.add('active');
  document.getElementById('linkPets').classList.add('bg-dark');

</script>
</body>
</html>
