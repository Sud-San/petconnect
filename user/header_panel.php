<?php
    session_start();
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

<header class="bg-dark-pet shadow-lg p-4 w-full">
            <div class="w-full flex justify-between items-center flex-wrap px-4">
                <a class="text-white font-bold text-lg md:text-2xl flex items-center" style="text-decoration: none;" href="../index.php">
                    <i class="fas fa-paw text-white mr-2"></i> Pet Connect
                </a>
                <button id="nav-toggle" class="text-white md:hidden text-2xl">
                    <i class="fa fa-bars"></i>
                </button>
                <div id="nav-menu" class="hidden md:flex flex-col md:flex-row md:ml-auto w-full md:w-auto md:mt-0">
                    <ul class="navbar-nav flex flex-col md:flex-row md:space-x-4">
                        <li class="nav-item">
                            <a href="../index.php"  class="nav-link text-gray-300 text-lg hover:text-white transition-colors duration-200 p-2 block">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="../about.php" class="nav-link text-gray-300 text-lg hover:text-white transition-colors duration-200 p-2 block">About</a>
                        </li>
                        <li class="nav-item">
                            <a href="../pet.php" class="nav-link text-gray-300 text-lg hover:text-white transition-colors duration-200 p-2 block">Browse Pets</a>
                        </li>
                        <li class="nav-item">
                            <a href="../vet.php" class="nav-link text-gray-300 text-lg hover:text-white transition-colors duration-200 p-2 block">Veterinarian</a>
                        </li>
                        <li class="nav-item">
                            <a href="../gallery.php" class="nav-link text-gray-300 text-lg hover:text-white transition-colors duration-200 p-2 block">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a href="../contact.php" class="nav-link text-gray-300 text-lg hover:text-white transition-colors duration-200 p-2 block">Contact</a>
                        </li>
                        <li class="nav-item">
                           
                                <form action="" method="post">
                                    <button class="btn  nav-link text-gray-300 text-lg hover:text-white transition-colors duration-200 p-2 block" type="submit" name="logout">Logout</button>
                                </form>
                            
                        </li>
                    </ul>
                </div>
            </div>
        </header>
       