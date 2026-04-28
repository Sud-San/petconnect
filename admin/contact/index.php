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
    if(isset($_POST['submit'])) {
        $id = $_POST['id'];
        $query = "UPDATE contact SET status='read' WHERE id='$id'";
        mysqli_query($conn, $query);
        if(mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('Message marked as read successfully.');</script>";
            header("Location: index.php");
        } else {
            echo "<script>alert('Failed to mark message as read.');</script>";
        }
        // Redirect to the seen messages page after updating
        
    }
  ?>
  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Messages</h1>
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
                    <th>Name</th>
                    <th>email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
                <?php
                    $str="select * from contact";
                    $data=mysqli_query($conn,$str);
                    $count=mysqli_num_rows($data);
                    if($count==0){
                        echo "<tr><td colspan='7' class='text-center'>No unread messages found.</td></tr>";
                    } else {
                        while($row=mysqli_fetch_array($data)){
                ?>
                <tr>
                  
                    <td><?php echo $row["id"];?></td>
                    <td><img src="../../<?php echo $row["profile"];?>" width="50" alt=""></td>
                    <td><?php echo $row["name"];?></td>
                    <td><?php echo $row["email"];?></td>
                    <td><?php echo $row["subject"];?></td>
                    <td><?php echo $row["message"];?></td>
                    <td>
                     <?php
                      if($row["status"]=="unread"){
                       ?>
                       <form action="" method="post">
                           <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                           <input type="submit" class="btn btn-outline-success" value="Mark as Read" name="submit">
                       </form>
                     <?php
                      }
                      else{
                        echo "<span class='badge badge-success'>Read</span>";
                      }
                     ?>
                    </td>
                    
                </tr>
                <?php } }?>
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
  document.getElementById('menuContact').classList.add('menu-open');
  document.getElementById('linkContact').classList.add('active');
  document.getElementById('linkContact').classList.add('bg-dark');

</script>
</body>
</html>
