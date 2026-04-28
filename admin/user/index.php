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

    <?php ob_start(); ?>
    <?php include "../header_panel.php"; ?>
    <?php include "../../db/db.php"?>
    

    <?php
      try{
        if(isset($_GET['id']))
        {
          $str="delete from users where user_id=".$_GET['id']."";
          mysqli_query($conn,$str);
          header("Location: index.php");
          
        }
      }
      catch(Exception $e){
        echo "<script>alert('".$e."')</script>";
      }
    ?>
    
  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Users</h1>
          </div>
        </div>
      </div>


    <section class="content">
      <div class="container-fluid">
        <!-- <a href=""><button class="btn btn-primary">Add User</button></a><br> -->
        <!-- Dashboard Widgets Example -->
        <div class="row">
            
            <!-- User Details -->
             <table class="table table-hover" border="1" cellspacing="0">
                <tr>
                    <th>Id</th>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>email</th>
                    <th>gender</th>
                    <th>phone</th>
                    <th>Action</th>
                </tr>
                <?php
                    $str="select * from users";
                    $data=mysqli_query($conn,$str);
                    while($row=mysqli_fetch_array($data)){
                ?>
                <tr>
                    <td><?php echo $row["user_id"];?></td>
                    <td><img src="../../<?php echo $row["profile"];?>" width="40" alt="profile"></td>
                    <td><?php echo $row["name"];?></td>
                    <td><?php echo $row["email"];?></td>
                    <td><?php echo $row["gender"];?></td>
                    <td><?php echo $row["phone"];?></td>
                    <td>
                      <a href="?id=<?php echo $row["user_id"];?>"><button class="btn"><i class="fa-solid fa-user-xmark" style="color: #eb0505;"></i></button></a>
                    </td>
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
  document.getElementById('menuUsers').classList.add('menu-open');
  document.getElementById('linkUsers').classList.add('active');
  document.getElementById('linkUsers').classList.add('bg-dark');

</script>
</body>
</html>
