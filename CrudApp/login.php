<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<?php
session_start();
require_once "index.php";
if (isset($_POST['username'])){
    $username = stripcslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($conn, $username);
    $password = stripcslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);
    // Check to confirm if user exists
    $sql = "SELECT * FROM 'users' WHERE username = ' .$username.' AND password = '" .md5($password)  . "'";
    $result= mysqli_query($conn,$sql);
    $rows = mysqli_num_rows($result);
    if ($rows == 1){
        $_SESSION['username'] =$username;
        //Direct the user to the Dashboard
        header("Location: dashboard.php");
    }
    else{
        echo "<h3> Details does not match.</h3><br>
        <p class='link'>Click here <a href='login.php'> to Login</a> again</p> ";
    }
}
else{
?>
    <form method="post">
        <div class="container">
            <h1>Basic Crud Application - Login</h1>
            <p>Please fill in this form to Login.</p>
            <hr>
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" id="username" required><br>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="password" required><br>

            <button type="submit" name="submit" value="Login" class="loginbtn">Login</button>
        </div>

        <div class="container signin">
            <p>Already have an account? <a href="login.php">Login </a></p>
        </div>
        <p class="link"><a href="register.php">Register Here</a></p>
    </form>
<?php
    }
?>
</body>
</html>

