<?php
session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="en" class="black">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | QxBroker</title>
    <link rel="stylesheet" href="assets/css/style1.css">
    <link rel="stylesheet" href="assets/css/style2.css">
    <link rel="stylesheet" href="assets/css/style8.css">
    <style>
        /* Styles for login and registration page */
        .page-container {
            display: flex;
            height: 100vh;
            width: 100%;
            background-color: #1E1E2F;
        }
        
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50%;
            padding: 20px;
            z-index: 1;
            background-color: #1E1E2F;
        }
        
        .form-box {
            background-color: #2B2D42;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            padding: 35px 25px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            color: #FFFFFF;
        }

        .form-title {
            font-size: 24px;
            margin-bottom: 25px;
            color: #FFFFFF;
        }

        .form-input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #3A3D55;
            border-radius: 5px;
            background-color: #3A3D55;
            color: #FFFFFF;
        }

        .form-input::placeholder {
            color: #B0B3C7;
        }

        .form-button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background-color: #3F72AF;
            color: #FFFFFF;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-button:hover {
            background-color: #5073B8;
        }

        .form-link {
            display: block;
            margin-top: 15px;
            font-size: 14px;
            text-decoration: none;
            transition: color 0.3s;
        }

        .register-link {
            color: #FFD369;
        }

        .login-link {
            color: #00ADB5;
        }

        .register-link:hover {
            color: #FFB800;
        }

        .login-link:hover {
            color: #65C1C9;
        }

        /* Forex-related background */
        .background-image {
            width: 80%;
            background-image: url('assets/forex_login.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: brightness(0.8);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .page-container {
                flex-direction: column;
            }
            .background-image {
                display: none;
            }
            .form-container {
                width: 100%;
            }
            .form-box {
                padding: 30px 20px;
                width: 90%;
            }
            .form-title {
                font-size: 20px;
            }
        }
    </style>
    <script>
        function showRegisterForm() {
            document.getElementById("login-form").style.display = "none";
            document.getElementById("register-form").style.display = "block";
        }

        function showLoginForm() {
            document.getElementById("register-form").style.display = "none";
            document.getElementById("login-form").style.display = "block";
        }
    </script>
</head>
<body class="loading">
    <div class="page-container">
        <!-- Form Section -->
        <div class="form-container">
            <!-- Login Form -->
            <div id="login-form" class="form-box">
                <h1 class="form-title">Login to QxBroker</h1>
                <?php
                // Check if success message is set in session
                if (isset($_SESSION['success_message'])) {
                    echo '<p class="success-message">' . $_SESSION['success_message'] . '</p>';
                    unset($_SESSION['success_message']); // Clear the message after displaying it
                }
                ?>
                <form action="login_processor" method="POST">
                    <input type="text" name="username" placeholder="Username" class="form-input" required>
                    <input type="password" name="password" placeholder="Password" class="form-input" required>
                    <button type="submit" class="form-button">Login</button>
                    <a href="forgot_password" class="form-link login-link">Forgot Password?</a>
                    <a href="javascript:void(0);" class="form-link register-link" onclick="showRegisterForm()">New to QxBroker? Register here</a>
                </form>
            </div>
                
            <!-- Registration Form -->
            <div id="register-form" class="form-box" style="display: none;">
                <h1 class="form-title">Register for QxBroker</h1>
                <form action="register" method="POST">
                    <input type="text" name="firstname" placeholder="First Name" class="form-input" required>
                    <input type="text" name="lastname" placeholder="Last Name" class="form-input" required>
                    <input type="text" name="username" placeholder="Username" class="form-input" required>
                    <input type="email" name="email" placeholder="Email" class="form-input" required>
                    <!-- Country Dropdown -->
                    <select id="country-select" name="country" class="form-input" required>
                        <option value="">Select Country</option>
                    </select>

                    <!-- Hidden input for country code -->
                    <input type="hidden" id="country-code" name="country_code" value="">
                    <input type="text" name="mobile" placeholder="Mobile Number" class="form-input">
                    <input type="password" name="password" placeholder="Password" class="form-input" required>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-input" required>
                    <button type="submit" class="form-button">Register</button>
                    <a href="javascript:void(0);" class="form-link login-link" onclick="showLoginForm()">Already registered? Login here</a>
                </form>
            </div>
        </div>
        
        <!-- Background Image Section -->
        <div class="background-image"></div>
    </div>
</body>
<script>
        // Fetch countries from REST Countries API
        fetch('https://restcountries.com/v3.1/all')
            .then(response => response.json())
            .then(data => {
                const countrySelect = document.getElementById('country-select');
                data.forEach(country => {
                    // Populate dropdown with country names and codes
                    let option = document.createElement('option');
                    option.value = country.cca2; // Use ISO Alpha-2 code
                    option.textContent = country.name.common;
                    option.setAttribute('data-country-code', country.idd?.root + (country.idd?.suffixes ? country.idd.suffixes[0] : ''));
                    countrySelect.appendChild(option);
                });

                // Update hidden country code input on country selection
                countrySelect.addEventListener('change', function() {
                    const selectedOption = countrySelect.options[countrySelect.selectedIndex];
                    const countryCode = selectedOption.getAttribute('data-country-code');
                    document.getElementById('country-code').value = countryCode || '';
                });
            })
            .catch(error => console.error('Error fetching country data:', error));
    </script>
</html>