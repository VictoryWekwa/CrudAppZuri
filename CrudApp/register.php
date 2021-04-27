<?php
session_start();
require_once "index.php";
if (isset($_POST['register'])){
    unset($error);
    $username = $mysqli -> real_escape_string(($_POST["username"])); 
    $email= $mysqli-> real_escape_string(($_POST["email"]));
    $password = $mysqli -> md5($_POST["password"]);
    $sql = "INSERT into 'users' (username, email, password) VALUES ('$username', '$email', '" . md5($password) . "')";
    $result = $mysqli_query($conn,$sql);
    if ($result) {
        echo "<h3> You have successfully registered.</h3>
        <p class='link'>Click here to <a href='login.php'>Login</a></p>";
    }
    else {
        echo "<h3>You must fill in your details</h3><br>
        <p class='link'>Click here to <a href='register.php'>Register</a>again</p>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

    <form method="post">
        <div class="container">
            <h1>Basic Crud Application - Register</h1>
            <p>Please fill in this form to register.</p>
            <hr>
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" id="username" required><br>

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" id="email" required><br>


            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="password" required><br>

            <button type="submit" name="submit" class="registerbtn">Register</button>
        </div>

        <div class="container signin">
            <p>Already have an account? <a href="login.php">Login </a></p>
        </div>
    </form>

</body>
</html>