<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pet Connect Admin Panel</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- AdminLTE CSS (Minimal Setup) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  
</head>
<body class="hold-transition sidebar-mini transition" id="mainBody">
<div class="wrapper">

    <?php include "header_panel.php"; ?>
  <?php ob_start(); ?>
  <?php
    include "../db/db.php";
    // Fetch total users
    $str = "SELECT COUNT(*) as total_users FROM users";
    $result = mysqli_query($conn, $str);
    $row = mysqli_fetch_array($result);
    $total_users = $row['total_users'];

    // Fetch total pets
    $str = "SELECT COUNT(*) as total_pets FROM pets";
    $result = mysqli_query($conn, $str);
    $row = mysqli_fetch_array($result);
    $total_pets = $row['total_pets'];

    // Fetch total conatct messages
    $str = "SELECT COUNT(*) as total_messages FROM contact where status = 'unread'";
    $result = mysqli_query($conn, $str);
    $row = mysqli_fetch_array($result);
    $total_messages = $row['total_messages'];

    // Fetch total pending requests
    $str = "SELECT COUNT(*) as total_pending_requests FROM adoptionrequests WHERE status = 'pending'";
    $result = mysqli_query($conn, $str);
    $row = mysqli_fetch_array($result);
    $total_pending_requests = $row['total_pending_requests'];
  ?>
  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <!-- Dashboard Widgets Example -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-primary bg-gradient">
              <div class="inner">
                <h3><?php echo $total_users; ?></h3>
                <p>Total Users</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-users"></i>
              </div>
              <a href="user/index.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary bg-gradient">
              <div class="inner">
                <h3><?php echo $total_pets; ?></h3>
                <p>Total Pets</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-dog"></i>
              </div>
              <a href="pet/index.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info bg-gradient">
              <div class="inner">
                <h3><?php echo $total_messages; ?></h3>
                <p>Unread Contact Messages</p>
              </div>
              <div class="icon">
                <i class="fas fa-solid fa-comments"></i>
              </div>
              <a href="contact/index.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- <div class="col-lg-3 col-6">
            <div class="small-box bg-success bg-gradient">
              <div class="inner">
                <h3>53</h3>
                <p>Services</p>
              </div>
              <div class="icon">
                <i class="fas fa-concierge-bell"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning bg-gradient">
              <div class="inner">
                <h3><?php echo $total_pending_requests; ?></h3>
                <p>Pending Requests</p>
              </div>
              <div class="icon">
                <i class="fas fa-calendar-check"></i>
              </div>
              <a href="adoption/index.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php include "footer.php";?>
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
</body>
</html>
