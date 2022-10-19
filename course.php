<?php
    include "config.php";
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
    <link rel="stylesheet" href="course.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    
    <section class="header">
        <nav>
            <a href="course.php">
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
    </section>

    <section class="search-sect">
        <h1>HOUSE OF WISEDOM</h1>
        <P>Search for Course Material, Teaching Resources</P>
        <div class="resource">
            <form method="POST" id="search" class="search-group">
                <input type="text" name="info" class="input-field" placeholder="">
                <button type="submit" name="search-info" class="search-btn">Search</button>
            </form>
        </div>
    </section>


    <!------ Course  -------->

    <section class="course">
        <!--<div class="row">-->
            <!-- <div class="course-list">
                <div class="course-find">
                    <div class="heading">
                        <h3>Departments</h3>
                    </div>
                    <div class="dept">
                        <input type="checkbox" name="cse" class="check-box">
                        <span>Computer Science and Engineering</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Mechanical Engineering</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Civil Engineering</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Electrical and Electronic Engineering</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Industrial and Production Engineering</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Electronic and Telecomunication Engineering</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Glass and Ceramic Engineering</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Urban and Regional Planning</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Mechatronics Engineering</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Architecture</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Chemical and Food Processing Engineering</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Electrical and Computer Engineering</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Building Engineering and Construction Management</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Material Science and Engineering</span>
                    </div>
                </div>
                <div class="course-find">
                    <div class="heading">
                        <h3>Features</h3>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Lecture Videos</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Lecture Notes</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Slides</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Books & Notes</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Assignments</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Practice Problem</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>CT Question</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Semester Final Question</span>
                    </div>
                </div>
                <div class="course-find">
                    <div class="heading">
                        <h3>Topics</h3>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Mathematics</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Physics</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Chemistry</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Introductory Programming</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>English</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Aerospace Engineering</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Artificial Engineering</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Machine Learning</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Material Science</span>
                    </div>
                    <div class="dept">
                        <input type="checkbox" class="check-box">
                        <span>Data Processing</span>
                    </div>
                </div>
            </div>-->
            <div class="course-detail">
                <div class="up">
                    <h3>COURSES</h3>
                </div>
                <div class="column">
                    <?php

                    if(isset($_POST['search-info']))
                    {
                        $var = trim($_POST['info']);
                        $sql = "SELECT * FROM courses WHERE cid LIKE '%$var%' OR cname LIKE '%$var%' OR instructors LIKE '%$var%' OR topics LIKE '%$var%' OR series LIKE '$var'";
                       $result = mysqli_query($conn,$sql);

                    while($row = mysqli_fetch_assoc($result))
                    {
                        ?>

                    <a class="course-part" href="resource.php?course_id=<?php echo $row['course_id']?>">       
                    <div class="course-col">
                        <div> <img src="image/<?php echo $row['cimage'] ?>"> </div>
                        <div class="detail">
                            <h3><?php echo $row['cid']?> | UNDERGRADUATE | <?php echo $row['series'] ?> SERIES</h3>
                            <h1><?php echo $row['cname'] ?></h1>
                            <h3><?php echo $row['instructors'] ?></h3>
                            <h3><?php echo $row['topics'] ?></h3>
                        </div>
                    </div>
                    </a>
                    <?php
                    }
                    }
                    elseif(isset($_GET['info']))
                    {
                        $var = trim($_GET['info']);
                        $sql = "SELECT * FROM courses WHERE cid LIKE '%$var%' OR cname LIKE '%$var%' OR instructors LIKE '%$var%' OR topics LIKE '%$var%' OR series LIKE '$var'";
                       $result = mysqli_query($conn,$sql);

                    while($row = mysqli_fetch_assoc($result))
                    {
                        ?>

                    <a class="course-part" href="resource.php?course_id=<?php echo $row['course_id']?>">       
                    <div class="course-col">
                        <div> <img src="image/<?php echo $row['cimage'] ?>"> </div>
                        <div class="detail">
                            <h3><?php echo $row['cid']?> | UNDERGRADUATE | <?php echo $row['series'] ?> SERIES</h3>
                            <h1><?php echo $row['cname'] ?></h1>
                            <h3><?php echo $row['instructors'] ?></h3>
                            <h3><?php echo $row['topics'] ?></h3>
                        </div>
                    </div>
                    </a>
                    <?php
                    }
                    }
                    else
                    {
                    $sql = "SELECT * FROM courses";
                    $result = mysqli_query($conn,$sql);

                    while($row = mysqli_fetch_assoc($result))
                    {
                        ?>

                    <a class="course-part" href="resource.php?course_id=<?php echo $row['course_id']?>">       
                    <div class="course-col">
                        <div> <img src="image/<?php echo $row['cimage'] ?>"> </div>
                        <div class="detail">
                            <h3><?php echo $row['cid']?> | UNDERGRADUATE | <?php echo $row['series'] ?> SERIES</h3>
                            <h1><?php echo $row['cname'] ?></h1>
                            <h3>Instructors : <?php echo $row['instructors'] ?></h3>
                            <h3>Topics : <?php echo $row['topics'] ?></h3>
                        </div>
                    </div>
                    </a>

                    <?php
                    }

                    }

                    ?>
                </div>
            </div>
        <!--</div>-->
    </section>
     <!-----   Footer   ----->
     <section class="footer">

        <div class="last">
        <p>Made with <i class="fa fa-heart-o"></i> by Palash</p>

        </div>

     </section>
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