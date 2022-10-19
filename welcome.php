<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOUSE OF WISDOM</title>
    <link rel="stylesheet" href="home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body{
            background-color: white;
        }
    </style>
</head>
<body>
    
    <section class="header">
        <nav>
            <a href="">
                <h1>HOUSEOFWISDOM</h1>
            </a>
            <div class="nav-links" id="navLinks">
            <i class="fa fa-times" onclick="hideMenu()"></i>
                <ul>
                <?php
                    include 'config.php';
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
                <div class="btn">
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
                <div class="btn">
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
                <div class="btn">
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
        <form action="course.php" method="POST" id="search" class="search-group">

            <input type="text" name="info" class="input-field" placeholder="">
            <button type="submit" name="search-info" class="search-btn">Search</button>

        </form>
        <?php

        if(isset($_POST['search-info']))
        {
            $info = $_POST['info'];
            header("location:course.php?info=$info");
        }

        ?>
    </section>

    <section class="feature-course">

        <h1>Featured Courses</h1>
        <p>Completed Course Materials and Teaching Resources</p>

        <div class="row">
            <?php
                $sql = "SELECT * FROM courses ORDER BY cur_time DESC LIMIT 4";
                $result = mysqli_query($conn,$sql);

                while($row = mysqli_fetch_assoc($result))
                {
                    ?>

            <a class="course-part" href="resource.php?course_id=<?php echo $row['course_id']?>">       
            <div class="course-col">
                <img src="image/<?php echo $row['cimage'] ?>">
                <h3><?php echo $row['cid']?> | UNDERGRADUATE | <?php echo $row['series'] ?> SERIES</h3>
                <h1><?php echo $row['cname'] ?></h1>
                <h3>Instructors : <?php echo $row['instructors'] ?></h3>
                <h3>Topics : <?php echo $row['topics'] ?></h3>
            </div>
                </a>

            <?php

                }

            ?>
        </div>

    </section>

    <!----   New Courses  ---->

    <section class="new-courses">

        <h1>New Courses</h1>
        <p>Ongoing Course Materials and Teaching Resources</p>
        <div class="row">
            <?php

                $sql = "SELECT * FROM courses ORDER BY cur_time DESC LIMIT 4";
                $result = mysqli_query($conn,$sql);

                while($row = mysqli_fetch_assoc($result))
                {
                    ?>

            <a class="course-part" href="resource.php?course_id=<?php echo $row['course_id']?>">       
            <div class="course-col">
                <img src="image/<?php echo $row['cimage'] ?>">
                <h3><?php echo $row['cid']?> | UNDERGRADUATE | <?php echo $row['series'] ?> SERIES</h3>
                <h1><?php echo $row['cname'] ?></h1>
                <h3>Instructors : <?php echo $row['instructors'] ?></h3>
                <h3>Topics : <?php echo $row['topics'] ?></h3>
            </div>
                </a>

            <?php

                }

            ?>
        </div>

    </section>

    <section class="science-courses">

        <h1>Science</h1>
        <p>Science Based Course Material and Teaching Resources</p>
        <div class="row">
            <?php

                $sql = "SELECT * FROM courses WHERE cid LIKE '%PHY%' OR cid LIKE '%CHE%' OR cid LIKE '%MATH%'";
                $result = mysqli_query($conn,$sql);

                while($row = mysqli_fetch_assoc($result))
                {
                    ?>

            <a class="course-part" href="resource.php?course_id=<?php echo $row['course_id']?>">       
            <div class="course-col">
                <img src="image/<?php echo $row['cimage'] ?>">
                <h3><?php echo $row['cid']?> | UNDERGRADUATE | <?php echo $row['series'] ?> SERIES</h3>
                <h1><?php echo $row['cname'] ?></h1>
                <h3>Instructors : <?php echo $row['instructors'] ?></h3>
                <h3>Topics : <?php echo $row['topics'] ?></h3>
            </div>
                </a>

            <?php

                }

            ?>
        </div>
    </section>
    <!-----   Discover Collections   ----->

    <section class="collections">
        <h1>Discover Collections</h1>
        <div class="row-collection">
            <div class="para">
                <p>Some Important topics which are very impotant for all Engineering Students. Complete the topics and Bright your Future</p>
            </div>
            <div class="discover">
                <ul>
                    <div class="intro"><li><a href="">English</a></li></div>
                    <div class="intro"><li><a href="">Physics</a></li></div>
                    <div class="intro"> <li><a href="">Humanities</a></li></div>
                    <div class="intro"><li><a href="">Chemistry</a></li></div>
                    <div class="intro"><li><a href="">Introductory Programming</a></li></div>
                    <div class="intro"><li><a href="">Python</a></li></div>

                </ul>
            </div>
        </div>
    </section>

     <!-----   Footer   ----->

     <section class="footer">

        <div class="last">
        <p>Made with <i class="fa fa-heart-o"></i> by Palash</p>

        </div>

     </section>

    <?php
    $var = $_SESSION['id'];
    $sql = "SELECT * FROM users WHERE id = $var ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    if($row['role'] === '0' || $row['role'] === '1')
    {
    ?>
    <button id="myBtn">Feedback</button>

    <!-- The Modal -->
    <div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
    <div class="modal-header">
        <span class="close">&times;</span>
        <h2>Give us a feedback </h2>
    </div>
    <div class="modal-body">
        <form  method="POST" id="register" class="input-group" enctype="multipart/form-data">
                
            <label class="feed">Roll </label><br>
            <input type="text" name="roll1" class="comment" placeholder="Enter Your Roll" required><br><br>
            <label class="feed">Email </label><br>
            <input type="text" name="email1" class="comment" placeholder="Enter Your Email" required><br><br>
            <label class="feed">Comments </label><br>
            <textarea rows="7" cols="80" class="com" name="comment1" placeholder="Enter Your Comment"></textarea><br><br>
            <button type="submit" name="com1" class="log-out"> Submit </button><br><br>
                
        </form>
        <?php

        if(isset($_POST['com1']))
        {
            $email = $_POST['email1'];
            $roll = $_POST['roll1'];
            $comment = $_POST['comment1'];
            $to = "palashislam1049@gmail.com";
            $body = $comment;
            $header = "From : $email";
            if(mail($to,"Feedback",$comment,$header))
            {
                echo"
                            <script>
                                alert('Thanks for your comments!');
                                window.location.href = 'login.php';
                            </script>
                            ";
            }
        }


        ?>
        </div>
    </div>

    </div>
    <?php
    }
    ?>

    <script>
    
    var modal = document.getElementById("myModal");

    var btn = document.getElementById("myBtn");
   
    var span = document.getElementsByClassName("close")[0];
  
    btn.onclick = function() {
    modal.style.display = "block";
    }
   
    span.onclick = function() {
    modal.style.display = "none";
    }
   
    window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    }
    </script>

    <script>

        var navLinks = document.getElementById("navLinks");
        function showMenu(){
            navLinks.style.right = "0";
        }
        function hideMenu(){
            navLinks.style.right = "-300px";
        }

    </script>

</body>
</html>