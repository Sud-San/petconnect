<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Pet Connect</title>
    
    <!-- Tailwind CSS CDN for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- Google Fonts for consistency -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <style>
        /* Custom CSS variables for consistent colors */
        :root {
            --primary-color: #16a34a; /* A vibrant, friendly green */
            --dark-color: #153e2a;    /* A deep, professional forest green */
            --gray-light: #f0fdf4;   /* A light, soft green for the background */
        }

        /* Basic body styling to match the dashboard */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--gray-light);
            /* Centering the login card on the screen */
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .bg-primary-pet { background-color: var(--primary-color); }
        .text-primary-pet { color: var(--primary-color); }

        /* Style for the message box */
        .message-box {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: bold;
            z-index: 1000;
            display: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        .message-box.success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .message-box.error {
            background-color: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body>
        <?php
            ob_start();
		    session_start();
        ?>
    <!-- Message Box for Feedback -->
    <div id="message-box" class="message-box"></div>

    <!-- Main login card container -->
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm mx-4">
        <div class="flex flex-col items-center mb-6">
            <!-- Site Logo/Icon -->
            <div class="bg-primary-pet p-4 rounded-full mb-4">
                <i class="fas fa-paw text-white text-3xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Welcome Back!</h2>
            <p class="text-gray-500 text-sm">Sign in to your account</p>
        </div>

        <!-- Login Form -->
        <!-- The form action is updated to point to a PHP script and the method is set to POST -->
        <form id="login-form" action="login.php" method="POST">
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email Address</label>
                <input type="text" id="email" name="email" placeholder="you@example.com" class="shadow-sm appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-pet focus:border-transparent">
                <p id="email-error" class="text-red-500 text-xs italic mt-1" style="display:none;"></p>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••" class="shadow-sm appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-pet focus:border-transparent">
                <p id="password-error" class="text-red-500 text-xs italic mt-1" style="display:none;"></p>
            </div>
            
            <!-- <div class="flex items-center justify-between mb-6">
                <a href="#" class="inline-block align-baseline font-semibold text-sm text-primary-pet hover:text-dark-pet">
                    Forgot Password?
                </a>
            </div> -->

            <!-- Login Button -->
            <button name="submit" type="submit" class="bg-primary-pet hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg w-full focus:outline-none focus:shadow-outline transition-colors duration-200">
                Sign In
            </button>
        </form>

        <!-- <div class="mt-6 text-center text-sm">
            <p class="text-gray-600">Don't have an account? 
                <a href="register.php" class="text-primary-pet hover:text-dark-pet font-semibold transition-colors duration-200">Register here</a>
            </p>
        </div> -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <?php
       
		include '../db/db.php';
        try {
		if(isset($_POST['submit']))
		{
			
			$str="select * from staff where username='".$_POST['email']."' and password='".$_POST['password']."'";
			$n=mysqli_query($conn,$str);
			if(mysqli_num_rows($n) > 0)
			{
				$_SESSION['aname']=$_POST['email'];
				header('Location:index.php');
				exit;
			}echo "<script>Swal.fire({
                        icon: 'error',
                        title: 'Login Failed',
                        text: 'Invalid email or password. Please try again.',
                        confirmButtonColor: '#16a34a'
                    });</script>";
		}
    } catch (Exception $e) {
            echo "<script>Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred: " . $e->getMessage() . "',
                        confirmButtonColor: '#16a34a'
                    });</script>";
        }

	?>

    <script>
        // Function to show a message box
        function showMessage(message, type) {
            const msgBox = document.getElementById('message-box');
            msgBox.textContent = message;
            msgBox.className = `message-box ${type}`;
            msgBox.style.display = 'block';

            // Hide the message after 3 seconds
            setTimeout(() => {
                msgBox.style.display = 'none';
            }, 3000);
        }

        // JavaScript for form validation and handling
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('login-form');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const emailError = document.getElementById('email-error');
            const passwordError = document.getElementById('password-error');

            form.addEventListener('submit', (e) => {
                let isValid = true;
                
                // Reset error messages
                emailError.style.display = 'none';
                passwordError.style.display = 'none';

                // Email validation
                if (emailInput.value.trim() === '' || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value.trim())) {
                    emailError.textContent = "Valid email address is required.";
                    emailError.style.display = 'block';
                    isValid = false;
                }


                // Password validation
                if (passwordInput.value.trim() === '') {
                    passwordError.textContent = "Password is required.";
                    passwordError.style.display = 'block';
                    isValid = false;
                }

                // Only prevent default if validation fails
                if (!isValid) {
                    e.preventDefault(); 
                    showMessage("Please fill in all required fields.", "error");
                }
            });
        });
    </script>
</body>
</html>
