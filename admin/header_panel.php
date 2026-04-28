<head>
  <title>Pet Connect Admin Panel</title>
  <link rel="icon" href="../images/paw.png">
</head>
<?php
  session_start();
  
  if(!isset($_SESSION['aname']))
  {
    header('Location:login.php');
    exit();
  }
  if(isset($_POST['logout']))
  {
    unset($_SESSION['aname']);
    header('Location:login.php');
  }
?>
<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Welcome <?php echo "admin"; //echo $_SESSION['username']; ?></a>
      </li>
  </nav>

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
      <i class="fas fa-paw mx-2"></i>
      <span class="brand-text font-weight-light" style="font-weight: bolder;">Pet Admin</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
          <li class="nav-item">
            <a href="index.php" class="nav-link bg-success">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <!-- Users menu with sub-options -->
          <li id="menuUsers" class="nav-item has-treeview">
            <a href="#" id="linkUsers" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="user/index.php" class="nav-link">
                   &nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-circle nav-icon"></i>
                  <p>All Users</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="user/create.php" class="nav-link">
                  &nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-circle nav-icon"></i>
                  <p>Add New User</p>
                </a>
              </li> -->
            </ul>
          

          <!-- Pets -->
          <li id="menuPets" class="nav-item">
            <a href="#" id="linkPets" class="nav-link ">
              <i class="nav-icon fas fa-dog"></i>
              <p>Pets
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview ">
              <li class="nav-item">
                <a href="pet/index.php" class="nav-link">
                  &nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-circle nav-icon"></i>
                  <p>All Pets</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pet/type.php" class="nav-link">
                  &nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-circle nav-icon"></i>
                  <p>Pet Types / Breeds</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="pet/create.php" class="nav-link">
                  &nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-circle nav-icon"></i>
                  <p>Add New Pets</p>
                </a>
              </li> -->
            </ul>
          <!-- Contact Messages -->
          <li id="menuContact" class="nav-item">
            <a id="linkContact" href="#" class="nav-link">
              <i class="nav-icon fas fa-envelope"></i>
              <p>Contact Messages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="contact/index.php" class="nav-link">
                  &nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-circle nav-icon"></i>
                  <p>All Messages</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="contact/seen.php" class="nav-link">
                  &nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-circle nav-icon"></i>
                  <p>Seen Messages</p>
                </a>
                </li> -->
            </ul>
          
          <!-- Adoption Requests -->
          <li id="menuAdoption" class="nav-item">
            <a id="linkAdoption" href="#" class="nav-link">
              <i class="nav-icon fas fa-paw"></i>
              <p>Adoption Requests
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="adoption/index.php" class="nav-link">
                  &nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-circle nav-icon"></i>
                  <p>Pending Requests</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="adoption/approved.php" class="nav-link">
                  &nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-circle nav-icon"></i>
                  <p>Approved Requests</p>
                </a>
                </li> -->
            </ul>
          
          <li class="nav-item">
            <form action="" method="post">
            <button name="logout" type="submit" class="nav-link bg-danger">
              <i class="nav-icon fas fa-solid fa-power-off"></i>
              <p>Logout</p>
            </button>
            </form>
          <li>
        </ul>
      </nav>
    </div>
  </aside>