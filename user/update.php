<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
     
    <!-- Tailwind CSS CDN for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- Google Fonts for consistency -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        
        :root {
            --primary-color: #16a34a; /* A vibrant, friendly green */
            --dark-color: #153e2a;    /* A deep, professional forest green */
            --gray-light: #f0fdf4;   /* A light, soft green for the background */
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--gray-light);
        }

        .bg-dark-pet { background-color: var(--dark-color); }
        .text-dark-pet { color: var(--dark-color); }
        .bg-primary-pet { background-color: var(--primary-color); }
        .text-primary-pet { color: var(--primary-color); }

        /* The sidebar is now a fixed-position element on mobile */
        .sidebar {
            width: 250px;
            min-height: 100vh;
            transition: transform 0.3s ease-in-out;
            transform: translateX(0);
        }

        /* This class hides the sidebar on mobile by default */
        .sidebar.hidden-mobile {
            transform: translateX(-100%);
        }

        /* On larger screens, the sidebar is visible and part of the flow */
        @media (min-width: 768px) {
            .sidebar.hidden-mobile {
                transform: translateX(0);
            }
        }

        .main-content {
            flex-grow: 1;
        }

        .navbar-nav .nav-item {
            position: relative;
        }
    
    </style>
    
</head>
<body>
    <?php
    session_start();
    include "../db/db.php";
    if(!isset($_SESSION['uname']))
    {
        header('Location:../login.php');
        exit;
    }
    if(isset($_POST['logout']))
    {
        unset($_SESSION['uname']);
        header('Location:../login.php');
        exit;
    }
    include '../db/db.php';
    // Database query to fetch user-specific data
    $user_id = $_SESSION['uname'];
    // $user_id = "we@hj.lcrtr";
    $str = "SELECT * FROM users WHERE email = '$user_id'";
    $result = mysqli_query($conn, $str);
    $user_data = mysqli_fetch_assoc($result);
    // print_r($user_data); // Debugging line to check user data
    // die;
?>

    <header class="bg-dark-pet shadow-lg p-1 w-full">
            <div class="w-full flex justify-between items-center flex-wrap px-4">
                <a class="text-white font-bold text-lg md:text-2xl flex items-center" href="#">
                    <i class="fas fa-paw text-white mr-2"></i> Pet Connect
                </a>
                <button id="nav-toggle" class="text-white md:hidden text-2xl">
                    <i class="fa fa-bars"></i>
                </button>
                <div id="nav-menu" class="hidden md:flex flex-col md:flex-row md:ml-auto w-full md:w-auto mt-3 mb-3 md:mt-0">
                    <ul class="navbar-nav flex flex-col md:flex-row md:space-x-6">
                        <li class="nav-item">
                            <a href="../index.php" class="nav-link text-gray-300 hover:text-white transition-colors duration-200 p-1 block">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="../about.php" class="nav-link text-gray-300 hover:text-white transition-colors duration-200 p-1 block">About</a>
                        </li>
                        <li class="nav-item">
                            <a href="../pet.php" class="nav-link text-gray-300 hover:text-white transition-colors duration-200 p-1 block">Browse Pets</a>
                        </li>
                        <li class="nav-item">
                            <a href="../vet.php" class="nav-link text-gray-300 hover:text-white transition-colors duration-200 p-1 block">Veterinarian</a>
                        </li>
                        <li class="nav-item">
                            <a href="../gallery.php" class="nav-link text-gray-300 hover:text-white transition-colors duration-200 p-1 block">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a href="../contact.php" class="nav-link text-gray-300 hover:text-white transition-colors duration-200 p-1 block">Contact</a>
                        </li>
                        <li class="nav-item">
                           
                                <form action="" method="post">
                                    <button class="btn nav-link text-gray-300 hover:text-white transition-colors duration-200 p-1 block" type="submit" name="logout">Logout</button>
                                </form>
                            
                        </li>
                    </ul>
                </div>
            </div>
        </header>
       
    <br>
    <div class="wrapper">

    <?php ob_start(); ?>
    
    
    <?php
    if (isset($_POST['submit'])) {
        $firstName = $_POST['first'] ." " . $_POST['last'];
        //echo $firstName;
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];

        // Insert user into the database
        $sql = "UPDATE users SET name='$firstName', phone='$phone', gender='$gender', address='$address', email='$email', password='$password' WHERE email='$email'";
        if (mysqli_query($conn, $sql)) {
            echo "<script>
            Swal.fire({
                title: 'Success!',
                text: 'User updated successfully!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'index.php'; // Redirect to the user list page after successful update
                }
            });
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Error updating user: " . mysqli_error($conn) . "',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            </script>";
        }
    }
    ?>
    
  <!-- Content Wrapper -->
  

    <?php 
        $name=explode(' ',$user_data['name']);
    ?>
    <section class="content">
      <div class="container-fluid">
        <!-- <a href=""><button class="btn btn-primary">Add User</button></a><br> -->
        <!-- Dashboard Widgets Example -->
        <div class="row">
            <!-- Registration Form -->
        <form id="registerForm" class="form-container form-hidden" method="POST" action="">
            <div class="row mb-4">
                <div class="col-sm">
                    <label for="firstname" class="block text-gray-700 text-sm font-bold mb-2">First Name</label>
                    <input id="firstname" value="<?php echo $name[0]; ?>" name="first" placeholder="First Name" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" type="text">
                </div>
                <div class="col-sm">
                    <label for="lastname" class="block text-gray-700 text-sm font-bold mb-2">Surname</label>
                    <input id="lastname" value="<?php echo $name[1]; ?>" name="last" placeholder="Last Name" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" type="text">
                </div>
            </div>
            <div class="mb-4">
                <label for="registerMob" class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
                <input type="text" value="<?php echo $user_data['phone']; ?>" id="registerMob" name="phone" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" placeholder="XXXXXXXXXX" required>
            </div>
            <div class="mb-4">
                <label for="registerGender" class="block text-gray-700 text-sm font-bold mb-2">Gender</label>
                <select id="registerGender" name="gender" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200">
                    <option value="" hidden>Select Gender</option>
                    <option value="male" <?php echo ($user_data['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                    <option value="female" <?php echo ($user_data['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                    <option value="other" <?php echo ($user_data['gender'] == 'other') ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="registerAddress" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                <textarea name="address" rows="5" id="registerAddress" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" placeholder="Your Address" required><?php echo $user_data['address']; ?></textarea>
            </div>
            <div class="mb-4">
                <label for="registerEmail" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" value="<?php echo $user_data['email']; ?>" id="registerEmail" name="email" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" placeholder="your@example.com" required>
            </div>
            <div class="mb-4">
                <label for="registerPassword" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" id="registerPassword" name="password" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" placeholder="********" required>
            </div>
            <!-- <div class="mb-6">
                <label for="confirmPassword" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" placeholder="********" required>
                <p id="passwordMatchError" class="text-red-500 text-xs italic mt-2 hidden">Passwords do not match.</p>
            </div> -->
            <!-- Changed button color to #00BD56 -->
            <button type="submit" name="submit" class="w-full bg-[#00BD56] hover:bg-[#00A04C] text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transition-all duration-200 shadow-md">
                Update User
            </button>
        </form>   
        <div>&nbsp;</div>      
        </div>
      </div>
    </section>
  </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>


</body>
</html>