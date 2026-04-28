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
    <style>
        /* Custom styles for smooth transitions and font */
        body {
            font-family: 'Inter', sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        

        /* Form transition animation */
        .form-container {
            transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
            transform-origin: center;
        }
        
        .form-visible {
            opacity: 1;
            transform: scale(1);
            position: relative;
            pointer-events: auto;
        }
        .relative-container {
            position: relative;
            min-height: 400px; /* Adjust based on form height */
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="hold-transition sidebar-mini transition" id="mainBody">
<div class="wrapper">

    <?php ob_start(); ?>
    <?php include "../header_panel.php"; ?>
    <?php include "../../db/db.php"?>
    <?php
    if (isset($_POST['submit'])) {
        $petName = $_POST['petname'];
        $petType = $_POST['pettype'];
        // Sanitize input to prevent SQL injection
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];

        // Insert user into the database
        $sql = "INSERT INTO users (name, phone, gender, address, email, password) VALUES ('$firstName', '$phone', '$gender', '$address', '$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Pet added successfully!');</script>";
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Error adding pet: " . mysqli_error($conn) . "');</script>";
        }
    }
    ?>
    
  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Pets</h1>
          </div>
        </div>
      </div>


    <section class="content">
      <div class="container-fluid">
        <!-- <a href=""><button class="btn btn-primary">Add User</button></a><br> -->
        <!-- Dashboard Widgets Example -->
        <div class="row">
            <!-- Registration Form -->
        <form id="registerForm" class="form-container form-hidden" method="POST" action="">
            <div class="row mb-4">
                <div class="col-sm">
                    <label for="petname" class="block text-gray-700 text-sm font-bold mb-2">Pet Name</label>
                    <input id="petname" name="petname" placeholder="Pet Name" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" type="text">
                </div>
                <div class="col-sm">
                    <label for="pettype" class="block text-gray-700 text-sm font-bold mb-2">Pet Type</label>
                    <select name="pettype" id="pettype" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200">
                        <option value="" hidden selected>Select Pet Type</option>
                        <?php
                        $sql = "SELECT * FROM pettypes";
                        $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['pet_type_id'] . "'>" . $row['type_name'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-sm">
                    <label for="userid" class="block text-gray-700 text-sm font-bold mb-2">Owner id</label>
                    <input id="userid" onchange="fetchOwnerName(this.value)" name="userid" placeholder="Owner ID" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" type="text">
                </div>
                <div class="col-sm">
                    <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Owner Name</label>
                    <input type="text" name="username" id="username" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" placeholder="Owner Name" readonly>
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <label for="age" class="block text-gray-700 text-sm font-bold mb-2">Pet Age</label>
                <input type="number" min="1" max="50" value="1" maxlength="20" id="age" name="age" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" required>
            </div>
            <div class="mb-4">
                <label for="breed" class="block text-gray-700 text-sm font-bold mb-2">Pet's Breed</label>
                <input type="text" id="breed" name="breed" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" placeholder="Enter Pet's Breed" required>
            </div>
            <div class="mb-4">
                <label for="registerGender" class="block text-gray-700 text-sm font-bold mb-2">Gender</label>
                <select id="registerGender" name="gender" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200">
                    <option value="" hidden selected>Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <textarea name="description" rows="5" id="description" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" placeholder="Your Description" required></textarea>
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image</label>
                <input type="file" id="image" name="image" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" required>
            </div>
            <button type="submit" name="submit" class="w-full bg-[#00BD56] hover:bg-[#00A04C] text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transition-all duration-200 shadow-md">
                Add User
            </button>
        </form>      
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
    function fetchOwnerName(value) {
        $.ajax({
            url: 'fetch_owner_name.php',
            type: 'POST',
            data: { userid: value },
            success: function(response) {
                // Set the response as the textbox value
                $('#username').val(response);
            }
        });
    }
</script>
<script>
  document.getElementById('menuPets').classList.add('menu-open');
  document.getElementById('linkPets').classList.add('active');
  document.getElementById('linkPets').classList.add('bg-dark');

</script>

</body>
</html>
