<?php

include "config.php";
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}

    $insert = false;

    if(isset($_POST['submit']))
    {
        $cid1 = $_POST['cid'];
        $cid = strtoupper($cid1);
        $cname = $_POST['cname'];
        $series = $_POST['series'];
        $instructors = $_POST['instructors'];
        $topics = $_POST['topics'];
        $file = $_FILES['image'];

        $fileName = $_FILES['image']['name'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileError = $_FILES['image']['error'];
        $fileType = $_FILES['image']['type'];
                    
        $fileExt = explode('.',$fileName);
        $fileActualExt = strtolower(end($fileExt));
                    
        $allowed = array('jpg','jpeg','png');
        $fileNewName = uniqid('',true).".".$fileActualExt;
                    
        if(in_array($fileActualExt,$allowed))
        {
            if($fileError === 0)
            {
                if($fileSize < 1000000)
                {
                    $fileDestination = 'image/'.$fileNewName;
                    move_uploaded_file($fileTmpName,$fileDestination);
                }
            }
            }

            $sql = "INSERT INTO courses(cid,cname,series,instructors,topics,cimage)
            VALUES('$cid','$cname','$series','$instructors','$topics','$fileNewName');";

            $stmt = mysqli_query($conn,$sql);

            if($stmt){ 
                echo"
                <script>
                     alert('A new course is created!');
                     window.location.href = 'create.php';
                 </script>
                 ";
            }
            else{
                echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
            } 

            }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOUSE OF WISDOM</title>
    <link rel="stylesheet" href="create.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<section class="header">
        <nav>
            <a href="resource.php">
                <h1>HOUSEOFWISDOM</h1>
            </a>
            <div class="nav-links" id="navLinks">
            <i class="fa fa-times" onclick="hideMenu()"></i>
            <ul>
                <?php
                    $var = $_SESSION['id'];
                    $sql = "SELECT * FROM users WHERE id = $var ";
                    $result = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <div class="pro-image1">
                    <img src="profile/<?php echo $row['profile_picture'] ?>">
                    <p> <?php echo $row['username'] ?> </p>
                    <p> <?php echo $row['email'] ?> </p>
                    <hr>
                    </div>
                    <li><a href="welcome.php">HOME</a></li>
                    <li><a href="course.php">COURSE</a></li>
                    <div class="logout11">
                    <li><a href="logout.php">Log Out</a></li>
                    </div>
                </ul>
            </div>
            <div class="pro-image">
            <img src="profile/<?php echo $row['profile_picture'] ?>">
            </div>
            <div class="dropdown">
            <button class="link"> <?php echo $_SESSION['roll'] ?> </button>
            <?php
            if($row['role'] === '0')
            {
            ?>
            <div class="dropdown-menu">
                <img src="profile/<?php echo $row['profile_picture'] ?>">
                <h4> <?php echo $row['username'] ?> </h4>
                <h5> <?php echo $row['email'] ?> </h5>
                <br>
                <form action="" method="POST">
                <div class="btn1">
                <button type="submit" name="logout" class="log-out"> Log Out </button>
                </div>
                <?php

                if(isset($_POST['logout']))
                {
                    header("location: logout.php");
                }

                ?>

                </form>
                
            </div>
            <?php
            }
            elseif($row['role'] === '1')
            {
            ?>
            <div class="dropdown-menu">
                <img src="profile/<?php echo $row['profile_picture'] ?>">
                <h4> <?php echo $row['username'] ?> </h4>
                <h5> <?php echo $row['email'] ?> </h5>
                <br>
                <a href="upload.php">  UPLOAD  </a> <br>
                <a href="create.php"> CREATE COURSE </a><br>
                <a href="request.php"> CR_REQUEST </a><br><br>
                <form action="" method="POST">
                <div class="btn1">
                <button type="submit" name="logout" class="log-out"> Log Out </button>
                </div>
                <?php

                if(isset($_POST['logout']))
                {
                    header("location: logout.php");
                }

                ?>

                </form>
                
            </div>
            <?php
            }
            elseif($row['role'] === '2')
            {
            ?>
            <div class="dropdown-menu">
                <img src="profile/<?php echo $row['profile_picture'] ?>">
                <h4> <?php echo $row['username'] ?> </h4>
                <h5> <?php echo $row['email'] ?> </h5>
                <br>
                <a href="superadmin.php">  CR_LIST  </a> <br>
                <a href="superadmin.php">  CR_REQUEST  </a> <br><br>
                <form action="" method="POST">
                <div class="btn1">
                <button type="submit" name="logout" class="log-out"> Log Out </button>
                </div>
                <?php

                if(isset($_POST['logout']))
                {
                    header("location: logout.php");
                }

                ?>

                </form>
                
            </div>
            <?php
            }
            ?>

            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>      
    </section>

    <section class="upload">

        <h1>CREATE A COURSE</h1>
        <div class="content">

            <form action="" method="POST" enctype="multipart/form-data" class="content_upload">

                <label class="label1">Course No.</label><br/>
                <input type="text" name="cid" class="input-field"required><br/>

                <label>Course Name</label><br/>
                <input type="text" name="cname" class="input-field"required><br/>

                <label>Series</label><br/>
                <input type="text" name="series" class="input-field"required><br/>

                <label>Instructors</label><br/>
                <input type="text" name="instructors" class="input-field"required><br/>

                <label>topics</label><br/>
                <input type="text" name="topics" class="input-field"required><br/>

                
                <label>Add a Image</label><br/>
                <input type="file" name="image" class="input-file"required><br/>

                <button type="submit" name="submit" class="course-btn">Create</button>


            </form>


        </div>

    </section>

</body>
</html>