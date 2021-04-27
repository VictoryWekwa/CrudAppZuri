<?php
include("auth_sess.php");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

    <form>
        <div class="container">
            <h1>Basic Crud Application - DASHBOARD</h1>
            <h3>Welcome to your Dashboard.</h3>
            <p>Hello, <?php echo $_SESSION['username']; ?>!</p>
            <p> You have successfully reggistered </p>
            <p><a href="logout.php">logout</a></p>
        </div>
    </form>
</body>
</html>