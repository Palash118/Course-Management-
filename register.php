<?php
require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Username cannot be blank";
    }
    else{
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken"; 
                }
                else{
                    $username = trim($_POST['username']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);


// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "Passwords should match";
}


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
{
    $roll = trim($_POST['roll']);
    $series = trim($_POST['series']);
    $email = trim($_POST['email']);
    $file = $_FILES['profile'];
    $v_code = bin2hex(random_bytes(16));

    $fileName = $_FILES['profile']['name'];
    $fileTmpName = $_FILES['profile']['tmp_name'];
    $fileSize = $_FILES['profile']['size'];
    $fileError = $_FILES['profile']['error'];
    $fileType = $_FILES['profile']['type'];

    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png');

    if(in_array($fileActualExt,$allowed))
    {
        if($fileError === 0)
        {
            if($fileSize < 1000000)
            {
                $fileNameNew = uniqid('',true).".".$fileActualExt;
                $fileDestination = 'profile/'.$fileNameNew;
                move_uploaded_file($fileTmpName,$fileDestination);
            }
        }
        }

    $sql = "INSERT INTO users (username,roll,series,email, password,profile_picture,v_code,verified) VALUES (?,?,?,?,?,?,?,?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ssssssss", $param_username,$param_roll,$param_series,$param_email, $param_password,$param_profile,$param_code,$param_verfied);

        // Set these parameters
        $param_username = $username;
        $param_roll = $roll;
        $param_series = $series;
        $param_email = $email;
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        $param_profile = $fileNameNew;
        $param_code = $v_code;
        $param_verfied = '0';

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            $receiver = $email;
            $subject = "Verification Of Email";
            $body = "For Verification, Please Click the verify link
            <a href='http://localhost/practice_project/verify.php?email=$email & v_code=$v_code'>Verify</a>";
            $header = "From:palashislam1049@gmail.com \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";
            if(mail($receiver, $subject, $body, $header)){
                echo"
                <script>
                     alert('Registration is Successful! Please Verify your Email');
                     window.location.href = 'login.php';
                 </script>
                 ";
            }else{
                echo "<script>
                alert('Something went wrong... cannot redirect!');
                window.location.href = 'login.php';
            </script>";
            }
            //header("location: login.php");
        }
        else{
            echo "<script>
                alert('Something went wrong... cannot redirect!');
                window.location.href = 'login.php';
            </script>";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=auto, initial-scale=1.0">
    <title>HOUSE OF WISEDOM</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="first">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn">Register</button>
            </div>
            <form action="register.php" method="POST" id="register" class="input-group" enctype="multipart/form-data">
                
                    <input type="text" name="username" class="input-field" placeholder="User Name" required>
                    <input type="text" name="roll" class="input-field" placeholder="Roll" required>
                    <input type="text" name="series" class="input-field" placeholder="Series" required>
                    <!--<input type="text" class="input-field" placeholder="Department" required>-->
                    <input type="email" name="email" class="input-field" placeholder="Email" required>
                
                    <input type="password" name="password" class="input-field" placeholder="Enter Password" required>
                    <input type="password" name="confirm_password" class="input-field" placeholder="Confirm Password" required><br>
                    <label id="picture" class="profile">Choose Your Profile Picture </label>
                    <input type="file" name="profile" class="profile"><br/>
                    <input type="checkbox" class="check-box" required>
                    <span>I agree to the terms & conditions</span>
                    <button type="submit" name="submit" class="submit-btn">Register</button>
                    <p>Already have a Account! <a href="login.php">Login Now </a></p>  
                    
            </form>
        </div>
    </div>

</body>
</html>