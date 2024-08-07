<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Vincent Witzmann">
    <meta name="keywords" content="NoteHub">
    <link rel="stylesheet" href="styles.css">
    <title>Create Account - NoteHub</title>
    <link rel="icon" type="image/png" href="./notehub_logo.png">
</head>
<body>

<div class="topnav">
    <nav>
        <img class="notehub_logo" src="./notehub_logo.png" alt="Logo">
        <div class="menu-icon fix">&#9776;</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="help.php">Help</a></li>
            <li><a href="login.html">Login</a></li>
        </ul>
    </nav>
</div>

<section class="create-account-content">
    <div class="logincontainer">
        <h1 class="loginh1">
            <span style="--i: 1;">C</span><span style="--i: 2;">r</span><span style="--i: 3;">e</span><span style="--i: 4;">a</span><span style="--i: 5;">t</span><span style="--i: 6;">e</span>
            </span><span style="--i: 10;">A</span><span style="--i: 11;">c</span><span style="--i: 12;">c</span><span style="--i: 13;">o</span><span style="--i: 14;">u</span><span style="--i: 15;">n</span><span style="--i: 16;">t</span>
        </h1>
        
        <form id="create-account-form" method="POST" class="login-form" action="create-account.php">
            <label for="username" class="loginlabel">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>
            
            <label for="password" class="loginlabel">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
 
            <!-- New password confirmation field -->
            <label for="confirm_password" class="loginlabel">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
            
            <input type="submit" value="Create">
        </form>

        <div id="error-message" style="color: red; font-weight: bold;"></div>

        <div class="login-options">
            Already have an account? <a href="login.html" class="login-options-create-label">Login</a>
        </div>
    </div>
</section>

<footer>
    <p class="footercontent">&copy; 2024 NoteHub. All rights reserved. <a href="impressum.php" class="footercontent">Impressum</a></p>
</footer>

<script>
    // JavaScript to display error message as a pop-up notification
    document.getElementById('create-account-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission

        const errorMessage = document.getElementById('error-message');
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        const confirm_password = document.getElementById('confirm_password').value;
        const uppercaseRegex = /[A-Z]/; // Regular expression to check for uppercase letter

        // Validating password
        if (password !== confirm_password) {
            errorMessage.innerText = "Password and confirmation password do not match";
            return;
        }
        if (!password.trim()) {
            errorMessage.innerText = "Password cannot be empty";
            return;
        }
        if (password.length < 4) {
            errorMessage.innerText = "Password must be at least 4 characters long";
            return;
        }
        if (!uppercaseRegex.test(password)) {
            errorMessage.innerText = "Password must contain at least one uppercase letter";
            return;
        }

        // Validating username
        if (!username.trim()) {
            errorMessage.innerText = "Username cannot be empty";
            return;
        }

        // Check if username already exists
        const request = new XMLHttpRequest();
        request.onload = function() {
            if (request.status === 200) {
                const response = JSON.parse(request.responseText);
                if (response.exists) {
                    errorMessage.innerText = "Username already exists. Please choose a different one.";
                } else {
                    // Submit the form if username is available
                    document.getElementById('create-account-form').submit();
                }
            }
        };
        request.open('GET', `check_username.php?username=${encodeURIComponent(username)}`);
        request.send();
    });

</script>



</body>
</html>