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
    <link rel="stylesheet" href="resource.css">
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


    <!------ Resource -------->

    <section class="resource">

        <?php

        $var = $_GET['course_id'];
        $sql = "SELECT * FROM courses WHERE course_id = $var";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class='course_name1'>
        <h1> <?php echo $row['cname'] ?> </h1>
        </div>

        <div class="row">

            <div id="myDIV" class="left">

                <button class="btn active" onclick="openlecture('lectureVideo')">Lecture Videos</button>
                <button class="btn" onclick="openlecture('lectureNote')">Lecture Notes</button>
                <button class="btn" onclick="openlecture('lectureSlide')">Slides</button>
                <button class="btn" onclick="openlecture('lectureBook')">Books & Notes</button>
                <button class="btn" onclick="openlecture('lectureAssignment')">Assignments</button>
                <button class="btn" onclick="openlecture('practiceProblem')">Practice Problems</button>
                <button class="btn" onclick="openlecture('ctQuestion')">CT Questions</button>
                <button class="btn" onclick="openlecture('semesterFinal')">Semester Final Questions</button>

            </div>

            <div class="right">


                    <div id="lectureVideo" class="lecture">
    
                    <ol class="or-list">
                        <?php

                            $var = $_GET['course_id'];

                            $sql = "SELECT * FROM lecture_video WHERE course_id = $var";
                            $result = mysqli_query($conn,$sql);
                            while($row = mysqli_fetch_assoc($result))
                            {
                                ?>

                                   <li class="list"> <a href="lecture_video/<?php echo $row['lectureVideo']?>"><?php echo $row['lectureVideo']?></a></li>

                        <?php
                            }
                        ?>
                        </ol>

                    </div>
                    <div id="lectureNote" class="lecture" style="display:none">
    
                    <ol class="or-list">
                        <?php

                            $var = $_GET['course_id'];

                            $sql = "SELECT * FROM lecture_note WHERE course_id='$var'";
                            $result = mysqli_query($conn,$sql);
                            while($row = mysqli_fetch_assoc($result))
                            {
                                ?>

                                   <li class="list"> <a href="lecture_note/<?php echo $row['lectureNote']?>"><?php echo $row['lectureNote']?></a></li>

                        <?php
                            }
                        ?>
                        </ol>
    
                    </div>
                    <div id="lectureSlide" class="lecture" style="display:none">
    
                    <ol class="or-list">
                        <?php

                            $var = $_GET['course_id'];

                            $sql = "SELECT * FROM slide WHERE course_id='$var'";
                            $result = mysqli_query($conn,$sql);
                            while($row = mysqli_fetch_assoc($result))
                            {
                                ?>

                                   <li class="list"> <a href="slide/<?php echo $row['lectureSlide']?>"><?php echo $row['lectureSlide']?></a></li>

                        <?php
                            }
                        ?>
                        </ol>
    
                    </div>
                    <div id="lectureBook" class="lecture" style="display:none">
    
                    <ol class="or-list">
                        <?php

                            $var = $_GET['course_id'];

                            $sql = "SELECT * FROM book_and_note WHERE course_id='$var'";
                            $result = mysqli_query($conn,$sql);
                            while($row = mysqli_fetch_assoc($result))
                            {
                                ?>

                                   <li class="list"> <a href="book/<?php echo $row['book']?>"><?php echo $row['book']?></a></li>

                        <?php
                            }
                        ?>
                        </ol>
    
                    </div>
                    <div id="lectureAssignment" class="lecture" style="display:none">
                        <ol class="or-list">
                        <?php

                            $var = $_GET['course_id'];

                            $sql = "SELECT * FROM assignment WHERE course_id='$var'";
                            $result = mysqli_query($conn,$sql);
                            while($row = mysqli_fetch_assoc($result))
                            {
                                ?>

                                   <li class="list"> <a href="assignment/<?php echo $row['assign']?>"><?php echo $row['assign']?></a></li>

                        <?php
                            }
                        ?>
                        </ol>
    
                    </div>
                    <div id="practiceProblem" class="lecture" style="display:none">
    
                    <ol class="or-list">
                        <?php

                            $var = $_GET['course_id'];

                            $sql = "SELECT * FROM practice_problem WHERE course_id='$var'";
                            $result = mysqli_query($conn,$sql);
                            while($row = mysqli_fetch_assoc($result))
                            {
                                ?>

                                   <li class="list"> <a href="practice_problem/<?php echo $row['problem']?>"><?php echo $row['problem']?></a></li>

                        <?php
                            }
                        ?>
                        </ol>
    
                    </div>
                    <div id="ctQuestion" class="lecture" style="display:none">
    
                    <ol class="or-list">
                        <?php

                            $var = $_GET['course_id'];

                            $sql = "SELECT * FROM ct_question WHERE course_id='$var'";
                            $result = mysqli_query($conn,$sql);
                            while($row = mysqli_fetch_assoc($result))
                            {
                                ?>

                                   <li class="list"> <a href="ct_question/<?php echo $row['ct']?>"><?php echo $row['ct']?></a></li>

                        <?php
                            }
                        ?>
                        </ol>
    
                    </div>
                    <div id="semesterFinal" class="lecture" style="display:none">
    
                    <ol class="or-list">
                        <?php

                            $var = $_GET['course_id'];

                            $sql = "SELECT * FROM semester_question WHERE course_id='$var'";
                            $result = mysqli_query($conn,$sql);
                            while($row = mysqli_fetch_assoc($result))
                            {
                                ?>

                                   <li class="list"> <a href="semester_question/<?php echo $row['semester']?>"><?php echo $row['semester']?></a></li>

                        <?php
                            }
                        ?>
                        </ol>
    
                    </div>

            </div>

        </div>  
    </section>
    <!-----   Footer   ----->
    <section class="footer">

        <div class="last">
        <p>Made with <i class="fa fa-heart-o"></i> by Palash</p>

        </div>

    </section>
    <script>

        var header = document.getElementById("myDIV");
        var btns = header.getElementsByClassName("btn");
        for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
        var current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");
        this.className += " active";
        });
    }

        function openlecture(name)
        {
            var i;
            var x = document.getElementsByClassName("lecture")
            for(i = 0; i < x.length; i++)
            {
                x[i].style.display = "none";
            }

            document.getElementById(name).style.display = "block";

        }

    </script>

    

</body>
</html>