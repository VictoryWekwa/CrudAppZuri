<?php
session_start();
require_once "index.php"

if (!isset($_SESSION["loggedin"])||
$_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}
$new_password = $passw=" ";
$new_password_err = $passw_err = " ";
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    if ($_POST["new_password"]){
        $new_password_err = "Enter new password.";
    }
    elseif(strlen($_POST["new_password"])<6){
        $new_password_err ="Your password must be greater than 6 characters.";
    }
    else {
        $new_password = $_POST["new_password"];
    }
    if (empty($_POST["passw"])){
        $passw_err="Confirm your password";
    }
    else{
        $passw = md5($_POST["passw"]);
        if (empty($new_password_err) && ($new_password !=$passw)){
            $passw_err= "Password do not match.";
        }
    }
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($passw_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $mysqli->close();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crud Application- Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $passw_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link ml-2" href="dashboard.php">Cancel</a>
            </div>
        </form>
    </div>    
</body>
</html>