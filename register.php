<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <!-- Use Tailwind CSS for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        /* Custom CSS variables for consistent colors */
        :root {
            --primary-color: #16a34a; /* A vibrant, friendly green */
            --dark-color: #153e2a;    /* A deep, professional forest green */
            --gray-light: #f0fdf4;   /* A light, soft green for the background */
        }
        body {
            background-color: var(--gray-light);
            font-family: 'Inter', sans-serif;
            /* background-color: #f3f4f6; */
        }
        /* Custom message box styles */
        .message-box {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            text-align: center;
            opacity: 0;
            transform: translate(-50%, -50%) scale(0.9);
            transition: all 0.3s ease-in-out;
        }
        .message-box.show {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">
        
    <!-- Custom message box for success/error messages -->
    <div id="messageBox" class="message-box hidden">
        <h3 id="messageTitle" class="text-xl font-bold mb-2"></h3>
        <p id="messageContent" class="text-gray-600 mb-4"></p>
        <button id="closeMessageBtn" class="bg-[#00BD56] hover:bg-[#00A04C] text-white font-bold py-2 px-4 rounded-lg focus:outline-none transition-all duration-200">
            OK
        </button>
    </div>

    <!-- Main Container -->
    <div class="bg-white p-8 rounded-2xl shadow-xl max-w-xl w-full">
        <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">Register</h1>
        
        <!-- The form with the novalidate attribute -->
        <form action="" method="post" id="registerForm" onsubmit="return validateForm()" class="form-container" autocomplete="off">   
            <div class="row mb-4 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                <div class="flex-1">
                    <label for="firstname" class="block text-gray-700 text-sm font-bold mb-2">First Name</label>
                    <input id="firstname" value="" name="first" placeholder="First Name" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" type="text">
                    <span id="firstname-error" class="text-red-500 text-xs italic mt-1"></span>
                </div>
                <div class="flex-1">
                    <label for="lastname" class="block text-gray-700 text-sm font-bold mb-2">Surname</label>
                    <input id="lastname" value="" name="last" placeholder="Last Name" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" type="text">
                    <span id="lastname-error" class="text-red-500 text-xs italic mt-1"></span>
                </div>
            </div>
            
            <div class="row mb-4 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                <div class="flex-1">
                    <label for="registerMob" class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
                    <input type="text" value="" id="registerMob" name="phone" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" placeholder="XXXXXXXXXX">
                    <span id="phone-error" class="text-red-500 text-xs italic mt-1"></span>
                </div>
                <div class="flex-1">
                    <label for="registerGender" class="block text-gray-700 text-sm font-bold mb-2">Gender</label>
                    <select id="registerGender" name="gender" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200">
                        <option value="" hidden selected>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                    <span id="gender-error" class="text-red-500 text-xs italic mt-1"></span>
                </div>
            </div>
            
            <div class="row mb-4 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                <div class="flex-1">
                    <label for="registerEmail" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input type="email" value="" id="registerEmail" name="email" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" placeholder="your@example.com">
                    <span id="email-error" class="text-red-500 text-xs italic mt-1"></span>
                </div>
                <div class="flex-1">
                    <label for="registerPassword" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" id="registerPassword" name="password" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" placeholder="********">
                    <span id="password-error" class="text-red-500 text-xs italic mt-1"></span>
                </div>
            </div>
            
            <div class="mb-4">
                <label for="registerAddress" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                <textarea name="address" rows="5" id="registerAddress" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" placeholder="Your Address"></textarea>
                <span id="address-error" class="text-red-500 text-xs italic mt-1"></span>
            </div>
            
            <div class="mb-4 text-center text-gray-600 text-sm">
                Already have an account? <a href="login.php" class="text-[#00BD56] hover:underline font-semibold">Sign in</a>
            </div>
            
            <button type="submit" name="submit" class="w-full bg-[#00BD56] hover:bg-[#00A04C] text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200 shadow-md">
                Register
            </button>
        </form>
    </div>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

     <?php
        ob_start(); 
        include 'db/db.php';
        ?>
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

        $emailCheck = "SELECT email FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $emailCheck);
        try{
            if (mysqli_num_rows($result) > 0) {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Registration Failed',
                            text: 'Email already exists. Please use a different email.',
                        }).then(() => {
                        window.history.back();
                        });
                    </script>";
            }else {
                //echo "<script>console.log('Email is unique, proceeding with registration.');</script>";
            }
            // Insert user into the database
            $sql = "INSERT INTO users (name, phone, gender, address, email, password) VALUES ('$firstName', '$phone', '$gender', '$address', '$email', '$password')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Registration Successful',
                        text: 'User added successfully!',
                    }).then(() => {
                        window.location.href = 'login.php';
                    });
                </script>";
            } else {
                echo "<script>alert('Error adding user: " . mysqli_error($conn) . "');</script>";
            }
        } catch (Exception $e) {
            echo "<script>alert('An error occurred: " . $e->getMessage() . "');</script>";
        }
    }
    ?>

    <script>
   
    function validateForm()
    {
            // Clear previous error messages by setting textContent to an empty string
            document.getElementById('firstname-error').textContent = '';
            document.getElementById('lastname-error').textContent = '';
            document.getElementById('phone-error').textContent = '';
            document.getElementById('gender-error').textContent = '';
            document.getElementById('email-error').textContent = '';
            document.getElementById('password-error').textContent = '';
            document.getElementById('address-error').textContent = '';

            let isValid = true;

            // Get the value of each input field
            const firstName = document.getElementById('firstname').value.trim();
            const lastName = document.getElementById('lastname').value.trim();
            const phone = document.getElementById('registerMob').value.trim();
            const gender = document.getElementById('registerGender').value;
            const email = document.getElementById('registerEmail').value.trim();
            const password = document.getElementById('registerPassword').value;
            const address = document.getElementById('registerAddress').value.trim();

            // Perform validation for each field and update the corresponding error span
            if (firstName === '') {
                isValid = false;
                document.getElementById('firstname-error').textContent = 'First name is required.';
            }
            
            if (lastName === '') {
                isValid = false;
                document.getElementById('lastname-error').textContent = 'Last name is required.';
            }

            // Regex for a 10-digit phone number
            if (phone === '' || !/^\d{10}$/.test(phone)) {
                isValid = false;
                document.getElementById('phone-error').textContent = 'A valid 10-digit phone number is required.';
            }

            if (gender === '') {
                isValid = false;
                document.getElementById('gender-error').textContent = 'Please select a gender.';
            }

            // Simple regex for email validation
            if (email === '' || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                isValid = false;
                document.getElementById('email-error').textContent = 'A valid email address is required.';
            }

            if (password === '') {
                isValid = false;
                document.getElementById('password-error').textContent = 'Password is required.';
            }

            if (address === '') {
                isValid = false;
                document.getElementById('address-error').textContent = 'Address is required.';
            }

            return isValid;
        }

</script>
</body>
</html>
