<?php
//This script will handle login
session_start();

// Already logged in
if(isset($_SESSION['username']))
{
    header("location: welcome.php");
    exit;
}
require_once "config.php";

$username = $password = "";
$err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username + password";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT id, username,roll, password,verified FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $roll, $hashed_password,$verified);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password) && $verified === '1')
                        {
                            //Password is corrct and allow user to login
                            session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $id;
                            $_SESSION["roll"] = $roll;
                            $_SESSION["loggedin"] = true;

                            //Redirect to welcome page
                            header("location: welcome.php");
                            
                        }
                        else
                        {
                            echo"
                            <script>
                                alert('Please Enter username and Password Correctly');
                                window.location.href = 'login.php';
                            </script>
                            ";
                        }
                    }

                }
                else
                {
                    echo"
                            <script>
                                alert('Please Enter username and Password Correctly');
                                window.location.href = 'login.php';
                            </script>
                            ";
                }

    }
}    


}


?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=auto, initial-scale=1.0">
    <title>HOUSE OF WISEDOM</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="first">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn">Login</button>
            </div>
            <form action="login.php" method="POST" id="login" class="input-group">
                <input type="text" name="username" class="input-field" placeholder="User Name" required>
                <input type="password" name="password" class="input-field" id="myInput" placeholder="Enter Password" required>
                <input type="checkbox" onclick="myFunction()" class="check-box">
                <span>Show Password</span>
                <button type="submit" class="submit-btn">Log In</button>
                <p>Don't have a Account? <a href="register.php">Register Now </a></p>
            </form>
        </div>
    </div>

    <script>
        function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        }
    </script>
  
</body>
</html>